<?php include("../includes/layouts/header.php"); ?>
<?php include("../includes/functions.php")?>

<?php
  $username = 'zach';
  $db_connection = db_connection('zach', 'captain8');
  $safe_username = mysqli_real_escape_string($db_connection,$username);
  $unit_set = find_all_units($username);
  $citizens = 0;
  $swordsmen = 0;
  $spearmen = 0;
  $cavalry = 0;

    if(isset($_POST['train'])){ ?>
    <pre>
      <?php print_r($_POST)?>
    </pre>
    <?php
    $row = find_all_units($username);
    $swordsmen = $row["swordsmen"];
    $cavalry = $row["cavalry"];
    $spearmen = $row["spearmen"];
    $citizens = $row["citizens"];

  //if the user is training units, update list
    $add_citizen = $citizens + (int)$_POST['add_citizen'];
    $add_swordsmen = $swordsmen + (int)$_POST['add_swordsmen'];
    $add_spearmen = $spearmen + (int)$_POST['add_spearmen'];
    $add_cavalry = $cavalry + (int)$_POST['add_cavalry'];
    $update  = "UPDATE units_list ";
    //**TO CHANGE** change to units
    $update .= "SET swordsmen = $add_swordsmen, spearmen = $add_spearmen, cavalry = $add_cavalry, citizens = $add_citizen ";
    //**TO CHANGE** Change to username
    $update .= "WHERE username = 'zach'";
    $update_result = mysqli_query($db_connection, $update);
  }

  $final_row = find_all_units($username);
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
        <ul id = "commander_options_list">
          <li><a class = "commander_options" href = "../project%20dick/base.htm"> Your Base </a>
          <li><a class = "commander_options" href = "../project%20dick/training.htm"> Train </a>
          <li><a class = "commander_options" href = "../project%20dick/home.htm"> Home </a>

      <td class = "middle_column"><table id = "train_units_table">
        <form action = "training.php" method = "post">
          <input type = 'hidden' name = 'username'><?php echo $username ?>
        <tr>
          <th colspan = 3> Train Your Units </th>
        </tr>
        <tr>
          <td> Unit Type </td>
          <td> Description </td>
          <td> Cost </td>
          <td> Quantity </td>
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
