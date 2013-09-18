<section class="actions">
	<div class="container">
		<p class="buttons"><button class="action add_issue">add an issue</button><button class="action sort">sort</button></p>
		<form action="issues.php" method="get" accept-charset="utf-8" name="add_issue" class="halt"><input name="cover" type="text" value="<?php echo $new_issue; ?>" /><button type="button">add</button></form>
		<form action="issues.php" method="get" accept-charset="utf-8" name="sort"><select name="sort" id="sort"><option value="id_ASC">issue id, ascending</option><option value="id_DESC">issue id, descending</option><option value="owner_ASC"># of owners, ascending</option><option value="owner_DESC"># of owners, descending</option></select><button action="submit">sort</button></form>
	</div>
</section>

<section class="list">
	<div class="container">
		<ul>
			<?php echo $list; ?>
		</ul>
	</div>
</section>				
