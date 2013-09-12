<section class="actions">
	<div class="container">
		<p class="buttons"><button class="action add">add a collection</button><button class="action sort">sort</button></p>
		<form action="collections.php" method="post" accept-charset="utf-8" name="add" class="halt"><input name="collection" type="text" placeholder="collection name"><button type="button">add</button></form>
		<form action="collections.php" method="get" accept-charset="utf-8" name="sort"><select name="sort" id="sort"><option value="id_ASC">id, ascending</option><option value="id_DESC">id, descending</option></select><button action="submit">sort</button></form>
	</div>
</section>

<section class="list">
	<div class="container">
		<ul>
			<li class="definition cf"><div class="id">id</div><div class="name">collection</div></li>
			<?php
				foreach ($data as $k1 => $v1) {
					echo "<li class=\"cf\"><div class=\"id\"><span class=\"mobile id\">id: </span>" . $k1 . "</div><div class=\"name\"><span class=\"mobile name\">name: </span><a href=\"issues.php?cid=" . $k1 . "\">" . $v1['data'] . "</a></div></li>";
				}
			?>
		</ul>
	</div>
</section>				
