<?php

	class data_list {
		
		private $id_type;
		private $id;
		private $sorted;
		
		function __construct ($argument) {
			$this->id_type = escape_data ($argument['id']['type']);
			$this->id = escape_data ($argument['id']['value']);
			$this->sorted = $argument['sorted'];
		}

		public function render () {

			$list_data		= '';

			foreach ($this->generate() as $k1 => $v1) {

				$list_data .= '<li class="cf"><div class="name"><a href="users.php?uid=' . $v1['id'] . '">' . htmlentities ($v1['name']) . '</a></div><div class="email"><a href="mailto:' . $v1['email'] . '" class="btn">' . $v1['email'] . '</a></div><div class="collection">' . $this -> collection ($v1['amount']) . '</div></li>';

			}
			return $this->list_header() . $list_data;
		}
		
		private function list_header () {
			return "<li class=\"definition cf\"><div class=\"name\">name</div><div class=\"email\">email address</div><div class=\"collection\">collection</div></li>";
		}

		private function collection ($amount) {
			GLOBAL $mysqli;

			$tier = array (1 => 20, 25, 35, 40, 50, 60, 100, 250, 315, 500, 1000);

			if ($amount < $tier[1]) {
				return '';
			} elseif (($amount >= $tier[1]) && ($amount < $tier[2])) {
				$id = 5; // $20
			} elseif (($amount >= $tier[2]) && ($amount < $tier[3])) {
				$id = 6; // $25
			} elseif (($amount >= $tier[3]) && ($amount < $tier[4])) {
				$id = 7; // $35
			} elseif (($amount >= $tier[4]) && ($amount < $tier[5])) {
				$id = 8; // $40
			} elseif (($amount >= $tier[5]) && ($amount < $tier[6])) {
				$id = 9; // $50
			} elseif (($amount >= $tier[6]) && ($amount < $tier[7])) {
				$id = 10; // $60
			} elseif (($amount >= $tier[7]) && ($amount < $tier[8])) {
				$id = 11; // $100
			} elseif (($amount >= $tier[8]) && ($amount < $tier[9])) {
				$id = 1; // $250
			} elseif (($amount >= $tier[9]) && ($amount < $tier[10])) {
				$id = 2; // $285
			} elseif (($amount >= $tier[10]) && ($amount < $tier[11])) {
				$id = 3; // $315
			} elseif (($amount >= $tier[10]) && ($amount < $tier[11])) {
				$id = 4; // $500
			} elseif ($amount >= $tier[10]) {
				$id = 12; // $1000
			}

			list ($result) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `data` FROM `collections` WHERE `id` = " . $id . " LIMIT 1"));			
			return $result;

		}

		private function generate () {

			GLOBAL $mysqli;

			if ($this->sorted) { // sort db results from "sort" dropdown
				$sort = explode ('_', $this->sorted);
				switch ($sort[0]) {
					case 'id': // sort by id
						$sql = "SELECT `user`.*, `user_info`.`amount` FROM `user`, `user_info` WHERE `user_info`.`user_id` = `user`.`id` ORDER BY `user`.`" . escape_data ($sort[0]) . "` " . escape_data ($sort[1]);
						break;
					default: // sort by quantity popularity
						$sql = "SELECT `user`.*, `user_info`.`amount` FROM `user`, `user_info` WHERE `user_info`.`user_id` = `user`.`id` ORDER BY `user`.`id` ASC";
						break;
				}
			} else { // standard sort -- user_id, asc
				$sql = "SELECT `user`.*, `user_info`.`amount` FROM `user`, `user_info` WHERE `user_info`.`user_id` = `user`.`id` ORDER BY `user`.`id` ASC";
			}
			
			// pull issues from db
			$result = array ();
			$r = mysqli_query ($mysqli, $sql);

			while ($row = mysqli_fetch_assoc ($r)) {
				$result[] = $row;
			}

			return $result;

		}

	}

?>