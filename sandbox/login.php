<!DOCTYPE html>

<html lang = "en">
  <head>
    <title> Login Processing </title>
  </head>
  <body>
    <br/>
    <?php
      $password = "secret";
      $hash_format = "$2y$10$";
      $salt = "Salt22CharacetrsOrMoreOrMore";
      echo "Length: " . strlen($salt);
      $format_and_salt = $hash_format . $salt;
      $hash = crypt($password, $format_and_salt);
      echo "<br/>";
      echo $hash;

      echo "<br/>";
      $hash2 =crypt("secret", $hash);
      echo "<br/>";
      echo $hash2;

    ?>

  </body>
</html>
