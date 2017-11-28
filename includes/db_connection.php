<?php
define ("DB_SERVER", "localhost");
define ("DB_USER", "zach");
define ("DB_PASSWORD", "captain8");
define ("DB_NAME", "db_projectd");


  $dbhost = DB_SERVER;
  $dbuser = DB_USER;
  $dbpass = DB_PASSWORD;
  $dbname = DB_NAME;
  //The function that actually establishes the fann_get_total_connections
  //$db_connection is a reference to the connection
  $db_connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  //Sanity Check to see if DB connected
  if(mysqli_connect_errno()){
    die("Database connection failed: " .
          mysqli_connect_error() .
          " (" . mysqli_connect_errno() .")"
        );
  }
?>
