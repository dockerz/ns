<?php

	require '../app_global.php';

	require '../classes/class.api.php';
	require '../classes/class.api.' . $_GET['action'] . '.php';

	foreach ($_GET as $k1 => $v1) {
		$data[$k1] = escape_data ($v1);
	}

	$interaction = new call_api ($data);

	echo $interaction -> get_response ();

?>