<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>New Scribbler Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo ROOT; ?>includes/css/reset.css">
	<link rel="stylesheet" href="<?php echo ROOT; ?>includes/css/screen.css" />
</head>
<body class="<?php echo BODY_CLASS; ?>">
	<header>
		<div class="container">
			<h1>New Scribbler: <span><?php echo CLIENT; ?></span></h1>
		</div>
	</header>

	<?php

		// admin section navigation. current location is determined by javascript.
		echo ($_SESSION['admin'] && (LOCATION !== 'public')) ? "<section class=\"tools\"><div class=\"container\"><ul><li class=\"dashboard\"><a href=\"index.php\">dashboard</a></li><li class=\"users\"><a href=\"users.php\">users</a></li><li class=\"issues\"><a href=\"issues.php\">issues</a></li><li class=\"collections\"><a href=\"collections.php\">collections</a></li><li class=\"admin\"><a href=\"admin.php\">admin</a></li><li><a href=\"index.php?logout=true\">logout</a></li></ul></div></section>" : "";

	?>