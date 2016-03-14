<?php
 session_start();
 session_unset();
 session_destroy();
 setcookie("Username","",time()-1,"/");
 setcookie("UserPassword","",time()-1,"/");
 header("location:../index.php");
?>