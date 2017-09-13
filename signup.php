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

<div class="container">
	<div class="container-content">
		

<?php
	
	require_once('db_con.php');
	
	if(filter_input(INPUT_POST, 'submit')){
		$email = filter_input(INPUT_POST, 'email')
			or die('missing/illegal email parameter');
		
		$password = filter_input(INPUT_POST, 'password')
			or die('missing/illegal password parameter');
		
		$name = filter_input(INPUT_POST, 'name')
			or die('missing/illegal artist name parameter');
		
		$artist_descrip = filter_input(INPUT_POST, 'artist_descrip')
			or die('missing/illegal artist description parameter');
		
		$password = password_hash($password, PASSWORD_DEFAULT);

		// echo 'Din bruger er nu oprettet<br>'.$username.':'.$password;
	
		$sql="INSERT INTO artist (email, pwhash, name, artist_descrip) VALUES (?, ?, ?, ?)";
		$stmt=$con->prepare($sql);
		$stmt->bind_param('ssss', $email, $password, $name, $artist_descrip);
		$stmt->execute();

			if($stmt->affected_rows > 0){
				echo '
				<div class="infobox">
					<h3>The user '.$email. ' has been created</h3>
					<p><a href="login.php">Log in here</a></p>
				</div>';
			}
			else{
				echo '
				<div class="infobox">
					<h3>Could not create new user</h3><p>The e-mail already exists!<br><br>
					<a href="login.php">Log in here</a><br>
					<a href="signup.php">Create an user</a></p>
				</div>';
			}
		
		$stmt->close();
		$con->close();
	}
		
	
	
	
	
	
	?>
	<h2 class="login-headline">Create a new artist profile</h2>
	
		<form class="login" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<fieldset>
				<input class="felt" name="email" type="email" placeholder="E-mail*" required><br><br>
				<input class="felt" name="password" type="password" placeholder="Password*" required><br>
				<a href="login.php">Have an user already?</a><br><br>
				<input class="felt" name="name" type="text" placeholder="Artist name*" required><br><br>
				<textarea rows="4" cols="100" type="text" name="artist_descrip" placeholder="Artist description*" required maxlength="255 char"></textarea><br><br><br>
				<input class="btn" name="submit" type="submit" value="Create artist profile">
			</fieldset>
		</form>
	
	</div>
</div>

<?php require 'footer.php'; ?>

</body>
</html>