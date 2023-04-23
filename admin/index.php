<?php
require "../func.php";
$error_msg = "";
if (isset($_SESSION["admin_token"])) {
  $conn = connDb();
  $token = $_SESSION["admin_token"];
  $stmt = $conn->prepare("SELECT * FROM admins WHERE id=? ;");
  $stmt->bind_param("s", $token);
  if (!$stmt->execute()) {
    $error_msg = "Error when verifying your session";
  } else {
    if ($stmt->get_result()->num_rows > 0) {
      mysqli_close($conn);
      header("Location: ./admin_dashboard.php");
    }
  }
  mysqli_close($conn);
}
if (isset($_GET["e"])) {
  switch ($_GET["e"]) {
    case '1':
      $error_msg = "Server error when checking your session";
      break;
    case '2':
      $error_msg = "Admin with this session not found";
      break;
  }
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
  <link rel="icon" type="image/x-icon" href="../icons/admin.svg">
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
      <a href="../">
        <img id="search-btn" width="25" src="../icons/back.svg" alt="Search">
      </a>
    </nav>
  </header>

  <main>
    <section id="hero">
      <?php admin_login() ?>
      <form method="POST" id="admin-signin-form" name="admin_signin_form">
        <div>
          <input type="text" class="login_input" name="email" id="email" placeholder="Email">
        </div>
        <div>
          <input type="password" class="login_input" name="password" id="password" placeholder="Password">
        </div>
        <div>
          <button type="submit" class="login_button">Login</button>
          <button type="reset" class="login_button">Cancel</button>
        </div>
      </form>
      <p class="error important_error">
        <?php if ($error_msg != "") echo $error_msg ?>
      </p>
    </section>
  </main>
</body>

<?php
function admin_login()
{
  if (isset($_POST['email'])) {
    $conn = connDb();
    global $error_msg;
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email=?");
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
      $error_msg = "Error when logging in. try again later.";
      mysqli_close($conn);
      return;
    }
    $res = $stmt->get_result();
    if ($res->num_rows == 0) {
      echo "<p>No user found with this email</p>";
    } else {
      $row = $res->fetch_array();
      $hashed_pwd = $row["password"];
      if (!password_verify($password, $hashed_pwd)) {
        echo "<p>Wrong password</p>";
      } else {
        $id = $row["id"];
        $access = $row["access"];
        session_set_cookie_params(86400 * 30);

        $_SESSION["admin_token"] = $id;
        $_SESSION["access"] = $access;
        echo "<p class='login_success'>You are logged in</p>";
        header("Location: ./admin_dashboard.php");
      }
    }
  }
}
?>

</html>