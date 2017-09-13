<?php 
	session_start();
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

<?php
	if(empty($_SESSION['uid'])){
		require 'menu.php'; 
	}
	else{
		require 'menu1.php'; 
	}
	?>

	<div class="container">
		<div class="container-content">
	
	
	<?php
		
	$id_artist = filter_input(INPUT_GET, 'id_artist', FILTER_VALIDATE_INT)
		or die('missing/illegal artist parameter');
		
	
	require_once('db_con.php');
	$sql = 'SELECT email, name, artist_descrip, artist.last_update, id_artist FROM artist WHERE id_artist =?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $id_artist);
	$stmt->execute();
	$stmt->bind_result($email, $name, $artist_descrip, $artist_update, $id_artist);
	
	while($stmt->fetch()){ ?>
	<div class="artist-profile">
		<h2 >Profile information</h2><br>	
		<h3><?=$name?></h3>
		<p>email: <?=$email?></p><br><br>
		<p><b>Artist description: </b><br><?=$artist_descrip?></p>
		
	</div>
	
	<?php } ?>
	
	
	
	
	<h2 class="artist-profile-headline"><?=$name?>'s art posts</h2>
	
	<?php
	require_once('db_con.php');
	$sql = 'SELECT id_art, title, imageurl, art_descrip, category, art.last_update, artist.name, id_artist FROM art, artist WHERE id_artist = artist_nr and id_artist = ? ORDER BY art.last_update DESC';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $id_artist);
	$stmt->execute();
	$stmt->bind_result($art_id, $title, $url, $art_descrip, $category, $time, $artist_name, $id_artist);
	
	while($stmt->fetch()){ ?>
	<div class="post">
		<p class="time"><?=$time?></p><br><br><br>
		<h3><?=$title?></h3>
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
	
	
<?php require 'footer.php'; ?>
	
</body>
</html>