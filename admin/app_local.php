<?php
	
	// log admin out
	if (isset ($_GET['logout'])) {
		if (mysqli_query ($mysqli, "DELETE FROM `admin_secret` WHERE `user_id` = " . escape_data ($_COOKIE['admin']) . " LIMIT 1")) {
			setcookie ("admin", "", time() - 3600, '/');
			setcookie ("secret", "", time() - 3600, '/');
			header ("Location: " . LOGIN);
			exit;				
		}
	}

	// setting permissions cookie for admins, if secret has changed(admin has been removed), admin is logged out.
	if (isset ($_COOKIE['admin'])) {
		$r = mysqli_query ($mysqli, "SELECT `s` FROM `admin`, `admin_secret` WHERE `admin_secret`.`user_id` = " . escape_data ($_COOKIE['admin']) . " AND `admin_secret`.`data` = '" . escape_data ($_COOKIE['secret']) . "' AND `admin`.`id` = `admin_secret`.`user_id` LIMIT 1");
		if (mysqli_num_rows ($r)) {
			list ($l) = mysqli_fetch_row ($r);
			$s = ($l == 1) ? TRUE : FALSE;
			define ('ADMIN', $_COOKIE['admin']);
			define ('ADMIN_SUPER', $s);
		} else {
			setcookie ("admin", "", time() - 3600, '/');
			setcookie ("secret", "", time() - 3600, '/');
			define ('ADMIN', FALSE);
			define ('ADMIN_SUPER', FALSE);
		}
		mysqli_free_result ($r);
	} else {
		define ('ADMIN', FALSE);
		define ('ADMIN_SUPER', FALSE);
	}
	define ('ADMIN_SUPER', FALSE);

	// log an admin in
	if (!ADMIN) {
		if (isset ($_POST['e'])) { 
			require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.tools.login.php';
			$login = new login ($_POST['e'], $_POST['p']);
			$login -> enact ();
		}
		$l = ($_GET['page'] == 'dashboard') ? 'index.php' : $_GET['page'] . '.php';
	}
	

?>