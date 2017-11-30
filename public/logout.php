<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>

<?php confirm_logged_in();?>

<?php
  $_SESSION["user_id"] = null;
  $_SESSION["username"] = null;
  $_SESSION["message"] = null;

  redirect_to("home.php");
 ?>
