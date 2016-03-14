<?php
error_reporting(0);
require_once("session_check.php");
require_once("mysql_connect.php");
$Username = $_SESSION['Username'];
$Title = $_POST['Title'];
$Tags = $_POST['Tags'];
$Description = $_POST['Description'];
//$Description = nl2br($_POST['Description']);

$p_sql_insert = "INSERT INTO photos (Title, Tags, Description, Username) VALUES ('$Title', '$Tags', '$Description', '$Username')";
mysql_query($p_sql_insert);
$PhotoID = mysql_insert_id();

if(is_uploaded_file($_FILES['UploadPhoto']['tmp_name'])){
 if(!move_uploaded_file($_FILES['UploadPhoto']['tmp_name'], "../photos/".$PhotoID.".jpg")){ //Upload failed
 ?>
 <script>
  location.href = "../upload.php";
  window.alert("Upload failed! Please try again.");
 </script>
 <?php
 }
 else{ //Upload successfully
 ?>
 <script>
  location.href = "../upload.php";
  window.alert("Upload successfully!");
 </script>
 <?php
 }
}
else{ //Abnormal state
?>
<script>
 location.href = "../upload.php";
 window.alert("Upload failed! Please try again.");
</script>
<?php
}
?>
