<?php

	setlocale (LC_MONETARY, 'en_US');

	if (isset ($_GET['uid'])) {
		
		// grab extra user data if kickstarted
		$sql = (USER_INFO) ? ', `user_info`.`amount`, `user_info`.`backer_id` FROM `user` LEFT JOIN `user_info` ON `user_info`.`user_id` = `user`.`id`' : '';
		list ($user['id'], $user['name'], $user['email'], $user['amount'], $user['backer_id']) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `user`.`id`, `user`.`name`, `user`.`email`" . $sql . " WHERE `user`.`id` = " . escape_data ($_GET['uid']). " LIMIT 1"));

	} else {

		if (isset ($_GET['sort'])) { // sort db results from "sort" dropdown
			$sort = explode ('_', $_GET['sort']);
			switch ($sort[0]) {
				case 'id': // sort by id
					$sql = "SELECT * FROM `user` ORDER BY `" . escape_data ($sort[0]) . "` " . escape_data ($sort[1]);
					break;
				default: // sort by quantity popularity
					$sql = "SELECT * FROM `user` ORDER BY `id` ASC";
					break;
			}
		} else { // standard sort -- user_id, asc
			$sql = "SELECT * FROM `user` ORDER BY `id` ASC";
		}

		$r = mysqli_query ($mysqli, $sql);
		while ($row = mysqli_fetch_assoc ($r)) {
			$page[] = $row;
		}
		
	}

?>