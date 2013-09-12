<?php

	class call_api extends api {
		
		private $device_uuid;
		
		function __construct ($data) {

			$this->device_uuid = $data['device_uuid'];

		}

		public function get_response () {
			
			return $this -> response (array ('success' => 1, 'data' => 'foo'));

		}

	}

?>