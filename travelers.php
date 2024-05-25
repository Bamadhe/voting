<!DOCTYPE html>
<html lang="en">
<head>
	<title>Approved Travelers</title>
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
	<link rel = "stylesheet" href = "style.css"/>
</head>
<body>
	<div class="hero-image"></div>
	<h1>Approved Travelers</h1>
<?php
	require_once('constants.php');
	$dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
	$query = "SELECT * FROM travelers WHERE  approved=1";
	$result = mysqli_query($dbc, $query) or die('Error...');
  	while($row = mysqli_fetch_array($result))
  	{
		echo '<h3><img src="'.PATH.$row['picture'].'"/><ul><li>Name: '.$row['name'].'</li><li>Age: '.$row['age'].'</li><li>Gender: '.$row['gender'].'</li><li>Package: '.$row['package'].'</li><li>Status: <strong>Approved</strong></li></ul></h3>';	              
 	}
	mysqli_close($dbc);
?>
<h2><a href = "main.html">Main Menu</a></h2>
</body>
</html>
