<?php
//
//  config.php
//  zadatak1.threedium
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	session_start();

	define(db_host, 'localhost');
	define(db_user, 'root');
	define(db_pass, 'root');
	define(db_name, 'threedium');

	require_once 'includes/user.class.php';
	$User_Class = new \site\userClass\user();
	$User_Class->getUserData();
?>