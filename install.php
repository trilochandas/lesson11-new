<style>
	a{
		border:1px solid; padding: 10px;
		display: block;
		width: 60px;
		text-align: center;
	}
</style>

<form method="POST">
	<p>Server name:</p>
	<input name="host" type="text">
	<p>User name:</p>
	<input name="username" type="text">
	<p>Password:</p>
	<input name="password" type="password">
	<p>Database:</p>
	<input type="text" name="db">
	<br>
	<br>
	<input type="submit">
</form>
<?php 

if ($_POST) {
	require_once('install-connection.php');
}

?>