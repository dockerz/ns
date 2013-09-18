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
				
				$redeemed = ($v1['date_redeemed'] == '') ? '<button class="action resend" id="code-' . $v1['code'] . '">resend</button>': date ('d M Y', $v1['date_redeemed']);

				$list_data .= "\n<li class=\"cf\"><div class=\"code\"><span class=\"mobile code\">code: </span>" . $v1['code'] . "</div><div class=\"issued\"><span class=\"mobile issued\">date issued: </span>" . date ('d M Y', $v1['date_issued']) . "</div><div class=\"redeemed\">" . $redeemed . "</div></li>";

			}
			
			return $this->list_header() . $list_data;
			
		}
		
		private function list_header () {
			return "<li class=\"definition cf\"><div class=\"code\">code</div><div class=\"issued\">date issued</div><div class=\"redeemed\">date redeemed</div></li>";
		}

		private function generate () {
			
			GLOBAL $mysqli;

			// pull issues from db
			$result = array ();
			$r = mysqli_query ($mysqli, "SELECT * FROM `promo_code` WHERE `user_id` = '" . escape_data ($this->id) . "'");

			while ($row = mysqli_fetch_assoc ($r)) {
				$result[] = $row;
			}

			return $result;

		}

	}

?>