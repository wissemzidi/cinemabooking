<?php
require "../func.php";
if (isset($_COOKIE["admin_token"])) {
  $conn = connDb();
  $token = $_COOKIE["admin_token"];
  $Rq = "SELECT * FROM admins WHERE id='$token' ;";
  $res = mysqli_query($conn, $Rq);
  if (!$res) {
    header("Location: ./index.php?errorMsg=AnErroroccurred");
  } elseif (mysqli_num_rows($res) == 0) {
    header("Location: ./index.php");
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
  <script src="./admin_dashboard.js" defer></script>
  <link rel="stylesheet" href="../home/style.css">
  <link rel="stylesheet" href="./admin.css">
  <title>Admin Dashboard</title>
</head>

<body>

  <header>
    <div>
      <a href="#">
        <img width="40" src="../icons/logo(dark).png" title="cinema booking" alt="">
      </a>
      <h1 id="page-main-title">Admin Dashboard</h1>
    </div>
    <!-- <nav id="header-nav">
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
    </nav> -->
  </header>

  <main>
    <section id="hero">
      <div class="hero_card">
        <div class="hero_card_preview">
          <div class="hero_card_title">
            <h2>Add movies</h2>
          </div>
          <div class="hero_card_img-container">
            <img class="hero_card_img" width="50" src="./plus.svg" alt="">
          </div>
        </div>
        <div class="hero_card_main" hidden>
          <form method="POST" id="add_movie_form" name="add_movie_form">
            <div>
              <input type="text" class="login_input" name="name" id="name" placeholder="Name">
            </div>
            <div>
              <textarea type="text" class="login_input" name="description" id="description" placeholder="Description"></textarea>
            </div>
            <div>
              <textarea type="text" class="login_input" name="picURL" id="picURL" placeholder="Poster URL"></textarea>
            </div>
            <div>
              <textarea type="text" class="login_input" name="seats" id="seats" placeholder="Seats"></textarea>
            </div>
            <div>
              <input type="datetime-local" class="login_input" name="showDate" id="showDate" min="2023-01-01T00:00" placeholder="Show Date"></input>
            </div>
            <div>
              <input type="text" class="login_input" name="genre" id="genre" placeholder="Genre"></input>
            </div>
            <div>
              <button type="submit" name="add_movie_btn" class="login_button">Add</button>
              <button type="reset" class="login_button">Cancel</button>
            </div>
          </form>
        </div>
      </div>


      <br>
      <br>



      <div class="hero_card">
        <div class="hero_card_preview">
          <div class="hero_card_title">
            <h2>Remove movie</h2>
          </div>
          <div class="hero_card_img-container">
            <img class="hero_card_img" width="50" src="./plus.svg" alt="">
          </div>
        </div>
        <div class="hero_card_main" hidden>
          <form method="POST" id="add_movie_form" name="add_movie_form">
            <div>
              <input type="text" class="login_input" name="name" id="name" placeholder="Name">
            </div>
            <div>
              <input type="datetime-local" class="login_input" name="showDate" id="showDate" min="2023-01-01T00:00" placeholder="Show Date"></input>
            </div>
            <div>
              <button type="submit" name="remove_movie_btn" class="login_button">Remove</button>
              <button type="reset" class="login_button">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>

</body>

<?php
// add movie
if (isset($_POST["add_movie_btn"])) {
  $conn = connDb();
  $name = $_POST["name"];
  $description = $_POST["description"];
  $picURL = $_POST["picURL"];
  $seats = $_POST["seats"];
  $showDate = $_POST["showDate"];
  $genre = $_POST["genre"];

  $Rq = "INSERT INTO movies VALUES ('', '$name', '$description', '$picURL', '$seats', '$showDate', '$genre') ;";
  $res = mysqli_query($conn, $Rq);
  if (!$res) {
    echo "<script>alert('An error occurred')</script>";
  } else {
    echo "<script>alert('Successfully adding the movie :  $name')</script>";
  }
  mysqli_close($conn);
}

// remove movie
if (isset($_POST["remove_movie_btn"])) {
  $conn = connDb();
  $name = $_POST["name"];
  $showDate = $_POST["showDate"];

  $Rq = "DELETE FROM movies WHERE name='$name' AND showDate='$showDate' ;";
  $res = mysqli_query($conn, $Rq);
  if (!$res) {
    echo "<script>alert('An error occurred')</script>";
  } else {
    echo "<script>alert('Successfully removing movie :  $name')</script>";
  }
  mysqli_close($conn);
}
?>

</html>