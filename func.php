<?php

session_start();

function connDb()
{
  require "conn.php";
  $conn = new mysqli($conn_server, $conn_username, $conn_pwd, $db);
  if (!$conn) {
    die("<p class='important_error error'>Error when connecting to database. please report this error and try again later</p>");
  } else {
    return $conn;
  }
}

refresh_user();
refresh_admin();

function refresh_admin()
{
  if (!isset($_SESSION["admin_token"])) {
    return;
  }
  $conn = connDb();
  $stmt = $conn->prepare("SELECT * FROM admins WHERE id=?");
  $stmt->bind_param("i", $_SESSION["admin_token"]);
  if (!$stmt->execute()) {
    echo ("<script>alert('Server Error, please try again later.');</script>");
  } else {
    $res = $stmt->get_result();
    if ($res->num_rows == 0) {
      session_destroy();
    }
    $row = $res->fetch_array();
    $_SESSION["admin_token"] = $row["id"];
  }
}

function refresh_user()
{
  if (!isset($_SESSION["userId"])) {
    return;
  }
  $conn = connDb();
  $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
  $stmt->bind_param("i", $_SESSION["userId"]);
  if (!$stmt->execute()) {
    echo ("<script>alert('Server Error, please try again later.');</script>");
  } else {
    $res = $stmt->get_result();
    if ($res->num_rows == 0) {
      session_destroy();
      exit(header("Location: /login/ "));
    }
    $row = $res->fetch_array();
    $_SESSION["username"] = $row["username"];
    $_SESSION["email"] = $row["email"];
  }
}

function subsMail()
{
  $conn = connDb();
  $email = $_POST["email"];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<span class='important_error error'>Invalid email format.</span>";
    return;
  }
  // css to go to the input field directly without smooth scrolling
  echo "<style>body {scroll-behavior: auto;}</style>";
  // js script to go to the input field
  echo "<script>window.location.href='./index.php#page2';</script>";

  $stmt = $conn->prepare("SELECT * FROM mailsubscribers WHERE email=? ;");
  $stmt->bind_param('s', $email);

  if (!$stmt->execute()) {
    echo "<span class='important_error error'>Server Error, please try again later.</span>";
  } else {
    if ($stmt->get_result()->num_rows > 0) {
      echo "<span class='important_error error'>User already exist.</span>";
    } else {
      $stmt = $conn->prepare("INSERT INTO mailsubscribers VALUES ('', ?)");
      $stmt->bind_param('s', $email);
      if (!$stmt->execute()) {
        mysqli_close($conn);
        echo "<span class='important_error error'>Server Error, please try again later.</span>";
      } else {
        echo "<span class='important_error error'>Subscribed successfully.</span>";
      }
    }
  }
  $conn->close();
}


function getAllMovies()
{
  $conn = connDb();
  $sql = "SELECT * FROM movies";
  $stmt = $conn->prepare($sql);
  if (!$stmt->execute()) {
    echo "<p class='error important_error'>execution ERROR, please try again later.</p>";
  } else {
    $res = $stmt->get_result();

    if ($stmt->affected_rows > 0) {
      while ($row = $res->fetch_array()) {
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
  }
  mysqli_close($conn);
}


function getMovieName()
{
  if (isset($_GET['movieId'])) {
    $conn = connDb();
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id =?;");
    $stmt->bind_param('s', $_GET["movieId"]);
    if (!$stmt->execute()) {
      echo "About Movie";
    } else {
      echo $stmt->get_result()->fetch_array()["name"];
    }
    mysqli_close($conn);
  } else {
    echo "About Movie";
  }
}


function getMovieInfo()
{
  if (isset($_GET['movieId'])) {
    $conn = connDb();
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id=? ;");
    $stmt->bind_param("s", $_GET["movieId"]);
    if (!$stmt->execute()) {
      echo "<span class='important-error' style='min-height: 40vh'>The server isn't responding please try again later.</span>";
      mysqli_close($conn);
      return;
    }
    $row = $stmt->get_result()->fetch_array();
    $movieId = $row["id"];
    $movieName = $row["name"];
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
      <form class='hero__buy' onsubmit=\"return confirm('Are you sure ?')\" name='purchase_seat' method='POST'>
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
  } else {
    echo "<p class='important-error' style='min-height: 40vh'>No movie was selected, please select one.</p>";
  }
}


function book_seat()
{

  if (isset($_POST["seat"]) && !isset($_SESSION["userId"])) {
    header("Location: ../signin/index.php");
  } elseif (isset($_POST["seat"])) {
    $conn = connDb();
    $userId = $_SESSION["userId"];
    $movieId = $_POST["movieId"];
    $reserved_seat = $_POST["seat"];
    $date = Date("Y-m-d H:m:s");

    // check if the seat is purchases before
    $stmt = $conn->prepare("SELECT * FROM purchases WHERE movieId=? AND seat=? ;");
    $stmt->bind_param("ss", $movieId, $reserved_seat);
    if (!$stmt->execute()) {
      echo "<p class='important-error' style='min-height: 40vh'>Your purchase wasn't completed successfully. please try later</p>";
      mysqli_close($conn);
      return;
    }
    if ($stmt->get_result()->num_rows > 0) {
      echo ("<p class='important-error' style='min-height: 40vh'>this seat is already reserved</p>");
      mysqli_close($conn);
      return;
    }

    // insert the purchase
    $stmt = $conn->prepare("INSERT INTO purchases VALUES(?, ?, ?, ?) ;");
    $stmt->bind_param("ssss", $userId, $movieId, $date, $reserved_seat);
    if (!$stmt->execute()) {
      echo "<p class='important-error' style='min-height: 40vh'>Your purchase wasn't completed successfully. please try later</p>";
      mysqli_close($conn);
      return;
    }

    // remove the purchased seat from the movie seats.
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id=? ; ");
    $stmt->bind_param("s", $movieId);
    if (!$stmt->execute()) {
      echo "<p class='error' style='min-height: 40vh'>Error when querying the seat, please check if the seat is purchased successfully</p>";
      mysqli_close($conn);
      return;
    }
    $seats = explode("|", $stmt->get_result()->fetch_array()["seats"]);
    unset($seats[array_search($reserved_seat, $seats)]);
    $seats = implode("|", $seats);

    // push the new seats update to the movie.
    $stmt = $conn->prepare("UPDATE movies SET seats=? WHERE id=? ;");
    $stmt->bind_param("ss", $seats, $movieId);
    if (!$stmt->execute()) {
      echo "<p class='error' style='min-height: 40vh'>Error when updating the seats, please check if the seat is purchased successfully</p>";
      mysqli_close($conn);
      return;
    } else {
      echo "<p class='success_purchase' style='min-height: 30vh'>Successfully purchase seat " . $reserved_seat . "</p>";
    }
    mysqli_close($conn);
  }
}



function get_suggested_movies()
{
  $conn = conndb();
  $pageMovieId = $_GET["movieId"];
  $stmt = $conn->prepare("SELECT genres FROM movies WHERE id=? ;");
  $stmt->bind_param("s", $pageMovieId);
  if (!$stmt->execute()) {
    // if query failed get the top 10 movies
    getTop10();
    mysqli_close($conn);
    return;
  }
  $res = $stmt->get_result();
  $sug_genres = explode("|", $res->fetch_array()["genres"]);
  $movies_id = [];

  foreach ($sug_genres as $sug_genre) {
    $sug_genre = $conn->real_escape_string($sug_genre);
    $res = $conn->query("SELECT * FROM movies WHERE genres LIKE '%$sug_genre%' ;");
    while ($row = $res->fetch_array()) {
      $movieId = $row["id"];
      if ($pageMovieId == $movieId || in_array($movieId, $movies_id)) continue;
      array_push($movies_id, $movieId);
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

  // if there are no suggested movie :
  if ($movies_id == []) {
    getTop10();
  }
  mysqli_close($conn);
}


function getTop10()
{
  $conn = connDb();
  $res = $conn->query("SELECT * FROM movies");

  while ($row = $res->fetch_array()) {
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
    if (empty($email)) {
      error_msg("=> please fill all the fields");
      $conn->close();
      return;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      error_msg("=> email is invalid.");
      $conn->close();
      return;
    }
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? ;");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    if ($stmt->get_result()->num_rows == 0) {
      $id = "";
      $username = $_POST["username"];
      $pwd = $_POST["pwd"];
      $verified = true;
      global $error_msg;
      if (empty($username) || empty($pwd)) {
        $error_msg = "=> please fill all the fields.<br>";
        $verified = false;
      }
      if (strlen($username) < 6) {
        $error_msg = $error_msg . "=> username must be at least 6 characters.<br>";
        $verified = false;
      }
      if (strlen($pwd) < 6 || !preg_match('/[@,#,$,%]/', $pwd)) {
        $error_msg = $error_msg . "=> password must be at least 6 characters and include one special character.";
        $verified = false;
      }

      if ($verified) {
        $stmt = $conn->prepare("INSERT INTO users VALUES('$id', ?, ?, ?) ;");
        $stmt->bind_param("sss", $username, $email, password_hash($pwd, PASSWORD_DEFAULT));
        if (!$stmt->execute()) {
          error_msg("something went wrong, please try again later");
        } else {
          header("Location: ../signin/");
        }
      }
    } else {
      error_msg("this account already exist");
    }
    $conn->close();
  }
}


function signin()
{

  if (isset($_SESSION["userId"])) {
    header("Location: ../dashboard/dashboard.php");
  } elseif (isset($_POST["reg"])) {
    $conn = connDb();
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? ;");
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
      error_msg("Error while executing the query");
      $conn->close();
      return;
    }
    $res = $stmt->get_result();
    if ($res->num_rows == 0) {
      error_msg("No account with this email.");
    } else {
      $row = $res->fetch_array();
      if (!password_verify($password, $res->fetch_array()["pwd"])) {
        echo "Wrong password";
      }
      $id = $row["id"];
      $username = $row["username"];

      session_set_cookie_params(86400 * 30);

      $_SESSION["userId"] = $id;
      $_SESSION["username"] = $username;
      $_SESSION["email"] = $email;

      header("Location: ../");
    }
    $conn->close();
  }
}

function purchased_movies_nb()
{
  if (!isset($_SESSION["userId"])) {
    header("Location: ../signin/");
    die();
  }
  $conn = connDb();
  $stmt = $conn->prepare("SELECT movieId FROM purchases WHERE userId=? ;");
  $stmt->bind_param("s", $_SESSION["userId"]);
  if (!$stmt->execute()) {
    echo "movies";
  } else {
    echo $stmt->get_result()->num_rows;
  }
  $conn->close();
}


// logout
function logout()
{
  if (isset($_POST['log_out_btn'])) {
    global $logout_msg;
    if (!session_destroy()) {
      $logout_msg = "Error when logging out !";
    } else {
      // header("Location : ../index.php");
      $logout_msg = "Successfully logged out";
      echo "<script>window.location.href='../index.php';</script>";
    }
  }
}


function error_msg($msg)
{
  global $error_msg;
  $error_msg = $msg;
}
