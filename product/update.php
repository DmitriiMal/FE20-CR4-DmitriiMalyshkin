<?php

session_start();

if ((!isset($_SESSION['user']) && !isset($_SESSION['adm'])) || !isset($_SESSION['user'])) {
  header("Location: /FE20-CR4-DmitriiMalyshkin/index.php");
  die();
}

require_once "../components/db_connection.php";
require_once "../components/file_upload.php";
require_once "../components/navbar.php";



if (isset($_GET['ISBN']) && !empty($_GET['ISBN'])) {

  $ISBN = $_GET['ISBN'];
  $sql = "SELECT * FROM `library` WHERE `ISBN`= $ISBN";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {


  $title = $_POST['title'];
  $image = fileUpload($_FILES['image']);
  $type = $_POST['type'];
  $short_description = $_POST['short_description'];
  $author_first_name = $_POST['author_first_name'];
  $author_last_name = $_POST['author_last_name'];
  $publisher_name = $_POST['publisher_name'];
  $publisher_address = $_POST['publisher_address'];
  $publish_date = $_POST['publish_date'];

  if ($_FILES['image']['error'] == 0) {
    if ($row['image'] !== "product.png") {
      unlink("images/$row[image]");
    }

    $sql = "UPDATE `library` SET `ISBN`='$ISBN',`title`='$title',`image`='$image[0]',`short_description`='$short_description',`type`='$type',`author_first_name`='$author_first_name',`author_last_name`='$author_last_name',`publisher_name`='$publisher_name',`publisher_address`='$publisher_address',`publish_date`='$publish_date' WHERE `ISBN`= $ISBN";
  } else {

    $sql = "UPDATE `library` SET `ISBN`='$ISBN',`title`='$title',`short_description`='$short_description',`type`='$type',`author_first_name`='$author_first_name',`author_last_name`='$author_last_name',`publisher_name`='$publisher_name',`publisher_address`='$publisher_address',`publish_date`='$publish_date' WHERE `ISBN`= $ISBN";
  }


  // Call data from database
  if ($result = mysqli_query($connect, $sql)) {
    echo "
    <div class='alert alert-success pt-120' role='alert'>
      The object has been updated!
    </div>
    ";
  } else {
    echo "
    <div class='alert alert-danger pt-120' role='alert'>
      Something went wrong ¯\_(ツ)_/¯ 
    </div>
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
  <link rel="stylesheet" href="../style/style.css">
  <script src="https://kit.fontawesome.com/553d5d3b41.js" crossorigin="anonymous"></script>
  <link rel="icon" type="image/x-icon" href="../favicon.ico" />
  <title>Edit | LibraLink</title>
</head>


<body>
  <?= $navbar ?>

  <div class="container pt-120 ">

    <form action="" method="post" enctype="multipart/form-data" class="row row-cols-1 gap-3 p-4">

      <input type="text" name="title" placeholder="Title" value="<?= $row['title'] ?? "" ?>" class="form-control">
      <input type="text" name="short_description" placeholder="Short description" value="<?= $row['short_description'] ?? "" ?>" class="form-control">
      <input type="text" name="author_first_name" placeholder="Author first name" value="<?= $row['author_first_name'] ?? "" ?>" class="form-control">
      <input type="text" name="author_last_name" placeholder="Author last name" value="<?= $row['author_last_name'] ?? "" ?>" class="form-control">
      <input type="text" name="publisher_name" placeholder="Publisher name" value="<?= $row['publisher_name'] ?? "" ?>" class="form-control">
      <input type="text" name="publisher_address" placeholder="Publisher address" value="<?= $row['publisher_address'] ?? "" ?>" class="form-control">
      <select name="type" class="form-control">
        <option <?= ($row['type'] == "book") ? "selected" : "" ?> value="book">Book</option>
        <option <?= ($row['type'] == "cd") ? "selected" : "" ?> value="cd">CD</option>
        <option <?= ($row['type'] == "dvd") ? "selected" : "" ?> value="dvd">DVD</option>
      </select>
      <input type="date" name="publish_date" placeholder="Publish date" value="<?= $row['publish_date'] ?? "" ?>" class="form-control">
      <input type="file" name="image" placeholder="Image" class="form-control">
      <input type="submit" name="submit" value="Update" class="btn btn-secondary">


    </form>
  </div>


</body>

</html>




<?php

// echo "<pre>";
// var_dump($row);
// echo "</pre>";
// exit();
?>