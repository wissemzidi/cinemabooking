<?php
require "../func.php";
if (isset($_COOKIE["admin_token"])) {
  $conn = connDb();
  $token = $_COOKIE["admin_token"];
  $Rq = "SELECT * FROM admins WHERE id='$token' ;";
  $res = mysqli_query($conn, $Rq);
  if (mysqli_num_rows($res) > 0) {
    header("Location: ./admin_dashboard.php");
  }
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<style>
  html {
    background-color: #000;
    color: #EEE;
  }
</style>

<head>
  <meta name="keywords" content="cinema, booking, cinemabooking, series, netflix, netflixy, movies">
  <meta name="author" content="Wissem">
  <meta name="publisher" content="wissem">
  <meta name="copyright" content="wissemzidi 2023">
  <meta name="description" content="the best website to book your movies/cinema tickets. online ticket buying for all the major theatres and cinemas across Tunisia.">
  <meta name="page-topic" content="online movies/theatre/cinema tickets booking/buying">
  <meta name="page-type" content="home">
  <meta name="audience" content="everyone">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../project assets/logo/logo(light).svg">
  <script src="../home/main.js" defer></script>
  <link rel="stylesheet" href="../home/style.css">
  <link rel="stylesheet" href="./admin.css">
  <title>Admin Login</title>
</head>

<body>

  <header>
    <div>
      <a href="#">
        <img width="40" src="../icons/logo(dark).png" title="cinema booking" alt="">
      </a>
      <h1 id="page-main-title">Admin Login</h1>
    </div>
    <nav id="header-nav">
      <button id="search-button">
        <img id="search-btn" width="25" src="../icons/search.png" alt="Search">
      </button>
      <input id="search-box" type="search" hidden disabled>
      <button>
        <img width="25" src="../icons/top.png" alt="">
      </button>
      <a href="../signin/index.php">
        <img width="25" src="../icons/account.png" alt="Account">
      </a>
      <button id="aside-btn-container">
        <img id="aside-btn" width="25" src="../icons/menu.png" alt="Menu">
      </button>
    </nav>
  </header>

  <main>
    <section id="hero">
      <form method="POST" id="admin-signin-form" name="admin_signin_form">
        <div>
          <input type="text" class="login_input" name="email" id="email" placeholder="Email">
        </div>
        <div>
          <input type="text" class="login_input" name="password" id="password" placeholder="Password">
        </div>
        <div>
          <button type="submit" class="login_button">Login</button>
          <button type="reset" class="login_button">Cancel</button>
        </div>
      </form>
    </section>
  </main>

  <?php
  if (isset($_POST['email'])) {
    $conn = connDb();
    $email = $_POST["email"];
    $password = $_POST["password"];
    $Rq = "SELECT id FROM admins WHERE email = '$email' AND password = '$password'";
    $res = mysqli_query($conn, $Rq);

    if (!$res) {
      echo "<p>An Error happened during the process, please try again later or contact us for more information</p>";
    } elseif (mysqli_num_rows($res) == 0) {
      echo "<p>Wrong email or password</p>";
    } else {
      $row = mysqli_fetch_array($res);
      $id = $row["id"];
      $token = $id;
      setcookie("admin_token", $token, time() + (86400 * 30), "/");
      echo "<p class='login_success'>You are logged in</p>";
      header("Location: ./admin_dashboard.php");
    }
  }
  ?>

</body>

</html>