<section class="form">
	<div class="container">
		<form action="tools.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<div class="formOption">
				<p><strong>import a list of users with this tool. import file must be in csv format!</strong></p>
			</div>
			<div class="formOption">
				<input type="hidden" name="import" value="1" />
				<input type="file" name="upload" /><button type="submit">do it!</button>
			</div>
		</form>
	</div>
</section>
<section class="divider">
	<div class="container">
		<hr />
	</div>
</section>
<section class="codes">
	<div class="container">
		<div class="formOption">
			<form action="tools.php" method="post" accept-charset="utf-8">
				<input type="hidden" name="generate_codes" value="1" />
				<p><strong>generate promo codes for all users who don't have one</strong> <button type="submit">do it!</button></p>
			</form>
		</div>
	</div>
</section>
<section class="divider">
	<div class="container">
		<hr />
	</div>
</section>