<?php
require "../func.php";
if (!isset($_GET["id"])) header("Location: ../");

global $id;
$id = $_GET["id"];

function verify_code()
{
  if (isset($_SESSION["email_code"]) && $_POST["code_input"] == $_SESSION["email_code"]) {
    $next_page = null;
    if (isset($_GET["next"])) {
      $next_page = $_GET["next"];
    } elseif (isset($_POST["next"])) {
      $next_page = $_POST["next"];
    }

    $id = $_POST["id"];
    switch ($next_page) {
      case '1':
        init_session($id);
        echo ("redirecting to the user dashboard...");
        // ! temp solution
        echo "<script>location.href='../dashboard/dashboard'</script>";
        // header("location : ../");
        break;
      default:
        header("location: ../");
        break;
    }
  } else {
    echo "<p class='result failure'>Wrong code.</p>";
  }
}

use PHPMailer\PHPMailer\PHPMailer;

function send_email_auth()
{
  require '../vendor/autoload.php';

  global $id;
  $conn = connDb();
  $stmt = $conn->prepare("SELECT * FROM users WHERE id=? ;");
  $stmt->bind_param("s", $id);
  if (!$stmt->execute()) {
    die("error getting the user. please contact our support team");
  }
  $row = $stmt->get_result()->fetch_array();
  $receiver_email = $row["email"];
  $receiver_name = $row["username"];

  $auth_code = random_int(111111, 999999);
  $sender_name = "CinemaBooking";
  $sender_email = "wissem.zidi.ofc@gmail.com";

  // initializing the mail
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  require_once "./smtp_conn.php";
  // $mail->Username   = '';
  // $mail->Password   = '';
  $mail->Port       = 465;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //Enable implicit SSL encryption


  // setting Recipients
  $mail->Subject = "2fa Authentification code";
  $mail->setFrom($sender_email, $sender_name);
  $mail->addAddress($receiver_email, $receiver_name);


  // setting the body of the email
  $html_content = str_replace("{verif_code}", $auth_code, file_get_contents("./auth_template/index.html"));
  $mail->isHTML();
  $mail->Body = $html_content;


  if ($mail->send()) {
    echo "<script>
      alert('An verification code was sent to your email address.')
    </script>";
  } else {
    echo "<p class='result failure'>an error happened while sending the email</p>";
  }

  // this is just for testing, after you will store the code in a session
  $_SESSION["email_code"] = $auth_code;
}
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
  <script defer src="../home/main.js"></script>
  <title>Email Auth</title>
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

  <main>
    <h2 class="main_title">Email Code :</h2>
    <form method="POST" class="main_form">
      <div class="inputs_container">
        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength='6' type="number" class="text-input" name="code_input" maxlength="6" required autofocus autocomplete="off">
        <input type="hidden" value=<?= $id ?> name="id">
      </div>
      <?php
      if (isset($_GET["id"]) && !isset($_POST["verify_code"])) send_email_auth();
      if (isset($_POST["verify_code"])) verify_code();
      ?>
      <div class="buttons_container">
        <button class="submit-btn" name="verify_code" type="submit">Verify</button>
        <button class="submit-btn" type="reset">Clear</button>
      </div>
    </form>
    <form method="GET" class="resend_email_form">
      <input type="hidden" value=<?= $id ?> name="id">
      <span class="resend_email_span">
        if the email not received try to
      </span>
      <button class="send_email_btn" type="submit"> Resend the Email</button>
    </form>
  </main>
</body>

</html>