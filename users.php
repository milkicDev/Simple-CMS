<?php
//
//  users.php
//  Simple CMS
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	require_once 'config.php';

	$page = "List Users";

	if (!ISSET($_SESSION['user'])) {
		header('LOCATION: login');
	}

	if ($User_Class->getData['role'] < 2) {
		echo "You don't have permission for this action!";
		exit;
	}
?>

<!doctype html>
<html lang="en">
	
	<?php include_once 'includes/head.php'; ?>

	<body>

		<?php include_once 'includes/header.php'; ?>

		<div class="container">
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

		</div>
		
	</body>
</html>