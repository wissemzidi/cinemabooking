<?php

function connDb()
{
  require "conn.php";
  $conn = mysqli_connect($conn_server, $conn_username, $conn_pwd);
  mysqli_select_db($conn, $db);
  return $conn;
}


function subsMail()
{
  $conn = connDb();
  $email = $_POST["email"];

  $Rq = "SELECT * FROM mailsubscribers WHERE email='$email' ;";
  $res = mysqli_query($conn, $Rq);

  if (mysqli_num_rows($res) > 0) {
    return "user already exist";
  } else {
    $Rq = "INSERT INTO mailsubscribers value('', '$email')";
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
      echo "<h4 class='page3__movieName'>$movieName</h4>";
      echo "<div><img class='page3__moviePic' width='100%' src='$row[pic]'></div>";
      if (strlen($row["seats"]) > 1) {
        echo "<div class='available page3__movieStatus'></div>";
      } else {
        echo "<div class='notAvailable page3__movieStatus'></div>";
      }

      // if (str_contains($_SERVER['REQUEST_URI'], "/movie.php")) {
      //   $dot = "..";
      // } else {
      //   $dot = ".";
      // }
      echo ("
      <div class='page3__movieBtn-container'>
        <a href='./movie/movie.php?movieId=$movieId' class='page3__movieBtn'>
          <img src='./icons/play.svg' width='50%' alt='Watch Now'>
        </a>
      </div>
      ");
      $genres = explode("|", $row["genres"]);
      echo ("
      <div class='page3__genres-container'>
      ");
      array_map(function ($genre) {
        echo "<span class='genre'>$genre</span>";
      }, $genres);
      echo ("
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
      echo "<span class='important-error' style='min-height: 40vh'>The server isn't responding please try again later.</span>";
    } else {
      $row = mysqli_fetch_array($res);
      $movieId = $row["id"];
      $movieName = $row["name"];
      $userId = "6"; // idk how to use cookies in php so...
      $seats = explode("|", $row["seats"]);

      echo ("
      <div class='hero__left'>
        <img class='hero__moviePic' width='100%' src='$row[pic]'>
      </div>
      ");
      echo ("
      <div class='hero__right'>
        <h2 class='hero__movieName'>$movieName</h2>
        <p class='hero__description'> $row[description] </p>
      ");
      if (count($seats) == 0 || $seats[0] == "") {
        echo "<p class='important-error'>sorry no seat available right now</p>";
      } else {
        echo ("
        <form class='hero__buy' name='purchase_seat' method='POST'>
          <input type='text' name='userId' value='$userId' hidden>
          <input type='text' name='movieId' value='$movieId' hidden>
        ");
        $last_seat_letter = $seats[0][0];
        echo "<div class='hero__buy_row'>";
        foreach ($seats as $seat) {
          $last_seat_letter[0] != $seat[0] ? $new_row = true : $new_row = false;
          if ($new_row) {
            $last_seat_letter = $seat[0];
            echo ("
            </div>
            <div class='hero__buy_row'>
            ");
          }
          echo ("
            <button type='submit' name='seat' value='$seat' class='buy_seat_btn'>$seat</button>
          ");
        }
        echo ("</form>");
      }
      echo ("
      </div>
      ");
      echo ("
      </div>
      ");
    }
  } else {
    echo "<p class='important-error' style='min-height: 40vh'>No movie was selected, please select one.</p>";
  }
}


function book_seat()
{
  if (isset($_POST["seat"])) {
    $conn = connDb();
    $userId = $_POST["userId"];
    $movieId = $_POST["movieId"];
    $reserved_seat = $_POST["seat"];
    $date = Date("Y-m-d H:m:s");

    $Rq = "SELECT * FROM purchases WHERE movieId = '$movieId' AND seat = '$reserved_seat' ;";
    $res = mysqli_query($conn, $Rq);

    if (!$res) {
      echo "<p class='important-error' style='min-height: 40vh'>Your purchase isn't successfully. please try later</p>";
    } elseif (mysqli_num_rows($res) > 0) {
      echo ("<p class='important-error' style='min-height: 40vh'>this seat is already reserved</p>");
    } else {
      $Rq = "INSERT INTO purchases VALUES('$userId', '$movieId', '$date', '$reserved_seat') ;";
      $res = mysqli_query($conn, $Rq);

      if (!$res) {
        echo "<p class='important-error' style='min-height: 40vh'>Your purchase isn't successfully. please try later</p>";
      } else {
        $Rq = "SELECT * FROM movies WHERE id = '$movieId' ; ";
        $res = mysqli_query($conn, $Rq);

        $row = mysqli_fetch_array($res);
        $seats = explode("|", $row["seats"]);
        unset($seats[array_search($reserved_seat, $seats)]);
        $seats = implode("|", $seats);

        $Rq = "UPDATE movies SET seats='$seats' WHERE id = '$movieId' ;";
        $res = mysqli_query($conn, $Rq);

        if (!$res) {
          echo "<p class='important-error' style='min-height: 40vh'>Your purchase isn't successfully. please try later</p>";
        } else {
          echo "<p class='success_purchase' style='min-height: 40vh'>Successfully purchase seat " . $reserved_seat . "</p>";
        }
      }
    }
    mysqli_close($conn);
  }
}



function get_suggested_movies()
{
  $conn = conndb();
  $pageMovieId = $_GET["movieId"];
  $Rq = "SELECT genres FROM movies WHERE id = '$pageMovieId'; ";
  $res = mysqli_query($conn, $Rq);

  if (!$res) {
    die("Couldn't get movies");
  } elseif (mysqli_num_rows($res) == 0) {
    getTop10($conn);
  }

  $row = mysqli_fetch_array($res);
  $sug_genres = explode("|", $row["genres"]);
  $id_userd = [];

  foreach ($sug_genres as $sug_genre) {
    $Rq = "SELECT * FROM movies WHERE genres LIKE '%$sug_genre%' ;";
    $res = mysqli_query($conn, $Rq);

    while ($row = mysqli_fetch_array($res)) {
      $movieId = $row["id"];
      if ($pageMovieId == $movieId || in_array($movieId, $id_userd)) {
        continue;
      }
      array_push($id_userd, $movieId);
      $movieName = $row["name"];
      echo "<div class='page3__card'>";
      echo "<h4 class='page3__movieName'>$movieName</h4>";
      echo "<div><img class='page3__moviePic' width='100%' src='$row[pic]'></div>";
      if (strlen($row["seats"]) > 1) {
        echo "<div class='available page3__movieStatus'></div>";
      } else {
        echo "<div class='notAvailable page3__movieStatus'></div>";
      }
      echo ("
      <div class='page3__movieBtn-container'>
        <a href='../movie/movie.php?movieId=$movieId' class='page3__movieBtn'>
          <img src='../icons/play.svg' width='50%' alt='Watch Now'>
        </a>
      </div>
      ");
      $genres = explode("|", $row["genres"]);
      echo ("
      <div class='page3__genres-container'>
      ");
      array_map(function ($genre) {
        echo "<span class='genre'>$genre</span>";
      }, $genres);
      echo ("
      </div>
      ");
      echo "</div>";
    }
  }
  mysqli_close($conn);
}


function getTop10($conn)
{
  $Rq = "SELECT * FROM movies";
  $res = mysqli_query($conn, $Rq);

  while ($row = mysqli_fetch_array($res)) {
    $movieId = $row["id"];
    $movieName = $row["name"];
    echo "<div class='page3__card'>";
    echo "<h4 class='page3__movieName'>$movieName</h4>";
    echo "<div><img class='page3__moviePic' width='100%' src='$row[pic]'></div>";
    if (strlen($row["seats"]) > 1) {
      echo "<div class='available page3__movieStatus'></div>";
    } else {
      echo "<div class='notAvailable page3__movieStatus'></div>";
    }
    echo ("
    <div class='page3__movieBtn-container'>
      <a href='../movie/movie.php?movieId=$movieId' class='page3__movieBtn'>
        <img src='../icons/play.svg' width='50%' alt='Watch Now'>
      </a>
    </div>
    ");
    $genres = explode("|", $row["genres"]);
    echo ("
    <div class='page3__genres-container'>
    ");
    array_map(function ($genre) {
      echo "<span class='genre'>$genre</span>";
    }, $genres);
    echo ("
    </div>
    ");
    echo "</div>";
  }
}



function signup()
{
  if (isset($_POST["reg"])) {
    $conn = connDb();
    $email = $_POST["email"];
    $Rq = "SELECT * FROM users WHERE email='$email' ;";
    $res = mysqli_query($conn, $Rq);

    if (mysqli_num_rows($res) == 0) {
      $username = $_POST["username"];
      $password = $_POST["pwd"];
      $Rq = "INSERT INTO users VALUES('', '$username', '$email', '$password') ;";
      $res = mysqli_query($conn, $Rq);

      if (!$res) {
        error_msg("something went wrong, please try again later");
      } else {
        echo "signed in successfully as $username";
        header("Location: ../signin/");
      }
    } else {
      error_msg("this account already exist");
    }
  }
}


function signin()
{
  if (isset($_POST["reg"])) {
    $conn = connDb();
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $Rq = "SELECT * FROM users WHERE email='$email' AND password='$password' ;";
    $res = mysqli_query($conn, $Rq);

    if (mysqli_num_rows($res) == 0) {
      global $error_msg;
      $error_msg = "Those credential are wrong.";
    } else {
      global $error_msg;
      $error_msg = "All good :).";
      header("Location: ../ ");
    }
  }
}


function error_msg($msg)
{
  global $error_msg;
  $error_msg = $msg;
}
