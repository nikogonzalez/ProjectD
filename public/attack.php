<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/db_connection.php")?>
<?php require_once("../includes/validation_functions.php");?>

<?php confirm_logged_in();?>

<?php
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];
  $safe_user_id = mysqli_prep($user_id);
  $unit_set = find_units_by_id($safe_user_id);
  $attackable_set = find_all_users();

  $citizens = 0;
  $swordsmen = 0;
  $spearmen = 0;
  $cavalry = 0;
?>

<?php include("../includes/layouts/header.php");?>

<?php
  $final_row = find_units_by_id($user_id);
  $swordsmen = $final_row["swordsmen"];
  $cavalry = $final_row["cavalry"];
  $spearmen = $final_row["spearmen"];

?>

<div>
<h3 id = "h3_1"> Attack </h3>

<table style = "width:100%">
  <tr>
      <td style = "width: 25%">
        <?php include("../includes/layouts/navigation.php");?>
      <td class = "middle_column"><table id = "train_units_table">
        <form action = "training.php" method = "post">
        <tr>
          <th colspan = 3> Attack </th>
        </tr>
        <tr>
          <td>  </td>
          <td> Username</td>
          <td> Rank </td>
          <td> Estimated Army Size </td>
        <tr>
          <td> Citizen </td>
          <td> A citizen of your territory </td>
          <td> 1 Resource </td>
          <td> <input type = "text" size = "3" name = "add_citizen" value = "000">
        </tr>
        <tr>
          <td> Swordsman </td>
          <td> A sword wielding fighter for your territory. Effective against spearmen</td>
          <td> 1 Citizen </td>
          <td> <input type = "text" size = "3" name = "add_swordsmen" value = "000">

        </tr>
        <tr>
          <td> Spearman </td>
          <td> A spear wielding fighter for your territory. Effective against cavalry </td>
          <td> 1 Citizen </td>
          <td> <input type = "text" size = "3" name = "add_spearmen" value = "000">

        </tr>
        <tr>
          <td> Cavalry </td>
          <td> A horse mounted fighter. Effective against swordsmen </td>
          <td> 1 Citizen </td>
          <td> <input type = "text" size = "3" name = "add_cavalry" value = "000">

        </tr>
        </tr>
        <tr>
          <td></td>
          <td colspan = 3> <input type = "submit" name = "train" value = "Train!"></td>
          <td></td>
        </tr>
        </table>
      </form>
      <td class = "right_column"> <table id  = "units_owned_table">
        <tr>
            <th colspan = 2> Units Owned
        </tr>
        <tr>
            <td> Swordsmen </td>
            <td id = "Swordsmen owned"> <?php echo $swordsmen ?> </td>
        </tr>
        <tr>
            <td> Spearmen </td>
            <td id = "Spearmen owned"> <?php echo $spearmen ?> </td>
        </tr>
        <tr>
            <td> Cavalry </td>
            <td id = "Cavalry owned"> <?php echo $cavalry ?> </td>
        </tr>

      </tr>

  </table>
</table>
</div>

<?php include("../includes/layouts/footer.php");?>
