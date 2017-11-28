
<?php
//Page Navigation Functions
  function redirect_to($new_location){
    header("Location: " . $new_location);
    exit;
  }
?>


<?php
//Login and Session Functions
  function attempt_login($username, $password){
    $user = find_user_by_username($username);
    if($user){
      //Check password
      echo "<pre> ";
      echo print_r($user);
      echo "</pre> ";
      if(password_check($password, $user['hashed_password'])){
        //password found
        return user;
      } else{
        return false;
      }
    } else{
      return false;
    }
  }

  function logged_in(){
    return isset($_SESSION['user_id']);
  }

  function confirm_logged_in(){
    if(!logged_in()){
      redirect_to("../public/home.php");
    }
  }
?>

<?php
  //DATABASE FUNCTIONS
  function mysqli_prep($string){
    global $db_connection;
    $safe_string = mysqli_real_escape_string($db_connection,$string);
    return $safe_string;
  }

  /*function db_connection($username,$password){
    $dbhost = DB_SERVER;
    $dbuser = $username;
    $dbpass = $password;
    $dbname = DB_NAME;
    //The function that actually establishes the fann_get_total_connections
    //$db_connection is a reference to the connection
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    //Sanity Check to see if DB connected
    if(mysqli_connect_errno()){
      die("Database connection failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() .")"
          );
    }
    return $connection;
  }*/

  function find_all_units($username){
    global $db_connection;
    $safe_username = mysqli_real_escape_string($db_connection, $username);
    $query  = "SELECT * ";
    $query .= "FROM units_list ";
    $query .= "WHERE username = '$safe_username' ";
    $query .= "LIMIT 1";
    $unit_set = mysqli_query($db_connection, $query); //format= mysqli_query(connection handler, query string)
    confirm_query($unit_set);
    if($row = mysqli_fetch_assoc($unit_set)){
        return $row;
    }
    else {
      return null;
    }
  }

  function find_all_users(){
    global $db_connection;
    $query  = "SELECT * ";
    $query .= "FROM user_profile ";
    $query .= "ORDER BY username ASC";
    $user_set = mysqli_query($db_connection, $query);
    confirm_query($user_set);
    return $user_set;
  }

  function find_user_by_id($user_id){
    global $db_connection;
    $safe_user_id = mysqli_real_escape_string($db_connection,$user_id);
    $query  = "SELECT * ";
    $query .= "FROM user_profile ";
    $query .= "WHERE id = {$safe_user_id} ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($db_connection, $query);
    confirm_query($user_set);
    if($user_set = mysqli_fetch_assoc($user_set)){
      return $user_set;
    } else{
      return null;
    }
  }

  function find_user_by_username($username){
    global $db_connection;
    $safe_username = mysqli_real_escape_string($db_connection,$username);
    $query  = "SELECT * ";
    $query .= "FROM user_profile ";
    $query .= "WHERE username = '{$safe_username}' ";
    $query .= "LIMIT 1";
    $user_set = mysqli_query($db_connection, $query);
    confirm_query($user_set);
    if($user_set = mysqli_fetch_assoc($user_set)){
      return $user_set;
    } else{
      return null;
    }
  }

  function confirm_query($result_set){
    if (!$result_set) {
      die("Database query failed");
    }
  }
?>

<?php
//HASHING functions
function password_encrypt($password){
  $salt_length = 22;
  $hash_format = "$2y$10$";
  $salt = generate_salt($salt_length);
  $format_and_salt = $hash_format . $salt;
  $hash = crypt($password, $format_and_salt);
  return $hash;

}

function generate_salt($length){
  //Not %100 unique, not %100 random. But good enough for a salt
  $unique_random_string = md5(uniqid(mt_rand(), true));
  //Valid characters for a salt are [a-z,A-Z,0-9,./]
  $base64_string = base64_encode($unique_random_string);
  //But not '+' which is valid in base64 encoding
  $modified_base64_string = str_replace('+', '-', $base64_string);
  //truncate to correct length
  $salt = substr($modified_base64_string, 0, $length);
  return $salt;
}

function password_check($password, $existing_hash){
  $hash = crypt($password, $existing_hash);
  if($hash === $existing_hash){
    return true;
  }
  else{
    return false;
  }
}
?>
