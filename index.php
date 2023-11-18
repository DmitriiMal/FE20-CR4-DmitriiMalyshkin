<?php
require_once "components/db_connection.php";
require_once "components/navbar.php";
$sql = "SELECT * FROM `library`";
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
            <p class='card-text'>$row[author_first_name] $row[author_first_name]</p>
            <a href='details.php?ISBN=$row[ISBN]' class='btn btn-primary'>Details</a>
            <a href='update.php?ISBN=$row[ISBN]' class='btn btn-warning'>Edit</a>
            <a href='delete.php?ISBN=$row[ISBN]' class='btn btn-danger'>Delete</a>
            
            <!--  <a href='publisher.php?publisher_name=$row[publisher_name]'> -->
            <a href='publisher.php?publisher_name=" . urlencode($row['publisher_name']) . "'>

              <p class='card-text fs-6'>$row[publisher_name]</p>
            </a>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="navbar.css">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/x-icon" href="favicon.ico" />
  <title>LibraLink</title>
</head>

<body>
  <?= $navbar ?>
  <div class="container">
    <div class="row row-cols-xs-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
      <?= $cards ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
<!--  -->

</html>