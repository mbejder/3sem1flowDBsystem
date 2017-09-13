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
		include 'menu.php';
		echo '<h2 id="loggedout">You are logged out!</h2>';}
	
	else{
		$a_nr = $_SESSION['uid'];
		include 'loggedin.php'; }
	?>

<?php require 'footer.php'; ?>
</body>
</html>