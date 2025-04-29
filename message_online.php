<?php
include("./include_folder/include.php");

if($_POST["friend_unique_id"]) {
    $friend_unique_id = $_POST["friend_unique_id"];
    $friend_username = $_POST["friend_username"];

    $select_online_user = "select * from `secret_users` where user_unique_id = $friend_unique_id and username = '$friend_username'";
    $select_online_result = mysqli_query($con, $select_online_user);
    $select_online_row = mysqli_num_rows($select_online_result);
    if($select_online_row > 0) {
        $online_data = mysqli_fetch_assoc($select_online_result);
        $online_true = $online_data["user_online"];
        if($online_true == "online") {

            echo "<div class='online-ih online'></div>";
        } else {
            echo "<div class='online-ih offline'></div>";
        }
    }
} else {
    echo "window.open('./sign_up_folder/sign_in.php')";
}