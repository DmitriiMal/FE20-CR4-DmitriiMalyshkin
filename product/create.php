<?php

session_start();

if ((!isset($_SESSION['user']) && !isset($_SESSION['adm'])) || isset($_SESSION['user'])) {
  header("Location: /FE20-CR4-DmitriiMalyshkin/index.php");
  die();
}

require_once "../components/db_connection.php";
require_once "../components/file_upload.php";
require_once "../components/navbar.php";

$options = "";

$sql = "SELECT * FROM `suppliers`";
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $options .= "
  <option value='$row[id]'>$row[name]</option>
  ";
}


if (isset($_POST['submit'])) {


  $ISBN = $_POST['ISBN'];
  $title = $_POST['title'];
  $image = fileUpload($_FILES['image']);
  $type = $_POST['type'];
  $short_description = $_POST['short_description'];
  $author_first_name = $_POST['author_first_name'];
  $author_last_name = $_POST['author_last_name'];
  $publisher_name = $_POST['publisher_name'];
  $publisher_address = $_POST['publisher_address'];
  $publish_date = $_POST['publish_date'];
  $supplier = $_POST['supplier'] !== 0 ? $_POST['supplier'] : NULL;

  // Generate random ISBN if it isn't entered
  if (empty($_POST['ISBN'])) {
    $sql = "INSERT INTO `library`(`ISBN`, `title`, `image`, `short_description`, `type`, `author_first_name`, `author_last_name`, `publisher_name`, `publisher_address`, `publish_date`, `fk_supplier`) VALUES (FLOOR(RAND() * 10000000000),'$title','$image[0]','$short_description','$type','$author_first_name','$author_last_name','$publisher_name','$publisher_address','$publish_date', $supplier)";
  } else {
    $sql = "INSERT INTO `library`(`ISBN`,`title`, `image`, `short_description`, `type`, `author_first_name`, `author_last_name`, `publisher_name`, `publisher_address`, `publish_date`, `fk_supplier`) VALUES ($ISBN, '$title','$image[0]','$short_description','$type','$author_first_name','$author_last_name','$publisher_name','$publisher_address','$publish_date', $supplier)";
  }

  // Call data from database
  if ($result = mysqli_query($connect, $sql)) {
    echo "
    <div class='alert alert-success pt-120' role='alert'>
      New object has been created!
    </div>
    ";
  } else {
    echo "
    <div class='alert alert-danger' role='alert pt-120'>
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
  <link rel="icon" type="image/x-icon" href="/FE20-CR4-DmitriiMalyshkin/favicon.ico" />
  <title>Create | LibraLink</title>
</head>


<body>
  <?= $navbar ?>
  <div class="container pt-120 ">

    <form action="" method="post" enctype="multipart/form-data" class="row row-cols-1 gap-3 p-4">

      <input type="number" name="ISBN" placeholder="ISBN" class="form-control">
      <input type="text" name="title" placeholder="Title" class="form-control">
      <input type="text" name="short_description" placeholder="Short description" class="form-control">
      <input type="text" name="author_first_name" placeholder="Author first name" class="form-control">
      <input type="text" name="author_last_name" placeholder="Author last name" class="form-control">
      <input type="text" name="publisher_name" placeholder="Publisher name" class="form-control">
      <input type="text" name="publisher_address" placeholder="Publisher address" class="form-control">
      <select name="type" class="form-control">
        <option selected value="book">Book</option>
        <option value="cd">CD</option>
        <option value="dvd">DVD</option>
      </select>
      <input type="date" name="publish_date" placeholder="Publish date" class="form-control">
      <select name="supplier" class="form-control">
        <option selected value="0">supplier</option>
        <?= $options ?>
      </select>
      <input type="file" name="image" placeholder="Image" class="form-control">
      <input type="submit" name="submit" value="Create" class="btn btn-secondary">


    </form>
  </div>


</body>

</html>