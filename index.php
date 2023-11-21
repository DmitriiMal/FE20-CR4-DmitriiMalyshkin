<?php
require_once "components/db_connection.php";
require_once "components/navbar.php";
$sql = "SELECT * FROM `library`";
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
              <p>$row[author_first_name] $row[author_last_name]</p>
              <!--  <a href='publisher.php?publisher_name=$row[publisher_name]'> -->
              <p class='card-text fs-6'>Publisher: <a class='pub-link' href='publisher.php?publisher_name=" . urlencode($row['publisher_name']) . "'>$row[publisher_name]</a></p>
              <a href='product/details.php?ISBN=$row[ISBN]' class='btn btn-primary'>Details</a>
              <a href='product/update.php?ISBN=$row[ISBN]' class='btn btn-secondary'>Edit</a>
              <a href='product/delete.php?ISBN=$row[ISBN]' class='btn btn-tertiary'>Delete</a>
          </div>
      </div>
    </div>
    ";
  }
} else {
  $cards = "<p>No data found ¯\_(ツ)_/¯</p>";
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
  <link rel="stylesheet" href="style/style.css">
  <title>LibraLink</title>
</head>

<body>
  <?= $navbar ?>
  <div class="container pt-120">
    <div class="grid-container">
      <?= $cards ?>
    </div>
  </div>


</body>

</html>