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
	if($cmd == 'update_art') {
		$art_id = filter_input(INPUT_POST, 'art_id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal art_id parameter');
		$title = filter_input(INPUT_POST, 'title') 
			or die('<div class="infobox1"><h3>Missing/illegal title parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
		$art_descrip = filter_input(INPUT_POST, 'art_descrip') 
			or die('<div class="infobox1"><h3>Missing/illegal art description parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
		$category = filter_input(INPUT_POST, 'category') 
			or die('Missing/illegal category parameter');
		
		require_once('db_con.php');
		$sql = 'UPDATE art SET title=?, art_descrip=?, category=? WHERE id_art=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('sssi', $title, $art_descrip, $category, $art_id);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo '<div class="infobox"><h3>Your art post is now updated</h3><p><a href="profile.php">Back to profile</a></p></div>';
		}
		else {
			echo '<div class="infobox"><h3>Could not update your post.</h3> <p>There are no changes.</p><p><a href="profile.php">Back to profile</a></p></div>';
		}	
	}
}
?>

<?php
	if (empty($art_id)){
		$art_id = filter_input(INPUT_GET, 'art_id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal art_id parameter');	
	}
	require_once('db_con.php');
	$sql = 'SELECT title, art_descrip, category FROM art WHERE id_art=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $art_id);
	$stmt->execute();
	$stmt->bind_result($title, $art_descrip, $category);
	while($stmt->fetch()){} 
?>



<h2 class="login-headline">Update your art post</h2>
<form class="login" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<input name="art_id" type="hidden" value="<?=$art_id?>" required/>
    	<input type="text" name="title" value="<?=$title?>" required/><br><br>
    	<textarea rows="4" cols="100" type="text" name="art_descrip" required><?=$art_descrip?></textarea><br><br>
    	<select name="category" required>
                   <option><?=$category?></option>
                    <option value="Painting">Painting</option>
                    <option value="Drawing">Drawing</option>
                    <option value="Graphic">Graphic</option>
                    <option value="Architectural">Architectural</option>
                    <option value="Photograph">Photograph</option>
                    <option value="Street-art">Steet art</option>
                    <option value="Body-paint">Body paint</option>
                    <option value="Space-art">Space art</option>
                    <option value="Symbolism">Symbolism</option>
                    <option value="Other">Other</option>
                </select><br><br>
    	<button class="btn" name="cmd" type="submit" value="update_art">Save update</button><br><br><br><br>
    	<a href="profile.php">Back to profile</a>
	</fieldset>
</form>

	</div>

<?php require 'footer.php'; ?>

</body>
</html>