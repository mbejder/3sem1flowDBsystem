<?php session_start();


if(isset($_POST['submit'])){
	header('location:profile.php');
}



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

<?php require 'menu.php'; ?>

<?php
	require_once('db_con.php');
	
	if(filter_input(INPUT_POST, 'submit')){
		$email = filter_input(INPUT_POST, 'email')
			or die('missing/illegal username parameter');
		
		$password = filter_input(INPUT_POST, 'password')
			or die('missing/illegal password parameter');
		
		
		$sql = 'SELECT id_artist, pwhash from artist WHERE email = ?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->bind_result($uid, $pwhash);
	
		while($stmt->fetch()) {}
	
		if((password_verify($password, $pwhash))){
			echo 'Du er nu logget ind!';
			$_SESSION['uid'] = $uid;
			$_SESSION['email'] = $email;
		}
		else{
			echo '
			<div class="infobox1">
				<h3>Forkert kombination af email og password<h3>
				<p><a href="login.php">Prøv igen?</a></p>
			</div>';
		}
		$stmt->close();
		$con->close();
	
	}
	?>
	
	<div class="container">
		<div class="container-content">
		
		<h2 class="login-headline">Login</h2>
	
		<form class="login" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<fieldset>
				<input class="felt" name="email" type="email" placeholder="E-mail" required><br><br>
				<input class="felt" name="password" type="password" placeholder="Password" required><br><br>
				<a class="link" href="signup.php">Create an user?</a><br><br><br>
				<input class="btn" name="submit" type="submit" value="Log ind">
			</fieldset>
		</form>
		
		
			</div>
	</div>

<?php require 'footer.php'; ?>

</body>
</html>