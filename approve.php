<!DOCTYPE html>
<html>
<head>
	<title>Approve Travelers</title>
	<meta http-equiv = "Content-Type" content="text/html; charset=utf-8"/>
	<link rel = "stylesheet" href = "style.css"/>
</head>
<body>
<div class="hero-image"></div>
<h1>Approve Travelers</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
 require_once('auth.php');
 require_once('constants.php');
 
 $dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
 $query = "SELECT * FROM travelers WHERE approved=0";
 $result = mysqli_query($dbc, $query) or die('Error...');
 while($row = mysqli_fetch_array($result))
 {
  echo '<h3><input type="checkbox" name="toApprove[]" value="'.$row['id'].'"/> ';
  echo '<img src="'.PATH.$row['picture'].'"/><ul><li>Name: '.$row['name'].'</li><li>E-mail: '.$row['email'].'</li><li>Age: '.$row['age'].'</li><li>Gender: '.$row['gender'].'</li><li>Phone Number: '.$row['phone'].'</li><li>Address: '.$row['address'].'</li><li>Package: '.$row['package'].'</li><li>Fee: '.$row['fee'].'</li><li>Registration date: '.$row['regDate'].'</li></br></h3></ul>';
 }
 mysqli_close($dbc); 
?>
<p><input type = "submit" name = "submit" value = "Approve Selected Travelers"/></p>
</form>

<?php


 if(isset($_POST['submit']))
 {
  $dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
  foreach($_POST['toApprove'] as $toApprove)
  {
   $query = "UPDATE travelers SET approved=1 WHERE id=$toApprove";
   mysqli_query($dbc, $query) or die('Error...');
   
  }
  mysqli_close($dbc); 
  echo '<h3>Registration of the selected travelers have been succesfully approved.</h3>';
  echo "<meta http-equiv='refresh' content='3'>";
 }
?>

<h2><a href = "main.html">Main Menu</a></h2>
</body>
</html>