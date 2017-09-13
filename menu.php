<?php $fn = basename($_SERVER['PHP_SELF']); ?>

<div class="header">
<img class="logo" src="pics/logo.png">
	<ul>
		<li><a class="menulink<?= ($fn == 'index.php') ? ' selected': '' ?>" href="index.php">ARTWORK</a></li>
		
		<li class="dropdown">
			<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="javascript:void(0)" class="dropbtn">CATEGORIES</a>
			<div class="dropdown-content">
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Painting'?>">Painting</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Drawing'?>">Drawing</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Graphic'?>">Graphic</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Architectural'?>">Architectural</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Photograph'?>">Photograph</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Street-art'?>">Street art</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Body-paint'?>">Body paint</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Space-art'?>">Space art</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Symbolism'?>">Symbolism</a>
				
				<a class="menulink<?= ($fn == 'categories.php') ? ' selected': '' ?>" href="categories.php?category=<?=$category = 'Other'?>">Other</a>
			</div>
		</li>
		
		<li><a class="menulink<?= ($fn == 'artists.php') 
				||($fn == 'artist-profile.php')
			? ' selected': '' ?>" href="artists.php">ARTISTS</a></li>
		
		<li><a class="menulink<?= ($fn == 'profile.php')
				||($fn == 'updateprofile.php')
				||($fn == 'updateart.php')
			? ' selected': '' ?>" href="profile.php">PROFILE</a></li>
		
		<li><a class="menulink<?= ($fn == 'login.php') 
				||($fn == 'signup.php')
			? ' selected': '' ?>" href="login.php">LOGIN</a></li>
	</ul>
</div>
	