<?php

	if (isset ($_POST['email'])) {
	
		if (mysqli_num_rows (mysql_fetch_row (mysqli_query ($mysqli, "SELECT `email` FROM `user` WHERE `email` = '" . escape_data ($_GET['email']) . "' LIMIT 1")))) {
			
			require ROOT .'/includes/class/class.promo_code.php';
			
			$promo_code = new promo_code;
			
			$message = 'promo code has been resent to ' . $_POST['email'];
//			mail ($_GET['email'], '', ''MESSAGE_HEADERS);
		} else {
			$message = 'there is no account associated with ' . $_POST['email'];
		}

	}

	$message = (isset ($message)) ? "<section class=\"message\"><div class=\"container\"><h2>" . $message . "</h2></div></section>" : '';

?>