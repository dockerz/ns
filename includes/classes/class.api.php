<?php

	class api {
		
		public function response ($data) {

			return "<response><success>" . $data['success'] . "</success><data>" . $data['data'] . "</data></response>";

		}

	}

?>