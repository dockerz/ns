<?php

	class call_api extends api {
		
		private $device_uuid;
		private $token;
		
		function __construct ($data) {

			$this->device_uuid = $data['device_uuid'];
			$this->token = $data['token'];

		}

		public function get_response () {
			
			return $this -> response (array ('success' => 1, 'data' => 'foo'));

		}

	}

?>