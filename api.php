<?php
//
//  api.php
//  Simple CMS
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//
	header("Content-Type: application/json");

	require_once 'config.php';

	$allowedTables = array("articles");

	if (in_array($_GET['tb'], $allowedTables)) {
		require_once 'includes/api.class.php';
		$apiClass = new site\apiClass\Api($_GET['action'], $_GET['tb'], $_GET['user'], $_GET['id']);

		// parms /action/table/user/id

		switch ($_GET['action']) {
			case 'insert':
				$func = $apiClass->insert();
				header('LOCATION: '. URL .'/articles');
				break;
			
			case 'read':
				$func = $apiClass->read();
				if ($func === null) {
					$func = array("error_message" => "Table is empty");
				}
				break;
			
			case 'update':
				$func = $apiClass->update();
				header('LOCATION: '. URL .'/articles');
				break;

			case 'remove':
				$func = $apiClass->remove();
				break;

			default:
				$func = array("error_message" => "Please select Action & Table");
				break;
		}
	} else {
		$func = array("error_message" => "This table can not be use!");
	}

	echo json_encode($func);
?>