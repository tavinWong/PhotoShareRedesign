<?php
 session_start();
 if(isset($_SESSION[Username])){ //Session has already been set, which means user has logged in
  $LoginState = 1;
 }
 else{ //Session has not been set, which means user has not logged in
  if(isset($_COOKIE[Username])){ //User is going to login, and server will identify the user
   require_once("mysql_connect.php");
   $l_sql = "select * from users where Username = '$_COOKIE[Username]' and UserPassword = '$_COOKIE[UserPassword]'";
   $l_query = mysql_query($l_sql);
   if(mysql_num_rows($l_query) == 0){ //Abnormal state
    $LoginState = 2;
   }
   else{ //Normal state
    $_SESSION[Username] = $_COOKIE[Username];
    $LoginState = 1;
   }
  }
  else{ //Tourist state
   $LoginState = 0;
  }
 }
?>