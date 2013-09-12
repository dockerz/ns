<?php

	$_GET['page'] = (!isset ($_GET['page'])) ? 'dashboard': $_GET['page'];

	// page constants
	DEFINE ("LOCATION", $_GET['page']);

	if (($_GET['page'] == 'users') && (isset ($_GET['uid']))): DEFINE ('BODY_CLASS', 'user'); else: DEFINE ('BODY_CLASS', $_GET['page']); endif;
	if (isset ($_GET['sort'])): $sort = explode('_', $_GET['sort']); DEFINE ('SORT', $sort[1]); else: DEFINE ('SORT', 'ASC'); endif;

	// load controllers
	require '../app_global.php';
	require 'app_local.php';
	require 'controller/' . LOCATION . '.php';

	// render page
	require ROOT . 'includes/header.php';
	require 'template/' . LOCATION . '.php';
	require ROOT . 'includes/footer.php';

?>