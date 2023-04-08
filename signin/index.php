<?php require '../func.php'; ?>
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
  <link rel="icon" type="image/x-icon" href="../project assets/logo/logo(light).svg">
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="#" />
  <script src="main.js" defer></script>
  <title>Sign In</title>
</head>

<body>
  <div class="bg"></div>
  <div class="spinner"></div>
  <section id="page">
    <center>
      <h2 id="login__header">Sign In</h2>
    </center>
    <form id="login" method="POST">
      <a href="../index.php" id="return__btn">
        <img height="20" src="./icons/return.svg" alt=">" />
      </a>
      <div id="login__input">
        <div id="login__input__container">
          <label for="email__input" id="email__label">Name or Email</label>
          <input id="email__input" class="" title="Email" type="text" autocomplete="off" name="name" />
        </div>
        <div id="login__input__container">
          <label for="password__input" id="password__label">Password</label>
          <input title="Password" id="password__input" class="" type="password" autocomplete="off" name="pwd" />
          <span id="input__conditions">Minimum 8 characters</span>
        </div>
      </div>
      <div id="login__submit">
        <button id="login__submit__btn" name="reg">Sign In</button>
      </div>
      <br>
      <center>
        <div>
          <a style="
                padding: 0.3rem 0.6rem;
                text-decoration: none;
                background-color: #111;
                color: white;
                border-radius: 50px;
                border: 1px solid #EEE
              " href="../signup/index.php">
            Sign Up
          </a>
        </div>
      </center>
      <center>
        <div style="color: red;">
          <br>
          <!-- Error message -->
          <?php errorMsg("") ?>
        </div>
      </center>
    </form>
  </section>
</body>

</html>