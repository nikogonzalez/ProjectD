<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/db_connection.php")?>
<?php require_once("../includes/validation_functions.php");?>

<!-- TO FIX:
Add function to modify user_info with faction choice after faction_submit
-->
<?php include("../includes/layouts/header.php");?>

<pre>
  <?php print_r($_POST);?>
</pre>

<section class ="faction-container">
  <form action = "base.php" method = "post">
    <h2> Choose a Faction </h2>
    <input type ="radio" name ="faction" value ="Faction 1" checked>
    Faction 1 </br>
    <input type ="radio" name ="faction" value ="Faction 2">
    Faction 2 </br>
    <input type ="submit" name = "faction_submit" value ="Play Now!">
  </form>
</section>

<?php include("../includes/layouts/footer.php");?>
