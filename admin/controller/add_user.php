<?php

	// controller
	
	if (!SUPER_ADMIN): exit; endif;
	
	if (isset ($_POST['add_user'])) {
		
	} else {

	}

	require $_SERVER['DOCUMENT_ROOT'] . '/classes/class.list.issues.php';
	
	$argument = array (
		'id' => array (
			'type' => 'uid',
			'value' => 0
		),
		'show' => 'ownership',
		'sorted' => FALSE,
	);

	$data_list = new data_list ($argument);
	$list = $data_list -> render ();
	
	unset ($argument);
	
	$js = "
	<script type=\"text/javascript\" charset=\"utf-8\">
		$('#add_user_button')
			.click(function (e) {
				e.preventDefault();
				var halt = false,
					message = '';
				if ($('form[name=\"add\"] input[name=\"name\"]').val() == '') {
					message += 'please enter a name. ';
					halt = true;
				}
				if ($('form[name=\"add\"] input[name=\"email\"]').val() == '') {
					message += 'please enter an email address. ';
					halt = true;
				}
				if (halt) {
					alert(message);
				} else {
					var issues = new Array (),
						inputData = {};
					$('.list ul li .ownership .active')
						.each(function(i) {
							issues.push($(this).attr('id').split('-')[1]);
						})
					inputData.name = $('form[name=\"add\"] input[name=\"name\"]').val();
					inputData.email = $('form[name=\"add\"] input[name=\"email\"]').val();
					inputData.ownership = issues.join(',');
					$.ajax({
						url: 'ajax/add_user.php',
						data: inputData
					})
					.done(function (r) {
						if (r) {
							window.location = 'users.php?uid=' + r;
						} else {
							alert('user not added');
						}
					})
					.fail(function () {
						alert('user not added');
					})					
				}
				
			});
	</script>";
	

?>