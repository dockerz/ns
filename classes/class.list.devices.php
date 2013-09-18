<?php

	class data_list {
		
		private $id_type;
		private $id;
		
		function __construct ($argument) {
			$this->id_type = escape_data ($argument['id']['type']);
			$this->id = escape_data ($argument['id']['value']);
		}

		public function render () {
			
			$list_data		= '';

			foreach ($this->generate() as $k1 => $v1) {
				
				$last = ($v1['date_last_token_sent'] == '') ? '': date ('d M Y', $v1['date_last_token_sent']);

				$list_data .= "\n<li class=\"cf\"><div class=\"uuid\"><span class=\"mobile uuid\">uuid: </span>" . $v1['device_uuid'] . "</div><div class=\"registered\"><span class=\"mobile registered\">date registered: </span>" . date ('d M Y', $v1['date_registered']) . "</div><div class=\"last\">" . $last . "</div><div class=\"remove\"><button class=\"action remove_device\" id=\"id-'" . $v1['uuid'] . "\">remove</button></div></li>";

			}
			
			return $this->list_header() . $list_data;
			
		}
		
		private function list_header () {
			return "<li class=\"definition cf\"><div class=\"uuid\">uuid</div><div class=\"registered\">date registered</div><div class=\"last\">date last token sent</div></li>";
		}

		private function generate () {
			
			GLOBAL $mysqli;

			// pull issues from db
			$result = array ();
			$r = mysqli_query ($mysqli, "SELECT * FROM `user_device` WHERE `user_id` = '" . escape_data ($this->id) . "'");

			while ($row = mysqli_fetch_assoc ($r)) {
				$result[] = $row;
			}

			return $result;

		}

	}

?>