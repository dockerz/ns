<?php

	class api {
		
		public function response ($data) {
			
			// $data[0] = success/fail || 1/0
			// $data[1] = response message
			// $data[2] = response data type

			return "<response><success>" . $data[0] . "</success><data type=\"" . $data[2] . "\">" . $data[1] . "</data></response>";

		}

	}

?>