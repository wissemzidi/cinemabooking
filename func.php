<?php

function connDb()
{
  $server = "localhost";
  $username = "root";
  $pwd = "";
  $dbname = "cinemabooking";
  $conn = mysqli_connect($server, $username, $pwd);
  mysqli_select_db($conn, $dbname);
  return $conn;
}

function subsMail()
{
  $conn = connDb();
  $useremail = $_POST["useremail"];

  $Rq = "SELECT * FROM mailsubscribers WHERE email='$useremail' ;";
  $res = mysqli_query($conn, $Rq);

  if (mysqli_num_rows($res) > 0) {
    return "user already exist";
  } else {
    $Rq = "INSERT INTO mailsubscribers value('', '$useremail')";
    $res = mysqli_query($conn, $Rq);

    if (!$res) {
      return "server error, try again later";
    } else {
      return "subscription successfully";
    }
  }
  mysqli_close($conn);
}


function getAllMovies()
{
  $conn = conndb();
  $Rq = "SELECT * FROM movies";
  $res = mysqli_query($conn, $Rq);

  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_array($res)) {
      $movieId = $row["id"];
      $movieName = $row["name"];
      echo "<div class='page3__card'>";
      echo "<div class='page3__movieName'>$movieName</div>";
      echo "<div><img class='page3__moviePic' width='100%' src='$row[pic]'></div>";
      if (strlen($row["sits"]) > 1) {
        echo "<div class='available page3__movieStatus'></div>";
      } else {
        echo "<div class='notAvailable page3__movieStatus'></div>";
      }
      echo ("
      <div class='page3__movieBtn-container'>
        <a href='./movie.php/?movieId=$movieId' class='page3__movieBtn'>
          <img src='./icons/play.svg' width='50%' alt='Watch Now'>
        </a>
      </div>
      ");
      echo "</div>";
    }
  } else {
    echo "<span class='error'>Sorry, no movies available right now</span>";
  }
  mysqli_close($conn);
}


function getMovieName()
{
  if (isset($_GET['movieId'])) {
    $movieId = $_GET["movieId"];
    $conn = connDb();
    $Rq = "SELECT * FROM movies WHERE id = '$movieId';";
    $Rs = mysqli_query($conn, $Rq);

    if (!$Rs) {
      echo "About Movie";
    } else {
      $row = mysqli_fetch_array($Rs);
      echo "$row[name]";
    }
  } else {
    echo "About Movie";
  }
}

function getMovieInfo()
{
  if (isset($_GET['movieId'])) {
    $conn = connDb();
    $movieId = $_GET["movieId"];
    $Rq = "SELECT * FROM movies WHERE id = '$movieId' ;";
    $res = mysqli_query($conn, $Rq);

    if (!$res) {
      echo "something went wrong";
    } else {
      $row = mysqli_fetch_array($res);
      echo "<p> $row[description] </p>";
      $movieId = $row["id"];
      $movieName = $row["name"];
      echo "<div class='page3__card'>";
      echo "<div class='page3__movieName'>$movieName</div>";
      echo "<div><img class='page3__moviePic' width='100%' src='$row[pic]'></div>";
      if (strlen($row["sits"]) > 1) {
        echo "<div class='available page3__movieStatus'></div>";
      } else {
        echo "<div class='notAvailable page3__movieStatus'></div>";
      }
      echo ("
      <div class='page3__movieBtn-container'>
        <a href='./movie.php/?movieId=$movieId' class='page3__movieBtn'>
          <img src='./icons/play.svg' width='50%' alt='Watch Now'>
        </a>
      </div>
      ");
      echo "</div>";
    }
  } else {
    echo "<span class='important-error' style='min-height: 40vh'>No movie was selected, please select one.</span>";
  }
}
