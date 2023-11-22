<?php

session_start();

if (isset($_SESSION["user"]) || isset($_SESSION["adm"])) {
  header("Location: ../index.php");
}

require_once "../components/db_connection.php";
require_once "../components/file_upload.php";
require_once "../components/navbar.php";


$emailError = "";
$passError = "";

if (isset($_POST['login'])) {
  $email = cleanInputs($_POST['email']);
  $password = cleanInputs($_POST['password']);
  $error = false;


  if (empty($email)) {
    $error = true;
    $emailError = "Email cannot be empty.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Email has the wrong format.";
  }

  if (empty($password)) {
    $error = true;
    $passError = "Password cannot be empty.";
  }


  if (!$error) {
    $password = hash("sha256", $password);

    $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if ($row['status'] === "user") {
        $_SESSION['user'] = $row['id'];
        header("Location: ../index.php");
      } elseif ($row['status'] === "adm") {
        $_SESSION['adm'] = $row['id'];
        header("Location: dashboard.php");
      }
    } else {
      echo "
      <div class='alert alert-danger pt-120' role='alert'>
          Either email or password is wrong.
      </div>";
    }
  }
}

mysqli_close($connect);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/x-icon" href="favicon.ico" />
  <link rel="stylesheet" href="../style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Log in</title>
</head>

<body>
  <?= $navbar; ?>

  <div class="container pt-120">
    <form action="" method="post">
      <label>
        Email:
        <input type="email" name="email" class="form-control" value="<?= $email ?? ""; ?>">
        <span><?= $emailError; ?></span>
      </label>
      <label>
        Password:
        <input type="password" name="password" class="form-control">
        <span><?= $passError; ?></span>
      </label>
      <input type="submit" value="Login" name="login" class="btn btn-secondary">
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>