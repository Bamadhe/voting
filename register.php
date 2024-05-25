<!DOCTYPE html>
<html>
<head>
 <title>2021 Summer Trip Registration</title>
 <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
 <link rel = "stylesheet" href = "style.css"/>
 <script type = "text/javascript" src = "reg.js"></script>
</head>
<body>
<div class="hero-image"></div>
<h1>Join us this summer!</h1>

<?php
require_once('constants.php');

if(isset($_POST['submit'])){
 $showTheForm = false;
 $name = $_POST['name'];
 $email = $_POST['email'];
 $pin = $_POST['pin'];
 $age = $_POST['age'];
 $phone = $_POST['phone'];
 $address = $_POST['address'];
 $fee = $_POST['fee'];
 $package = $_POST['package'];
 $gender = $_POST['gender'];
 
 if(!empty($name) && !empty($email) && !empty($age) && !empty($pin) && !empty($phone) && !empty($address) && !empty($fee) && $package!=0 && !empty($gender) && !empty($_FILES['picture']['name'])){
 
 	$pictureError = $_FILES['picture']['error'];
 	$pictureType = $_FILES['picture']['type'];
 	$pictureSize = $_FILES['picture']['size'];
 	
 	if($pictureError == 0 && $pictureSize > 0 && $pictureSize <= MAXFS && ($pictureType == 'image/gif' || $pictureType == 'image/jpeg' || $pictureType == 'image/pjpeg' || $pictureType == 'image/png'))
 	{                    
    $tempFolder = $_FILES['picture']['tmp_name'];
    $picture = time().$_FILES['picture']['name'];
    $target = PATH.$picture;
    
    if(move_uploaded_file($tempFolder, $target))
    {
     $dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Error connection...');
     $query = "INSERT INTO travelers VALUES(0, '$name', '$email', '$pin', '$age', '$phone','$address', '$fee', '$package', '$gender', '$picture', NOW(),0)";
     mysqli_query($dbc, $query) or die('Error...');	
     mysqli_close($dbc);
     echo '<h3>Successful registration, please wait for admin approval</h3>';
     echo '<h3><a href="'.$_SERVER['PHP_SELF'].'">Register Another Traveler</a></h3>';
    }else{ echo '<h3>There is no picture..</h3>'; $showTheForm = true; }
 	
 	}else{ echo '<h3>Error: gif, jpg, jpeg, png are acceptable! Maximum size: '.MAXFS.' bytes. It has to be greater then 0 bytes!</h3>'; $showTheForm = true; }
 
 }else{ echo '<h3>There are some empty fields...</h3>'; $showTheForm = true; }
	
}else{ $showTheForm = true; }

if($showTheForm)
{
?>
<form id = "formId" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>" enctype = "multipart/form-data">
<input type = "hidden" name = "MAX_FILE_SIZE" value = "<?php echo MAXFS; ?>"/>
<fieldset>
 <p>Name: <input type = "text" id = "name" name = "name" value = "<?php if(!empty($name)){echo $name;} ?>"/></p>
 <p>Email: <input type="text" id = "email" name = "email" value = "<?php if(!empty($email)){echo $email;} ?>"/></p>
 <p>PIN code: <input type="text" id = "pin" name = "pin" value = "<?php if(!empty($pin)){echo $pin;} ?>"/></p> 
 <p>Age: <input type = "text" id = "age" name = "age" value="<?php if(!empty($age)){echo $age;} ?>"/></p>
 <p>Phone number: <input type = "text" id = "phone" name = "phone" value="<?php if(!empty($phone)){echo $phone;} ?>"/></p>
 <p>Address: <input type = "text" id = "address" name = "address" value="<?php if(!empty($address)){echo $address;} ?>"/></p>
 <p>Fee: <input type = "text" id = "fee" name = "fee" value="<?php if(!empty($fee)){echo $fee;} ?>"/></p>
</fieldset>

<fieldset>
 <p>Trip Package: 
  <select id = "package" name = "package">
   <option value = "0">Select Your package...</option>
   <option value = "1">VIP</option>
   <option value = "2">Econemy</option>
  </select>
 </p>
</fieldset>

<fieldset>
 <p>
  Gender: male<input type = "radio" name = "gender" value = "male"/>	female<input type = "radio" name = "gender" value = "female"/>	
 </p>
</fieldset>

<fieldset>
  <p>Upload Your Picture: <input type = "file" name = "picture"/></p>
</fieldset>

<fieldset id = "last">
 <p id = "buttons">
  <p><input type = "reset" value = "Reset my data"></p>
  <p><input type = "submit" name = "submit" value = "Register for the trip" id = "reg"></p>
 </p>
</fieldset>

<p><ul id = "errorList"></ul></p>
</form>
<?php
}
?>

<h2><a href = "main.html">Main Menu</a></h2>

</body>
</html>