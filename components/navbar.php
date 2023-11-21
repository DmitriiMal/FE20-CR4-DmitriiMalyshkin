<?php
echo "
  <nav>
    <input id='nav-toggle' type='checkbox' />
    <div class='logo'>
      <a href='/FE20-CR4-DmitriiMalyshkin/index.php'><i class='fa-solid fa-book-open-reader'></i> LibraLink</a>
    </div>
    <ul class='links'>";
if (isset($_SESSION['adm'])) {
  echo "
      <li><a href='/FE20-CR4-DmitriiMalyshkin/product/product_dashboard.php'>Product</a></li>
      <li><a href='/FE20-CR4-DmitriiMalyshkin/user/dashboard.php'>Dashboard</a></li>
      <li><a href='/FE20-CR4-DmitriiMalyshkin/product/create.php'>Create</a></li>
      
      ";
} elseif (isset($_SESSION['user'])) {
  echo "
      <li><a href='/FE20-CR4-DmitriiMalyshkin/user/update.php'>Update</a></li>
      ";
};
if (isset($_SESSION['user']) || isset($_SESSION['adm'])) {
  echo "
      <li><a href='/FE20-CR4-DmitriiMalyshkin/user/logout.php'>Logout</a></li>
      ";
} elseif (!isset($_SESSION['user']) && !isset($_SESSION['adm'])) {
  echo "
      <li><a href='/FE20-CR4-DmitriiMalyshkin/user/login.php'>Login</a></li>
      <li><a href='/FE20-CR4-DmitriiMalyshkin/user/register.php'>Register</a></li>
      ";
}

echo "</ul>
    <label for='nav-toggle' class='icon-burger'>
    <div class='line'></div>
    <div class='line'></div>
    <div class='line'></div>
    </label>
    </nav>
    ";
    
    // <li><a href='/FE20-CR4-DmitriiMalyshkin/index.php'>Home</a></li>