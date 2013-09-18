<?php

	// controller

	if (isset ($_GET['cid'])) { // show only results that have a specific collection with this cid
		$argument = array (
			'id' => array (
				'type' => 'cid',
				'value' => $_GET['cid']
			),
			'show' => 'count',
			'sorted' => FALSE,
		);
	} else {
		$argument = array (
			'id' => array (
				'type' => NULL,
				'value' => NULL
			),
			'show' => 'count'
		);
		$argument['sorted'] = (isset ($_GET['sort'])) ? $_GET['sort'] : FALSE;
	}

	require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.list.issues.php';
	
	$data_list = new data_list ($argument);
	$list = $data_list -> render ();
	
	list ($iid) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT `id` FROM `issue` ORDER BY `id` DESC"));
	$new_issue = $iid + 1;
	
	unset ($argument, $iid);

?>