<?php

	require $_SERVER['DOCUMENT_ROOT'] . '/app_global.php';
	require '../app_local.php';
	
	if (ADMIN && (isset ($_GET['n']))) {
		if (mysqli_query ($mysqli, "INSERT INTO `issue` (`creator`) VALUES ('" . ADMIN . "')")) {
			echo mysqli_insert_id ($mysqli);
		} else {
			echo FALSE;
		}
	}

?>