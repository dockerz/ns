<?php

	require $_SERVER['DOCUMENT_ROOT'] . 'app_global.php.php';
	
	list ($iid) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `id` FROM `issue` ORDER BY `id` DESC"));
	return $iid + 1;

?>