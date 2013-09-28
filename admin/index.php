<?php

	$_GET['page'] = (!isset ($_GET['page'])) ? 'dashboard': $_GET['page'];

	// page constants
	DEFINE ("LOCATION", $_GET['page']);

	if (($_GET['page'] == 'users') && (isset ($_GET['uid']))): DEFINE ('BODY_CLASS', 'user'); else: DEFINE ('BODY_CLASS', $_GET['page']); endif;
	if (isset ($_GET['sort'])): $sort = explode('_', $_GET['sort']); DEFINE ('SORT', $sort[1]); else: DEFINE ('SORT', 'DESC'); endif;

	// load controllers
	require '../app_global.php';
	require 'app_local.php';
	require 'controller/' . LOCATION . '.php';

	// render page
	require ROOT . 'includes/header.php';
	if (ADMIN): require 'template/' . LOCATION . '.php'; else: require 'template/login.php'; endif;
	require ROOT . 'includes/footer.php';

?>