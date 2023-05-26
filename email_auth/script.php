<?php

// $email = "kossayriahi38@gmail.com";
$email = "wissem.zidi.ofc@gmail.com";

$res = email_auth($email);
while ($res == false) {
  $res = email_auth($email);
}


function email_auth($email)
{
  $verif_code = random_int(100000, 999999);

  file_put_contents(
    "transfer.json",
    "{
      \"email\": \"$email\",
      \"verif_code\": \"$verif_code\"
    }"
  );
  exec("python fetch.py");

  // check if there any error while sending the request
  $data = json_decode(file_get_contents("transfer.json"));
  if ($data->erreur_msg != '') {
    echo "an Error happened \n";
    print_r($data->erreur_msg);
  }

  for ($i = 0; $i < 3; $i++) {
    if (readline("verification code : ") == $verif_code) {
      echo "authentification success";
      return true;
    } elseif ($i == 2) {
      echo " ! request limit reached ! \n";
      echo " ! sending new verification code required ! \n";
      return false;
    } else {
      echo "wrong code please try again \n";
    }
  }
}
