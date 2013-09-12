<section class="actions">
	<div class="container">
		<p class="buttons"><button class="action add">add an issue</button><button class="action sort">sort</button></p>
		<form action="issues.php" method="get" accept-charset="utf-8" name="add" class="halt"><input name="cover" type="text" placeholder="cover"><select name="collection" id="collection"><option value="">collection</option>
			<?php
				foreach ($collections as $k1 => $v1) {
					echo "<option value='" . $k1 . "'>" . $v1 . "</option>";
				}
			?>			
		</select><button type="button">add</button></form>
		<form action="issues.php" method="get" accept-charset="utf-8" name="sort"><select name="sort" id="sort"><option value="id_ASC">issue id, ascending</option><option value="id_DESC">issue id, descending</option><option value="owner_ASC"># of owners, ascending</option><option value="owner_DESC"># of owners, descending</option></select><button action="submit">sort</button></form>
	</div>
</section>

<section class="list">
	<div class="container">
		<ul>
			<li class="definition cf"><div class="id">id</div><div class="name">cover</div><div class="collections">collection</div><div class="owners">owners</div></li>
			<?php
				foreach ($data as $k1 => $v1) {
					$cols = array ();
					if ($v1['collections']) {
						foreach ($v1['collections'] as $v2) {
							$cols[] = "<a href=\"issues.php?cid=" . $v2. "\">" . $collections[$v2] . "</a>";
						}						
					} else {
						$cols[] = '&nbsp;';
					}
					echo "<li class=\"cf\"><div class=\"id\"><span class=\"mobile id\">id: </span>" . $k1 . "</div><div class=\"name\"><span class=\"mobile cover\">cover: </span><a href=\"issues.php?iid=" . $k1 . "\">" . $v1['cover'] . "</a></div><div class=\"collections\"><span class=\"mobile collections\">collections: </span>" . implode (', ', $cols) . "</div><div class=\"owners\"><span class=\"mobile owners\"># of owners: </span>" . $v1['count'] . "</div></li>";
				}
			?>
		</ul>
	</div>
</section>				
