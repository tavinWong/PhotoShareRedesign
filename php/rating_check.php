<?php
 error_reporting(0);
 require_once("session_check.php");
 require_once("mysql_connect.php");
 $Username = $_SESSION['Username'];
 $PhotoID = $_GET['PhotoID'];
 $InitialCount = 2;
 $InitialUp = 1 ;
 if($_POST['likebt0']){ //ThemeUp
  $sql_rating = "INSERT INTO ratings (Username, PhotoID, Theme) VALUES ('$Username', '$PhotoID', '1') ON DUPLICATE KEY UPDATE RatingTime = CURRENT_TIMESTAMP, Theme = '1'";
 }
 else if($_POST['dislikebt0']){ //ThemeDown
  $sql_rating = "INSERT INTO ratings (Username, PhotoID, Theme) VALUES ('$Username', '$PhotoID', '0') ON DUPLICATE KEY UPDATE RatingTime = CURRENT_TIMESTAMP, Theme = '0'";
 }
 else if($_POST['likebt1']){ //CompositionUp
  $sql_rating = "INSERT INTO ratings (Username, PhotoID, Composition) VALUES ('$Username', '$PhotoID', '1') ON DUPLICATE KEY UPDATE RatingTime = CURRENT_TIMESTAMP, Composition = '1'";
 }
 else if($_POST['dislikebt1']){ //CompositionDown
  $sql_rating = "INSERT INTO ratings (Username, PhotoID, Composition) VALUES ('$Username', '$PhotoID', '0') ON DUPLICATE KEY UPDATE RatingTime = CURRENT_TIMESTAMP, Composition = '0'";
 }
 else if($_POST['likebt2']){ //ExecutionUp
  $sql_rating = "INSERT INTO ratings (Username, PhotoID, Execution) VALUES ('$Username', '$PhotoID', '1') ON DUPLICATE KEY UPDATE RatingTime = CURRENT_TIMESTAMP, Execution = '1'";
 }
 else if($_POST['dislikebt2']){ //ExecutionDown
  $sql_rating = "INSERT INTO ratings (Username, PhotoID, Execution) VALUES ('$Username', '$PhotoID', '0') ON DUPLICATE KEY UPDATE RatingTime = CURRENT_TIMESTAMP, Execution = '0'";
 }
 else if($_POST['likebt3']){ //OriginalityUp
  $sql_rating = "INSERT INTO ratings (Username, PhotoID, Originality) VALUES ('$Username', '$PhotoID', '1') ON DUPLICATE KEY UPDATE RatingTime = CURRENT_TIMESTAMP, Originality = '1'";
 }
 else if($_POST['dislikebt3']){ //OriginalityDown
  $sql_rating = "INSERT INTO ratings (Username, PhotoID, Originality) VALUES ('$Username', '$PhotoID', '0') ON DUPLICATE KEY UPDATE RatingTime = CURRENT_TIMESTAMP, Originality = '0'";
 }
 mysql_query($sql_rating);
 $sql_photoratings = "SELECT * FROM photoratings WHERE PhotoID = '$PhotoID'";
 $query_photoratings = mysql_query($sql_photoratings);
 $photo = mysql_fetch_array($query_photoratings);
 
 $Theme = ($InitialUp + $photo[ThemeUp]) / ($InitialCount + $photo[ThemeUp] + $photo[ThemeDown]) * 100;
 $Composition = ($InitialUp + $photo[CompositionUp]) / ($InitialCount + $photo[CompositionUp] + $photo[CompositionDown]) * 100;
 $Execution = ($InitialUp + $photo[ExecutionUp]) / ($InitialCount + $photo[ExecutionUp] + $photo[ExecutionDown]) * 100;
 $Originality = ($InitialUp + $photo[OriginalityUp]) / ($InitialCount + $photo[OriginalityUp] + $photo[OriginalityDown]) * 100;
 $Rating = ($Theme + $Composition + $Execution + $Originality) / 4;
 
 $sql_updaterating = "UPDATE photos SET Theme = '$Theme', Composition = $Composition, Execution = $Execution, Originality = $Originality, Rating = $Rating WHERE PhotoID = '$PhotoID'";
 mysql_query($sql_updaterating);
?>
<script>
 location.href = "javascript:history.back()";
</script>