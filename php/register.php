<?php
 error_reporting(0);
 if($_POST['Register_Submit']) require_once("register_check.php");
?> 
<html>
 <head>
  <link rel="stylesheet" type="text/css" href="../css/normalize.css" />

  <link rel="stylesheet" type="text/css" href="../css/overlay.css" />
  <script src = "advancedSelect.js"></script>
 </head>
 <body>
  <form class = "form-4" method = "post" action = "">
    <label for = "R_Username">Username</label>
    <span class = "error_msg" id = "r_username_msg">
     <?php echo "$R_UsernameMsg"; ?>
    </span>
    <input type = "text" id = "R_Username" name = "R_Username" size = 16 maxlength = 16 value = "<?php echo "$_COOKIE[reg_username]"; ?>" onclick = "advancedSelect(this)" onblur = "flag = true">

    <label for = "R_UserPassword">Password</label>
    <span class = "error_msg" id = "r_userpassword_msg">
     <?php echo "$R_UserPasswordMsg" ?>
    </span>
    <input type = "password" id = "R_UserPassword" name = "R_UserPassword" size = 16 maxlength = 16 value = "<?php echo "$_COOKIE[reg_userpassword]"; ?>" onclick = "advancedSelect(this)" onblur = "flag = true">
      
    <label for = "R_ConfirmPassword">Confirm password</label>
    <span class = "error_msg" id = "r_confirmpassword_msg">
     <?php echo "$R_ConfirmPasswordMsg" ?>
    </span>
    <input type = "password" id = "R_ConfirmPassword" name = "R_ConfirmPassword" size = 16 maxlength = 16 value = "<?php echo "$_COOKIE[reg_confirmpassword]"; ?>" onclick = "advancedSelect(this)" onblur = "flag = true">

    <input type = "submit" name = "Register_Submit" value = "Register"> 
    <!--<input type = "button" value = "Cancel" onclick = "window.parent.registerCancel();parent.location.reload();">-->
  </form>
 </body>
</html>