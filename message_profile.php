<?php
include("./include_folder/include.php");

if (isset($_POST['friend_unique_id'])) {
    $current_friend_pic = $_POST["friend_unique_id"];
    $select_sender_pic_1 = "select * from `secret_users` where user_unique_id = $current_friend_pic";
    $select_sender_pic_result_1 = mysqli_query($con, $select_sender_pic_1);
    $sender_pic_row_1 = mysqli_num_rows($select_sender_pic_result_1);

    if($sender_pic_row_1 >= 1) {
        $sender_pic_data_1 = mysqli_fetch_assoc($select_sender_pic_result_1);
        $sender_pic_1 = $sender_pic_data_1["user_picture"];
        echo "<img src='./sign_up_folder/user_image/$sender_pic_1' alt='photo'>";
    }
}