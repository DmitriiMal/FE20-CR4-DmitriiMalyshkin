<?php
require_once "../components/db_connection.php";
require_once "../components/file_upload.php";
require_once "../components/navbar.php";

$error = false;


$fname = $lname = $email = $date_of_birth = "";
$fnameError = $lnameError = $emailError = $dateError = $passError = "";

if (isset($_POST["sign-up"])) {
  $fname = cleanInputs($_POST["fname"]);
  $lname = cleanInputs($_POST["lname"]);
  $email = cleanInputs($_POST["email"]);
  $password = cleanInputs($_POST["password"]);
  $date_of_birth = cleanInputs($_POST["date_of_birth"]);
  $picture = fileUpload($_FILES["picture"]);


  // simple validation for the "first name"
  if (empty($fname)) {
    $error = true;
    $fnameError = "Please, enter your first name";
  } elseif (strlen($fname) < 3) {
    $error = true;
    $fnameError = "Name must have at least 3 characters";
  } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
    $error = true;
    $fnameError = "Name must contain only letters and spaces.";
  }

  // simple validation for the "last name"
  if (empty($lname)) {
    $error = true;
    $lnameError = "Please, enter your last name";
  } elseif (strlen($lname) < 3) {
    $error = true;
    $lnameError = "Last name must have at least 3 characters.";
  } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
    $error = true;
    $lnameError = "Last name must contain only letters and spaces.";
  }

  // simple validation for the "date of birth"
  if (empty($date_of_birth)) {
    $error = true;
    $dateError = "Date of birth can't be empty!";
  }

  // simple validation for the email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter a valid email address";
  } else {
    $query = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) !== 0) {
      $error = true;
      $emailError = "Provided Email is already in use";
    }
  }

  // simple validation for the "password"
  if (empty($password)) {
    $error = true;
    $passError = "Password can't be empty!";
  } elseif (strlen($password) < 3) {
    $error = true;
    $passError = "Password must have at least 3 characters.";
  }

  if (!$error) {
    $password = hash("sha256", $password);

    $sql = "INSERT INTO `users`(`first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`) VALUES ('$fname','$lname','$password','$date_of_birth','$email','$picture[0]')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
      echo "<div class='alert alert-success pt-120'>
                   <p>New account has been created, $picture[1]</p>
                </div>";
    } else {
      echo "<div class='alert alert-danger pt-120'>
                   <p>Something went wrong, please try again later ...</p>
                </div>";
    }
  }
}

mysqli_close($connect);


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="../style/style.css">
  <link rel="icon" type="image/x-icon" href="/FE20-CR4-DmitriiMalyshkin/favicon.ico" />
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link>
</head>

<body>
  <?= $navbar ?>
  <div class="container pt-120">
    <h1 class="text-center">Sign Up </h1>
    <form method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="mb-3 mt-3">
        <label for="fname" class="form-label">First name </label>
        <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="<?= $fname ?>">
        <span class="text-danger"><?= $fnameError ?></span>
      </div>
      <div class="mb-3">
        <label for="lname" class="form-label">Last name </label>
        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?= $lname ?>">
        <span class="text-danger"><?= $lnameError ?></span>
      </div>
      <div class="mb-3">
        <label for="date" class="form-label">Date of birth</label>
        <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $date_of_birth ?>">
        <span class="text-danger"><?= $dateError ?></span>
      </div>
      <div class="mb-3">
        <label for="picture" class="form-label">Profile picture </label>
        <input type="file" class="form-control" id="picture" name="picture">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address </label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
        <span class="text-danger"><?= $emailError ?></span>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <span class="text-danger"><?= $passError ?></span>
      </div>
      <button name="sign-up" type="submit" class="btn btn-secondary">Create account </button>

      <span>you have an account already? <a href="login.php">sign in here </a></span>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>