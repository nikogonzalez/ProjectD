<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/db_connection.php")?>
<?php require_once("../includes/validation_functions.php");?>

<?php confirm_logged_in();?>

<!--TO FIX:
faction gets pulled from database.
List recent attacks, pulled from database.
-->

<?php include("../includes/layouts/header.php");?>
<?php
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];
  $user_info = find_user_by_id($user_id);
  $units_list = find_all_units($user_id);
?>
<section id = "middle">
  <h3 id = "h3_1"> <?php echo $username ?>'s Base </h3>

  <table style = "width:100%">
      <tr>
        <td style = "width: 25%">
          <?php include("../includes/layouts/navigation.php");?>
        </td>
        <td ><table id = "commander info">
          <tr>
            <th colspan = "2"> Commander Info</th>
          </tr>
          <tr>
            <td> Username </td>
            <td> <?php echo $username; ?> </td>
          </tr>
          <tr>
            <td> Faction </td>
            <td> <?php echo ucfirst($units_list['faction']); ?> </td>
          </tr>
        </table>
      </td>
      <td><table id = "recent_attacks">
        <tr>
          <!--Lists the recent attacks from other users-->
          <th colspan = 3> Recent Attacks </th>
        </tr>
      </td>
    </tr>

  </table>
</table>
</section>

<?php include("../includes/layouts/footer.php");?>
