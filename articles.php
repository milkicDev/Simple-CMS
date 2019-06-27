<?php
//
//  index.php
//  Simple CMS
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	require_once 'config.php';

	$page = "List Articles";

	if (!ISSET($_SESSION['user'])) {
		header('LOCATION: '. URL .'/login');
	}

	if ($_GET['action'] === 'all' && $User_Class->getData['role'] >= 2) {
		$apiURL = URL .'/api/read/articles';
	} else if ($_GET['action'] === 'update' && $_GET['id'] !== null) {
		$apiURL = URL .'/api.php?action=read&tb=articles&id='. $_GET['id'];
	} else {
		$apiURL = URL .'/api.php?action=read&tb=articles&user='. $User_Class->getData['ID'];
	}

	$Artices_data = json_decode(file_get_contents($apiURL));

	if (ISSET($_GET['id'], $Artices_data->error_message)) {
		header('LOCATION: '. URL .'/articles');
	}
?>

<!doctype html>
<html lang="en">
	
	<?php include_once 'includes/head.php'; ?>

	<body>

		<?php include_once 'includes/header.php'; ?>

		<div class="container">
			<div class="card mb-3 text-center">
				<div class="card-header">
					<h5>ARTICLES TABLE <sup><a href="<?php echo URL; ?>/articles/insert">ADD NEW</a></sup><h5>
					<p id="message"></p>
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<td scope="col">ID</td>
							<td scope="col">Title</td>
							<td scope="col">Body</td>
							<td scope="col">Author</td>
							<td scope="col">Action</td>
						</tr>

						<?php
							foreach ($Artices_data as $key => $value) {
								if (ISSET($Artices_data->error_message)) {
									echo '
										<tr class="text-center">
											<td colspan="5">'. $Artices_data->error_message .'</td>
										</tr>';
								} else {
									echo '
										<tr>
											<td scope="row">'. $Artices_data->{$key}->ID .'</td>
											<td>'. $Artices_data->{$key}->title .'</td>
											<td>'. $Artices_data->{$key}->body .'</td>
											<td>'. $Artices_data->{$key}->author .'</td>
											<td><a class="btn btn-primary" href="'. URL .'/articles/update/'. $Artices_data->{$key}->ID .'">UPDATE</a> <a class="btn btn-danger" href="" onclick="remove('. $Artices_data->{$key}->ID .')">REMOVE</a></td>
										</tr>';
								}
							}
						?>

					</table>
				</div>
			</div>
		</div>
		
		<div class="row" style="<?php echo (ISSET($_GET['id']) && $_GET['action'] === 'update' || $_GET['action'] === 'insert') ? "display: block" : "display: none"; ?>">
				<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
					<div class="card card-signin my-5">
						<div class="card-body">
							<h5 class="card-title text-center">ADD/Update Articles</h5>

							<?php $ID = (ISSET($_GET['id'])) ? '/'. $_GET['id'] : ''; ?>
							<form action="<?php echo URL .'/api/'. $_GET["action"] .'/articles'. $ID; ?>" method="POST" class="form-group">
								<input type="hidden" name="author" value="<?php echo $User_Class->getData['ID']; ?>">

								<div class="form-label-group pb-3">
									<label for="inputTitle">Title</label>
									<input type="text" id="inputTitle" name="title" class="form-control" placeholder="Title" value="<?php echo $Artices_data->{$_GET['id']}->title; ?>" required>
								</div>

								<div class="form-label-group pb-3">
									<label for="inputBody">Article Body</label>
									<textarea type="text" id="inputBody" name="body" class="form-control" placeholder="Body" required><?php echo $Artices_data->{$_GET['id']}->body; ?></textarea>
								</div>

								<button class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" type="submit">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>


	</body>
</html>