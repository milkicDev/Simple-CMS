<?php
//
//  user.class.php
//  Simple CMS
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
					header('LOCATION: home');
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
			$query = sprintf("SELECT ID, username, password FROM users WHERE username = '%s'", $username);
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

		public function CryptData($string, $type = "username") {
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

		public function getUserData($userID = null) {
			if ($userID === null) {
				$query = sprintf("SELECT * FROM users WHERE ID = '%s'", $_SESSION['user']);
			} else {
				$query = sprintf("SELECT * FROM users WHERE ID = '%s'", $userID);
			}
			
			$result = connection::Select($query);
			$row = $result->fetch_assoc();

			foreach ($row as $key => $value) {
				$this->getData[$key] = $value;
			}
		}

		public function getUsersData() {
			$query = "SELECT * FROM users";
			$result = connection::Select($query);

			return $result;
		}

		public function editUserData($userID) {
			$query = sprintf("UPDATE users SET firstname = '%s', lastname = '%s', email = '%s', role = '%s' WHERE ID = '%s'", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role'], $userID);
			connection::Select($query);

			$this->error_message = "Your Profile has been updated!";

			header('LOCATION: '. URL .'/profile');
		}

		public function error_message() {
			return $this->error_message;
		}
	}

?>