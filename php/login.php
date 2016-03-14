<?php
 error_reporting(0);
 if($_POST['Login_Submit']) require_once("login_check.php");
?>
<html>
 <head>
  <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="../css/demo.css" />
  <link rel="stylesheet" type="text/css" href="../css/overlay.css" />
  <script src = "../js/advancedSelect.js"></script>
 </head>
 <body>
  <form class = "form-4" method = "post" action = "">
   <label id = "Label_L_Username" for = "L_Username">Username</label>
   <span class = "error_msg" id = "L_Username_Msg">
    <?php echo "$L_UsernameMsg" ?>
   </span>
   <input type = "text" id = "L_Username" name = "L_Username" maxlength = 16 value = "<?php echo "$_COOKIE[login_username]" ?>" onclick = "advancedSelect(this)" onblur = "flag = true">

   <label id = "Label_L_UserPassword" for = "L_UserPassword">Password</label>
   <span class = "error_msg" id = "L_UserPassword_Msg">
    <?php echo "$L_UserPasswordMsg" ?>
   </span>
   <input type = "password" id = "L_UserPassword" name = "L_UserPassword" maxlength =16 value = "<?php echo "$_COOKIE[login_userpassword]" ?>" onclick = "advancedSelect(this)" onblur = "flag = true">

   <input type = "checkbox" id = "L_AutoLogin" name = "L_AutoLogin" <?php if(!isset($L_AutoLogin)) echo "checked = checked"; else if($L_AutoLogin == 1) echo "checked = checked"; ?> ondblclick = "this.click()" />
   <label id = "Label_AutoLogin" for = "L_AutoLogin">Remember me</label>
   <input type = "submit" id = "Login_Submit" name = "Login_Submit" value = "Login">
   <p>No account yet?</p>
   <input type="button" id="register" name="register" value="register" onclick = "parent.document.getElementById('login_window').style.display = 'none';parent.document.getElementById('register_window').style.display = 'block';">
   <!--<input type = "button" id = "Login_Cancel" value = "Cancel" onclick = "window.parent.loginCancel();parent.location.reload();">-->
  </form>
 </body>
</html>