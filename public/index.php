<?php

	// page controller constants
	DEFINE ("LOCATION", 'public');
	DEFINE ("BODY_CLASS", 'public');

	// load controllers
	require '../app_global.php';
	require 'app_local.php';

	// render page
	require ROOT . 'includes/header.php';
	
	echo $message;

	?>

	<section class="resend">
		<div class="container">
			<form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post" accept-charset="utf-8">
				<legend>Forgot your Promo Code?</legend>
				<div class="formOption">
					<p class="formHelp">please enter the email address associated with your account.</p>
				</div>
				<div class="formOption">
					<label for="email">email</label><input type="text" name="email" class="textInput" />
				</div>
				<div class="formButtonRow">
					<input type="hidden" name="resend" value="1" />
					<button type="submit">submit</button>
				</div>
			</form>
		</div>
	</section>

	<?php

	require ROOT . 'includes/footer.php';

?>