<?php
//
//  api.class.php
//  Simple CMS
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//
	namespace site\apiClass;
	
	require_once 'includes/db.class.php';
	use site\dbClass\connection as connection;

	class Api {
		private $action, $table, $user, $ID;

		public function __construct($action, $table, $user = null, $ID = null) {
			$this->action = $action;
			$this->table = $table;
			$this->user = $user;
			$this->ID = $ID;
		}

		public function insert() {
			if ($this->table === "articles") {
				$query = sprintf("INSERT INTO articles (`title`, `body`, `author`, `featured_img`)
												values ('%s', '%s', '%s', '%s')", $_POST['title'], $_POST['body'], $_POST['author'], $_POST['img']);
			} else {
				$this->error_message = "Please select another table!";
			}

			connection::Insert($query);

			return $this->error_message;
		}

		public function read() {
			if ($this->ID !== null || $this->user !== null) {
				if ($this->ID === null && $this->user !== null) {
					$query = sprintf("SELECT * FROM `%s` WHERE author = '%s'", $this->table, $this->user);	
				}
				else if ($this->ID !== null && $this->user === null) {
					$query = sprintf("SELECT * FROM `%s` WHERE ID = '%s'", $this->table, $this->ID);
				} else {
					$query = sprintf("SELECT * FROM `%s` WHERE ID = '%s' AND author = '%s'", $this->table, $this->ID, $this->user);
				}
			} else {
				$query = sprintf("SELECT * FROM `%s`", $this->table);
			}
			
			$result = connection::Select($query);

			while ($row = $result->fetch_assoc()) {
				$data[$row['ID']] = $row;
			}

			return $data;
		}

		public function update() {
			if ($this->table === "articles") {
				$query = sprintf("UPDATE articles SET title = '%s', body = '%s', author = '%s', featured_img = '%s' WHERE ID = '%s'", $_POST['title'], $_POST['body'], $_POST['author'], $_POST['img'], $this->ID);
			} else {
				$this->error_message = "Please select another table!";
			}

			connection::Update($query);

			return $this->error_message;
		}

		public function remove() {
			$query = sprintf("DELETE FROM `%s` WHERE ID = '%s'", $this->table, $this->ID);
			connection::Select($query);
		}
	}

?>