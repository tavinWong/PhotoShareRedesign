<?php
 error_reporting(0);
 session_start();
 require_once("mysql_connect.php");
 $loginSuccess = 0;
 $L_Username = modifiedInput($_POST['L_Username']);
 $L_UserPassword = modifiedInput($_POST['L_UserPassword']);
 if($_POST[L_AutoLogin]) $L_AutoLogin = "1";
 else $L_AutoLogin = "0";

 if($L_Username == ""){ //Check username step 1
  $L_UsernameMsg = "Username is required!";
 }
 else{ //Check username step 2
  $l_sql_user = "select Username from users where Username = '$L_Username'";
  $l_query_user = mysql_query($l_sql_user);
  if(mysql_num_rows($l_query_user) == 0){
   $L_UsernameMsg = "Username does not exist!";
  }
  else{
   $L_UsernameMsg = "";
   $loginSuccess += 1;
  }
 }
 setcookie("login_username", "$L_Username", time()+1); //Set cookie for username
 $_COOKIE[login_username] = "$L_Username";

 if($loginSuccess == 1){
  if($L_UserPassword == ""){ //Check password step 1
    $L_UserPasswordMsg = "Password is required!";
  }

  else{ //Check password step 2   
   $l_sql_password = "select UserPassword from users where Username = '$L_Username' and UserPassword = '$L_UserPassword'";
   $l_query_password = mysql_query($l_sql_password);
   if(mysql_num_rows($l_query_password) == 0){
    $L_UserPasswordMsg = "Password wrong!";
   }
   else{
    $L_UserPasswordMsg = "";
    $loginSuccess += 2;
   }
  }
 }
 setcookie("login_userpassword", "$L_UserPassword", time()+1); //Set cookie for password
 $_COOKIE[login_userpassword] = "$L_UserPassword";
 
 if($loginSuccess == 3){ //Login successfully
  if($L_AutoLogin == "1"){ //Login automatically
   setcookie("Username", "$L_Username", time()+10*365*24*3600,"/");
   setcookie("UserPassword", "$L_UserPassword", time()+10*365*24*3600,"/");
   setcookie("login_username", "$L_Username", time()+10*365*24*3600,"/");
   setcookie("login_userpassword", "$L_UserPassword", time()+10*365*24*3600,"/");
  }
  else{ //Login manually
  }
  $_SESSION[Username] = $L_Username;
  ?>
  <script>
   parent.document.getElementById("login_window").style.display = "none";
   parent.document.getElementById("mask").style.display = "none";
   parent.location.reload();
  </script>
  <?php
 }
 function modifiedInput($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
?>