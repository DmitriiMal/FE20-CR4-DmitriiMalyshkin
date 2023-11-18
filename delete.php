<?php
require_once "components/db_connection.php";


if (isset($_GET['ISBN']) && !empty($_GET['ISBN'])) {
  $ISBN = $_GET['ISBN'];
  $sql = "SELECT * FROM `library` WHERE `ISBN`= $ISBN";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);

  if ($row['image'] !== "product.png") {
    unlink("images/$row[image]");
  }

  $sql = "DELETE FROM `library` WHERE `ISBN`= $ISBN";

  mysqli_query($connect, $sql);

  mysqli_close($connect);
  header("Location: index.php");
} else {

  mysqli_close($connect);
  header("Location: index.php");
}
