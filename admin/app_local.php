<?php
	
	// log user out
	if (isset ($_GET['logout'])): unset ($_SESSION['admin']); endif;

	if (!isset ($_SESSION['admin'])) {
		if (isset ($_POST['e'])) {
			list ($id) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `id` FROM `admin` WHERE `p` = '" . salty ($_POST['p']) . "' AND `e` = '" . escape_data ($_POST['e']) . "' LIMIT 1"));
			if ($id) {
				$_SESSION['admin'] = $id;
			} else {
				$message = 'try again.';
			}
		}

		$l = ($_GET['page'] == 'dashboard') ? 'index.php' : $_GET['page'] . '.php';

	}

?>