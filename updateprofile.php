<?php 
	session_start();
	$a_nr = $_SESSION['uid'];

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Artwork</title>
<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<?php require 'menu1.php'; ?>


	<div class="container-content">
		


<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){
	if($cmd == 'update_profile') {
		$a_nr = filter_input(INPUT_POST, 'a_nr', FILTER_VALIDATE_INT) 
			or die('Missing/illegal a_nr parameter');
		
		$name = filter_input(INPUT_POST, 'name') 
			or die('<div class="infobox1"><h3>Missing/illegal artist name parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
		
		$email = filter_input(INPUT_POST, 'email') 
			or die('<div class="infobox1"><h3>Missing/illegal email parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
		
		$artist_descrip = filter_input(INPUT_POST, 'artist_descrip') 
			or die('<div class="infobox1"><h3>Missing/illegal artist description parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
		
		
		require_once('db_con.php');
		$sql = 'UPDATE artist SET name=?, email=?, artist_descrip=? WHERE id_artist=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('sssi', $name, $email, $artist_descrip, $a_nr);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo '<div class="infobox"><h3>Your profile is now updated</h3><p><a href="profile.php">Back to profile</a></p></div>';
		}
		else {
			echo '<div class="infobox"><h3>Sorry, could not update your profile</h3><p><a href="profile.php">Back to profile</a></p></div>';
		}	
	}
}
?>

<?php
	if (empty($a_nr)){
		$a_nr = filter_input(INPUT_GET, 'a_nr', FILTER_VALIDATE_INT) 
			or die('Missing/illegal a_nr parameter');	
	}
	require_once('db_con.php');
	$sql = 'SELECT  name, email, artist_descrip FROM artist WHERE id_artist=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $a_nr);
	$stmt->execute();
	$stmt->bind_result($name, $email, $artist_descrip);
	while($stmt->fetch()){} 
?>

<h2 class="login-headline">Update your profile information</h2>
<form class="login" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<input name="a_nr" type="hidden" value="<?=$a_nr?>" required />
    	<input type="text" name="name" value="<?=$name?>" required /><br><br>
    	<input type="text" name="email" value="<?=$email?>" required /><br><br>
    	<textarea rows="4" cols="100" type="text" name="artist_descrip" required><?=$artist_descrip?></textarea><br><br><br>
    	<button class="btn" name="cmd" type="submit" value="update_profile">Save update</button><br><br><br>
    	
    	<a href="profile.php">Back to profile</a>
	</fieldset>
</form>



	
</div>

<?php require 'footer.php'; ?>

</body>
</html>