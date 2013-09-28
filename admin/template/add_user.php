<section>
	<div class="container">
		<h2>add a user</h2>
		<form action="add_user.php" method="post" accept-charset="utf-8" name="add">
			<p class="formHelp" style="margin-bottom: 15px;">add which issues this new user owns by clicking the buttons in the "owned" column.</p>
			<div class="formOption">
				<label for="name">name</label><input type="text" name="name" class="textInput" />
			</div>
			<div class="formOption">
				<label for="email">email address</label><input type="text" name="email" class="textInput" />
			</div>
			<div class="formButtonRow">
				<input type="hidden" name="add_user" value="1" />
				<button type="submit" id="add_user_button">add</button>
			</div>
		</form>
	</div>
</section>
<section class="list single issues">
	<div class="container">
		<ul>
			<?php echo $list; ?>
		</ul>
	</div>
</section>			
