<?php

use PragmaRX\Google2FA\Google2FA;

global $id;
if (isset($_GET["id"])) {
  $id = $_GET["id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="dark">
  <link rel="stylesheet" href="../home/style.css">
  <link rel="stylesheet" href="./style.css">
  <title>Verify with 2fa</title>
</head>

<body>

  <main>
    <h1 class="main_title">2fa verification :</h1>
    <form action="" method="POST" class="main_form">
      <div class="inputs_container">
        <input type="text" class="text_input" name="input_code" size="22" minlength="6" maxlength="6" autofocus>
      </div>
      <?php verify_2fa() ?>
      <div class="form_buttons">
        <button class="submit_btn" type="submit">Verify</button>
        <button class="submit_btn" type="reset">Cancel</button>
      </div>
    </form>
    <div style="margin-top: 4rem;">
      <a href="../emailAuth?id=<?= $id ?>" style="text-decoration: none;">Use other method</a>
      <br>
      <p style="opacity: 0.5;">You will find the code in your authentification app</p>
    </div>
  </main>
</body>

<?php

function verify_2fa()
{
  if (isset($_POST["input_code"])) {
    require "vendor/autoload.php";
    $google2fa = new Google2FA();

    $code = $_POST["input_code"];

    $otp_token = "5BVEIZHH4SBEGI4A"; //! get this from the database
    $verify = $google2fa->verify($code, $otp_token);

    if (!$verify) {
      echo "<p class='result failure'>Wrong code, try again.</p>";
    }
  }
}

?>

</html>