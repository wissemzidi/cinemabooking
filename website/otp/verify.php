<?php
require_once "../func.php";

use PragmaRX\Google2FA\Google2FA;

if (!isset($_GET["id"])) {
  die("<h2>Error, No user was selected.</h2>");
} else {
  $id = $_GET["id"];
  global $id;
}
$next_page = null;
if (isset($_GET["next"])) {
  $next_page = $_GET["next"];
} elseif (isset($_POST["next"])) {
  $next_page = $_POST["next"];
}
global $next_page;
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
  <title>Verify with 2fa</title>
</head>

<?php
$conn = connDb();
$stmt = $conn->prepare("SELECT otp_token FROM users WHERE id=? ;");
$stmt->bind_param("s", $id);
if (!$stmt->execute()) {
  die("Error, couldn't get the otp_token from the database");
}
$res = $stmt->get_result();
if ($res->num_rows == 0) {
  die("<h3>No user with this id.</h3>");
}

$otp_token = $res->fetch_array()["otp_token"];
global $otp_token;
if ($otp_token == "") {
  echo ("<a href='../emailAuth?id=<?= $id ?>' style='text-decoration: none;'>Use other method</a>");
  die("<h3>this account isn't associated with OTP authentification</h3>");
}
?>

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


  <main>
    <h1 class="main_title">OTP verification :</h1>
    <form action="" method="POST" class="main_form">
      <div class="inputs_container">
        <input maxlength='6' type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" autocomplete="off" class="text_input" name="input_code" maxlength="6" required autofocus>
      </div>
      <?php verify_2fa() ?>
      <div class="form_buttons">
        <button class="submit_btn" type="submit">Verify</button>
        <button class="submit_btn" type="reset">Cancel</button>
      </div>
    </form>
    <div style="margin-top: 4rem;">
      <a href="../emailAuth?id=<?= $id ?>&next=<?= $next_page ?>" style="text-decoration: none;">Use other method</a>
      <br>
      <p style="opacity: 0.5;">You will find the code in your authentification app</p>
    </div>
  </main>
</body>

<?php

function verify_2fa()
{
  if (isset($_POST["input_code"])) {
    require "../vendor/autoload.php";
    $google2fa = new Google2FA();

    $code = $_POST["input_code"];

    global $otp_token;
    $verify = $google2fa->verify($code, $otp_token);

    if (!$verify) {
      echo "<p class='result failure'>Wrong code, try again.</p>";
    } else {
      global $id;
      switch ($next_page) {
        case '1':
          init_session($id);
          header("location: ../dashboard/dashboard.php");
          break;
        default:
          header("location: ../");
          break;
      }
    }
  }
}

?>

</html>