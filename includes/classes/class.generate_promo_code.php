<?php

	class promo_code {

		function __construct () { }

		public function render () {
			
		}

		public function redeem ($code) {
			return mysqli_query ($mysqli, "UPDATE `promo_code` SET `date_redeemed` = '" . time () . " WHERE `code` = '" . $code . "' LIMIT 1");
		}

		private function promo_code_exists () {
			
		}
		
		private function insert_into_db () {
			mysqli_query ($mysqli, "INSERT INTO `promo_code` (`code`, `user_id`, `issued`) VALUES ('" . $this -> generate_code () . "', '" . $this -> get_user_id_from_email () . "', '" . time () . "')");
		}
		
		private function generate_new_code () {
			return TRUE;
		}

	}

?>