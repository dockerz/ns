<?php

	if ((!empty ($_GET['n'])) && (!empty ($_GET['e']))) {
		require $_SERVER['DOCUMENT_ROOT'] . '/app_global.php';
		if (SUPER_ADMIN) {
			require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.generate.string.php';
			$string = new string;
			$p = $string -> generate (6);
			mysqli_query ($mysqli, "INSERT INTO `admin` (`n`, `e`, `p`, `o`) VALUES ('" . escape_data ($_GET['n']) . "', '" . escape_data ($_GET['e']) . "', '" . salty ($p) . "', '" . escape_data ($_GET['o']) . "')");
			$id = mysqli_insert_id ($mysqli);
			$message['body'] = "You have been made a New Scribbler admin

Your password is: " . $p . "
You can log in here: " . LOGIN;
			if (mail ($_GET['e'], 'Welcome to New Scribbler', $message['body'], MESSAGE_HEADERS)): echo $id; endif;
		} else {
			echo FALSE;
		}
	} else {
		echo FALSE;
	}

?>