<?php
//
//  profile.php
//  Simple CMS
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	require_once 'config.php';

	$page = "Profile";

	if (!ISSET($_SESSION['user'])) {
		header('LOCATION: login');
	}

	if (ISSET($_POST['submit'])) {
		$User_Class->editUserData($User_Class->getData['ID']);
	}
?>

<!doctype html>
<html lang="en">
	
	<?php include_once 'includes/head.php'; ?>

	<body>

		<?php include_once 'includes/header.php'; ?>

		<div class="container">
			<h1 class="text-center mb-4">Profile - <?php echo $User_Class->getData['username']; ?></h1>

			<div class="row">
				<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
					<?php 
						if (!EMPTY($User_Class->error_message())) { 
							echo '
								<div class="card card-signin my-5">
									<div class="card-body text-center">
										<h5 class="card-title text-danger">INFO</h3>
										<span>'. $User_Class->error_message() .'</span>
									</div>
								</div>';
						}
					?>

					<div class="card card-signin my-5">
						<div class="card-body">
							<h5 class="card-title text-center">Profile</h5>

							<form action="profile" method="POST" class="form-group">
								<div class="form-label-group pb-3">
									<label for="inputUsername">Username</label>
									<p class="text-muted"><?php echo $User_Class->getData['username']; ?></p>
								</div>

								<div class="form-label-group pb-3">
									<label for="inputFirstname">Firstname</label>
									<input type="text" id="inputFirstname" name="firstname" class="form-control" placeholder="Firstname" value="<?php echo $User_Class->getData['firstname']; ?>" required>
								</div>

								<div class="form-label-group pb-3">
									<label for="inputLastname">Lastname</label>
									<input type="text" id="inputLastname" name="lastname" class="form-control" placeholder="Lastname" value="<?php echo $User_Class->getData['lastname']; ?>" required>
								</div>

								<div class="form-label-group pb-3">
									<label for="inputEmail">Email</label>
									<input type="text" id="inputEmail" name="email" class="form-control" placeholder="Lastname" value="<?php echo $User_Class->getData['email']; ?>" required>
								</div>

								<?php
									if ($User_Class->getData['role'] >= 2) {
								?>
									<div class="form-label-group pb-3">
										<label for="inputRole">Role</label>
										<select name="role" id="inputRole" class="form-control">
											<option value="1" <?php echo ($User_Class->getData['role'] === '1') ? "selected" : "" ?>>User</option>
											<option value="2" <?php echo ($User_Class->getData['role'] === '2') ? "selected" : "" ?>>Administrator</option>
										</select>
									</div>
								<?php
									}
								?>

								<button class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" type="submit">Update</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</body>
</html>