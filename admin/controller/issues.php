<?php

	// set up db query
	if (isset ($_GET['cid'])) { // show only results that have a specific collection with this cid
		$sql = "SELECT `issue`.`id`, `issue`.`name` FROM `issue`, `issue_collection` WHERE `issue_collection`.`collection_id` = " . escape_data ($_GET['cid']) . " AND `issue_collection`.`issue_id` = `issue`.`id` ORDER BY `id` ASC";
	} elseif (isset ($_GET['iid'])) { 
		$sql = "SELECT `issue`.`id`, `issue`.`name` FROM `issue`, `issue_collection` WHERE `issue`.`id` = " . escape_data ($_GET['iid']) . " AND `issue_collection`.`issue_id` = `issue`.`id` ORDER BY `id` ASC";
	} else {
		if (isset ($_GET['sort'])) { // sort db results from "sort" dropdown
			$sort = explode ('_', $_GET['sort']);
			switch ($sort[0]) {
				case 'id': // sort by id
					$sql = "SELECT * FROM `issue` ORDER BY `" . escape_data ($sort[0]) . "` " . escape_data ($sort[1]);
					break;
				default: // sort by quantity popularity
					$sql = "SELECT * FROM `issue` ORDER BY `id` ASC";
					break;
			}
		} else { // standard sort -- user_id, asc
			$sql = "SELECT * FROM `issue` ORDER BY `id` ASC";
		}
	}

	// get issues from db
	$data = array ();
	$r = mysqli_query ($mysqli, $sql);

	while ($row = mysqli_fetch_assoc ($r)) {

		$data[$row['id']]['cover'] = $row['name'];
		$data[$row['id']]['count'] = mt_rand (1, 1000); // temporary count, put into query

		// get this issue's associated collection(s)
		$r1 = mysqli_query ($mysqli, "SELECT `collection_id` FROM `issue_collection` WHERE `issue_id` = " . $row['id'] . " AND (`collection_id` > 4 AND `collection_id` < 12) ORDER BY `id` ASC");
		if (mysqli_num_rows ($r1)) { // has collection, put into array
			while ($row1 = mysqli_fetch_assoc ($r1)) {
				$data[$row['id']]['collections'][] = $row1['collection_id'];
			}
		} else {
			$data[$row['id']]['collections'] = FALSE; // does not have collection
		}

		mysqli_free_result ($r1);

	}

	mysqli_free_result ($r);

	if (!isset ($_GET['iid'])) { // this query is not needed if only showing info on a single issue
		
		// get issue collections from the db
		$collections = array ();
		$r = mysqli_query ($mysqli, "SELECT * FROM `collections` ORDER BY `id` ASC");

		while ($row = mysqli_fetch_assoc ($r)) {
			$collections[$row['id']] = $row['data'];
		}

		mysqli_free_result ($r);

	}

?>