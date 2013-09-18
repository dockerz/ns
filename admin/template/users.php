<?php

	// template

	if (isset ($_GET['uid'])) { $l = 'single ' . $list_type; ?>
		<section>
			<div class="container">
				<div class="cell name">
					<p>user:</p>
					<h2><?php echo $user['name']; ?></h2>			
				</div>
				<div class="cell info">
					<h3>email address:</h3>
					<p><?php echo $user['email']; ?></p>
					<?php if (USER_INFO) { ?>
					<h3>kickstarter - backer id / amount:</h3>
					<p><?php echo $user['backer_id']; ?> / <?php echo money_format ('%i', $user['amount']); ?></p>
					<?php } ?>			
				</div>
			</div>
		</section>
		<section class="actions">
			<div class="container">
				<p class="buttons"><a href="users.php">back to user list</a> | <?php echo $actions; ?> | <button class="action generate">generate code</button></p>
			</div>
		</section>
<?php } else { $l = 'multi'; ?>
		<section class="actions">
			<div class="container">
				<p class="buttons"><button class="action add">add user</button><button class="action search">search for user</button><button class="action sort">sort</button></p>
				<form action="users.php" method="get" accept-charset="utf-8" name="add"><input name="name" type="text" placeholder="name"><input name="email" type="text" placeholder="email address"><button action="do">add</button></form>
				<form action="users.php" method="get" accept-charset="utf-8" name="search"><input name="name" type="text" placeholder="name"><input name="email" type="text" placeholder="email address"><button action="do">search</button></form>
				<form action="users.php" method="get" accept-charset="utf-8" name="sort"><select name="sort" id="sort"><option value="id_ASC">user id, ascending</option><option value="id_DESC">user id, descending</option></select><button action="submit">sort</button></form>
			</div>
		</section>
<?php } ?>
		<section class="list <?php echo $l; ?>">
			<div class="container">
				<ul>
					<?php echo $list; ?>
				</ul>
			</div>
		</section>			
