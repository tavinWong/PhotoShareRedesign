<?php
 error_reporting(0);
 require_once("mysql_connect.php");
 $registerSuccess = 0;
 $R_Username = modifiedInput($_POST['R_Username']);
 $R_UserPassword = modifiedInput($_POST['R_UserPassword']);
 $R_ConfirmPassword = modifiedInput($_POST['R_ConfirmPassword']);
 if($R_Username == ""){ //Check username step 1
  $R_UsernameMsg = "Username is required!";
 }
 else if(strlen($R_Username) < 4 || strlen($R_Username) > 16){ //Check username step 2
  $R_UsernameMsg = "Length limit: 4-16 chars!";
 }
 else{ //Check username step 3
  $r_sql_user = "select Username from users where Username = '$R_Username'";
  $r_query_user = mysql_query($r_sql_user);
  if(mysql_num_rows($r_query_user) > 0){
   $R_UsernameMsg = "Username exists!";
  }
  else{ //Username is ok
   $R_UsernameMsg = "Username is ok.";
   $registerSuccess += 1;
   ?>
   <style>#r_username_msg{color:black;}</style>
   <?php 
  }
 }
 setcookie("reg_username", "$R_Username", time()+1); //Set cookie for username
 $_COOKIE[reg_username] = "$R_Username";
 
 if($R_UserPassword == ""){ //Check password step 1
  $R_UserPasswordMsg = "Password is required!";
 }
 else if(strlen($R_UserPassword) < 6 || strlen($R_UserPassword) > 16){ //Check password step 2
  $R_UserPasswordMsg = "Length limit: 6-16 chars!";
 }
 else{ //Password is ok
  $R_UserPasswordMsg = "Password is ok.";
  $registerSuccess += 2;
  ?>
  <style>#r_userpassword_msg{color:black;}</style>
  <?php 
 }
 setcookie("reg_userpassword", "$R_UserPassword", time()+1); //Set cookie for password
 $_COOKIE[reg_userpassword] = "$R_UserPassword";

 if($registerSuccess == 2 || $registerSuccess == 3){
  if($R_ConfirmPassword != $R_UserPassword){ //Check confirm password
   $R_ConfirmPasswordMsg = "Passwords don't match!";
  }
  else{
   $registerSuccess += 4;
   setcookie("reg_confirmpassword", "$R_ConfirmPassword", time()+1); //Set cookie for confirm password
   $_COOKIE[reg_confirmpassword] = "$R_ConfirmPassword";
  }

  if($registerSuccess == 7){ //Register successfully
   $r_sql_insert = "INSERT INTO users (Username, UserPassword) VALUES ('$R_Username', '$R_UserPassword')";
   mysql_query($r_sql_insert);
   copy("../img/systemimage/defaultavatar.jpg", "../avatars/".$R_Username.".jpg");
   ?>
   <script>
    parent.document.getElementById("register_window").style.display = "none";
    parent.document.getElementById("mask").style.display = "none";
    window.alert("Register successfully!");
   </script>
  <?php
  }
 }
 function modifiedInput($data)
 {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
?>
