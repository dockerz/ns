<?php

	list ($data['issues']) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT COUNT(`id`) FROM `issue`"));
	list ($data['users']) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT COUNT(`id`) FROM `user`"));
	list ($data['collections']) = mysqli_fetch_row (mysqli_query ($mysqli, "SELECT COUNT(`id`) FROM `collections`"));

?>