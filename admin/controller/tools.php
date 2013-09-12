<?php

	/*
	
	tool for attaching collections to issues
	
	$a = 1;
	while ($a <= 126) {
		mysqli_query ($mysqli, "INSERT INTO `issue_collection` (`issue_id`, `collection_id`) VALUES ('" . $a . "', 13)");
		echo mysqli_error ($mysqli);
		$a++;
	}

	*/
	
	if ((isset ($_POST['import'])) && ($_FILES['upload']['type'] == 'text/csv')) {

		$tmpName = $_FILES['upload']['tmp_name'];

		if (($handle = fopen ($tmpName, 'r')) !== FALSE) {
			echo $_FILES['upload']['name'] . "<hr />";
			$row = 0;
			while (($array = fgetcsv ($handle, 1000, ',')) !== FALSE) {
				if ($row == 0) {

					/*
						keys must be arranged as follows:

							0 => backer id,
							1 => backer name,
							2 => email,
							3 => pledge amount

					*/

					foreach ($array as $k1 => $v1) {
						switch ($v1) {
							case 'Backer Id':
								$keys[0] = $k1;
								break;
							case 'Backer Name':
								$keys[1] = $k1;
								break;
							case 'Email':
								$keys[2] = $k1;
								break;
							case 'Pledge Amount':
								$keys[3] = $k1;
								break;
						}

					}

				} else {
					foreach ($keys as $k1 => $v1) {
						switch ($k1) {
							case 1:
								$data[$k1] = utf8_decode ($array[$v1]);
								break;
							case 3:
								$data[$k1] = intval (preg_replace ('/([^0-9.]+)/', '', $array[$v1]));
								break;
							default:
								$data[$k1] = $array[$v1];
								break;
						}
					}
					$sql = "INSERT INTO `user` (`name`, `email`) VALUES ('" . escape_data ($data[1]) . "', '" . $data[2] . "')";
					if (mysqli_query ($mysqli, $sql)) {
						mysqli_query ($mysqli, "INSERT INTO `user_info` (`user_id`, `backer_id`, `amount`) VALUES ('" . mysqli_insert_id ($mysqli) . "', '" . $data[0] . "', '" . $data[3] . "')");
					} else {
						echo "<div class=\"debug\"><pre>";
						print_r ($sql);
						echo mysqli_error ($mysqli);
						echo "</pre></div>";
					}					
					unset ($data, $id);
				}
				
				$row++;
			}
			fclose ($handle);
		}
	}

	if (isset ($_POST['generate'])) {
		echo 2;
	}

?>