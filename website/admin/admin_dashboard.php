<?php
require "../func.php";
// redirect to admin signin page if is not signed-in
if (!isset($_SESSION["admin_token"])) {
  $conn = connDb();
  $stmt = $conn->prepare("SELECT * FROM admins WHERE id=? ;");
  $stmt->bind_param("s", $_SESSION["admin_token"]);
  if (!$stmt->execute()) {
    header("Location: ./index.php?e=1");
    mysqli_close($conn);
  } elseif ($stmt->get_result()->num_rows == 0) {
    header("Location: ./index.php?e=2");
    mysqli_close($conn);
  }
  mysqli_close($conn);
}
// logout
if (isset($_POST["logout_btn"])) {
  session_destroy();
  exit(header("Location: ./index.php"));
}
$edit_error = "";
$update_user_error = "";
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
  <link rel="icon" type="image/x-icon" href="../icons/admin.svg">
  <link rel="stylesheet" href="../home/style.css">
  <link rel="stylesheet" href="./admin.css">
  <script src="./admin_dashboard.js" defer></script>
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
    <nav id="header-nav">
      <a href="../">
        <img id="search-btn" width="25" src="../icons/home.svg" alt="Search">
      </a>
    </nav>
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
          <form method="POST" class="form" id="add_movie_form" name="add_movie_form">
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
            <h2>Delete movie</h2>
          </div>
          <div class="hero_card_img-container">
            <img class="hero_card_img" width="50" src="./plus.svg" alt="">
          </div>
        </div>
        <div class="hero_card_main" hidden>
          <form method="POST" class="form" id="add_movie_form" name="add_movie_form">
            <div>
              <input type="text" class="login_input" name="name" id="name" placeholder="Movie Name">
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

      <br>
      <br>

      <div class="hero_card">
        <div class="hero_card_preview">
          <div class="hero_card_title">
            <h2>Edit Movie</h2>
          </div>
          <div class="hero_card_img-container">
            <img class="hero_card_img" width="50" src="./plus.svg" alt="">
          </div>
        </div>
        <div class="hero_card_main" id="update_movie_form_container" hidden>
          <?php update_movie(); ?>
          <p class='error error'>
            <?php echo $edit_error ?>
          </p>
        </div>
      </div>

      <br>
      <br>

      <div class="hero_card">
        <div class="hero_card_preview">
          <div class="hero_card_title">
            <h2>Delete User</h2>
          </div>
          <div class="hero_card_img-container">
            <img class="hero_card_img" width="50" src="./plus.svg" alt="">
          </div>
        </div>
        <div class="hero_card_main" id="delete_user_form_container" hidden>
          <form method="POST" id="delete_user_form" class="form" name="delete_user_form">
            <div>
              <input type="text" class="login_input" name="email" id="email" placeholder="User Email">
            </div>
            <div>
              <button type="submit" name="delete_user_btn" class="login_button">Delete</button>
              <button type="reset" class="login_button">Cancel</button>
            </div>
          </form>
          <?php delete_user() ?>
        </div>
      </div>

      <br>
      <br>

      <div class="hero_card">
        <div class="hero_card_preview">
          <div class="hero_card_title">
            <h2>Edit User</h2>
          </div>
          <div class="hero_card_img-container">
            <img class="hero_card_img" width="50" src="./plus.svg" alt="">
          </div>
        </div>
        <div class="hero_card_main" id="update_user_form_container" hidden>
          <?php update_user(); ?>
          <p class='error error'>
            <?php echo $update_user_error ?>
          </p>
        </div>
      </div>


      <?php
      if ($_SESSION["access"] >= 2) {
        echo ("<br><br>
        <div class='hero_card'>
          <div class='hero_card_preview'>
            <div class='hero_card_title'>
              <h2>Add Admin</h2>
            </div>
            <div class='hero_card_img-container'>
              <img class='hero_card_img' width='50' src='./plus.svg' alt=''>
            </div>
          </div>
          <div class='hero_card_main' id='add_admin_form_container' hidden>
            <form method='POST' id='add_admin_form' class='form' name='add_admin_form'>
              <div>
                <input type='text' class='login_input' name='name' id='name' placeholder='Admin Name'>
              </div>
              <div>
                <input type='text' class='login_input' name='email' id='email' placeholder='Admin Email'>
              </div>
              <div>
                <input type='text' class='login_input' name='pwd' id='pwd' placeholder='Admin Password'>
              </div>
              <div>
                <input type='number' min='1' max='2' class='login_input' name='access' id='access' placeholder='Admin Access'>
              </div>
              <div>
                <button type='submit' name='add_admin_btn' class='login_button'>Add</button>
                <button type='reset' class='login_button'>Cancel</button>
              </div>
            </form>
        ");
        add_admin();
        echo ("
          </div>
        </div>
        ");
      }
      ?>


      <?php
      if ($_SESSION["access"] >= 2) {
        echo ("<br><br>
        <div class='hero_card'>
          <div class='hero_card_preview'>
            <div class='hero_card_title'>
              <h2>Delete Admin</h2>
            </div>
            <div class='hero_card_img-container'>
              <img class='hero_card_img' width='50' src='./plus.svg' alt=''>
            </div>
          </div>
          <div class='hero_card_main' id='delete_admin_form_container' hidden>
            <form method='POST' id='delete_admin_form' class='form' name='delete_admin_form'>
              <div>
                <input type='text' class='login_input' name='email' id='email' placeholder='Admin Email'>
              </div>
              <div>
                <button type='submit' name='delete_admin_btn' class='login_button'>Delete</button>
                <button type='reset' class='login_button'>Cancel</button>
              </div>
            </form>
        ");
        delete_admin();
        echo ("
          </div>
        </div>
        ");
      }
      ?>

    </section>


    <form class="form" name="logout_form" id="logout_form" method="post">
      <button type="submit" name="logout_btn" class="logout_btn">
        <img id="search-btn" width="25" src="../icons/logout.svg" alt="Search">
        <h3>Logout</h3>
      </button>
    </form>
  </main>

</body>

<?php

function add_admin()
{
  if (isset($_POST["add_admin_btn"])) {
    $conn = connDb();
    $access = $_POST["access"];
    focus_open_card("add_admin_form_container");
    if ($access >= $_SESSION["access"] || $access < 1) {
      echo "<p class='error'>You can't create an admin with this access level</p>";
    } else {
      $stmt = $conn->prepare("INSERT INTO admins VALUES ('', ?, ?, ?, ?) ;");
      $hashed_pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
      $stmt->bind_param("ssss", $_POST["name"], $_POST["email"], $hashed_pwd, $access);
      if (!$stmt->execute() || $stmt->affected_rows == 0) {
        echo "<p class='error'>Error while executing the query</p>";
      } else {
        echo "<p class='success'>Admin added successfully</p>";
      }
    }
    $conn->close();
  }
}

function delete_admin()
{
  if (isset($_POST["delete_admin_btn"])) {
    $conn = connDb();
    $email = $_POST["email"];
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email=? ;");
    $stmt->bind_param("s", $_POST["email"]);
    focus_open_card("delete_admin_form_container");
    if (!$stmt->execute()) {
      echo "<p class='error'>Error while executing the query</p>";
    } else {
      $res = $stmt->get_result();
      if ($res->num_rows == 0) {
        echo "<p class='error'>No admin with this email was found</p>";
      } elseif ($res->fetch_array()["access"] >= $_SESSION["access"]) {
        echo "<p class='error'>You are not allowed to delete this admin</p>";
      } else {
        $stmt = $conn->prepare("DELETE FROM admins WHERE email=? ");
        $stmt->bind_param("s", $email);
        if (!$stmt->execute() || $stmt->affected_rows == 0) {
          echo "<p class='error'>Error while executing the query</p>";
        } else {
          echo "<p class='success'>Admin deleted successfully</p>";
        }
      }
    }
    $conn->close();
  }
}


// printing the default form to select the movie
function echo_selector_form_data()
{
  echo ("
  <form method='POST' id='selector_form' class='form' name='selector_form'>
    <div>
      <input type='text' class='login_input' name='name' id='name' placeholder='Movie Name'>
    </div>
    <div>
      <input type='date' class='login_input' name='showDate' id='showDate' min='2023-01-01T00:00' placeholder='Show Date'></input>
    </div>
    <div>
      <button type='submit' name='selector_form_btn' class='login_button'>Select</button>
      <button type='reset' class='login_button'>Cancel</button>
    </div>
  </form>
  ");
}

function update_movie()
{
  // printing the default form
  if (!isset($_POST["selector_form_btn"]) && !isset($_POST["edit_movie_btn"])) {
    echo_selector_form_data();
  }

  // selecting a movie form handler
  if (isset($_POST["selector_form_btn"]) && !isset($_POST["edit_movie_btn"])) {
    $conn = connDb();
    global $edit_error;
    $old_name = $_POST["name"];
    $old_showDate = $_POST["showDate"];
    $stmt = $conn->prepare("SELECT * FROM movies WHERE name=? AND showDate=? ;");
    $stmt->bind_param("ss", $old_name, $old_showDate);
    focus_open_card("update_movie_form_container");
    if (!$stmt->execute()) {
      $edit_error = "Error while executing your request !";
    }
    $res = $stmt->get_result();
    if ($res->num_rows == 0) {
      $edit_error = "Unknown Movie";
    }
    if ($edit_error != "") {
      echo_selector_form_data();
    } else {
      $row = $res->fetch_array();
      $description = $row["description"];
      $picURL = $row["pic"];
      $seats = $row["description"];
      $genres = $row["description"];
      echo ("
      <form method='POST' id='edit_form' class='form' name='edit_form'>
        <div>
          <h3>Change Credentials : </h3>
        </div>
        <div>
          <label for='name_input'>Movie Name :</label>
          <input type='text' class='login_input' name='name' id='name_input' value='$old_name' placeholder='Name' autofocus>
        </div>
        <div>
          <label for='description_input'>Movie Description :</label>
          <textarea type='text' class='login_input' name='description' id='description_input' placeholder='Description'>$description</textarea>
        </div>
        <div>
          <label for='picURL_input'>Movie Picture URL :</label>
          <textarea type='text' class='login_input' name='picURL' id='picURL_input' placeholder='Poster URL'>$picURL</textarea>
        </div>
        <div>
          <label for='seats_input'>Movie Seats :</label>
          <textarea type='text' class='login_input' name='seats' id='seats_input' placeholder='Seats'>$seats</textarea>
        </div>
        <div>
          <label for='showDate_input'>Movie Show Date :</label>
          <input type='datetime-local' class='login_input' name='showDate' id='showDate_input' value='$old_showDate' min='2023-01-01T00:00' placeholder='Show Date'>
        </div>
        <div>
          <label for='genre_input'>Movie Genre :</label>
          <input type='text' class='login_input' name='genres' id='genre_input' value='$genres' placeholder='Genre'>
        </div>
        <div>
          <input type='text' class='login_input' name='old_name' value='$old_name' hidden>
          <input type='text' class='login_input' name='old_showDate' value='$old_showDate' hidden>
          <button type='submit' name='edit_movie_btn' class='login_button'>Edit</button>
          <button type='reset' class='login_button'>Cancel</button>
        </div>
      </form>
      ");
    }
  }

  // edit movie form handler
  if (isset($_POST["edit_movie_btn"]) && !isset($_POST["selector_form_btn"])) {
    $conn = connDb();

    $stmt = $conn->prepare(
      "UPDATE movies 
      SET `name`=?, `description`=?, pic=?, seats=?, showDate=?, `genres`=? 
      WHERE `name`=? AND showDate=? ;"
    );
    $stmt->bind_param(
      "ssssssss",
      $_POST["name"],
      $_POST["description"],
      $_POST["picURL"],
      $_POST["seats"],
      $_POST["showDate"],
      $_POST["genres"],
      // 
      $_POST["old_name"],
      $_POST["old_showDate"]
    );
    echo_selector_form_data();
    if (!$stmt->execute()) {
      $edit_error = "error when executing the request";
    } elseif ($stmt->affected_rows > 0) {
      echo "<p class='success success'>Movie updated successfully</p>";
    } else {
      $edit_error = "No movie was updated !";
    }
    $conn->close();
  }
}

// printing the default form to select the movie
function default_update_user_form()
{
  echo ("
  <form method='POST' id='select_user_form' class='form' name='select_user_form'>
    <div>
      <input type='text' class='login_input' name='email' id='email' placeholder='User Email'>
    </div>
    <div>
      <button type='submit' name='select_user_btn' class='login_button'>Select</button>
      <button type='reset' class='login_button'>Cancel</button>
    </div>
  </form>
  ");
}

function update_user()
{
  global $update_user_error;

  // printing the default form
  if (!isset($_POST["select_user_btn"]) && !isset($_POST["edit_user_btn"])) {
    default_update_user_form();
  }

  // selecting a movie form handler
  if (isset($_POST["select_user_btn"]) && !isset($_POST["edit_user_btn"])) {
    $conn = connDb();
    $old_email = $_POST["email"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? ;");
    $stmt->bind_param("s", $old_email);
    if (!$stmt->execute()) {
      $update_user_error = "Error while executing your request !";
      default_update_user_form();
      focus_open_card("update_user_form_container");
      $conn->close();
      return;
    }
    $res = $stmt->get_result();
    if ($res->num_rows == 0) {
      $update_user_error = "Unknown User";
    }
    if ($update_user_error != "") {
      default_update_user_form();
    } else {
      $name = $res->fetch_array()["username"];
      echo ("
      <form method='POST' id='edit_form' class='form' name='edit_user_form'>
        <div>
          <label for='name_input'>User Name :</label>
          <input type='text' class='login_input' name='name' id='name_input' value='$name' placeholder='Name' autofocus>
        </div>
        <div>
          <label for='email_input'>User Email :</label>
          <input type='text' class='login_input' name='email' id='email_input' value='$old_email' placeholder='Name'>
        </div>
        <div>
          <input type='text' class='login_input' name='old_email' value='$old_email' hidden>
          <button type='submit' name='edit_user_btn' class='login_button'>Edit</button>
          <button type='reset' class='login_button'>Cancel</button>
        </div>
      </form>
      ");
    }
    focus_open_card("update_user_form_container");
  }

  // edit movie form handler
  if (isset($_POST["edit_user_btn"]) && !isset($_POST["select_user_btn"])) {
    $conn = connDb();
    $stmt = $conn->prepare(
      "UPDATE users 
      SET username=?, email=? 
      WHERE email=? ;"
    );
    $stmt->bind_param(
      "sss",
      $_POST["name"],
      $_POST["email"],
      // 
      $_POST["old_email"]
    );
    default_update_user_form();
    if (!$stmt->execute()) {
      $update_user_error = "Error when executing the request";
    } elseif ($stmt->affected_rows > 0) {
      echo "<p class='success'>User Credentials updated successfully</p>";
    } else {
      $update_user_error = "No user was updated !";
    }
    focus_open_card("update_user_form_container");
    $conn->close();
  }
}


// add movie
if (isset($_POST["add_movie_btn"])) {
  $conn = connDb();
  $stmt = $conn->prepare("INSERT INTO movies VALUES ('', ?, ?, ?, ?, ?, ?) ;");
  $stmt->bind_param(
    "ssssss",
    $name = $_POST["name"],
    $description = $_POST["description"],
    $picURL = $_POST["picURL"],
    $seats = $_POST["seats"],
    $showDate = $_POST["showDate"],
    $genre = $_POST["genre"]
  );
  if (!$stmt->execute() || $stmt->affected_rows == 0) {
    echo "<script>alert('An error occurred')</script>";
  } else {
    echo "<script>alert('Successfully adding the movie :  $name')</script>";
  }
  mysqli_close($conn);
}

// delete movie
if (isset($_POST["remove_movie_btn"])) {
  $conn = connDb();
  $name = $_POST["name"];
  $showDate = $_POST["showDate"];

  $stmt = $conn->prepare("DELETE FROM movies WHERE name=? AND showDate=? ;");
  $stmt->bind_param("ss", $name, $showDate);
  if (!$stmt->execute()) {
    echo "<script>alert('Error while executing the query.')</script>";
  } elseif ($stmt->affected_rows == 0) {
    echo "<script>alert('No Movie has those Credentials.')</script>";
  } else {
    echo "<script>alert('Successfully removing movie :  $name.')</script>";
  }
  $conn->close();
}

function delete_user()
{
  if (isset($_POST["delete_user_btn"])) {
    $conn = connDb();
    $email = $_POST["email"];

    $stmt = $conn->prepare("DELETE FROM users WHERE email=? ;");
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
      echo ("<p class='error'>ERROR in the execution of the request</p>");
    } elseif ($stmt->affected_rows == 0) {
      echo ("<p class='error'>User not found</p>");
    } else {
      echo ("<p class='success success'>User deleted successfully</p>");
    }
    focus_open_card("delete_user_form_container");
    $conn->close();
  }
}

// scroll to and open a card
function focus_open_card($card_id)
{
  echo ("
  <script>
    document.querySelectorAll('.hero_card_main').forEach((main) => {
      main.setAttribute('hidden', '');
    });
    document.getElementById('$card_id').removeAttribute('hidden');
    window.location.href = './admin_dashboard.php#$card_id';
  </script>");
}

?>

</html>