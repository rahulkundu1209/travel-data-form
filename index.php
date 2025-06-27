<?php
// form_submit.php
  $inserted = false;
  if(isset($_POST['name'])){
    $server = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($server, $username, $password);

    if(!$con){
      die("Connection to the database failed due to " . mysqli_connect_error());
    }
    // echo "Database connected successfully!";

    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $comments = $_POST["comments"];

    $insertQuery = "INSERT INTO `learning`.`trip` (`name`, `gender`, `age`, `email`,  `comment`, `dt`) VALUES ('$name', '$gender', '$age', '$email', '$comments',  current_timestamp());";

    if($name!="" && $con->query($insertQuery) == true) {
      $con->close();
      header("Location: index.php?submitted=1");
      exit();
    } 
    else{
      echo "Error: " . $con->error;
      $con->close();
    }
  }
?>

<!-- A simple form to take informations from users about a travel program -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1 class="form-title">Welcome to Purulia Trip Form</h1>
  <p>Join us and explore the beauty of Purulia!</p>
  <?php
    if(isset($_GET['submitted'])){
      echo "<p class='submit-success'>Thanks for submitting your details! We are delighted to have you on board.</p>";
    }
  ?>
  <form class="travel-form" action="index.php" method="POST">
    <label class="form-label" for="name">Name:</label>
    <input class="form-input" type="text" id="name" name="name" required>

    <label class="form-label" for="gender">Gender:</label>
    <select class="form-select" id="gender" name="gender" default="select" required>
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select>

    <label class="form-label" for="age">Age:</label>
    <input class="form-input" type="number" id="age" name="age" min="0" required>

    <label class="form-label" for="email">Email:</label>
    <input class="form-input" type="email" id="email" name="email" required>

    <textarea class="form-textarea" id="comments" name="comments" rows="4" cols="50" placeholder="Any comments or special requests..."></textarea>

    <button class="form-button" type="submit">Submit</button>
    <button class="form-button" type="reset">Reset</button>
  </form>
</body>
</html>