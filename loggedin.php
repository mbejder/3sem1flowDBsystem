<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<? require('menu1.php');?>
	
	
<div class="container">
	<div class="container-content">
	
	
	<?php
	
	require_once('db_con.php');
	$sql = 'SELECT email, name, artist_descrip, artist.last_update FROM artist WHERE id_artist =?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $a_nr);
	$stmt->execute();
	$stmt->bind_result($email, $name, $artist_descrip, $artist_update);
	
	while($stmt->fetch()){ ?>
	<div class="profile">
	<h2>Profile information</h2><br>
		<h3><?=$name?> <a href="updateprofile.php?art_id=<?=$art_id?>">Update profile</a></h3><br>
		<p><b>Email: </b><br> <?=$email?></p><br><br>
		<p><b>Artist description: </b><br><?=$artist_descrip?></p>
		
	</div>
	
	<?php } ?>

	
	<div class="upload">
	<form action="upload.php" method="post" enctype="multipart/form-data">
	<legend>Upload your art</legend>
		<input type="text" name="title" placeholder="Image title" required><br><br>
		<select name="category" required>
            <option selected disabled>Category</option>
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
		<textarea rows="4" cols="100" type="text" name="art_descrip" placeholder="Art description" required maxlength="1000 char"></textarea><br><br>
		<input type="file" name="fileToUpload" id="fileToUpload" required><br><br>
		
		<input class="uploadbtn" type="submit" value="Upload Image" name="submit">
	</form>
	
	</div>
	</div>
	
	
	<div class="container-content">
	<h2 class="headline">All of my art posts</h2>
	
	
	
	
	
	
	 <?php	
	
	if($cmd = filter_input(INPUT_POST, 'cmd')){
		
		$url = filter_input(INPUT_POST, 'url')
			or die('<div class="upload-info"><h3>Missing/illegal url parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
		
		if($cmd == 'del_art'){
			$art_id = filter_input(INPUT_POST, 'art_id')
			or die('missing/illegal art_id parameter');

			require_once('db_con.php');
			$sql = "DELETE FROM art WHERE id_art=?";
			$stmt = $con->prepare($sql);
			$stmt->bind_param('i', $art_id);
			$stmt->execute();

			if($stmt->affected_rows > 0){
				echo '<div class="info"><h3>Deleted art post '.$url.'</h3></div>';
				unlink($url);
			}
			else{
				echo 'Could not delete art post';
			}
		}
		else {
			die ('unknown cmd: '.$cmd);
		}	
	}
	
	
	require_once('db_con.php');
	$sql = 'SELECT id_art, title, imageurl, art_descrip, category, art.last_update, artist.name FROM art, artist WHERE id_artist = artist_nr and id_artist = ? ORDER BY art.last_update DESC';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $a_nr);
	$stmt->execute();
	$stmt->bind_result($art_id, $title, $url, $art_descrip, $category, $time, $artist_name);
	
	while($stmt->fetch()){ ?>
	<div class="post">
		
		<p class="time"><?=$time?>
		
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<input type="hidden" name="url" value="<?=$url?>"/>
				<input type="hidden" name="art_id" value="<?=$art_id?>"/>
				<button class="delete" type="submit" value="del_art" name="cmd"><img src="pics/delete.png"></button>
			</form><a href="updateart.php?art_id=<?=$art_id?>"><img id="edit" src="pics/edit.png"></a></p><br>
		
		<h3 class="post-profile-title"><?=$title?></h3>
		<p>Category: <a href="categories.php?category=<?=$category?>"><?=$category?></a><br>
		Artist: <a href="artist-profile.php?a_nr=<?=$a_nr?>"><?=$artist_name?></a></p>
		<img src="<?=$url?>"/>
		<p><b>Description:</b><br><?=$art_descrip?></p>
		
		<br>
		
	</div>
		
	
	<?php } ?>
	
	
	<div class="spacer"></div>
	<div class="spacer"></div>
	</div>
</div>
	
	
</body>
</html>