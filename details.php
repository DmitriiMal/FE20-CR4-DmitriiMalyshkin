<?php
require_once "components/db_connection.php";
require_once "components/navbar.php";


if (isset($_GET['ISBN']) && !empty($_GET['ISBN'])) {

  $sql = "SELECT * FROM `library` WHERE `ISBN` = $_GET[ISBN]";

  $result = mysqli_query($connect, $sql);


  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
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
  <title>Details | LibraLink</title>
</head>

<body>
  <?= $navbar ?>
  <div class="container">

    <div class='my-2'>
      <div class='card'>
        <img src='images/<?= $row['image'] ?>' class='card-img-top' alt='...'>
        <div class='card-body'>
          <h5 class='card-title'> <?= $row['title'] ?></h5>
          <p class='card-text'><?= $row['ISBN'] ?></p>
          <p class='card-text'><?= $row['author_first_name'] ?> <?= $row['author_first_name'] ?></p>
          <p class='card-text'><?= $row['short_description'] ?></p>
          <p class='card-text'><?= $row['type'] ?></p>
          <a href='publisher.php?publisher_name=<?= urlencode($row['publisher_name']) ?>'>

            <p class='card-text fs-6'><?= $row['publisher_name'] ?></p>
          </a>
          <p class='card-text'><?= $row['publisher_address'] ?></p>
          <p class='card-text'><?= $row['publish_date'] ?></p>
          <a href='index.php' class='btn btn-dark'>Home</a>
          <a href='update.php?ISBN=$row[ISBN]' class='btn btn-warning'>Edit</a>
          <a href='delete.php?ISBN=$row[ISBN]' class='btn btn-danger'>Delete</a>
        </div>
      </div>
    </div>

  </div>
</body>

</html>