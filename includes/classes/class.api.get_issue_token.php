<?php

	class call_api extends api {
		
		private $device_uuid;
		private $issue_number;
		
		function __construct ($data) {

			$this->device_uuid = $data['device_uuid'];
			$this->issue_number = $data['issue_number'];

		}

		public function get_response () {
			
			return $this -> response (array ('success' => 1, 'data' => 'foo'));

		}

	}

?>