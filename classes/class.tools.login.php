<?php

	class login {
		
		private $password;
		private $email;
		
		function __construct ($email, $password) {
			$this->email = escape_data ($email);
			$this->password = salty ($password);
		}
		
		public function enact () {			

			GLOBAL $mysqli;

			$r = mysqli_query ($mysqli, $sql = "SELECT `id` FROM `admin` WHERE `e` = '" . $this->email . "' AND `p` = '" . $this->password . "' LIMIT 1");
			
			if (mysqli_num_rows ($r)) {
				
				list ($admin) = mysqli_fetch_row ($r);

				require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.generate.string.php';
				
				$string = new string;
				$secret = $string -> generate (10);

				mysqli_query ($mysqli, "DELETE FROM `admin_secret` WHERE `user_id`=" . $admin . " LIMIT 1");
				mysqli_query ($mysqli, "INSERT INTO `admin_secret` (`user_id`, `data`, `expires`) VALUES ('" . $admin . "', '" . $secret . "', '" . (time() + COOKIE_TIME) . "')");				

				define ('ADMIN', $admin);

				setcookie ("admin", $admin, time() + COOKIE_TIME, '/');
				setcookie ("secret", $secret, time() + COOKIE_TIME, '/');
				
				return TRUE;

			}

			mysqli_free_result ($r);

			return FALSE;

		}
	}

?>