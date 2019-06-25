<?php
//
//  db.class.php
//  zadatak1.threedium
//
//  Created by MR. Programer on 21.6.19..
//  Copyright © 2019. milkic.dev. All rights reserved.
//

	namespace site\dbClass;

	class connection {
		private static $conn, $db_name;

		public static function Select($query, $database = db_name) {
			self::$db_name = $database;
			self::OpenConnection();

			$result = self::$conn->query($query);

			self::CloseConnection();

			return $result;
		}

		public static function OpenConnection() {
			self::$conn = new \mysqli(db_host, db_user, db_pass, db_name);

			if (self::$conn->connect_error) {
				die('FATAL ERROR MYSQLI: '. self::$conn->connect_errno .' - '. self::$conn->connect_error);
			}
		}

		public static function CloseConnection() {
			self::$conn->close();
		}
	}

?>