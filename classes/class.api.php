<?php

	class api {
		
		public function response ($data) {
			
			// $data[0] = success/fail || 1/0
			// $data[1] = response message

			return "<response><success>" . $data[0] . "</success><data>" . $data[1] . "</data></response>";

		}

	}

?>