<?php

	require '../app_global.php';
	require 'app.php';
	require '../includes/header.php';

	if ($logged_in) {
		echo 'logged in';
	} else {
		echo 'not logged in';		
	}

	require '../includes/footer.php';

?>