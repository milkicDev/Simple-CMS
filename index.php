<?php
//
//  index.php
//  zadatak1.threedium
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	require_once 'config.php';

	if (!ISSET($_SESSION['user'])) {
		header('LOCATION: login.php');
	}
?>

<!doctype html>
<html lang="en">
	
	<?php
		include_once 'includes/head.php';
	?>

	<body>

		<div class="container">
			<h1>Hello, <?php echo $User_Class->getData['username']; ?></h1>
		</div>
		
	</body>
</html>