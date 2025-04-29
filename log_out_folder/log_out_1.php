<?php
include("../include_folder/include.php");

if(isset($_POST["logging_out"])) {
    session_start();

    $user_unique_id = $_SESSION["user_unique_id"];
    $offline = "offline";
    $coming_offline = "update `secret_users` set user_online = '$offline' where user_unique_id = $user_unique_id";
    $coming_offline_result = mysqli_query($con, $coming_offline);
  
    setcookie("SecretBook", "", -1, "/");
    setcookie("SecretBook1", "",  -1, "/");
    session_destroy();
    exit();
} else {
    echo "window.open('../sign_up_folder/sign_up.php', '_self')";
}