<?php require "./func.php" ?>
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
  <script src="./home/main.js" defer></script>
  <link rel="stylesheet" href="./home/style.css">
  <title>Cinema Booking</title>
</head>

<body>
  <img class="deco-img deco-img1" src="./icons/Film camera.png" alt="">
  <img class="deco-img deco-img2" src="./icons/3d glasses.png" alt="">
  <img class="deco-img deco-img3" src="./icons/Video camera.png" alt="">

  <aside id="aside" hidden aria-disabled="true">
    <div class="aside__header">
      <h2 class="aside__title">Menu</h2>
    </div>
    <div class="aside__main">
      <nav class="aside__nav" aria-label="side bar">
        <ul class="aside__ul">
          <div>
            <li><a href="#header">Home</a></li>
            <li><a href="#section2">About Me</a></li>
          </div>
          <div>
            <li><a href="#section3">Work</a></li>
            <li><a href="#footer">Contact</a></li>
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
        <img width="40" src="./icons/logo(dark).png" title="cinema booking" alt="">
      </a>
      <h1 id="page-main-title">Cinema Booking</h1>
    </div>
    <nav id="header-nav">
      <button id="search-button">
        <img id="search-btn" width="25" src="./icons/search.png" alt="Search">
      </button>
      <input id="search-box" type="search" hidden disabled>
      <button>
        <img width="25" src="./icons/top.png" alt="">
      </button>
      <a href="./signin/index.php">
        <img width="25" src="./icons/account.png" alt="Account">
      </a>
      <button id="aside-btn-container">
        <img id="aside-btn" width="25" src="./icons/menu.png" alt="Menu">
      </button>
    </nav>
  </header>

  <main>
    <section id="hero">
      <div class="hero__left">
        <h2 class="hero-p">
          choose your <span class="hero-important">movie</span> and buy your ticket
        </h2>
        <div class="hero-button">
          <a href="#">Buy Now</a>
        </div>
        <ul class="hero-recommandation-list">
          <li><a href="#">Top Selling</a></li>
          <li><a href="#">Trending</a></li>
          <li><a href="#">Popular</a></li>
        </ul>
      </div>
      <div class="hero__right">
        <div class="hero__right-line hero__right-line1">
          <div class="image-container">
            <img src="./img/movie1.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie2.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie3.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie4.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie1.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie2.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie3.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie4.jpg" alt="img">
          </div>
        </div>
        <div class="hero__right-line  hero__right-line2">
          <div class="image-container">
            <img src="./img/movie5.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie6.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie7.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie8.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie5.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie6.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie7.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie8.jpg" alt="img">
          </div>
        </div>
        <div class="hero__right-line  hero__right-line3">
          <div class="image-container">
            <img src="./img/movie9.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie10.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie11.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie12.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie9.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie10.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie11.jpg" alt="img">
          </div>
          <div class="image-container">
            <img src="./img/movie12.jpg" alt="img">
          </div>
        </div>
      </div>
      </div>
    </section>





    <section id="page1">
      <article class="page1-header">
        <a href="">
          <img src="./icons/Fast charge.png" alt="">
          <br>
          <h4>Fast</h4>
        </a>
        <a href="">
          <img src="./icons/Cyber security.png" alt="">
          <br>
          <h4>Secure</h4>
        </a>
        <a href="">
          <img src="./icons/Low price.png" alt="">
          <br>
          <h4>Cheap</h4>
        </a>
      </article>
      <article class="page2-main" id="page2-main">
        <div selected>
          <img src="./img/movie12.jpg" alt="">
        </div>
        <div>
          <img src="./img/movie9.jpg" alt="">
        </div>
        <div>
          <img src="./img/movie2.jpg" alt="">
        </div>
        <div>
          <img src="./img/movie5.jpg" alt="">
        </div>
        <div>
          <img src="./img/movie4.jpg" alt="">
        </div>
      </article>
    </section>



    <section id="page2">
      <h2>Subscribe to our news mail :</h2>
      <form method="post" onsubmit="verifyMailSubs()">
        <div class="input-container">
          <input type="mail" name="useremail" id="useremailInput">
          <button type="submit" name="mailSubsBtn" id="mailSubsBtn">Subscribe</button>
        </div>
        <div class="error">
          <?php
          if (isset($_POST["mailSubsBtn"])) {
            $res = subsMail();
            echo "<span class='res'>$res</span>";
          }
          ?>
        </div>
      </form>
    </section>


    <section id="page3">
      <h2 class="page3__header">Available movies : </h2>
      <div class='page3__cards-container'>
        <?php getAllMovies() ?>
      </div>
    </section>
  </main>

</body>

</html>