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

<div class="infobox2">

<?php
	$title = filter_input(INPUT_POST, 'title')
		or die('<div class="upload-info"><h3>Missing/illegal title parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
	
	$art_descrip = filter_input(INPUT_POST, 'art_descrip')
		or die('<div class="upload-info"><h3>Missing/illegal art description parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
	
	$category = filter_input(INPUT_POST, 'category')
		or die('<div class="upload-info"><h3>Missing/illegal category parameter</h3><p><a href="profile.php">Back to profile</a></p></div>');
		
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo '<div class="upload-info"><h3>File is not an image.<br></h3></div>';
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo '<div class="upload-info"><h3>Sorry, file already exists.<br></h3></div>';
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo '<div class="upload-info"><h3>Sorry, your file is too large.<br></h3></div>';
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
    echo '<div class="upload-info"><h3>Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br></h3></div>';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo '<div class="upload-info"><p>Sorry, your file was not uploaded.<br></p></div>';
	
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo '<div class="upload-info"><h3>The file '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.<br></h3></div>';
			
			
			
			
		
			require_once('db_con.php');
			$sql = 'INSERT INTO art (title, imageurl, art_descrip, category, artist_nr) 
			VALUES (?, ?, ?, ?, ?)';
			$stmt = $con->prepare($sql);
			$stmt->bind_param('ssssi', $title, $target_file, $art_descrip, $category, $a_nr);
			$stmt->execute();
			if($stmt->affected_rows > 0){
				echo '<div class="upload-info"><p>Your filedata is added to the database...</p></div>';
			} else{
			echo '<div class="upload-info"><p>Could not add your filedata to the database...</p></div>';
			}
	
		
    } else {
        echo '<div class="upload-info"><h3>Sorry, there was an error uploading your file.</h3></div>';
    }
}
?>
	<p><a href="profile.php">Go to your profile</a></p>

</div>
		
	</div>
</div>

<?php require 'footer.php'; ?>
</body>
</html>