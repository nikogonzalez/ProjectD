<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/db_connection.php")?>
<?php require_once("../includes/validation_functions.php");?>


<!--TO FIX:
faction gets pulled from database.
List recent attacks, pulled from database.
-->
<?php include("../includes/layouts/header.php");?>

<?php
  $username = $_SESSION['username'];
  $user_info = find_user_by_username($username);
?>

<section id = "middle">
  <h3 id = "h3_1"> Your Base </h3>

  <table style = "width:100%">
      <tr>
        <td style = "width: 25%">
          <ul id = "commander_options_list">
            <li><a class = "commander_options" href = "/project%20dick/sandbox/basetwo.php"> Your Base </a>
            <li><a class = "commander_options" href = "../training.htm"> Train </a>
            <li><a class = "commander_options" href = "../hometwo.html"> Home </a>
            <li><a class = "commander_options" href = "../sandbox/basetwo.php?id=<?php echo $id;?>"> Test </a>
          </ul>
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
            <td> <?php echo ucfirst($user_info['faction']); ?> </td>
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
</section>

<?php include("../includes/layouts/footer.php");?>
