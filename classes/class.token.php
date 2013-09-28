<?php

	class token {
		
		function __construct () { }
		
		public function construct ($issue_id, $uuid) {
			$bare_token = time() . ',' . $issue_id . ',' . $uuid;
			require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.generate.string.php';
			$string = new string;
			$secret_key = $string -> generate (10);
			return $bare_token . '-' . hash ('sha256', $secret_key . ',' . $bare_token);
		}
		
		public function destruct ($token) {

			$token = explode ('-', $token);
			$token_data = explode (',', $token[0]);
			$result['bare_token']['time'] = $token_data[0];
			$result['bare_token']['issue_number'] = $token_data[1];
			$result['bare_token']['device_uuid'] = $token_data[2];
			$result['signed_token'] = $token[1];
			
			return $result;
			
		}

	}

?>