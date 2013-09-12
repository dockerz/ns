<?php

	// this action needs to become an object

	if (!empty ($_GET['collection'])) {
		require '../../app_global.php';
		if (isset ($_SESSION['admin'])) {
			mysqli_query ($mysqli, "INSERT INTO `collections` (`data`) VALUES ('" . escape_data ($_GET['collection']) . "')");
			echo mysqli_insert_id ($mysqli);
		} else {
			echo FALSE;
		}
	} else {
		echo FALSE;
	}

?>