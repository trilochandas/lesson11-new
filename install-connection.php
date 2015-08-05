<?php 

	try {
			$servername = $_POST['host'];
			$username = $_POST['username'];
			$password = $_POST['password'];
	    $db = $_POST['db'];
	    $conn = new PDO("mysql:host=$servername;", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql1 = "use {$db}";
	    $sql2 = "CREATE TABLE `adverts` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `private` tinyint(2) NOT NULL,
						  `seller_name` varchar(30) NOT NULL,
						  `email` varchar(50) NOT NULL,
						  `allow_mails` tinyint(1) NOT NULL,
						  `phone` varchar(14) NOT NULL,
						  `city` varchar(30) NOT NULL,
						  `metro` varchar(30) NOT NULL,
						  `category_id` varchar(5) NOT NULL,
						  `title` varchar(50) NOT NULL,
						  `description` text NOT NULL,
						  `price` mediumint(7) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;
						INSERT INTO `adverts` (`id`, `private`, `seller_name`, `email`, `allow_mails`, `phone`, `city`, `metro`, `category_id`, `title`, `description`, `price`) VALUES
						(1,	0,	'11111',	'',	0,	'1111',	'',	'0',	'',	'1111',	'1111',	11111),
						(2,	0,	'asdf',	'asdf@asdf.asdf',	0,	'123',	'',	'0',	'',	'321',	'321',	321),
						(3,	0,	'222',	'',	0,	'222',	'',	'0',	'',	'222',	'222',	222),
						(4,	0,	'444',	'',	0,	'444',	'',	'0',	'',	'444',	'444',	444),
						(5,	0,	'',	'454',	0,	'455',	'',	'0',	'',	'454',	'454',	454),
						(6,	1,	'Trilochan das',	'tri@f.rudas',	0,	'8883331111',	'16108',	'2',	'3',	'TestAdvert Test2',	'Test text Test2',	1081),
						(7,	0,	'',	'',	0,	'',	'',	'',	'',	'',	'',	108),
						(8,	0,	'das',	'',	0,	'',	'',	'',	'',	'',	'',	0);
						CREATE TABLE `select_meta` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(20) NOT NULL,
						  `label` varchar(20) NOT NULL,
						  `options` longtext NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;

						INSERT INTO `select_meta` (`id`, `name`, `label`, `options`) VALUES
						(1,	'city',	'Город',	'{\"\":\"Выберите город\",\"64\":\"Маяпур\", \"16108\":\"Пури\", \"108\":\"Вриндаван\"}'),
						(2,	'metro',	'Метро',	'[\"Выберите станцию\",\"Deli-Aeropor\", \"Jabo\", \"Haribo\"]'),
						(3,	'Categorys',	'Категории',	'{\"\":\"Выберите категорию\",\"Спорт\":{\"6\":\"Гольф\",\"9\":\"Крикет\",\"7\":\"Плавание\"},\"Отдых\":{\"3\":\"Сауна\",\"1\":\"Массаж\"}}')";
			$sql3= "DROP DATABASE {$db}; CREATE DATABASE {$db};";
	    $conn->exec("set names utf8");
	    $conn->exec($sql3);
	    $conn->exec($sql1);
	    $conn->exec($sql2);
	    echo '<h3>Welcome!</h3>';
	    echo "<a href='lesson11.php'>Enter</a>";
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: <br/>" . $e->getMessage();
	    echo '<br/>';
	    echo '<h3 style="color:#E86060;">Please try again...</h3>';
	    }

	    file_put_contents('test.txt', $_POST);