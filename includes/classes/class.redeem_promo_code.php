<?php

	class redeem_promo_code {

		private $user_id;
		private $code;
		private $returnee;

		function __construct ($user_id, $code, $action) {
			$this->user_id = $user_id;
			$this->code = $code;
			$this->returnee = $returnee;
		}

		public function enact () {
			if (mysqli_query ($mysqli, "UPDATE `promo_code` SET `date_redeemed` = '" . time () . " WHERE `user_id` = '" . $this->user_id() . "' AND `code` = '" . $this->code() . "' LIMIT 1")) {
				switch ($this->returnee()) {					
					case 'remote':
						return TRUE;
						break;
					case 'local':
						return TRUE;
						break;
				}
			} else {
				return FALSE;
			}	
		}
		
		private function decrypt_promo_code () {
			return TRUE;
		}
		
	}

?>