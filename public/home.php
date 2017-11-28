<?php require_once("../includes/session.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/db_connection.php")?>
<?php require_once("../includes/validation_functions.php");?>

<?php
  $username = "";
  //PROCESS THE LOGIN FORM
  if(isset($_POST['login']))
  {
    $required_fields = array("username", "password");
    validate_presence($required_fields);

    if(empty($errors)){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $found_user = attempt_login($username, $password);
      if($found_user){
        $_SESSION["user_id"] = $found_user["id"];
        $_SESSION["username"] = $found_user["username"];
        redirect_to("base.php");
      } else{
        $_SESSION["message"] = "Username/Password not found.";
      }
    }
  }
  //PROCESS THE REGISTRATION FORM
  elseif (isset($_POST['registration']))
  {
    $required_fields = array("username", "password", "firstname", "lastname", "email");
    validate_presence($required_fields);

    $fields_with_max_length = array("username"=>30, "firstname"=>30, "lastname"=>30, "email"=>30);
    validate_max_lengths($fields_with_max_length);

    if(empty($errors)){
    //try to Log in
      $username = mysqli_prep($_POST["username"]);
      $hashed_password = password_encrypt($_POST["password"]);
      $firstname = mysqli_prep($_POST["firstname"]);
      $lastname = mysqli_prep($_POST["lastname"]);
      $email = mysqli_prep($_POST["email"]);


      $query  = "INSERT INTO user_profile(";
      $query .= " username, hashed_password, firstname, lastname, email";
      $query .= ") VALUES (";
      $query .= "'{$username}', '{$hashed_password}', '{$firstname}', '{$lastname}', '{$email}'";
      $query .= ")";
      $result = mysqli_query($db_connection, $query);

      if($result){
        $_SESSION["message"] ='Registered New User.';
        redirect_to("choose_faction.php");
      } else{
        $_SESSION["message"] = "Registration failed.";
      }
    }
  }  else{
    //this is a GET Request
    $username = "";
    $password = "";
  }
?>

<?php include("../includes/layouts/header.php");?>

 <!-- create log in form and style to left side -->

 <section class="log-in-container">
         <form action = "home.php" method = "post">
             <label>Sign in:</label>
             <!--If form submission error, keep username in the login field-->
             <input class="space" type = "text" name="username" value = <?php echo htmlspecialchars($username);?>>

              <?php$_SESSION["username"] = $username;?>
             <input class="space" type = "password" name="password" placeholder="Password">
             <input class="space" type= "submit" name="login" value="Log In">
         </form>
         <?php echo form_errors($errors);?>
         <?php echo message() ?><br/>
     </section>
     <!-- container for create profile form move to right-->
     <section class="registration-container">
         <form action = "home.php" method = "post">
            <h2>Join for Free!</h2>
            <label>Create a Profile:</label>
            <input class="block" name="firstname" type="text" placeholder="First Name" required>
            <input class="block" name="lastname" type="text" placeholder ="Last Name" required>
            <input class="block" name="email" type="text" placeholder="Email Address" required>
            <input class="block" name="username" type="text" placeholder="Username" required>
            <input class="block" name="password" type="password" placeholder="Password" required>
          </br>
            <input type = "submit" name = "registration" value = "Create Account">
         </form>
         <?php echo message()?>
     </section>

<?php include("../includes/layouts/footer.php");?>
