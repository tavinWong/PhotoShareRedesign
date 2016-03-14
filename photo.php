<!DOCTYPE html>
<?php
	error_reporting(0);
	require_once("php/session_check.php");
	require_once("php/mysql_connect.php");
	$PhotoID = $_GET['PhotoID'];
	
	$sql_photo = "SELECT * FROM photos WHERE PhotoID = '$PhotoID'";
	$query_photo = mysql_query($sql_photo);
	$photo = mysql_fetch_array($query_photo);
	
	$sql_photorating = "SELECT * FROM ratings WHERE PhotoID = '$PhotoID'";
	$query_photorating = mysql_query($sql_photorating);
	$ratingnum = mysql_num_rows($query_photorating);
	
	if($LoginState == 1){
		$sql_myrating = "SELECT * FROM ratings WHERE Username = '$_SESSION[Username]' and PhotoID = '$PhotoID'";
		$query_myrating = mysql_query($sql_myrating);
		$myrating = mysql_fetch_array($query_myrating);
	}
?>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PhotoPage</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="css/gear.css" />
		<meta name="description" content="A Professional Prospective of Photography." />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/heroimage.css" />
		<link rel="stylesheet" type="text/css" href="css/PhotoLayout.css" />
		<link rel="stylesheet" type="text/css" href="css/overlay.css" />
		<link rel="stylesheet" type="text/css" href="css/self.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/gear.css" />
		<script src="jquery/jquery-2.1.1.min.js"></script>
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/ajax_likes.js"></script>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="cover">
				<div class="titlelogo">
					<img src= "img/logo.png" width="130px"/>
				</div> 
				<div class="back">
					<a href="index.php">
						<img src="img/systemimage/back.png" width="20px"/>
					</a>
				</div>
		</div>
			<div class="space">	

					<div class="name">
						<p class="itemTitle" style="float:left; margin-left:5%;"><?php echo $photo[Title]; ?></p>
					</div>

					<div class="point">
						<div class="sub">
							<p class="reviewTimes"><?php echo $ratingnum; ?> Reviewed</p>
						</div>
						<div class="photorating" style = "font-size:50px"><?php echo $photo[Rating]; ?></div>
					</div>
	
			</div>
			<script src = "js/photoRating.js"></script>
			<div class="pic">
				<img src= <?php echo "photos/".$PhotoID.".jpg" ?> style="width: 705px">
			</div>
			
			<div class="discription">
				<div class="dis">
				<p1 class="itemDiscription"><?php echo $photo[Description]; ?></p1>
				</div>
			</div>
			
			<div class="rating">
				<div class="Theme">
					<div class="pointtext">
						<p>Theme:</p>
					</div>
					<div style='float:left;'>
						<form method = "post" action = <?php echo "\"php/rating_check.php?PhotoID=".$PhotoID."\"" ?> >
							<button type="submit" class='ld-btn-like' id="likebt0" name = "likebt0" title = "I like it." value = "on">
								<img class='ld-img-like' src="img/systemimage/thumbs-up-ss.png">
							</button>
							<button type="submit" class='ld-btn-dislike' id="dislikebt0" name = "dislikebt0" title = "I dislike it." value = "on">
								<img class='ld-img-dislike' src="img/systemimage/thumbs-down-ss.png">
							</button>
						</form>
						<div class="votebar">
							<div class="a_1" id="likebar0" style = <?php echo "\"width:".(5 * $photo[Theme])."px\"" ?> ><?php echo $photo[Theme]; ?></div>
							<div class="a_2" id="dislikebar0" style = <?php echo "\"width:".(500 - 5 * $photo[Theme])."px\"" ?> ><?php echo 100 - $photo[Theme]; ?></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="rating">
				<div class="Theme">
					<div class="pointtext">
						<p>Composition:</p>
					</div>
					<div style='float:left;'>
						<form method = "post" action = <?php echo "\"php/rating_check.php?PhotoID=".$PhotoID."\"" ?> >
							<button type="submit" class='ld-btn-like' id="likebt1" name = "likebt1" title = "I like it." value = "on">
								<img class='ld-img-like' src="img/systemimage/thumbs-up-ss.png">
							</button>
							<button type="submit" class='ld-btn-dislike' id="dislikebt1" name = "dislikebt1" title = "I dislike it." value = "on">
								<img class='ld-img-dislike' src="img/systemimage/thumbs-down-ss.png">
							</button>
						</form>
						<div class="votebar">
							<div class="a_1" id="likebar1" style = <?php echo "\"width:".(5 * $photo[Composition])."px\"" ?> ><?php echo $photo[Composition]; ?></div>
							<div class="a_2" id="dislikebar1" style = <?php echo "\"width:".(500 - 5 * $photo[Composition])."px\"" ?> ><?php echo 100 - $photo[Composition]; ?></div>
						</div>
					</div>
				</div>
			</div>

			<div class="rating">
				<div class="Theme">
					<div class="pointtext">
						<p>Execution:</p>
					</div>
					<div style='float:left;'>
						<form method = "post" action = <?php echo "\"php/rating_check.php?PhotoID=".$PhotoID."\"" ?> >
							<button type="submit" class='ld-btn-like' id="likebt2" name = "likebt2" title = "I like it." value = "on">
								<img class='ld-img-like' src="img/systemimage/thumbs-up-ss.png">
							</button>
							<button type="submit" class='ld-btn-dislike' id="dislikebt2" name = "dislikebt2" title = "I dislike it." value = "on">
								<img class='ld-img-dislike' src="img/systemimage/thumbs-down-ss.png">
							</button>
						</form>
						<div class="votebar">
							<div class="a_1" id="likebar2" style = <?php echo "\"width:".(5 * $photo[Execution])."px\"" ?> ><?php echo $photo[Execution]; ?></div>
							<div class="a_2" id="dislikebar2" style = <?php echo "\"width:".(500 - 5 * $photo[Execution])."px\"" ?> ><?php echo 100 - $photo[Execution]; ?></div>
						</div>
					</div>
				</div>
			</div>

			<div class="rating">
				<div class="Theme">
					<div class="pointtext">
						<p>Originality:</p>
					</div>
					<div style='float:left;'>
						<form method = "post" action = <?php echo "\"php/rating_check.php?PhotoID=".$PhotoID."\"" ?> >
							<button type="submit" class='ld-btn-like' id="likebt3" name = "likebt3" title = "I like it." value = "on">
								<img class='ld-img-like' src="img/systemimage/thumbs-up-ss.png">
							</button>
							<button type="submit" class='ld-btn-dislike' id="dislikebt3" name = "dislikebt3" title = "I dislike it." value = "on">
								<img class='ld-img-dislike' src="img/systemimage/thumbs-down-ss.png">
							</button>
						</form>
						<div class="votebar">
							<div class="a_1" id="likebar3" style = <?php echo "\"width:".(5 * $photo[Originality])."px\"" ?> ><?php echo $photo[Originality]; ?></div>
							<div class="a_2" id="dislikebar3" style = <?php echo "\"width:".(500 - 5 * $photo[Originality])."px\"" ?> ><?php echo 100 - $photo[Originality]; ?></div>
						</div>
						<br>
						<div style="height=200px; float:left"></div>	
					</div>
				</div>
			</div>
			
		<!--<script src="js/classie.js"></script>-->
		<script>
			if(<?php echo $LoginState ?> != 1){ //Disable rating function if not logged in
				document.getElementById("likebt0").disabled = true;
				document.getElementById("likebt0").title = "You are not logged in.";
				document.getElementById("dislikebt0").disabled = true;
				document.getElementById("dislikebt0").title = "You are not logged in.";
				document.getElementById("likebt1").disabled = true;
				document.getElementById("likebt1").title = "You are not logged in.";
				document.getElementById("dislikebt1").disabled = true;
				document.getElementById("dislikebt1").title = "You are not logged in.";
				document.getElementById("likebt2").disabled = true;
				document.getElementById("likebt2").title = "You are not logged in.";
				document.getElementById("dislikebt2").disabled = true;
				document.getElementById("dislikebt2").title = "You are not logged in.";
				document.getElementById("likebt3").disabled = true;
				document.getElementById("likebt3").title = "You are not logged in.";
				document.getElementById("dislikebt3").disabled = true;
				document.getElementById("dislikebt3").title = "You are not logged in.";
			}
		</script>
		<script>
			if(<?php echo isset($myrating[Theme]) ?>){ //Disable Theme
				document.getElementById("likebt0").disabled = true;
				document.getElementById("likebt0").title = "You have rated Theme.";
				document.getElementById("dislikebt0").disabled = true;
				document.getElementById("dislikebt0").title = "You have rated Theme.";
			}
		</script>
		<script>
			if(<?php echo isset($myrating[Composition]) ?>){ //Disable Composition
				document.getElementById("likebt1").disabled = true;
				document.getElementById("likebt1").title = "You have rated Composition.";
				document.getElementById("dislikebt1").disabled = true;
				document.getElementById("dislikebt1").title = "You have rated Composition.";
			}
		</script>
		<script>
			if(<?php echo isset($myrating[Execution])?>){ //Disable Execution
				document.getElementById("likebt2").disabled = true;
				document.getElementById("likebt2").title = "You have rated Execution.";
				document.getElementById("dislikebt2").disabled = true;
				document.getElementById("dislikebt2").title = "You have rated Execution.";
			}
		</script>
		<script>
			if(<?php echo isset($myrating[Originality])?>){ //Disable Originality
				document.getElementById("likebt3").disabled = true;
				document.getElementById("likebt3").title = "You have rated Originality.";
				document.getElementById("dislikebt3").disabled = true;
				document.getElementById("dislikebt3").title = "You have rated Originality.";
			}
		</script>
		<script>
			(function() {		

				function noscroll() {
					window.scrollTo( 0, 0 );
				}
				
				// reset scrolling position
				document.body.scrollTop = document.documentElement.scrollTop = 0;


				trigger.addEventListener( 'click', toggleContent );

				// For Demo purposes only (prevent jump on click)
				[].slice.call( document.querySelectorAll('.items-wrap a') ).forEach( function(el) { el.onclick = function() { return false; } } );
			})();

		</script>
	</body>
</html>

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
    
