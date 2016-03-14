<?php
 error_reporting(0);
 require_once("session_check.php");
 if($_POST['ChangeAvatar_Submit']){
  if(is_uploaded_file($_FILES['UploadAvatar']['tmp_name'])){
   if(!move_uploaded_file($_FILES['UploadAvatar']['tmp_name'], "../avatars/".$_SESSION[Username].".jpg")){ //Update failed
   ?>
   <script>
    window.alert("Upload failed! Please try again.");
   </script>
   <?php
   }
  }
  ?>
  <script>
   parent.document.getElementById("changeavatar_window").style.display = "none";
   parent.document.getElementById("mask").style.display = "none";
   parent.location.reload();
  </script>
  <?php
 }
?>
<html>
 <head>
  <style>
   .ChangeAvatar_Session{
    float:left;
    margin:10px;
    width:202px;
    text-align:center;
   }
   #UploadAvatar_Msg{
    color:red;
    position:absolute;
    top:240px;
    left:0px;
    width:100%;
    text-align:center;
   }
   #ChangeAvatar_Submit{
    float:left;
	margin-left:10%;
	margin-top:30px;
	width: 30%;
	height: 25px;
	border: 1px solid rgba(78,48,67, 0.8);
    background: #417CF0;
	color: white;
	letter-spacing: 1px;
	font-size: 15px;
	transition: background-color 0.3s, color 0.3s, width 0.3s, border-width 0.3s, border-color 0.3s;
	
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
   }
   #ChangeAvatar_Cancel{
    float:right;
	margin-right:10%;
	margin-top:30px;
	width: 30%;
	height: 25px;
	border: 1px solid rgba(78,48,67, 0.8);
    background: #417CF0;
	color: white;
	letter-spacing: 1px;
	font-size: 15px;
	transition: background-color 0.3s, color 0.3s, width 0.3s, border-width 0.3s, border-color 0.3s;
	
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
   }
   #ChangeAvatar_Submit:hover{
	border: 2px solid #58BBEC;
	color: #58BBEC;
   }
    #ChangeAvatar_Cancel:hover{
		border: 2px solid #58BBEC;
	color: #58BBEC;
	}
  </style>
  <script src = "../js/autoResizeImage.js"></script>
  <script>
   function checkImage(file, image){
    var ChangeAvatarSuccess;
    if(file.value.match('.(jpg|jpeg|png|bmp)')){
     if(file.files[0].size < 5 * 1024 * 1024){
      ChangeAvatarSuccess = 1;
      setPreviewImage(file, image, image.width, image.height);
      document.getElementById("UploadAvatar_Msg").innerHTML = "";
     }
     else{
      ChangeAvatarSuccess = 0;
      image.src = "../img/systemimage/uploadbutton.jpg";
      document.getElementById("UploadAvatar_Msg").innerHTML = "File must be smaller than 5MB!";
     }
    }
    else{
     ChangeAvatarSuccess = 0;
     image.src = "../img/systemimage/uploadbutton.jpg";
     if(file.value.length > 0){
      document.getElementById("UploadAvatar_Msg").innerHTML = "supporting types: jpg/jpeg/png/bmp !";
     }
    }
    if(ChangeAvatarSuccess != 1){ //The avatar is not suitable, and save button is not available.
     document.getElementById("ChangeAvatar_Submit").disabled = true;
    }
    else{ //The avatar is suitable, and save button is available.
     document.getElementById("ChangeAvatar_Submit").disabled = false;
    }
   }
  </script>
 </head>
 <body>
  <form enctype="multipart/form-data" method = "post" action = "">
   <div class = "ChangeAvatar_Session">
    <label id = "Label_CurrentAvatar" ><p style="font-family: "Josefin Sans", "Helvetica Neue", Helvetica, sans-serif;color:#417CF0;">Current</p></label>
    <image id="CurrentAvatar" style = "" src = <?php echo "../avatars/".$_SESSION[Username].".jpg" ?> width = "200" height = "200" onload = "autoResizeImage(this, 200, 200)">
   </div>
   <div class = "ChangeAvatar_Session">
    <label id = "Label_NewAvatar"><p style="font-family: "Josefin Sans", "Helvetica Neue", Helvetica, sans-serif; color:#417CF0;">New</p></label>
    <input type = "image" id = "NewAvatar" style = "" src = "../img/systemimage/uploadbutton.jpg" width = "200" height = "200" onclick = "UploadAvatar.click();return false;" onload = "autoResizeImage(this, 200, 200)">
   </div>
   <span id = "UploadAvatar_Msg" style = "float:left"></span>
   <input type = "file" id = "UploadAvatar" name = "UploadAvatar" style = "display:none"  onchange="checkImage(this, document.getElementById('NewAvatar'));" />
   <input type = "submit" id = "ChangeAvatar_Submit" name = "ChangeAvatar_Submit" value = "Save" disabled = true>
   <input type = "button" id = "ChangeAvatar_Cancel" value = "Cancel" onclick = "parent.document.getElementById('changeavatar_window').style.display = 'none';parent.document.getElementById('mask').style.display = 'none';parent.location.reload();">
  </form>
 </body> 
</html>