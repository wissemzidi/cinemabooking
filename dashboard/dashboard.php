<?php
$error_msg = "";
require "../func.php";
session_start();
if (!isset($_SESSION["userId"])) header("Location: ../index.php");
isset($_GET["p"]) ? $selected_page = $_GET["p"] : $selected_page = "settings";
$logout_msg = "";
logout();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./framework.css" />
  <link rel="icon" type="image/x-icon" href="../icons/logo.svg">
  <link rel="stylesheet" href="./dashboard.css" />
  <script src="./dashboard.js" defer></script>
  <title><?php echo $selected_page ?></title>
</head>

<body>


  <header>
    <h1 id="page-title" class="fw-light fs-30 pb-30 pt-20">
      <?php echo $selected_page ?>
    </h1>
  </header>



  <main>
    <nav id="aside" class="w-fit p-10 fw-light" method="GET">
      <ul id="aside-list" class="no-list d-grid gap-10">
        <li class="nav-btn" class="nav-btn" id="settings-page-btn">
          <a href="./dashboard.php?p=settings">
            <img width="20" class="op-min" src="./icons/settings 2.0.svg" alt="" />
            <span class="hide-600">Settings</span>
          </a>
        </li>
        <li class="nav-btn" id="dashboard-page-btn">
          <a href='./dashboard.php?p=purchases'>
            <img width="20" src="./icons/shopping.svg" alt="" />
            <span class="hide-600">Purchases</span>
          </a>
        </li>
        <li class="nav-btn" id="account-page-btn">
          <a href="./dashboard.php?p=account">
            <img width="20" src="./icons/account.svg" alt="" />
            <span class="hide-600">Account</span>
          </a>
        </li>
        <li id="home-page-btn">
          <a href="../index.php">
            <img width="20" src="./icons/home 2.0.svg" alt="" />
            <span class="hide-600">Home</span>
          </a>
        </li>
        <li id="show-full-aside" data-active="false" class="show-600">
          <a href="#">
            <img width="20" class="op-min" src="./icons/right arrow.svg" alt="" />
            <span class="hide-600">Hide</span>
          </a>
        </li>
      </ul>
    </nav>

    <?php
    if ($selected_page == "settings") {
      echo ("
    <section class='page pr-20 pl-20' id='settings-page' style='width: 100%'>
      <form method='POST' id='privacy-box' class='border-l rad-20 p-20 pt-10'>
        <h2 class='txt-c fw-light pb-10'>Privacy</h2>
        <div class='pb-10 pt-10'>
          number of devices with this account :
          <span class='c-white bg-gray fw-light rad-50 pr-10 pl-10'>5</span>
        </div>
        <div class='pt-10 border-t d-flex align-c justify-sb gap-20'>
          <span style='letter-spacing: -0.5px'> Show Email </span>
          <input class='toggle-input' type='checkbox' name='show-mail' hidden checked />
          <div class='toggle-switch'>
            <div class='toggle-switch_inner'></div>
          </div>
        </div>
        <div class='submit-btn-container' class='pt-30 d-flex'>
          <button class='submit-btn' type='submit'>
            Save
          </button>
        </div>
      </form>
      <form method='POST' id='privacy-box' class='border-l rad-20 p-20 pt-10'>
        <h2 class='txt-c fw-light pb-10'>Appearance</h2>
        <div class='pb-10 pt-10 d-flex align-c justify-sb gap-20'>
          <span style='letter-spacing: -0.5px'> Website animations </span>
          <input id='theme' class='toggle-input' type='checkbox' name='dark-theme' hidden />
          <div class='toggle-switch'>
            <div class='toggle-switch_inner'></div>
          </div>
        </div>
        <div class='pt-10 pb-10 border-t d-flex align-c justify-sb gap-20'>
          <span style='letter-spacing: -0.5px'> Hide main page on enter </span>
          <input class='toggle-input' type='checkbox' name='hide-main' hidden checked />
          <div class='toggle-switch'>
            <div class='toggle-switch_inner'></div>
          </div>
        </div>
        <div class='pt-10 border-t d-flex align-c justify-sb gap-20'>
          <label for='font-size' class='fs-14'>change font size : </label>
          <select name='font-size' id='font-size' class='select-input'>
            <option selected value='mid'>Medium (Recommended)</option>
            <option value='min'>Minimum</option>
            <option value='max'>Maximum</option>
          </select>
        </div>
        <div class='submit-btn-container' class='pt-30 d-flex'>
          <button class='submit-btn' type='submit'>
            Save
          </button>
        </div>
      </form>
      <form method='POST' id='privacy-box' class='border-l rad-20 p-20 pt-10'>
        <h2 class='txt-c fw-light pb-10'>Payment</h2>
        <div class='pb-10 pt-10'>
          you are paying using :
          <span class='c-white bg-gray rad-50 pr-10 pl-10'>PayPal</span>
        </div>
        <div class='pb-10 pt-10 border-t d-flex align-c justify-sb gap-20'>
          <span style='letter-spacing: -0.5px'>show payment method</span>
          <input class='toggle-input' type='checkbox' name='dark-theme' hidden />
          <div class='toggle-switch'>
            <div class='toggle-switch_inner'></div>
          </div>
        </div>
        <div class='pb-10 pt-10 border-t d-flex align-c justify-sb gap-20'>
          <label for='font-size' class='fs-14'>Warn me before paying</label>
          <select name='font-size' id='font-size' class='select-input'>
            <option selected value='payPal'>PayPal</option>
            <option value='masterCard'>Master Card</option>
            <option value='visa'>Visa</option>
            <option value='aliPay'>Ali pay</option>
          </select>
        </div>
        <div class='submit-btn-container' class='pt-30 d-flex'>
          <button class='submit-btn' type='submit'>
            Save
          </button>
        </div>
        <center class='pt-10 border-t'>
          <span class='op-min'>
            All your banking and payment info are not secure :)
          </span>
        </center>
      </form>
    </section>
      ");
    } else if ($selected_page == "purchases") {
      delete_movie();
      echo ("
    <section class='page' id='purchases-page' style='width: 100%'>
      <article id='content' class='border-l rad-20 p-20 pt-10'>
      ");
      echo ("
        <div class='movies-boxes__header'>
          <span style='font-size: 0.9rem'>
        ");
      purchased_movies_nb();
      echo ("
          purchases
          </span>
        </div>
        <div id='movies_cards_container'>
      ");
      get_purchased_movies();
      echo ("
        </div>
      </article>
    </section>
      ");
    } else {
      echo ("
    <section class='page' id='account-page'>
      <form name='username_form' class='account-page__form' method='POST'>
        <label for='name_input'><h3>Change Username : </h3></label>
        <input class='text-input' type='text' name='name' id='name_input' placeholder='New Username' />
        <input class='text-input' type='text' name='confirm_name' id='confirm_name_input' placeholder='Confirm Username' />
        ");
      change_username();
      echo ("
        <button class='submit-btn' name='username_submit' type='submit'>Change</button>
      </form>
      <form name='email_form' class='account-page__form' method='POST'>
        <label for='email_input'><h3>Change Email : </h3></label>
        <input class='text-input' type='text' name='email' id='email_input' placeholder='New Email' />
        <input class='text-input' type='text' name='confirm_email' id='confirm_email_input' placeholder='Confirm Email' />
        ");
      change_email();
      echo ("
        <button class='submit-btn' name='email_submit' type='submit'>Change</button>
      </form>
      <form name='password_form' class='account-page__form' method='POST'>
        <label for='password_input'><h3>Change Password : </h3></label>
        <input class='text-input' type='text' name='password' id='password_input' placeholder='New Password' />
        <input class='text-input' type='text' name='confirm_password' id='confirm_pwd_input' placeholder='Confirm Password' />
        ");
      change_pwd();
      echo ("
        <button class='submit-btn' name='password_submit' type='submit'>Change</button>
      </form>
      <form name='log_out' class='account-page__form log_out_form' method='POST'>
        <button class='submit-btn' name='log_out_btn' type='submit'>
          <img width='30' src='./icons/logout.svg' alt=''>
          <h3>Logout</h3>
        </button>
        <p class='important_error'>
      ");
      echo $logout_msg;
      echo ("
        </p>
      </form>
    </section>
      ");
    };
    ?>

  </main>
</body>

<?php
// delete movie

function delete_movie()
{
  if (isset($_POST['delete_btn'])) {
    $conn = connDb();
    $user_id = $_SESSION["userId"];
    $movie_id = $_POST["deleted_movieId"];
    $deleted_seat = $_POST["deleted_seat"];

    $Rq = "SELECT seats FROM movies WHERE id='$movie_id' ;";
    $res = mysqli_query($conn, $Rq);

    if (!$res) {
      error_msg("Error in getting the seats in movies db, please try again later.");
    } else {
      $row = mysqli_fetch_array($res);
      $seats = explode("|", $row["seats"]);
      for ($i = 0; $i < count($seats); $i++) {
        if ($i == count($seats) - 1) {
          array_push($seats, $deleted_seat);
          break;
        } elseif ($deleted_seat < $seats[$i]) {
          array_splice($seats, $i, 0, $deleted_seat);
          break;
        }
      }
      $seats = implode("|", $seats);
      $Rq = "UPDATE movies SET seats='$seats' WHERE id='$movie_id' ;";
      $res = mysqli_query($conn, $Rq);

      if (!$res) {
        error_msg("Error in updating the seats in movies db, please try again later.");
      } else {
        $Rq = "DELETE FROM purchases WHERE movieId='$movie_id' AND userId='$user_id' AND seat='$deleted_seat' ;";
        $res = mysqli_query($conn, $Rq);

        if (!$res) {
          error_msg("Error in deleting the movie from purchases db, please try again later.");
        } else {
          error_msg("purchase deleted successfully");
        }
      }
    }
    mysqli_close($conn);
  }
}


// change username/email/password
function change_username()
{
  if (isset($_POST["username_submit"])) {
    $user_id = $_SESSION["userId"];
    $new_name = $_POST["name"];
    $confirm_name = $_POST["confirm_name"];

    if ($new_name != $confirm_name) {
      echo "<span class='error'>the confirmation is wrong.</span>";
    } else {
      $conn = connDb();
      $stmt = mysqli_prepare($conn, "UPDATE users SET username=? WHERE id=?");
      $stmt->bind_param("ss", $new_name, $user_id);
      if ($stmt->execute()) {
        echo "<span class='success'>Username successfully changed.</span>";
      } else {
        echo "<span class='error'>Error, try again.</span>";
      }
      mysqli_close($conn);
    }
  }
}
function change_email()
{
  if (isset($_POST["email_submit"])) {
    $user_id = $_SESSION["userId"];
    $new_email = $_POST["email"];
    $confirm_email = $_POST["confirm_email"];

    if ($new_email != $confirm_email) {
      echo "<span class='error'>the confirmation is wrong.</span>";
    } else {
      $conn = connDb();
      $stmt = mysqli_prepare($conn, "UPDATE users SET email=? WHERE id=?");
      $stmt->bind_param("ss", $new_email, $user_id);
      if ($stmt->execute()) {
        echo "<span class='success'>Email successfully changed.</span>";
      } else {
        echo "<span class='error'>Error, try again.</span>";
      }
      mysqli_close($conn);
    }
  }
}
function change_pwd()
{
  if (isset($_POST["password_submit"])) {
    $user_id = $_SESSION["userId"];
    $new_pwd = $_POST["password"];
    $confirm_pwd = $_POST["confirm_password"];

    if ($new_pwd != $confirm_pwd) {
      echo "<span class='error'>the confirmation is wrong.</span>";
    } else {
      $conn = connDb();
      $stmt = mysqli_prepare($conn, "UPDATE users SET password=? WHERE id=?");
      $stmt->bind_param("ss", $new_pwd, $user_id);
      if ($stmt->execute()) {
        echo "<span class='success'>Password successfully changed.</span>";
      } else {
        echo "<span class='error'>Error, try again.</span>";
      }
      mysqli_close($conn);
    }
  }
}


function get_purchased_movies()
{
  $conn = connDb();
  $Rq = "SELECT * FROM purchases WHERE userId='$_SESSION[userId]' ;";
  $res = mysqli_query($conn, $Rq);

  if (!$res) {
    echo "Un Error happened";
  } else {
    while ($row = mysqli_fetch_array($res)) {
      $date = $row['datePurchase'];
      $seat = $row['seat'];
      $movieId = $row['movieId'];
      $Rq = "SELECT * FROM movies WHERE id='$movieId' ;";
      $res_movie = mysqli_query($conn, $Rq);
      $row_movie = mysqli_fetch_array($res_movie);
      $movie_name = $row_movie['name'];
      $movie_pic = $row_movie['pic'];

      echo ("
    <div class='movie_card'>
      <form name='delete_movie_form' method='POST'>
        <div class='movie_card_header'>
          <h4 class='movie_name'>$movie_name</h4>
          <button type='submit' name='delete_btn' class='delete_btn'>
            <img width='25' src='./icons/delete.svg' alt='Delete'>
          </button>
        </div>
        <div class='movie_card_img_container'>
          <img class='movie_pic' width='100%' src='$movie_pic'>
        </div>
        <div class='movie_card_footer'>
          <div>$seat</div>
          <div>$date</div>
        </div>
        <input type='text' style='opacity: 0; width: 0; height: 0;' name='deleted_seat' value='$seat' hidden>
        <input type='text' style='opacity: 0; width: 0; height: 0;' name='deleted_movieId' value='$movieId' hidden>
      </form>
    </div>
    ");
    }
  }
  mysqli_close($conn);
}

?>

</html>