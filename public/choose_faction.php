<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/db_connection.php")?>
<?php require_once("../includes/validation_functions.php");?>

<?php confirm_logged_in();?>
<!-- TO FIX:
Add function to modify user_info with faction choice after faction_submit
-->
<?php include("../includes/layouts/header.php");?>
<pre>
  <?php print_r($_SESSION);?>
  <?php print_r($_POST);?>
</pre>
<?php
  $username = "";
  if(isset($_POST['faction_submit'])){
    create_new_unit_list($_SESSION['user_id'], $_POST['faction']);
    $result = find_user_by_id($_SESSION['user_id']);
    if($result){
      redirect_to("base.php");
    } else{
      echo "Please choose a faction!";
      redirect_to("choose_faction.php");
    }
  }
 ?>

<section class ="faction-container">
  <form action = "choose_faction.php" method = "post">
    <h2> Choose a Faction </h2>
    <input type ="radio" name ="faction" value ="faction1" checked>
    Faction 1 </br>
    <input type ="radio" name ="faction" value ="faction2">
    Faction 2 </br>
    <input type ="submit" name = "faction_submit" value ="Play Now!">
  </form>
</section>

<?php include("../includes/layouts/footer.php");?>
