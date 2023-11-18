<?php
require_once "components/db_connection.php";
require_once "components/navbar.php";


if (isset($_GET['publisher_name']) && !empty($_GET['publisher_name'])) {

  $publisher_name = urldecode($_GET['publisher_name']);


  $sql = "SELECT * FROM `library` WHERE `publisher_name` = '$publisher_name'";

  $result = mysqli_query($connect, $sql);


  $cards = "";

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $cards .= "
   

    <div class='m-03'>
      <div class='card'>
          <img src='images/$row[image]' alt=''>
          <div class='details'>
              <label>$row[title]</label>
              <p>Autor: $row[author_first_name] $row[author_last_name]</p>
              <!--  <a href='publisher.php?publisher_name=$row[publisher_name]'> -->
              <p class='card-text fs-6'>Publisher: <a class='pub-link' href='publisher.php?publisher_name=" . urlencode($row['publisher_name']) . "'>$row[publisher_name]</a></p>
              <a href='details.php?ISBN=$row[ISBN]' class='btn btn-primary'>Details</a>
              <a href='update.php?ISBN=$row[ISBN]' class='btn btn-secondary'>Edit</a>
              <a href='delete.php?ISBN=$row[ISBN]' class='btn btn-tertiary'>Delete</a>
          </div>
      </div>
    </div>
    ";
    }
  } else {
    $cards = "<p>No data found ¯\_(ツ)_/¯</p>";
  }
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style/style.css">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/x-icon" href="favicon.ico" />
  <title>Publisher | LibraLink</title>
</head>

<body>
  <?= $navbar ?>
  <div class="container pt-120">
    <h1>Publisher: <?= $_GET['publisher_name'] ?></h1>
    <div class="grid-container">
      <?= $cards ?>
    </div>
  </div>

</body>

</html>