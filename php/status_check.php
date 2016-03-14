<?php
 error_reporting(0);
 require_once("session_check.php");
 require_once("mysql_connect.php");
 $Username = $_SESSION[Username];
 $Status = $_POST[Status];
 
 $sql_updatestatus = "Update users SET Status = '$Status' WHERE Username = '$Username'";
 $query_updatestatus = mysql_query($sql_updatestatus);
?>
<script>
 window.location.href = "javascript:history.back()";
</script>