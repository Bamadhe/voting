<!DOCTYPE html>
<html lang="en">
<head>
	<title>Messages</title>
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
	<link rel = "stylesheet" href = "style.css"/>
</head>
<body>
	<div class="hero-image"></div>
	<h1>Messages</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
	require_once('auth.php');
	require_once('constants.php');
	
 $dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
 $query = "SELECT * FROM messages";
 $result = mysqli_query($dbc, $query) or die('Error...');
 while($row = mysqli_fetch_array($result))
 {
	echo '<h3><input type="checkbox" name="todelete[]" value="'.$row['id'].'"/> ';
	echo '<ul><li>Name: '.$row['name'].'</li><li>E-mail: '.$row['email'].'</li><li>Message: <p>'.$row['message'].'</p></br></li><li>Time: '.$row['messageTime'].'</li></h3></ul>';
 }
 mysqli_close($dbc); 
?>
<p><input type = "submit" name = "submit" value = "Delete Selected Messages"/></p>
</form>	
	
<?php
	
	if(isset($_POST['submit']))
  {
  $dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
  foreach($_POST['todelete'] as $toDelete)
  {
   $query = "SELECT * FROM messages WHERE id=$toDelete";
   $result = mysqli_query($dbc, $query) or die('Error...');
   $row = mysqli_fetch_array($result);
   $query = "DELETE FROM messages WHERE id=$toDelete";
   mysqli_query($dbc, $query) or die('Error...');
  }
  mysqli_close($dbc); 
  echo '<h3>Message has been deleted.</h3>';
  echo "<meta http-equiv='refresh' content='2'>";
 }
?>

<h2><a href = "main.html">Main Menu</a></h2>
</body>
</html>