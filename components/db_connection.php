<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "BE20_CR4_DmitriiMalyshkin_BigLibrary";

$connect = mysqli_connect($host, $user, $pass, $dbName);

if (!$connect) {
  echo "No connection";
}
