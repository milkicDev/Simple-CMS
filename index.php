<?php
//
//  index.php
//  Simple CMS
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	require_once 'config.php';

	$page = "Home Page";

	if (!ISSET($_SESSION['user'])) {
		header('LOCATION: login');
	}

	if ($User_Class->getData['role'] >= 2) {
		$apiURL = URL .'/api/read/articles';
	} else {
		$apiURL = URL .'/api.php?action=read&tb=articles&user='. $User_Class->getData['ID'];
	}
	
	$Artices_data = json_decode(file_get_contents($apiURL));
?>

<!doctype html>
<html lang="en">
	
	<?php include_once 'includes/head.php'; ?>

	<body>

		<?php include_once 'includes/header.php'; ?>

		<div class="container">
			<h1 class="text-center mb-4">Hello, <?php echo $User_Class->getData['username']; ?></h1>

			<?php
				if ($User_Class->getData['role'] >= 2) {
					echo '
						<div class="card mb-3 text-center">
							<div class="card-header">
								<h5>USERS TABLE <sup><a href="">ADD NEW</a></sup><h5>
							</div>
							<div class="card-body">
								<table class="table">
									<tr>
										<td scope="col">ID</td>
										<td scope="col">Username</td>
										<td scope="col">Firstname</td>
										<td scope="col">Lastname</td>
										<td scope="col">Action</td>
									</tr>';

									$result = $User_Class->getUsersData();
									while ($Users_Data = $result->fetch_assoc()) {
										echo '
											<tr>
												<td scope="row">'. $Users_Data['ID'] .'</td>
												<td>'. $Users_Data['username'] .'</td>
												<td>'. $Users_Data['firstname'] .'</td>
												<td>'. $Users_Data['lastname'] .'</td>
												<td><button class="btn btn-primary">UPDATE</button> <button class="btn btn-danger">REMOVE</button></td>
											</tr>';
									}
					echo '
							</table>
						</div>
					</div>';
				}
			?>

					
		
			<div class="card mb-3 text-center">
				<div class="card-header">
					<h5>ARTICLES TABLE <sup><a href="">ADD NEW</a></sup><h5>
					<p id="message"></p>
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<td scope="col">ID</td>
							<td scope="col">Title</td>
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
										<td scope="row">
											<a href="'. URL .'/article/'. $Artices_data->{$key}->ID .'">'. $Artices_data->{$key}->ID .'</a>
										</td>
										<td>
											<a href="'. URL .'/article/'. $Artices_data->{$key}->ID .'">'. $Artices_data->{$key}->title .'</a>
										</td>
										<td>
											<a href="'. URL .'/article/'. $Artices_data->{$key}->ID .'">'. $Artices_data->{$key}->author .'</a>
										</td>
										<td>
											<a class="btn btn-primary" href="'. URL .'/articles/update/'. $Artices_data->{$key}->ID .'">UPDATE</a> 
											<a class="btn btn-danger" href="" onclick="remove('. $Artices_data->{$key}->ID .')">REMOVE</a>
										</td>
									</tr>';
								}
							}
						?>

					</table>
				</div>
			</div>
		</div>
		
	</body>
</html>