<?php

	require $_SERVER['DOCUMENT_ROOT'] . '/app_global.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/admin/app_local.php';
	
	if (SUPER_ADMIN) {
		foreach ($_GET as $k1 => $v1) {
			$data[$k1] = escape_data ($v1);
		}
		mysqli_query ($mysqli, "INSERT INTO `user` (`email`, `name`, `admin`) VALUES ('" . $data['email'] . "', '" . $data['name'] . "', '" . ADMIN . "')");
		$id = mysqli_insert_id ($mysqli);
		mysqli_query ($mysqli, "INSERT INTO `user_issue_index` (`user_id`, `data`) VALUES ('" . $id . "', '" . $data['ownership'] . "')");
		echo $id;
	}	

?>