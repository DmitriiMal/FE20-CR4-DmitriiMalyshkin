<?php
require_once "components/db_connection.php";
require_once "components/navbar.php";


if (isset($_GET['ISBN']) && !empty($_GET['ISBN'])) {

  $sql = "SELECT * FROM `library` WHERE `ISBN` = $_GET[ISBN]";

  $result = mysqli_query($connect, $sql);

  $cards = "";

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $cards .= "
    <div class='my-2'>
        <div class='card'>
          <img src='images/$row[image]' class='card-img-top' alt='...'>
          <div class='card-body'>
            <h5 class='card-title'>$row[title]</h5>
            <p class='card-text'>$row[ISBN]</p>
            <p class='card-text'>$row[author_first_name] $row[author_first_name]</p>
            <p class='card-text'>$row[short_description]</p>
            <p class='card-text'>$row[type]</p>
            <p class='card-text'>$row[publisher_name]</p>
            <p class='card-text'>$row[publisher_address]</p>
            <p class='card-text'>$row[publish_date]</p>
            <a href='index.php' class='btn btn-dark'>Back</a>
            <a href='update.php?ISBN=$row[ISBN]' class='btn btn-warning'>Edit</a>
            <a href='delete.php?ISBN=$row[ISBN]' class='btn btn-danger'>Delite</a>
          </div>
        </div>
    </div>
    ";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Library</title>
</head>

<body>
  <?= $navbar ?>
  <div class="container">

    <?= $cards ?>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>