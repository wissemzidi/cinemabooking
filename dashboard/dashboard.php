<?php
$error_msg = "";
require "../func.php";
session_start();
isset($_GET["p"]) ? $selected_page = $_GET["p"] : $selected_page = "settings";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./framework.css" />
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
    <section class='page' id='settings-page' style='width: 100%'>
      <form id='content' class='pr-20 pl-20' method='POST'>
        <article id='privacy-box' class='border-l rad-20 p-20 pt-10'>
          <h2 class='txt-c fw-light pb-10'>Privacy</h2>
          <div class='pb-10 pt-10'>
            number of devices with this account :
            <span class='c-white bg-gray fw-light rad-50 pr-10 pl-10'>5</span>
          </div>
          <div class='pb-10 pt-10 border-t d-flex align-c justify-sb gap-20'>
            <span style='letter-spacing: -0.5px'> Show phone number </span>
            <input class='toggle-input' type='checkbox' name='show-tel' hidden />
            <div class='toggle-switch'>
              <div class='toggle-switch_inner'></div>
            </div>
          </div>
          <div class='pt-10 border-t d-flex align-c justify-sb gap-20'>
            <span style='letter-spacing: -0.5px'> Show Email </span>
            <input class='toggle-input' type='checkbox' name='show-mail' hidden checked />
            <div class='toggle-switch'>
              <div class='toggle-switch_inner'></div>
            </div>
          </div>
        </article>
        <article id='privacy-box' class='border-l rad-20 p-20 pt-10'>
          <h2 class='txt-c fw-light pb-10'>Appearance</h2>
          <div class='pb-10 pt-10'>
            current theme :
            <span class='c-white bg-gray rad-50 pr-10 pl-10'>Light</span>
          </div>
          <div class='pb-10 pt-10 border-t d-flex align-c justify-sb gap-20'>
            <span style='letter-spacing: -0.5px'> Dark theme </span>
            <input id='theme' class='toggle-input' type='checkbox' name='dark-theme' hidden />
            <div class='toggle-switch'>
              <div class='toggle-switch_inner'></div>
            </div>
          </div>
          <div class='pt-10 pb-10 border-t d-flex align-c justify-sb gap-20'>
            <span style='letter-spacing: -0.5px'> Hide main page </span>
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
        </article>
        <article id='privacy-box' class='border-l rad-20 p-20 pt-10'>
          <h2 class='txt-c fw-light pb-10'>Policy</h2>
          <div class='pb-10 pt-10 d-flex align-c justify-sb gap-20'>
            <span style='letter-spacing: -0.5px'> MIT license </span>
            <input class='toggle-input' type='checkbox' name='license' hidden />
            <div class='toggle-switch'>
              <div class='toggle-switch_inner'></div>
            </div>
          </div>
          <center class='border-t pt-10'>
            <span class='op-min'>
              Permission is hereby granted, free of charge, to any person
              obtaining a copy of this software and associated documentation
              files (the 'Software'), to deal in the Software without
              restriction, including without limitation the rights to use,
              copy, modify, merge, publish, distribute, sublicense, and/or
              sell copies of the Software, and to permit persons to whom the
              Software is furnished to do so,
            </span>
          </center>
        </article>
        <article id='privacy-box' class='border-l rad-20 p-20 pt-10'>
          <h2 class='txt-c fw-light pb-10'>Payment</h2>
          <div class='pb-10 pt-10'>
            current way :
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
            <label for='font-size' class='fs-14'>change Payment method</label>
            <select name='font-size' id='font-size' class='select-input'>
              <option selected value='mid'>PayPal</option>
              <option value='min'>Master Card</option>
              <option value='max'>Visa</option>
              <option value='max'>Ali pay</option>
            </select>
          </div>
          <center class='pt-10 border-t'>
            <span class='op-min'>
              All your banking info and transactions info are safe
            </span>
          </center>
        </article>
        <div id='submit-btn-container' class='pt-30 d-flex'>
          <button id='submit-btn' type='submit'>
            Save
          </button>
        </div>
      </form>
    </section>
      ");
    } else if ($selected_page == "purchases") {
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
        <input class='text-input' type='text' name='confirm_name' id='' placeholder='Confirm Username' />
        <button class='submit-btn' type='submit'>Change</button>
      </form>
      <form name='email_form' class='account-page__form' method='POST'>
        <label for='email_input'><h3>Change Email : </h3></label>
        <input class='text-input' type='text' name='email' id='email_input' placeholder='New Email' />
        <input class='text-input' type='text' name='confirm_email' id='' placeholder='Confirm Email' />
        <button class='submit-btn' type='submit'>Change</button>
      </form>
      <form name='password_form' class='account-page__form' method='POST'>
        <label for='password_input'><h3>Change Password : </h3></label>
        <input class='text-input' type='text' name='password' id='password_input' placeholder='New Password' />
        <input class='text-input' type='text' name='confirm_password' id='' placeholder='Confirm Password' />
        <button class='submit-btn' type='submit'>Change</button>
      </form>
    </section>
      ");
    };
    ?>

  </main>
</body>

<?php
// delete movie
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