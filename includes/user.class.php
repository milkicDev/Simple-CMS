<?php
//
//  user.class.php
//  zadatak1.threedium
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	namespace site\userClass;

	require_once 'includes/db.class.php';
	use site\dbClass\connection as connection;

	class user {
		private $ID, $username;
		public $getData = array();

		public function User_Login() {
			$username = $this->CryptData($_POST['username'], 'username');
			$password = $this->CryptData($_POST['password'], 'password');

			if ($username !== "" && $password !== "") {
				$isValid = $this->ValidationUserData($username, $password);

				if ($isValid === true) {
					$_SESSION['user'] = $this->ID;
					header('LOCATION: index.php');
				} else {
					$this->error_message = "Your Username OR Password not correctly. Please try again!";
				}
			} else {
				$this->error_message = "Please insert into inputs your username & password!";
			}
		}
	
		public function User_Logout() {
			unset($_SESSION['user']);
			session_destroy();
		}

		private function ValidationUserData($username, $password) {
			$query = "SELECT ID, username, password FROM users WHERE username = '$username'";
			$result = connection::Select($query);
			$userData = $result->fetch_assoc();

			$userData['username'] = $this->CryptData($userData['username'], 'username');

			$isValid = false;
			if ($username === $userData['username'] && $password === $userData['password']) {
				$this->ID = $userData['ID'];
				$isValid = true;
			}

			return $isValid;
		}

		private function CryptData($string, $type = "username") {
			switch ($type) {
				case 'username':
					$value = trim($string);
					$value = strtolower($value);
					break;

				case 'password':
					$value = strtolower($string);
					$value = md5($value);
					break;
			}

			return $value;
		}

		public function getUserData() {
			$query = sprintf("SELECT * FROM users WHERE ID = '%s'", $_SESSION['user']);
			$result = connection::Select($query);
			$row = $result->fetch_assoc();

			foreach ($row as $key => $value) {
				$this->getData[$key] = $value;
			}
		}

		public function error_message() {
			return $this->error_message;
		}
	}

?>