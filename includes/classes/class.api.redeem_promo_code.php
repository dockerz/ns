<?php

	class call_api extends api {
		
		private $device_uuid;
		private $promo_code;
		
		function __construct ($data) {

			$this->device_uuid = $data['device_uuid'];
			$this->promo_code = $data['promo_code'];

		}

		public function get_response () {
			
			return $this -> response (array ('success' => 1, 'data' => 'foo'));

		}

	}

?>