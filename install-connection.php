<?php 

	try {
			$servername = $_POST['host'];
			$username = $_POST['username'];
			$password = $_POST['password'];
	    $db = $_POST['db'];
	    $conn = new PDO("mysql:host=$servername;", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $conn->exec("set names utf8");
	    $conn->exec("use {$db}");
	    $conn->exec(file_get_contents('dump.sql'));
	    echo '<h3>Welcome!</h3>';
	    echo "<a href='lesson11.php'>Enter</a>";
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: <br/>" . $e->getMessage();
	    echo '<br/>';
	    echo '<h3 style="color:#E86060;">Please try again...</h3>';
	    }
	    $loginData = serialize($_POST);
	    var_dump($loginData);
	    file_put_contents('test.txt', $loginData);