<section class="actions">
	<div class="container">
		<p class="buttons"><button class="action add">add an admin</button></p>
		<form action="admin.php" method="post" accept-charset="utf-8" name="add"><input name="n" type="text" placeholder="name"><input name="e" type="text" placeholder="email address"><button type="button">add</button></form>
	</div>
</section>
<section class="list">
	<div class="container">
		<ul>
			<li class="definition cf"><div class="id">id</div><div class="name">name</div><div class="email">email address</div></li>
			<?php
				$r = mysqli_query ($mysqli, "SELECT * FROM `admin` ORDER BY `id` ASC");
				while ($row = mysqli_fetch_assoc ($r)) {
					echo "<li class=\"cf\"><div class=\"id\"><span class=\"mobile id\">id: </span>" . $row['id'] . "</div><div class=\"name\"><span class=\"mobile name\">name: </span>" . $row['n'] . "</div><div class=\"email\"><span class=\"mobile email\">email: </span><a href=\"mailto:" . $row['e'] . "\">" . $row['e'] . "</a></div></li>";
				}
			?>
		</ul>
	</div>
</section>				