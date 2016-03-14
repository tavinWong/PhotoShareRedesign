<!DOCTYPE html>
<?php
	error_reporting(0);
	//session_start();
	//session_destroy();
	//setcookie("Username","1",time()-10000,"/");
	//$_COOKIE[Username] = "";
	require_once("php/session_check.php");
	require_once("php/mysql_connect.php");
	
	$sql_highestrating = "SELECT * FROM photos ORDER BY Rating DESC LIMIT 1"; //Choose the photo with hightest rating
	$query_highestrating = mysql_query($sql_highestrating);
	$highestrating = mysql_fetch_array($query_highestrating);
	
	$sql_random = "SELECT * FROM photos ORDER BY rand() limit 12"; //Generate random photos
	$query_random = mysql_query($sql_random);
	$PhotoNum = mysql_num_rows($query_random);
?>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Exposure</title>
		<meta name="description" content="A Professional Prospective of Photography." />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/heroimage.css" />
		<link rel="stylesheet" type="text/css" href="css/PhotoLayout.css" />
		<link rel="stylesheet" type="text/css" href="css/overlay.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/self.css" />
		<script src="jquery/jquery-2.1.1.min.js"></script>
		<script>
			
		</script>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div id="container" class="container">
			<header class="intro">
				<img class="intro__image" src="img/Hero/1.png" width="100%"/>
				<div id="mask"></div>
				
				<iframe id = "login_window" src = "php/login.php" scrolling = "no"></iframe>
				<iframe id = "register_window" src = "php/register.php" scrolling = "no"></iframe>
				
				<script src="js/login.js"></script>
				
				<div id="overlay">
					<div id="des">A Professional Prospective of Photography.</div>
				</div>
				<button id="Login-button"><span>Login And Discover</span></button>
				
				<div class="intro__content">
					<div class="intro__subtitle">
						
						<div class="titlelogo">
							<img src="img/logo.png" width="130px"/>
						</div>
						<div class="rightbar">
							<a id = "nav_username" href="self.php" class="navButton"><?php echo $_SESSION[Username] ?></a>
							<a id = "nav_upload" href="upload.php" class="navButton">Upload</a>
							<a href="index.php" class="navButton" onclick = "javascript:setPosition(1)">Discovery</a>
							<a href="gear.php" class="navButton" onclick = "javascript:setPosition(1)">Gear</a>
							<a href="contact.php" class="navButton">Contact US</a>
							<button class="trigger">
								<svg width="100%" height="100%" viewBox="0 0 60 60" preserveAspectRatio="none">
									<g class="icon icon--grid">
										<rect x="32.5" y="5.5" width="22" height="22"/>
										<rect x="4.5" y="5.5" width="22" height="22"/>
										<rect x="32.5" y="33.5" width="22" height="22"/>
										<rect x="4.5" y="33.5" width="22" height="22"/>
									</g>
									<g class="icon icon--cross">
										<line x1="4.5" y1="55.5" x2="54.953" y2="5.046"/>
										<line x1="54.953" y1="55.5" x2="4.5" y2="5.047"/>
									</g>
								</svg>
								<span>View content</span>
							</button>
						</div>
					</div>
				</div><!-- /intro__content -->	
				
				<script>
					if(<?php echo $LoginState ?> == 0){ //Tourist state
						document.getElementById("Login-button").style.display = "block"; 
						document.getElementById("nav_username").style.display = "none";
						document.getElementById("nav_upload").setAttribute("class","disable navButton");
						document.getElementById("nav_upload").removeAttribute("href");
					}
					else if(<?php echo $LoginState ?> == 1){ //Normal state
						document.getElementById("Login-button").style.display = "none"; 
						document.getElementById("nav_username").style.display = "inline-block"; 
					
					}
					else{ //Abnormal state
						document.getElementById("Login-button").style.display = "block"; 
						document.getElementById("nav_username").style.display = "none"; 
						document.getElementById("nav_upload").setAttribute("class","disable navButton");
						document.getElementById("nav_upload").removeAttribute("href");
					}
				</script>
			
			</header><!-- /intro -->
			
			<section class="items-wrap"style="background-color:#F2EDED">
				<div class="bigzone">
				<?php
					if($PhotoNum != 0){
					?>
						<div class="itemL">
							<img class="bigimgstyle" src = <?php echo "photos/".$highestrating[PhotoID].".jpg" ?> alt = <?php echo "photos/".$highestrating[PhotoID].".jpg" ?> onclick = '<?php echo "location.href = \"photo.php?PhotoID=".$highestrating[PhotoID]."\"" ?>' />
							<h2 class = "item__title photorating"><?php echo "$highestrating[Rating]" ?></h2>
						</div>
						<?php
					}
					?>
				</div>
				<div class="bigzone0">
				<?php //Random photos 1-4	
					if($PhotoNum <= 4) $PhotoNum_1 = $PhotoNum;
					else $PhotoNum_1 = 4;
					for($counter = 0; $counter < $PhotoNum_1; $counter ++){
						$photo = mysql_fetch_array($query_random);
						?>
						<div class="itemS">
							<img class = "item__image" src = <?php echo "photos/".$photo[PhotoID].".jpg" ?> alt = <?php echo "photos/".$photo[PhotoID].".jpg" ?> onclick = '<?php echo "location.href = \"photo.php?PhotoID=".$photo[PhotoID]."\"" ?>' />
							<h2 class = "item__title photorating"><?php echo "$photo[Rating]" ?></h2>
						</div>
						<?php
					}
					?>
				</div>
				
				<?php //Random photos 5-12
				if($PhotoNum > 4){
					for($counter = 4; $counter < $PhotoNum; $counter ++){
						$photo = mysql_fetch_array($query_random);
						?>
						<div class="item">
							<img class = "item__image" src = <?php echo "photos/".$photo[PhotoID].".jpg" ?> alt = <?php echo "photos/".$photo[PhotoID].".jpg" ?> onclick = '<?php echo "location.href = \"photo.php?PhotoID=".$photo[PhotoID]."\"" ?>' />
							<h2 class = "item__title photorating"><?php echo "$photo[Rating]" ?></h2>
						</div>
						<?php
					}
				}	
				?>
			</section>
			<script src = "js/photoRating.js"></script>
		</div><!-- /container -->
		<div class="footer">
				<p>All Rights Reserved 2015.</p>
		</div>
		<script src="js/classie.js"></script>
		<script>
			//(function() {
			
				function setPosition(position){
					document.cookie = "position=" + position +";";
				}
			
				var container = document.getElementById( 'container' ),
					trigger = container.querySelector( 'button.trigger' );

				function toggleContent() {
					if( classie.has( container, 'container--open' ) ) {
						setPosition(0);
						classie.remove( container, 'container--open' );
						classie.remove( trigger, 'trigger--active' );
						window.addEventListener( 'scroll', noscroll );
					}
					else {
						setPosition(1);
						classie.add( container, 'container--open' );
						classie.add( trigger, 'trigger--active' );
						window.removeEventListener( 'scroll', noscroll );
					}
					
				}
				function noscroll() {
					window.scrollTo( 0, 0 );
				}
				
				// disable scrolling
				window.addEventListener( 'scroll', noscroll );
				trigger.addEventListener( 'click', toggleContent );

				//Record position
				if(!/position/.test(document.cookie)){
					setPosition(0);
				}
				var position = document.cookie.split("position=")[1].split(";")[0];
				if(position == 1){
					toggleContent();
					
					
				}
				
				// reset scrolling position
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				
				
				// For Demo purposes only (prevent jump on click)
				[].slice.call( document.querySelectorAll('.items-wrap a') ).forEach( function(el) { el.onclick = function() { return false; } } );
			//})();
		</script>
	</body>
</html>
