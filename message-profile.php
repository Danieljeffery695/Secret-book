<?php 

include("./include_folder/include.php");
session_start();

if(isset($_SESSION["user_unique_id"])) {
    $user_unique_id = $_SESSION["user_unique_id"];
    $select_current_user = "select * from `secret_users` where user_unique_id = $user_unique_id";
    $select_current_result = mysqli_query($con, $select_current_user);
    $current_user_row = mysqli_num_rows($select_current_result);
    if($current_user_row >= 1) {
        $arr = mysqli_fetch_assoc($select_current_result);
        $username_1 = $arr["username"];
        $select_all_friend = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id or friend_unique_id_2 = $user_unique_id";
        $select_all_result = mysqli_query($con, $select_all_friend);
        $select_all_friend_row = mysqli_num_rows($select_all_result);
        if($select_all_friend_row >= 1) {
           $friend_true = true;
        } else {
            $friend_true = false;
        }
    }

    $online = "online";

    $coming_online = "update `secret_users` set user_online = '$online' where user_unique_id = $user_unique_id";
    $coming_online_result = mysqli_query($con, $coming_online);
} else {
    echo "<script>window.open('./sign_up_folder/sign_in.php', '_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- font awesome links start here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ends here -->
    <!-- font text start here -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Karla:ital,wght@0,200..800;1,200..800&family=Kode+Mono:wght@400..700&family=Pacifico&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- ends here -->
    <!-- link css start here -->
    <link rel="stylesheet" href="./user_profile_folder/user_profile.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>

    </style>
    
</head>
<body>


<?php 
    if($friend_true) {
        while($friends_data = mysqli_fetch_assoc($select_all_result)) {
            $friend_unique_id_1 = $friends_data["friend_unique_id_1"];
            $friend_unique_id_2 = $friends_data["friend_unique_id_2"];
            $friend_username_1 = $friends_data["friend_username_1"];
            $friend_username_2 = $friends_data["friend_username_2"];
            if($friend_unique_id_1 == $user_unique_id) {
                $friend_unique_id = $friend_unique_id_2;
                $friend_username = $friend_username_2;
            } else {
                $friend_unique_id = $friend_unique_id_1;
                $friend_username = $friend_username_1;
            }
            

            $select_friend_pic = "select * from `secret_users` where user_unique_id = $friend_unique_id and username = '$friend_username'";
            $friend_pic_result = mysqli_query($con, $select_friend_pic);
            $select_friend_pic_row = mysqli_num_rows($friend_pic_result);
                if($select_friend_pic_row >= 1) {
                    $friend_pic_data = mysqli_fetch_assoc($friend_pic_result);
                    $friend_pic = $friend_pic_data["user_picture"]; 
                } else {
                    continue;
                }

            $select_friend_message_id = "select max(msg_id) as newMessage from `users_chat` where sender_id = $friend_unique_id and sender_username = '$friend_username'
              and receiver_id = $user_unique_id and receiver_username = '$username_1'";
            $select_friend_message_result = mysqli_query($con, $select_friend_message_id);
            $select_friend_message_row = mysqli_num_rows($select_friend_message_result);
                if($select_friend_message_row >= 1) {
                    $select_friend_message_data = mysqli_fetch_assoc($select_friend_message_result);
                    $friend_msg_id = $select_friend_message_data["newMessage"];
                }

                if($friend_msg_id) {
                    $select_friend_msg = "select * from `users_chat` where msg_id = $friend_msg_id and sender_id = $friend_unique_id and sender_username = '$friend_username'
                    and receiver_id = $user_unique_id and receiver_username = '$username_1'";
                    $select_friend_msg_result = mysqli_query($con, $select_friend_msg);
                    $select_friend_msg_row = mysqli_num_rows($select_friend_msg_result);
                    if($select_friend_msg_row >= 1) {
                        $select_friend_msg_data = mysqli_fetch_assoc($select_friend_msg_result);
                        $friend_msg_content = $select_friend_msg_data["msg_content"];
                    
                    } 
                    
                } else {
                    $friend_msg_content = "Message Unavailable..!!";
                }

                echo "
                 <div class='user-message'>
                    <div class='message-picture-div'>
                        <img src='../sign_up_folder/user_image/$friend_pic' alt='photo'>
                    </div>
                    <div class='message-data-div'>
                        <p class='message-username-p'>$friend_username</p>
                        <p class='message-p'>$friend_msg_content</p>
                    </div>
                    <div class='update-message-div'></div>
                </div>
                ";
        }
        

    } else {
        echo "
        <div class='user-message-profile'>
           <div class='message-picture-div'>
               <img src='../user_home_folder/pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png' alt='photo'>
           </div>
           <div class='message-data-div'>
               <p class='message-username-p'>SecretBook</p>
               <p class='message-p'>No friend yet</p>
           </div>
           <div class='update-message-div'></div>
       </div>
       ";
    }
?>

</body>