<?php

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
  <link rel="stylesheet" href="style.css">
  <title>Generate a 2fa secret</title>
</head>

<body>

  <main>
    <h1 class="main_title">2fa verification</h1>
    <img width="100%" src="" alt="">
    <?php
    require "vendor/autoload.php";

    // quick and simple:
    $google2fa = new Google2FA();
    $otp_token = $google2fa->generateSecretKey();
    $uri = $google2fa->getQRCodeUrl("CinemaBooking", "username", $otp_token);
    echo '<img src="' . (new QRCode)->render($uri) . '" alt="QR Code" />';

    echo "<p id='secret_token' hidden>{$otp_token}</p>";
    ?>
    <button id="show_token">Show Secret Code</button>
  </main>

</body>

<script>
  document.getElementById("show_token").addEventListener("click", () => {
    document.getElementById("secret_token").removeAttribute("hidden");
  });
</script>

</html>