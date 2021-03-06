<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/db_connection.php")?>
<?php require_once("../includes/validation_functions.php");?>

<?php confirm_logged_in();?>

<?php
  $_SESSION['message'] = "";
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];
  $safe_user_id = mysqli_prep($user_id);
  $unit_set = find_units_by_id($safe_user_id);?>

  <?php
  $citizens = 0;
  $swordsmen = 0;
  $spearmen = 0;
  $cavalry = 0;
?>

<?php include("../includes/layouts/header.php");?>

<?php
  if(isset($_POST['train'])){
    $swordsmen = (int)$unit_set["swordsmen"];
    $cavalry = (int)$unit_set["cavalry"];
    $spearmen =(int)$unit_set["spearmen"];
    $citizens = (int)$unit_set["citizens"];

  //if the user is training units, update list
    $add_citizen = $citizens + (int)$_POST['add_citizen'];
    $add_swordsmen = $swordsmen + (int)$_POST['add_swordsmen'];
    $add_spearmen = $spearmen + (int)$_POST['add_spearmen'];
    $add_cavalry = $cavalry + (int)$_POST['add_cavalry'];

    $total_new_units = $add_swordsmen + $add_spearmen + $add_cavalry;
    $result = false;
    if(check_citizen_count($total_new_units)){
      $result = update_unit_list($safe_user_id, $add_swordsmen, $add_spearmen, $add_cavalry);
    }
    else{
      $_SESSION["message"] = "Not enough citizens to train";
    }

    if($result){
      $_SESSION["message"] = "units updated";
    } else{
      $_SESSION["message"]  = "unit update failed";
    }
  }

  $final_row = find_units_by_id($user_id);
  $citizens = $final_row["citizens"];
  $swordsmen = $final_row["swordsmen"];
  $cavalry = $final_row["cavalry"];
  $spearmen = $final_row["spearmen"];

?>

<div>
<h3 id = "h3_1"> Training </h3>
<table style = "width:100%">
  <tr>
      <td style = "width: 25%">
        <?php include("../includes/layouts/navigation.php");?>
      <td class = "middle_column"><table id = "train_units_table">
        <form action = "training.php" method = "post">
        <tr>
          <th colspan = 3> Train Your Units </th>
        </tr>
        <tr>
          <td> Unit Type </td>
          <td> Description </td>
          <td> Cost </td>
          <td> Quantity </td>
        <tr>
          <td> Available Citizens </td>
          <td> A citizen of your territory </td>
          <td></td>
          <td> <?php echo $citizens;?> </td>
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
          <?php echo $_SESSION['message']; ?>
          <td></td>
        </tr>
        </table>
      </form>
      <td class = "right_column"> <table id  = "units_owned_table">
        <tr>
            <th colspan = 2> Units Owned
        </tr>
        <tr>
            <td> Citizens </td>
            <td id = "citizens owned"> <?php echo $citizens ?>  </td>
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
