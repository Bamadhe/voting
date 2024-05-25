<!DOCTYPE html>
<html>
<head>
	<title>Send us a message</title>
	<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
	<link rel = "stylesheet" href = "style.css"/>
</head>
<body>
<div class="hero-image"></div>
<h1>Send us a message</h1>
<?php
require_once('constants.php');

if(isset($_POST['submit'])){
 $showTheForm = false;
 $name = $_POST['name'];
 $email = $_POST['email'];
 $message = $_POST['message'];
 
 
  if(!empty($name) && !empty($email) && !empty($message))
	{
	$dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Error connection...');
     $query = "INSERT INTO messages VALUES(0, '$name', '$email', '$message', NOW())";
     mysqli_query($dbc, $query) or die('Error...');	
     mysqli_close($dbc);
     echo '<h3>Your message was sent seccussfuly</h3>';
    }
	else{ echo '<h3>Each field has to be filled!</h2>'; $showTheForm = true; }

}else{ $showTheForm = true; }


if($showTheForm)
{
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p>Name: <input type="text" name="name" value="<?php if(!empty($name)){echo $name;} ?>"/></p>
<p>E-mail: <input type="text" name="email" value="<?php if(!empty($email)){echo $email;} ?>"/></p>
<p>Message: <textarea cols="50" rows="10" name="message"><?php if(!empty($message)){echo $message;} ?></textarea></p>
<p><input type="submit" name="submit" value="Send"/></p>
</form>
<?php
}
?>
<h2><a href="main.html">Main Menu</a></h2>
</body>
</html>