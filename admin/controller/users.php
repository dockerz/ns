<?php

	// controller

	if (isset ($_GET['uid'])) { // viewing single user
		
		setlocale (LC_MONETARY, 'en_US');

		// grab extra user data if kickstarted
		$sql = (USER_INFO) ? ', `user_info`.`amount`, `user_info`.`backer_id` FROM `user` LEFT JOIN `user_info` ON `user_info`.`user_id` = `user`.`id`' : '';
		list ($user['id'], $user['name'], $user['email'], $user['amount'], $user['backer_id']) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `user`.`id`, `user`.`name`, `user`.`email`" . $sql . " WHERE `user`.`id` = " . escape_data ($_GET['uid']). " LIMIT 1"));
		
		switch ($_GET['view']) {

			case 'devices': // show device list

				$actions = '<a href="users.php?uid=' . $_GET['uid'] . '&view=codes">view codes</a><a href="users.php?uid=' . $_GET['uid'] . '&view=issues">view issues</a>';
				$list_type = "devices";

				require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.list.devices.php';
				
				$argument = array (
					'id' => array (
						'type' => 'uid',
						'value' => $_GET['uid']
					)
				);

				break;

			case 'codes': // show promo code list

				$actions = '<a href="users.php?uid=' . $_GET['uid'] . '&view=issues">view issues</a><a href="users.php?uid=' . $_GET['uid'] . '&view=devices">view devices</a>';
				$list_type = "codes";
				
				require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.list.promo_codes.php';
				
				$argument = array (
					'id' => array (
						'type' => 'uid',
						'value' => $_GET['uid']
					)
				);
				
				break;

			default: // show issue list

				$actions = '<a href="users.php?uid=' . $_GET['uid'] . '&view=codes">view codes</a><a href="users.php?uid=' . $_GET['uid'] . '&view=devices">view devices</a>';
				if (ADMIN_SUPER): $actions .= ' | <button class="action update_ownership">update ownership</button>'; endif;
				$list_type = "issues";
				
				require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.list.issues.php';
				
				$argument = array (
					'id' => array (
						'type' => 'uid',
						'value' => $_GET['uid']
					),
					'show' => 'ownership',
					'sorted' => FALSE,
				);
				
				break;

		}

	} else {

		require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.list.users.php';
		
		$argument = array (
			'id' => array (
				'type' => NULL,
				'value' => NULL
			),
			'show' => 'count'
		);
		$argument['sorted'] = (isset ($_GET['sort'])) ? $_GET['sort'] : FALSE;

		
	}

	$data_list = new data_list ($argument);
	$list = $data_list -> render ();
	
	unset ($argument);

?>