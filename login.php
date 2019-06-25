<?php
//
//  login.php
//  zadatak1.threedium
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	require_once 'config.php';

	if (ISSET($_SESSION['user'])) {
		header('LOCATION: index.php');
	}

	if (ISSET($_POST['submit'])) {
		$User_Class->User_Login();
	}
?>

<!doctype html>
<html lang="en">
	
	<?php
		include_once 'includes/head.php';
	?>

  <body>

	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<?php 
					if (!EMPTY($User_Class->error_message())) { 
						echo '
							<div class="card card-signin my-5">
								<div class="card-body text-center">
									<h5 class="card-title text-danger">ERROR</h3>
									<span>'. $User_Class->error_message() .'</span>
								</div>
							</div>';
					}
				?>

				<div class="card card-signin my-5">
					<div class="card-body">
						<h5 class="card-title text-center">Sign In</h5>
						<form action="login.php" method="POST" class="form-signin">
							<div class="form-label-group pb-3">
								<label for="inputUsername">Username</label>
								<input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
							</div>

							<div class="form-label-group pb-3">
								<label for="inputPassword">Password</label>
								<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
							</div>

							<button class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" type="submit">Sign in</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    
  </body>
</html>