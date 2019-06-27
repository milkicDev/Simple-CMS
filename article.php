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
		header('LOCATION: login');
	}

	$apiURL = URL .'/api.php?action=read&tb=articles&id='. $_GET['id'];
	
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
					<h5>
						<?php echo $Artices_data->{$_GET['id']}->title; ?>
						 <a class="btn btn-primary" href="<?php echo URL .'/articles/update/'. $_GET['id']; ?>">UPDATE</a>
					<h5>
				</div>
				<div class="card-body">
					<p><?php echo $Artices_data->{$_GET['id']}->body; ?></p>

					<small class="float-right">
						<?php
							$author = $Artices_data->{$key}->author;
							$User_Class->getUserData($author);

							echo '<strong>Author:</strong> <em>'. $User_Class->getData['username'] .'</em>';
						?>
					</small>
				</div>
			</div>
		</div>
		
	</body>
</html>