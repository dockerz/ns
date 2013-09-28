<?php

	class data_list {
		
		private $id_type;
		private $id;
		private $sorted;
		private $show;
		
		function __construct ($argument) {
			$this->id_type = escape_data ($argument['id']['type']);
			$this->id = escape_data ($argument['id']['value']);
			$this->show = $argument['show'];
			$this->sorted = $argument['sorted'];
		}

		public function render () {
			
			$collections	= $this->get_collections();
			$list_data		= '';

			foreach ($this->generate() as $k1 => $v1) {

				switch ($this->show) {
					case 'count':
						$v1['owned'] = '';
						$own = '';
						break;

					case 'ownership':
						$own = ($v1['owned'] == 'yes') ? ' active': ' inactive';
						$own = "<div class=\"ownership\"><span id=\"id-" . $k1 . "\" class=\"action own" . $own . "\">" . $v1['owned'] . "</div>";
						break;
				}

				$cols = array ();
				if ($v1['collections']) {
					foreach ($v1['collections'] as $v2) {
						$cols[] = "<a href=\"issues.php?cid=" . $v2 . "\">" . $collections[$v2] . "</a>";
					}						
				} else {
					$cols[] = '&nbsp;';
				}

				$list_data .= "\n<li class=\"cf\"><div class=\"id\"><span class=\"mobile id\">id: </span>" . $k1 . "</div><div class=\"collections\"><span class=\"mobile collections\">collections: </span>" . implode (', ', $cols) . "</div>" . $own . "</li>";

			}

			return $this->list_header() . $list_data;
		}
		
		private function get_collections () {
			GLOBAL $mysqli;
			$result = array ();
			$r = mysqli_query ($mysqli, "SELECT * FROM `collections` ORDER BY `id` ASC");
			while ($row = mysqli_fetch_assoc ($r)) {
				$result[$row['id']] = $row['data'];
			}
			mysqli_free_result ($r);			
			return $result;
		}
		
		private function list_header () {
			$extras = ($this->show == 'count') ? "" : "<div class=\"own\">owned</div>";
			return "<li class=\"definition cf\"><div class=\"id\">id</div><div class=\"collections\">collections</div>" . $extras . "</li>";
		}

		private function generate () {
			
			GLOBAL $mysqli;
			
			if ($this->id_type == 'uid') {
				list ($issues) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `data` FROM `user_issue_index` WHERE `user_id` = '" . $this->id . "' LIMIT 1"));
			}
			
			if ($this->id_type == 'cid') {
				$sql = "SELECT `issue`.`id`, `issue`.`name` FROM `issue`, `issue_collection` WHERE `issue_collection`.`collection_id` = " . $this->id . " AND `issue_collection`.`issue_id` = `issue`.`id` ORDER BY `id` DESC";
			} else {
				if ($this->sorted) { // sort db results from "sort" dropdown
					$sort = explode ('_', $this->sorted);
					switch ($sort[0]) {
						case 'id': // sort by id
							$sql = "SELECT * FROM `issue` ORDER BY `" . escape_data ($sort[0]) . "` " . escape_data ($sort[1]);
							break;
						default: // sort by quantity popularity
							$sql = "SELECT * FROM `issue` ORDER BY `id` DESC";
							break;
					}
				} else { // standard sort -- user_id, asc
					$sql = "SELECT * FROM `issue` ORDER BY `id` DESC";
				}
			}
			
			// pull issues from db
			$result = array ();
			$r = mysqli_query ($mysqli, $sql);

			while ($row = mysqli_fetch_assoc ($r)) {

				if ($this->id_type == 'uid'):
					$result[$row['id']]['owned'] = (indexof ($row['id'], $issues)) ? 'yes' : 'no';
				endif;

				// get this issue's associated collection(s)
				$r1 = mysqli_query ($mysqli, "SELECT `collection_id` FROM `issue_collection` WHERE `issue_id` = " . $row['id'] . " AND (`collection_id` > 4 AND `collection_id` < 12) ORDER BY `id` ASC");
				if (mysqli_num_rows ($r1)) { // has collection, put into array
					while ($row1 = mysqli_fetch_assoc ($r1)) {
						$result[$row['id']]['collections'][] = $row1['collection_id'];
					}
				} else {
					$result[$row['id']]['collections'] = FALSE; // does not have collection
				}

				mysqli_free_result ($r1);
				
			}

			return $result;

		}

	}

?>