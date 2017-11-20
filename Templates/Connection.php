<?php
	try {
		$db = new PDO('mysql:host=localhost;dbname=y91036d3_ss1', 'y91036d3_ss1', '361451qqq', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	} catch (PDOException $e) {
		exit($e->getMessage());
	}
?>