<?php
require_once "../func.php";

use PragmaRX\Google2FA\Google2FA;
use chillerlan\QRCode\QRCode;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="dark">
  <link rel="stylesheet" href="../home/style.css">
  <link rel="stylesheet" href="./style.css">
  <script src="../home/main.js" defer></script>
  <title>Generate a 2fa secret</title>
</head>

<body>

  <aside id="aside" hidden aria-disabled="true">
    <div class="aside__header">
      <h2 class="aside__title">Menu</h2>
    </div>
    <div class="aside__main">
      <nav class="aside__nav" aria-label="side bar">
        <ul class="aside__ul">
          <div>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../signin/index.php">Account</a></li>
          </div>
        </ul>
      </nav>
      <div class="aside-search">
        <input id="aside-search-box" type="search">
      </div>
    </div>
  </aside>

  <header>
    <div>
      <a href="#">
        <img width="35" src="../icons/logo.svg" title="cinema booking" alt="">
      </a>
      <h1 id="page-main-title">Cinema Booking</h1>
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

  <main class="generate_main">
    <h1 class="main_title">2fa verification</h1>
    <img width="100%" src="" alt="">
    <?php
    require "../vendor/autoload.php";

    if (!isset($_POST["id"])) {
      die("<h2>no user was selected to set an otp.<h2>");
    }
    $id = $_POST["id"];
    $conn = connDb();

    // quick and simple:
    $google2fa = new Google2FA();
    $otp_token = $google2fa->generateSecretKey();

    // changing the otp_token in the db
    $stmt = $conn->prepare("UPDATE users SET otp_token=? WHERE id=? ;");
    $stmt->bind_param("ss", $otp_token, $id);
    if (!$stmt->execute()) {
      die("Error, otp token couldn't be saved");
    }

    // getting the username
    $stmt = $conn->prepare("SELECT username FROM users WHERE id=? ;");
    $stmt->bind_param("s", $id);
    if (!$stmt->execute()) {
      $username = "";
    } else {
      $username = $stmt->get_result()->fetch_array()["username"];
    }

    // generating and printing the qr_code
    $uri = $google2fa->getQRCodeUrl("CinemaBooking", $username, $otp_token);
    echo '<img style="filter: invert(1)" src="' . (new QRCode)->render($uri) . '" alt="QR Code" />';
    echo "<p id='secret_token' hidden>{$otp_token}</p>";

    ?>

    <a class="submit_btn" href="../index.php" style="text-decoration: none; margin-inline: auto;">Complete</a>
    <br>
    <button class="submit_btn" id="show_token">Show Secret Code</button>
  </main>

</body>

<script>
  document.getElementById("show_token").addEventListener("click", () => {
    document.getElementById("secret_token").removeAttribute("hidden");
  });
</script>

</html>