<?php
require '../func.php';
$error_msg = Null
?>
<!DOCTYPE html>
<html lang="en">

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
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="#" />
  <link rel="icon" type="image/x-icon" href="../project assets/logo/logo(light).svg">
  <script src="main.js" defer></script>
  <title>Sign Up</title>
</head>

<body>
  <section id="page">
    <center>
      <h2 id="login__header">Sign Up</h2>
    </center>
    <?php signup() ?>
    <form name="singup_form" id="login" method="post">
      <a href="../index.php" id="return__btn">
        <img height="20" src="./icons/return.svg" alt=">" />
      </a>
      <div id="login__input">
        <div id="login__input__container">
          <label for="name__input" id="name__label">Name</label>
          <input name="username" id="name__input" class="" title="Name" type="text" autocomplete="off" required />
        </div>
        <div id="login__input__container">
          <label for="email__input" id="email__label">Email</label>
          <input name="email" id="email__input" class="" title="Email" type="email" autocomplete="off" />
        </div>
        <div id="login__input__container">
          <label for="password__input" id="password__label">Password</label>
          <input name="pwd" title="Password" id="password__input" class="" type="password" autocomplete="off" />
          <span id="input__conditions">Minimum 8 characters</span>
        </div>
      </div>
      <div id="login__submit">
        <button id="login__submit__btn" name="reg">Sign Up</button>
      </div>
      <br />
      <center>
        <div>
          <a style="
                padding: 0.3rem 0.6rem;
                text-decoration: none;
                background-color: #111;
                color: #999;
                border-radius: 50px;
                border: 1px solid #777
              " href="../signin/index.php">
            Sign In
          </a>
        </div>
      </center>
      <br>
      <center style="color: red;">
        <?php echo $error_msg ?>
      </center>
    </form>
  </section>
</body>

</html>