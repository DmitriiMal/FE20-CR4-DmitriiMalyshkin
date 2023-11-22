<?php
session_start();
require_once "../components/db_connection.php";
require_once "../components/navbar.php";


if (isset($_GET['ISBN']) && !empty($_GET['ISBN'])) {

  $sql = "SELECT * FROM `library` as l LEFT JOIN `suppliers` as s ON l.fk_supplier= s.sup_id WHERE `ISBN` = $_GET[ISBN]";

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
  <link rel="stylesheet" href="../style/style.css">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/x-icon" href="../favicon.ico" />
  <title>Details | LibraLink</title>
</head>

<body>
  <?= $navbar ?>
  <div class="container grid-details pt-120">

    <div id="grig-info">
      <h2> <?= $row['title'] ?></h2>
      <p><strong>ISBN: </strong><?= $row['ISBN'] ?></p>
      <p><strong>Author: </strong><?= $row['author_first_name'] ?> <?= $row['author_first_name'] ?></p>
      <p><strong>Description:</strong></p>
      <p><?= $row['short_description'] ?></p>
      <p><strong>Type: </strong><?= $row['type'] ?></p>
      <p><a href='../publisher.php?publisher_name=<?= urlencode($row['publisher_name']) ?>'><?= $row['publisher_name'] ?></p></a>
      <p><strong>Publisher: </strong><?= $row['publisher_address'] ?></p>
      <p><strong>Supplier: </strong><?= $row['sup_name'] ?></p>
      <p><strong>Date of publication: </strong><?= $row['publish_date'] ?></p>
    </div>
    <div id="grig-buttons">
      <a href='../index.php' class='btn btn-primary'>Home</a>
      <?php
      if (isset($_SESSION['adm'])) {
        echo "
        <a href='update.php?ISBN=<?= $row[ISBN] ?>' class='btn btn-secondary'>Edit</a>
        <a href='delete.php?ISBN=<?= $row[ISBN] ?>' class='btn btn-tertiary'>Delete</a>
        ";
      }
      ?>
    </div>
    <img id="grig-image" src='../images/<?= $row['image'] ?>' class='card-img-top' alt='...'>



  </div>
</body>

</html>