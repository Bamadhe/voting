<!DOCTYPE html>
<html>
<head>
 <title>Show my data</title>
 <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
 <link rel = "stylesheet" href = "style.css"/>
 <script type = "text/javascript" src = "reg.js"></script>
</head>
<body>
<div class="hero-image"></div>
<h1>Enter your PIN code!</h1>

	<form id = "formId" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<fieldset>
			<p>PIN: <input type="text" name="pin"/></p>
			<p><input type="submit" name="submit" value="Show my data"/><p>
			</fieldset>
	</form>
	</br>
	
<?php
 require_once('constants.php');

 if(isset($_POST['submit']))
 {
	$dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
	$pin = $_POST['pin'];
	$query = "SELECT * FROM travelers WHERE pin=$pin ";
	$result = mysqli_query($dbc, $query) or die('Error...');
	
	  	while($row = mysqli_fetch_array($result))
  	{
	echo '<h3><img src="'.PATH.$row['picture'].'"/><ul><li>Name: '.$row['name'].'</li><li>E-mail: '.$row['email'].'</li><li>Age: '.$row['age'].'</li><li>Gender: '.$row['gender'].'</li><li>Phone Number: '.$row['phone'].'</li><li>Address: '.$row['address'].'</li><li>Fee: '.$row['fee'].'</li><li>Registration date: '.$row['regDate'].'</li><li>Package: '.$row['package'].'</li><li>Status: '.$row['approved'].'</li></ul></h3>';	
	echo '<p> Package: [1 = VIP] , [2 = Econemy]</p>';
	echo '<p> Status: [0 = Not Approved] , [1 = Approved]</p>';
 	}
	mysqli_close($dbc);
 }
 
?>	
	  
<h2><a href = "main.html">Main Menu</a></h2>

</body>
</html>