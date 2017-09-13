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
	<?php if(empty($_SESSION['uid'])){
		require 'menu.php'; 
	}
	else{
		require 'menu1.php'; 
	}
	?>
<div class="container">
	<div class="container-content">

<?php	
	
	require_once('db_con.php');
	$sql = 'select name, artist_descrip, last_update, id_artist from artist ORDER BY artist.name ASC';
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($artist_name, $artist_descrip, $updated, $id_artist);
	
	while($stmt->fetch()){ ?>
	
	<a class="artists" href="artist-profile.php?id_artist=<?=$id_artist?>"><div>
		<p class="time">Last changed: <?=$updated?></p>
		<h3><?=$artist_name?></h3>
		<p><b>Description:</b><br><?=$artist_descrip?></p>
	</div></a>
<?php } ?>

	</div>
</div>


<?php require 'footer.php'; ?>


</body>
</html>