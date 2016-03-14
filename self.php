<?php
	error_reporting(0);
	require_once("php/session_check.php");
	require_once("php/mysql_connect.php");
	$Username = $_SESSION[Username];
	
	$sql_user = "SELECT * FROM users WHERE Username = '$Username'"; //Get user info
	$query_user = mysql_query($sql_user);
	$user = mysql_fetch_array($query_user);
	
	$sql_myhighestrating = "SELECT * FROM photos WHERE Username = '$Username' ORDER BY Rating DESC LIMIT 1"; //Choose my photo with hightest rating
	$query_myhighestrating = mysql_query($sql_myhighestrating);
	$myhighestrating = mysql_fetch_array($query_myhighestrating);
	
	$sql_myphotos = "SELECT * FROM photos WHERE Username = '$Username' ORDER BY UploadTime DESC"; //Generate random photos
	$query_myphotos = mysql_query($sql_myphotos);
	$MyPhotoNum = mysql_num_rows($query_myphotos);
?>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Exposure</title>
		<meta name="description" content="A Professional Prospective of Photography." />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/self.css">
		<script src="jquery/jquery-2.1.1.min.js"></script>
		<script src = "js/autoResizeImage.js"></script>
		<script src = "js/advancedSelect.js"></script>
		<script>
			$(document).ready(function () {
				$('#UserAvatar').click(function () {
					$("#changeavatar_window").css("display", "block");
					$("#mask").fadeIn(300);
					return false;
				});

				// When clicking on the button close or the mask layer the popup closed
				$('body').on('click', ' #mask', function () {
					$('#mask, #changeavatar_window, #register_window').fadeOut(300);
					return false;
				});
			});
		</script>
		<script>
			function statusOnClick(element){
				element.style.background = "white";
				element.title = "Press Enter to update status.";
			}
			function statusOnBlur(element){
				element.style.background = "transparent";
				element.title = "Click to edit status.";
				element.value = '<?php echo $user[Status] ?>';
			}
		</script>

	</head>
	<body>
		<div id="mask"></div>
		<div class="big_container">
			<div class="cover">
				<div class="titlelogo">
					<img src="img/logo.png" width="130px"/>
				</div> 
				<div class="back">
					<a href="index.php">
						<img src = "img/systemimage/back.png" width="20px"/>
					</a>
				</div>
			</div>
			<div class="uploadtitle">
				<div class="User">
					<div class="selfie">
						<img id = "UserAvatar" src = <?php echo "avatars/".$_SESSION[Username].".jpg" ?> width = "105" height = "105" onload = "autoResizeImage(this, 105, 105)" title = "Click to change avatar" />
					</div>
					<div class="realtitle"><?php echo "$_SESSION[Username]"?>
						<form class = "status" method = "post" action = "php/status_check.php">
							<input type="text" name = "Status" value = '<?php echo $user[Status] ?>' maxlength = "40" placeholder = "#Personal Website" title = "Click to edit status." onclick = "advancedSelect(this);statusOnClick(this)" onblur = "flag = true; statusOnBlur(this)" />
						</form>
					</div>
				</div>

					<div class="selfNav">
						<div class="selfNav1">
							<a class="active" style="color:white" href="php/logout.php">LOGOUT</a>
						</div>
						<div class = "selfNav1">
							<a class="active" style="color:white" href="selfAbout.php">ABOUT</a>
						</div>
						<div class="selfNav2">
							<a class="active" style="color:white" href="self.php">PHOTO</a>
						</div>
					</div>

			</div>
			<iframe id = "changeavatar_window" src = "php/changeavatar.php" scrolling = "no"></iframe>
			
		<section class="items-wrap">
			<div class="bigzone">
			<?php
				if($MyPhotoNum != 0){
				?>
					<div class="myitemL">
						<img class="item_image" src = <?php echo "photos/".$myhighestrating[PhotoID].".jpg" ?> alt = <?php echo "photos/".$myhighestrating[PhotoID].".jpg" ?> />
						<h2 class = "myitem__title photorating"><?php echo "$myhighestrating[Rating] " ?></h2>
					</div>
				<?php
				}
			?>
			</div>
			<div class="bigzone0">
			<?php //My photos 1-4	
				if($MyPhotoNum <= 4) $MyPhotoNum_1 = $MyPhotoNum;
				else $MyPhotoNum_1 = 4;
				for($counter = 0; $counter < $MyPhotoNum_1; $counter ++){
					$myphoto = mysql_fetch_array($query_myphotos);
					?>
					<div class="myitemS">
						<img class = "myitem__image" src = <?php echo "photos/".$myphoto[PhotoID].".jpg" ?> alt = <?php echo "photos/".$myphoto[PhotoID].".jpg" ?> />
						<h2 class = "myitem__title photorating"><?php echo "$myphoto[Rating]" ?></h2>
					</div>
					<?php
				}
			?>
			</div>
			
			<?php //Other photos 
			if($MyPhotoNum > 4){
				for($counter = 4; $counter < $MyPhotoNum; $counter ++){
					$myphoto = mysql_fetch_array($query_myphotos);
					?>
					<div class="myitem">
						<img class = "myitem__image" src = <?php echo "photos/".$myphoto[PhotoID].".jpg" ?> alt = <?php echo "photos/".$myphoto[PhotoID].".jpg" ?> />
						<h2 class = "myitem__title photorating"><?php echo "$myphoto[Rating]" ?></h2>
					</div>
					<?php
				}
			}	
			?>
		</section>
		<script src = "js/photoRating.js"></script>


	
			<div class="footer">
				<p>All Rights Reserved 2015.</p>
			</div>
		</div>
	</body>
</html>