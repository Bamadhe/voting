<?php
	$user = 'admin';
	$passwd = 'root';
	if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER']!=$user) || ($_SERVER['PHP_AUTH_PW']!=$passwd))
	{
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="Admin"');
		exit('Error....');
	}
?>
