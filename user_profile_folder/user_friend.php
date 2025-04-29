<?php 
include("../include_folder/include.php");
@session_start();

if(isset($_SESSION["user_unique_id"])) {
    $owner_unique_id = $_SESSION["user_unique_id"];
} else {
    echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}

// try {
    $select_friend_table = "select * from `secret_friend_table` where friend_unique_id_1 = $owner_unique_id or friend_unique_id_2 = $owner_unique_id";
    $select_friend_table_result = mysqli_query($con, $select_friend_table);
    $select_friend_table_row = mysqli_num_rows($select_friend_table_result);
    if($select_friend_table_row >= 1) {
        $friend_true = true; 
    } else {
        $friend_true = false;
    }
// } catch (Throwable $th) {
//     echo "<script>something went wrong</script>";
//     echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <link rel="stylesheet" href="user_friend.css">
</head>
<body>
    <div class="friend-container-div">
       <div class="friend-container-nav-div">
        <p>Friends</p>
        <input type="text" name="search-friend" class="search-friend-input" placeholder="Search friend">
       </div> 
       <div class="friend-container-div-1">
           <?php
        if($friend_true) {
            while($table_data = mysqli_fetch_assoc($select_friend_table_result)) {
                $friend_unique_id_1 = $table_data["friend_unique_id_1"];
                $friend_unique_id_2 = $table_data["friend_unique_id_2"];
                $friend_username_1 = $table_data["friend_username_1"];
                $friend_username_2 = $table_data["friend_username_2"]; 
                
                
            if($friend_unique_id_1 == $owner_unique_id) {
            $select_friend_profile = "select * from `secret_users` where user_unique_id = $friend_unique_id_2";
            $friend_profile_result = mysqli_query($con, $select_friend_profile);
            if($friend_profile_result) {
                while($friend_data = mysqli_fetch_assoc($friend_profile_result)) {
                    $friend_username = $friend_data["username"];
                    $friend_pics = $friend_data["user_picture"];

                    echo "
                        <div class='friend-container-flex-1'>
                            <p class='specification-p'>People you Add</p>
                            <div class='friend-container-profile-div'>
                                <div class='friend-container-profile-pic'>
                                    <div class='friend-profile-pic-div'><img src='../sign_up_folder/user_image/$friend_pics' alt='photo'></div>
                                    <p>$friend_username</p>
                                </div>
                                <button class='already-friend-btn'>Friend</button>
                            </div>
                        </div>
                    ";
                }
            }
            
        }else {
            
            $select_friend_profile_1 = "select * from `secret_users` where user_unique_id = $friend_unique_id_1";
            $friend_profile_result_1 = mysqli_query($con, $select_friend_profile_1);
            if($friend_profile_result_1) {
                while($friend_data_1 = mysqli_fetch_assoc($friend_profile_result_1)) {
                    $friend_username_1 = $friend_data_1["username"];
                    $friend_pics_1 = $friend_data_1["user_picture"];
                    
                    echo "
                        <div class='friend-container-flex-2'>
                            <p class='specification-p'>People who Add you</p>
                            <div class='friend-container-profile-div-1'>
                                <div class='friend-container-profile-pic-1'>
                                    <div class='friend-profile-pic-div'><img src='../sign_up_folder/user_image/$friend_pics_1' alt='photo'></div>
                                    <p>$friend_username_1</p>
                                </div>
                                <button class='already-friend-btn'>Friend</button>
                            </div>
                        </div>
                    ";
                }
            }
        }
       }
      }
      
        ?>
       </div>
    </div>
</body>
</html>