<?php

session_start();

if (!isset($_SESSION['adm'])) {
  header("Location: ../index.php");
}

require_once "../components/db_connection.php";
require_once "../components/navbar.php";

$data = "";
$sql = "SELECT * FROM `users` WHERE `status` != 'adm'";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $data .= "
              <tr>
                <th scope='row'>$row[id]</th>
                <td><img src='../images/$row[picture]' alt='user pic' width='50' height='50'></td>
                <td>$row[first_name]</td>
                <td>$row[last_name]</td>
                <td>$row[date_of_birth]</td>
                <td>$row[email]</td>
                <td><a href='../user/update.php?id=$row[id]' class='btn btn-secondary'>Update</a></td>
              </tr>
            ";
  }
}

mysqli_close($connect);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/x-icon" href="favicon.ico" />
  <link rel="stylesheet" href="../style/style.css">
  <title>LibraLink</title>
</head>

<body>
  <?= $navbar ?>
  <div class="container pt-120">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Picture</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Date Of Birth</th>
          <th scope="col">Email</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?= $data; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>