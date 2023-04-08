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
  <title> <?php getMovieName() ?> </title>
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
        <img width="25" src="./icons/top.png" alt="top">
      </button>
      <button>
        <img width="25" src="./icons/account.png" alt="Account">
      </button>
      <button id="aside-btn-container">
        <img id="aside-btn" width="25" src="./icons/menu.png" alt="Menu">
      </button>
    </nav>
  </header>

  <main>
    <section id="hero">
      <?php getMovieInfo() ?>
    </section>


    <section id="page3">
      <h2 class="page3__header">other movies you might like : </h2>
      <div class='page3__cards-container'>
        <?php getAllMovies() ?>
      </div>
    </section>
  </main>

</body>

</html>