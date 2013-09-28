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

	if (isset ($_POST['generate_ownership'])) {
		
		exit;

		mysqli_query ($mysqli, "TRUNCATE TABLE `user_issue_index`");

		$collection = array ();
		$r = mysqli_query ($mysqli, "SELECT `id`, `data`, `amount` FROM `collections`");
		while (list ($id, $name, $amount) = mysqli_fetch_row ($r)) {
			$collection[$amount] = array ('id' => $id, 'name' => $name);
			$r1 = mysqli_query ($mysqli, "SELECT `issue_id` FROM `issue_collection` WHERE `collection_id` = " . $id);
			while (list ($iid) = mysqli_fetch_row ($r1)) {
				$collection[$amount]['issues'][] = $iid;
			}
			mysqli_free_result ($r1);
		}
		mysqli_free_result ($r);
		
		$tier = array (1 => 20, 25, 35, 40, 50, 60, 100, 250);

		$r = mysqli_query ($mysqli, "SELECT `user_id`, `amount` FROM `user_info` ORDER BY `amount` ASC");

		$a = 0;

		while ($row = mysqli_fetch_assoc ($r)) {

			$issues = array ();

			if (($row['amount'] >= $tier[1]) && ($row['amount'] < $tier[2])) {
//				$a = $a + count ($collection[$tier[1]]['issues']);
				$issues = $collection[$tier[1]]['issues'];
			} elseif (($row['amount'] >= $tier[2]) && ($row['amount'] < $tier[3])) {
//				$a = $a + count ($collection[$tier[2]]['issues']);
				$issues = $collection[$tier[2]]['issues'];
			} elseif (($row['amount'] >= $tier[3]) && ($row['amount'] < $tier[4])) {
//				$a = $a + count ($collection[$tier[3]]['issues']);
				$issues = $collection[$tier[3]]['issues'];
			} elseif (($row['amount'] >= $tier[4]) && ($row['amount'] < $tier[5])) {
//				$a = $a + count ($collection[$tier[4]]['issues']);
				$issues = $collection[$tier[4]]['issues'];
			} elseif (($row['amount'] >= $tier[5]) && ($row['amount'] < $tier[6])) {
//				$a = $a + count ($collection[$tier[5]]['issues']);
				$issues = $collection[$tier[5]]['issues'];
			} elseif (($row['amount'] >= $tier[6]) && ($row['amount'] < $tier[7])) {
//				$a = $a + count ($collection[$tier[6]]['issues']);
				$issues = $collection[$tier[6]]['issues'];
			} elseif (($row['amount'] >= $tier[7]) && ($row['amount'] < $tier[8])) {
//				$a = $a + count ($collection[$tier[7]]['issues']);
				$issues = $collection[$tier[7]]['issues'];
			} elseif ($row['amount'] >= $tier[8]) {
				$issues = $collection[$tier[8]]['issues'];
			}

			mysqli_query ($mysqli, "INSERT INTO `user_issue_index` (`user_id`, `data`) VALUES ('" . $row['user_id'] . "', '" . implode (',', $issues) . "')");

		}

//		echo $a;

		mysqli_free_result ($r);

	}
	
	if ((isset ($_POST['import'])) && ($_FILES['upload']['type'] == 'text/csv')) {
		
		exit;

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

	if (isset ($_POST['generate_codes'])) {
		require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.generate.string.php';
		$string = new string;
		$r = mysqli_query ($mysqli, "SELECT `id` FROM `user`");
		$a = 0;
		while (list ($id) = mysqli_fetch_row ($r)) {
			$insert = FALSE;
			$code = $string -> generate (16);
			list ($dupe) = mysqli_fetch_row (mysqli_query ("SELECT `code` FROM `promo_code` WHERE `code` = '" . $code . " LIMIT 1"));
			if ($code !== $dupe) {
				mysqli_query ($mysqli, "INSERT INTO `promo_code` (`code`, `user_id`, `date_issued`) VALUES ('" . $code . "', '" . $id . "', '" . time (). "')");
				$a++;
			} else {
				$code = $string -> generate (16);
				if ($code !== $dupe) {
					mysqli_query ($mysqli, "INSERT INTO `promo_code` (`code`, `user_id`, `date_issued`) VALUES ('" . $code . "', '" . $id . "', '" . time (). "')");
					$a++;
				} else {
					$code = $string -> generate (16);
					if ($code !== $dupe) {
						mysqli_query ($mysqli, "INSERT INTO `promo_code` (`code`, `user_id`, `date_issued`) VALUES ('" . $code . "', '" . $id . "', '" . time (). "')");
						$a++;
					}
				}
			}
		}		
		echo $a . " users have promo codes";
	}

?>