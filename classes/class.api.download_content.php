<?php

	class call_api extends api {
		
		private $device_uuid;
		private $token;
		
		function __construct ($data) {

			$this->device_uuid = $data['device_uuid'];
			$this->token = $data['token'];

		}

		public function get_response () {
			
			require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.token.php';
			$token = new token;
			$token_array = $token -> destruct ($this->token);

			$data = array ('1', 'Deliver content', 'text');

			return $this -> response ($data);

		}

		private function validate () {
			return TRUE;
		}

	}

?>