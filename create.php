<?php
require_once "components/db_connection.php";

if (isset($_POST['submit'])) {
  $ISBN = $_POST['ISBN'];
  $title = $_POST['title'];
  $image = $_POST['image'];
  $short_description = $_POST['short_description'];
  $author_first_name = $_POST['author_first_name'];
  $author_last_name = $_POST['author_last_name'];
  $publisher_name = $_POST['publisher_name'];
  $publisher_address = $_POST['publisher_address'];
  $publish_date = $_POST['publish_date'];
}


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
  <?php require_once "components/navbar.php" ?>
  <div class="container">

    <form action="" method="post" class="row row-cols-1 gap-3 p-4">

      <input type="number" name="ISBN" placeholder="ISBN">
      <input type="text" name="title" placeholder="Title">
      <input type="text" name="image" placeholder="Image">
      <input type="text" name="short_description" placeholder="Short description">
      <select name="type">
        <option selected value="book">Book</option>
        <option value="cd">CD</option>
        <option value="dvd">DVD</option>
      </select>
      <input type="text" name="author_first_name" placeholder="Author first name">
      <input type="text" name="author_last_name" placeholder="Author last name">
      <input type="text" name="publisher_name" placeholder="Publisher name">
      <input type="text" name="publisher_address" placeholder="Publisher address">
      <input type="date" name="publish_date" placeholder="Publish date">
      <input type="submit" name="submit" value="Create">


    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>