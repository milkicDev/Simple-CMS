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

	$apiURL = URL .'/api/read/articles';
	
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

					
		
			<?php
				foreach ($Artices_data as $key => $value) {
					echo '<div class="card mb-3 text-center">';

					if (ISSET($Artices_data->error_message)) {
						echo '
							<div class="card-body">
								<p>'. $Artices_data->error_message .'</p>
								<a class="btn btn-primary" href="'. URL .'/articles/insert">ADD NEW</a>
							</div>';
					} else {
						$author = $Artices_data->{$key}->author;
						$User_Class->getUserData($author);

						echo '
							<div class="card-header">
								<h5>
									'. $Artices_data->{$key}->title .'
								</h5>
							</div>
							<div class="card-body">
								<p>'. $Artices_data->{$key}->body .'</p>

								<small class="float-right">
										<strong>Author:</strong> <em>'. $User_Class->getData['username'] .'</em>
								</small>
							</div>';
					}

					echo '</div>';
				}
			?>
		</div>
		
	</body>
</html>