<?php session_start(); ?>

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
		$category = filter_input(INPUT_GET, 'category')
		or die('missing/illegal category fuuuuuuuuuuuuuck parameter'); ?>
	

<h2 class="headline1"><?=$category?></h2>

<?php
	require_once('db_con.php');
	$sql = 'SELECT title, imageurl, art_descrip, art.last_update, name, category, id_artist FROM art, artist WHERE id_artist = artist_nr and category = ? ORDER BY art.last_update DESC';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $category);
	$stmt->execute();
	$stmt->bind_result($title, $url, $art_descrip, $time, $name, $category, $id_artist);
	
	while($stmt->fetch()){ ?>
	
	<div class="post">
		<p class="time"><?=$time?></p><br><br><br>
		<h3><?=$title?></h3>
		<p>Category: <a href="categories.php?category=<?=$category?>"><?=$category?></a></p>
		<p>Artist: <a href="artist-profile.php?id_artist=<?=$id_artist?>"><?=$name?></a></p>
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