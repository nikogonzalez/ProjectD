<?php
  $dbhost = "localhost";
  $dbuser = "zach";
  $dbpass = "captain8";
  $dbname = "db_projectd";
  $db_connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if(mysqli_connect_errno()){
    die("Database connection failed: " .
          mysqli_connect_error() .
          " (" . mysqli_connect_errno() .")"
        );
  }
?>

<?php
  $query  = "SELECT * ";
  $query .= "FROM command_options ";
  $result = mysqli_query($db_connection, $query); //format= mysqli_query(connection handler, query string)

  if (!$result) {
    die("Database query failed");
  }
?>
<?php
  $query = "INSERT INTO db_projectd (menu_name,position, visible)
            VALUES('${menu_name}',{$position}, {$visible})";
<!DOCTYPE html >
  <html lang = "en">
    <head>
        <title>DB_Test</title>
    </head>
    <body>

      <ul>
      <?php
        while ($command_options = mysqli_fetch_assoc($result)){
          ?>
          <li><?php echo $command_options["menu_name"] . "<br/>";?> </li>
      <?php
        }
      ?>
    </ul>
      <?php
        mysqli_free_result($result)
       ?>

    </body>
  </html>
<?php
  mysqli_close($db_connection);
?>
