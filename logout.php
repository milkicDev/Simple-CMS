<?php
//
//  logout.php
//  zadatak1.threedium
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	require_once 'config.php';

	$User_Class->User_Logout();

	header('LOCATION: login');
?>