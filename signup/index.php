<?php
    require '../conn.php';
    require '../funcs.php';
    if ($logged_in){ header("Location: /"); }
    $error_msg = "";
    if (isset($_POST['reg'])){
        $email = isset($_POST['mail']) ? $_POST['mail'] : "";
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $pwd  = isset($_POST['pwd']) ?  $_POST['pwd']  : "";
        $re_pwd  = isset($_POST['re_pwd']) ?  $_POST['re_pwd']  : "";

        // Error messages
        $error_msg .= (!verify_email($email)) ?                          "Email isn't valid<br>" : "";
        $error_msg .= (!verify_username($name)) ?                        "Invalid username format<br>" : "";
        $error_msg .= (!(strlen($name) <= 16 && strlen($name) >= 4)) ?   "Username length should be between 4 and 16<br>" : "";
        $error_msg .= (!(strlen($pwd) >= 8)) ?                           "Password length should be more than 8<br>" : "";
        $error_msg .= (username_exists($conn,$name)) ?                   "Username already exists<br>" : "";
        $error_msg .= (email_exists($conn,$email)) ?                     "Email already exists<br>" : "";
        // $error_msg .= ($pwd != $re_pwd) ?                                "Password doesn't match<br>" : "";
        
        // In case we don't have any errors
        if (strlen($error_msg) === 0){
            Register($conn,$name,$email,$pwd);
            $login_id = Login($conn,$name,$pwd);
            if ($login_id !== false){
                $_SESSION['id'] = $login_id;
                header("Location: /"); 
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="#" />
    <link rel="icon" type="image/x-icon" href="../project assets/logo/logo(light).svg">
    <script src="main.js" defer></script>
    <title>Sign Up</title>
  </head>
  <body>
    <div class="bg"></div>
    <div class="spinner"></div>
    <section id="page">
      <center><h2 id="login__header">Sign Up</h2></center>
      <form id="login" method="post">
        <a href="../index.php" id="return__btn">
          <img height="20" src="./icons/return.svg" alt=">" />
        </a>
        <div id="login__input">
          <div id="login__input__container">
            <label for="name__input" id="name__label">Name</label>
            <input
              name="name"
              id="name__input"
              class=""
              title="Name"
              type="text"
              autocomplete="off"
              required
            />
          </div>
          <div id="login__input__container">
            <label for="email__input" id="email__label">Email</label>
            <input
              name="mail"
              id="email__input"
              class=""
              title="Email"
              type="email"
              autocomplete="off"
            />
          </div>
          <div id="login__input__container">
            <label for="password__input" id="password__label">Password</label>
            <input
              name="pwd"
              title="Password"
              id="password__input"
              class=""
              type="password"
              autocomplete="off"
            />
            <span id="input__conditions">Minimum 8 characters</span>
          </div>
        </div>
        <div id="login__submit">
          <button id="login__submit__btn" name="reg">Sign Up</button>
        </div>
        <br />
        <center>
          <div>
            <a
              style="
                padding: 0.3rem 0.6rem;
                text-decoration: none;
                background-color: black;
                color: white;
                border-radius: 50px;
              "
              href="../signin/index.php"
            >
              Sign In
            </a>
          </div>
        </center>
        <br>
        <center style="color: red;">
          <?php echo $error_msg; ?>
        </center>
      </form>
    </section>
  </body>
</html>
