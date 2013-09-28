<?php

	class call_api extends api {
		
		private $device_uuid;
		private $issue_number;
		private $user_id;
		private $issue_id;
		
		function __construct ($data) {

			$this->device_uuid = $data['device_uuid'];
			$this->issue_number = $data['issue_number'];

		}

		public function get_response () {
			
			if (($result = $this->uuid_exists()) == TRUE) {
				$this->user_id = $result;
				unset ($result);
			} else {
				$data = array ('0', 'Device UUID unkown', 'text');
			}

			if (!isset ($data)) {
				if (($result = $this->issue_exists()) == TRUE) {
					$this->issue_id = $result;
					unset ($result);
				} else {
					$data = array ('0', 'Unknown Issue Number', 'text');
				}
			}

			if (!isset ($data)) {
				if (($result = $this->issue_owned()) != TRUE) {
					$data = array ('0', 'User does not have access to that issue', 'text');
				}
			}

			if (!isset ($data)) {
				if ($this -> update_last_token_sent ()) {
					require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.token.php';
					$token = new token;
					$data = array ('1', $token -> construct ($this->issue_id, $this->device_uuid), 'token');
				}
			}

			return $this -> response ($data);

		}

		private function update_last_token_sent () {
			GLOBAL $mysqli;
			return mysqli_query ($mysqli, "UPDATE `user_device` SET `date_last_token_sent` = '" . time () . "' WHERE `device_uuid` = '" . $this->device_uuid . "' LIMIT 1");
		}

		private function uuid_exists () {
			GLOBAL $mysqli;
			list ($result) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `user_id` FROM `user_device` WHERE `device_uuid` = '" . $this->device_uuid . "' LIMIT 1"));
			return $result;
		}

		private function issue_exists () {
			GLOBAL $mysqli;
			if (mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `id` FROM `issue` WHERE `id` = '" . $this->issue_number . "' LIMIT 1"))) {
				return TRUE;
			} else {
				return FALSE;
			}			
		}

		private function issue_owned () {
			GLOBAL $mysqli;
			list ($issues) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `data` FROM `user_issue_index` WHERE `user_id` = '" . $this->user_id . "' LIMIT 1"));
			return indexof ($this->issue_number, $issues);
		}

		private function make_token () {
			return 1;
		}

	}

?>