<?php
	if (isset ($_GET['uid'])) { // viewing individual member
?>
<section>
	<div class="container">
		<table>
			<tr>
				<td class="cell name">
					<p>user:</p>
					<h2><?php echo $user['name']; ?></h2>
				</td>
				<td class="spacer">&nbsp;</td>
				<td class="cell info">
					<h3>email address:</h3>
					<p><?php echo $user['email']; ?></p>
					<?php if (USER_INFO) { ?>
					<h3>kickstarter - backer id / amount:</h3>
					<p><?php echo $user['backer_id']; ?> / <?php echo money_format ('%i', $user['amount']); ?></p>
					<?php } ?>
				</td>
			</tr>
		</table>
	</div>
</section>
<section class="actions">
	<div class="container">
		<p class="buttons"><a href="users.php">back to user list</a><button class="action generate">generate code</button></p>
	</div>
</section>
<section class="list single">
	<div class="container">
		<ul>
			<li class="definition cf"><div class="name">name</div><div class="email">email address</div><div class="codes">promo code</div><div class="status">status</div></li>
			<li class="cf"><div class="name"><a href="users.php?uid=1">Nice Name</a></div><div class="email">foo@bar.com<a href="mailto:foo@bar.com" class="btn">email</a></div><div class="codes">#4h23h2h435hern</div><div class="status"><span class="yes">&nbsp;</span></div></li>
			<li class="cf"><div class="name"><a href="users.php?uid=1">Nice Name</a></div><div class="email">foo@bar.com<a href="mailto:foo@bar.com" class="btn">email</a></div><div class="codes">#4h23h2h435hern</div><div class="status"><span class="no">&nbsp;</span></div></li>
			<li class="cf"><div class="name"><a href="users.php?uid=1">Nice Name</a></div><div class="email">foo@bar.com<a href="mailto:foo@bar.com" class="btn">email</a></div><div class="codes">#4h23h2h435hern</div><div class="status"><span class="yes">&nbsp;</span></div></li>
			<li class="cf"><div class="name"><a href="users.php?uid=1">Nice Name</a></div><div class="email">foo@bar.com<a href="mailto:foo@bar.com" class="btn">email</a></div><div class="codes">#4h23h2h435hern</div><div class="status"><span class="maybe">&nbsp;</span></div></li>
			<li class="cf"><div class="name"><a href="users.php?uid=1">Nice Name</a></div><div class="email">foo@bar.com<a href="mailto:foo@bar.com" class="btn">email</a></div><div class="codes">#4h23h2h435hern</div><div class="status"><span class="maybe">&nbsp;</span></div></li>
			<li class="cf"><div class="name"><a href="users.php?uid=1">Nice Name</a></div><div class="email">foo@bar.com<a href="mailto:foo@bar.com" class="btn">email</a></div><div class="codes">#4h23h2h435hern</div><div class="status"><span class="yes">&nbsp;</span></div></li>
		</ul>
	</div>
</section>
<?php
	} else { // view entire list of members
?>
<section class="actions">
	<div class="container">
		<p class="buttons"><button class="action search">search for user</button><button class="action sort">sort</button></p>
		<form action="users.php" method="get" accept-charset="utf-8" name="search"><input name="name" type="text" placeholder="name"><input name="email" type="text" placeholder="email address"><button action="do">search</button></form>
		<form action="users.php" method="get" accept-charset="utf-8" name="sort"><select name="sort" id="sort"><option value="id_ASC">user id, ascending</option><option value="id_DESC">user id, descending</option></select><button action="submit">sort</button></form>
	</div>
</section>

<section class="list multi">
	<div class="container">
		<ul>
			<li class="definition cf"><div class="name">name</div><div class="email">email address</div><div class="codes">promo code</div><div class="status">status</div></li>
			<?php
				foreach ($page as $k1 => $v1) {
					echo '<li class="cf"><div class="name"><a href="users.php?uid=' . $v1['id'] . '">' . htmlentities ($v1['name']) . '</a></div><div class="email">' . $v1['email'] . '<a href="mailto:' . $v1['email'] . '" class="btn">email</a></div><div class="codes"></div><div class="status"><span class="yes">&nbsp;</span></div></li>';
				}
			?>
		</ul>
	</div>
</section>				

<?php
	}
?>