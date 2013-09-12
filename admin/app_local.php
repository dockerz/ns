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
		} else {
			require ROOT . 'includes/header.php';
			echo "<section class=\"actions show\"><div class=\"container\"><form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" accept-charset=\"utf-8\"><p class=\"form\"><input type=\"text\" name=\"e\" placeholder=\"email\" /> <input type=\"password\" name=\"p\" placeholder=\"password\" /><button type=\"submit\">login</button></p></form></div></section>";
			require ROOT . 'includes/footer.php';
			exit;
		}
	}

?>