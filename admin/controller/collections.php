<?php

	if (isset ($_GET['sort'])) { // sort db results from "sort" dropdown
		$sort = explode ('_', $_GET['sort']);
		$sql = "SELECT * FROM `collections` ORDER BY `" . escape_data ($sort[0]) . "` " . escape_data ($sort[1]);
	} else { // standard sort -- user_id, asc
		$sql = "SELECT * FROM `collections` ORDER BY `id` ASC";
	}

	$data = array ();
	$r = mysqli_query ($mysqli, $sql);
	while ($row = mysqli_fetch_assoc ($r)) {
		$data[$row['id']]['data'] = $row['data'];
	}
	mysqli_free_result ($r);

?>
