<?php

	class call_api extends api {
		
		private $device_uuid;
		private $promo_code;
		private $clean_code;
		private $user_id;
		
		function __construct ($data) {

			$this->device_uuid = $data['device_uuid'];
			$this->promo_code = $data['promo_code'];
			$this->clean_code = str_replace ('-', '', $data['promo_code']);

		}

		public function get_response () {

			if ($this->is_valid() !== TRUE): $data = array ('0', 'Invalid Promo Code', 'text'); endif; // see if promo code is valid. if no, define fail response.
			// if fail response not defined, proceed with search for promo code -- if ($result == TRUE), is user_id
			if ((!isset ($data)) && (($result = $this->code_exists()) == TRUE)) {
				$this->user_id = $result;
				unset ($result);
			} else {
				$data = array ('0', 'Invalid Promo Code', 'text'); // code does not exist in database, define fail response.
			}

			// if fail response not defined, look to see if device is registered
			if ((!isset ($data)) && (!$this->device_is_registered())) {
				// device not registered.
				if (($this->device_count()) >= POLICY_LIMIT) { // assess if policy_limit has been reached
					$data = array ('0', 'Too many devices active', 'text'); // policy limit reached. disallow.
				} else {
					$this->add_device(); // policy limit not reached. add this device to `user_device`.
				}
			}

			if (!isset ($data)) { // if fail response not defined, proceed.
				if ($this->update_promo_code()) { // update promo code with present time
					// 1 step missing -- insert/update `user_issue` with what's in `promo_code_issues` -- no idea how this works
					$data = array ('1', 'Promo Code redeemed', 'text');	
				}
			}

			return $this -> response ($data);

		}

		private function is_valid () { // get from chris what a valid promo code looks like.
			return (preg_match ("/^[A_Z0-9]{4}-[A_Z0-9]{4}-[A_Z0-9]{4}-[A_Z0-9]{4}$/", $this->promo_code)) ? TRUE : FALSE;
		}

		private function code_exists () {
			GLOBAL $mysqli;
			list ($result) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `user_id` FROM `promo_code` WHERE `code` = '" . $this->clean_code . "' LIMIT 1"));
			return $result;
		}

		private function device_is_registered () {
			GLOBAL $mysqli;
			if (mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `device_uuid` FROM `user_device` WHERE `device_uuid` = '" . $this->device_uuid . "' LIMIT 1"))) {
				return TRUE;
			} else {
				return FALSE;
			}			
		}

		private function device_count () {
			GLOBAL $mysqli;
			list ($result) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT COUNT(`user_id`) FROM `user_device` WHERE `user_id` = '" . $this->user_id . "'"));
			return $result;
		}

		private function add_device () {
			GLOBAL $mysqli;
			return mysqli_query ($mysqli, "INSERT INTO `user_device` (`device_uuid`, `user_id`, `date_registered`) VALUES ('" . $this->device_uuid . "', '" . $this->user_id . "', '" . time () . "')");
		}

		private function update_promo_code () {
			GLOBAL $mysqli;
			return mysqli_query ($mysqli, "UPDATE `promo_code` SET `date_redeemed` = '" . time (). "' WHERE `code` = '" . $this->clean_code . "' AND `user_id` = '" . $this->user_id . "' LIMIT 1");
		}

	}

?>