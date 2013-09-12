<?php

	// this action needs to become an object

	if ((!empty ($_GET['n'])) && (!empty ($_GET['e']))) {
		
		require '../../app_global.php';

		if (isset ($_SESSION['admin'])) {

			// generate random password string
			function toolGiver ($chars = 6) {
				$i = 1;
				$tool = array();
				while ($i <= $chars) {
					$tool[] = mt_rand(1, 26);
					$i++;
				}
				$rndi = mt_rand (1, $chars);
				$rndn = array();
				$n = 1;
				while ($n <= $rndi) {
					$rndn[] = mt_rand (1, $chars);
					$n++;
				}
				$rndn = array_unique ($rndn);
				foreach ($rndn as $k1 => $v1) {
					$tool[$v1] = chr (mt_rand (97, 122));
				}
				unset ($k1, $v1);
				$tool = implode (".", $tool);
				$tool = str_replace (".", "", $tool);
				return substr ($tool, 0, $chars);
			}

			$p = toolGiver ();
			$sql = "INSERT INTO `admin` (`n`, `e`, `p`) VALUES ('" . escape_data ($_GET['n']) . "', '" . escape_data ($_GET['e']) . "', '" . salty ($p) . "')";
			
			mysqli_query ($mysqli, $sql);
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