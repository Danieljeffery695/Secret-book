<?php 
declare(strict_types=1);
include("../include_folder/include.php");
session_start();

if(isset($_SESSION["user_unique_id"])) {
    $user_unique_id = $_SESSION["user_unique_id"];
} else {
    echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user_profile.css">
</head>
<body>
    <?php 
    //     $increase_like = 1;
    //     $decrease_like = 1;
    //     $increase_inserted_like = 1;
    // if(isset($_POST["user_profile_like"])) {
    //     $user_post_like =  $_POST["user_profile_like"];
    //     $select_post = "select * from `secret_user_post` where user_id = $user_post_like";
    //     $result = mysqli_query($con, $select_post);
    //     if($result) {
    //         $row_count = mysqli_num_rows($result);
    //         $row_data = mysqli_fetch_assoc($result);
    //         $user_like_num = $row_data["user_post_like"];
    //         $increase_like += $user_like_num;
    //         $decrease_like -= $user_like_num;
    //         $increase_inserted_like += $user_like_num; 
    //         $clicked = "true";
    //         $un_clicked = "false";
    //         if($row_count >= 1) {
    //             $select_post_1 = "select * from `user_profile_like` where post_id = $user_post_like";
    //             $result_1 = mysqli_query($con, $select_post_1);
    //             $like_row = mysqli_num_rows($result_1);
    //             if($like_row >= 1) {
    //                 if($result_1) {
    //                     $row_data_1 = mysqli_fetch_assoc($result_1);
    //                     $btn_liked = $row_data_1["is_clicked"];
    //                   if($btn_liked == "true") {
    //                     $update_post_like = "update `secret_user_post` set user_post_like = $decrease_like where user_id = $user_post_like";
    //                     $update_post_like_1 = "update `user_profile_like` set is_clicked = '$un_clicked' where post_id = $user_post_like and user_unique_id = $user_unique_id";
    //                     $result_2 = mysqli_query($con, $update_post_like);
    //                     $result_3 = mysqli_query($con, $update_post_like_1);
    //                     if(!$result_2 || !$result_3) {
    //                         echo "something wrong";
    //                     } else {
    //                         echo $decrease_like;
    //                     }
    //                   } else {
    //                     $update_post_like_1 = "update `secret_user_post` set user_post_like = $increase_like where user_id = $user_post_like";
    //                     $update_post_like_2 = "update `user_profile_like` set is_clicked = '$clicked' where post_id = $user_post_like and user_unique_id = $user_unique_id";
    //                     $result_4 = mysqli_query($con, $update_post_like_1);
    //                     $result_5 = mysqli_query($con, $update_post_like_2);
    //                     if(!$result_4 || !$result_5) {
    //                        echo "something wrong"; 
    //                     } else {
    //                         echo $increase_like;
    //                     }
    //                   }
    //                 }
    //             } else {
    //                 // echo "something wrong";
    //                 $is_clicked = "true";
    //                 $insert_query = ("insert into `user_profile_like` (post_id, is_clicked, user_unique_id, liked_date) values (?, ?, ?, NOW())");
    //                 $stmt = $con->prepare($insert_query);
    //                 $stmt->bind_param("isi", $user_post_like, $is_clicked, $user_unique_id);
    //                 $stmt->execute();

    //                 $update_post_like_3 = "update `secret_user_post` set user_post_like = '$increase_inserted_like' where user_id = $user_post_like";
    //                 $result_6 = mysqli_query($con, $update_post_like_3);
    //                 if(!$result_6) {
    //                    echo "something wrong"; 
    //                 } else {
    //                     echo $increase_inserted_like;
    //                 }
    //             }
    //         }  else {
    //             echo "something wrong"; 
    //         }
    //     } else {
    //         echo "something wrong"; 
    //     }
    // }

    $increase_like = 1;
    $decrease_like = 1;
    $increase_inserted_like = 1;
if(isset($_POST["user_profile_like"])) {
    $user_post_like =  $_POST["user_profile_like"];
    $user_post_unique_id = $_POST["profile_post_comment_id"];
    $user_story_post = $_POST["profile_comment_post"];
    $select_post = "select * from `secret_user_post` where post_unique_id = $user_post_like and user_unique_id = $user_post_unique_id and user_post_img = '$user_story_post'";
    $result = mysqli_query($con, $select_post);
    if($result) {
        $row_count = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);
        $user_like_num = $row_data["user_post_like"];
        $post_id = $row_data["user_id"];
        $increase_like += $user_like_num;
        $decrease_like -= $user_like_num;
        $increase_inserted_like += $user_like_num; 
        $clicked = "true";
        $un_clicked = "false";
        if($row_count >= 1) {
            $select_post_1 = "select * from `user_profile_like` where post_id = $post_id";
            $result_1 = mysqli_query($con, $select_post_1);
            $like_row = mysqli_num_rows($result_1);
            if($like_row >= 1) {
                if($result_1) {
                    $row_data_1 = mysqli_fetch_assoc($result_1);
                    $btn_liked = $row_data_1["is_clicked"];
                  if($btn_liked == "true") {
                    $update_post_like = "update `secret_user_post` set user_post_like = $decrease_like where user_id = $post_id";
                    $update_uploaded_like = "update `profile_uploaded` set post_like = $decrease_like where user_unique_id = $user_post_unique_id and upload_id = $user_post_like";
                    $update_post_like_1 = "update `user_profile_like` set is_clicked = '$un_clicked' where post_id = $post_id and user_unique_id = $user_post_unique_id";
                    $result_2 = mysqli_query($con, $update_post_like);
                    $result_3 = mysqli_query($con, $update_post_like_1);
                    $result_7 = mysqli_query($con, $update_uploaded_like);
                    if(!$result_2 || !$result_3 || !$result_7) {
                        echo "something wrong";
                    } else {
                        echo $decrease_like;
                        $increase_like = 1;
                        $decrease_like = 1;
                        $increase_inserted_like = 1;
                    }
                  } else {
                    $update_post_like_1 = "update `secret_user_post` set user_post_like = $increase_like where user_id = $post_id";
                    $update_uploaded_like_1 = "update `profile_uploaded` set post_like = $increase_like where user_unique_id = $user_post_unique_id and upload_id = $user_post_like";
                    $update_post_like_2 = "update `user_profile_like` set is_clicked = '$clicked' where post_id = $post_id and user_unique_id = $user_post_unique_id";
                    $result_4 = mysqli_query($con, $update_post_like_1);
                    $result_5 = mysqli_query($con, $update_post_like_2);
                    $result_8 = mysqli_query($con, $update_uploaded_like_1);
                    if(!$result_4 || !$result_5 || !$result_8) {
                       echo "something wrong"; 
                    } else {
                        echo $increase_like;
                        $increase_like = 1;
                        $decrease_like = 1;
                        $increase_inserted_like = 1;
                    }
                  }
                }
            } else {
                // echo "something wrong";
                $is_clicked = "true";
                $insert_query = ("insert into `user_profile_like` (post_id, is_clicked, user_unique_id, liked_date) values (?, ?, ?, NOW())");
                $stmt = $con->prepare($insert_query);
                $stmt->bind_param("isi", $post_id, $is_clicked, $user_unique_id);
                $stmt->execute();

                $update_post_like_3 = "update `secret_user_post` set user_post_like = '$increase_inserted_like' where user_id = $post_id";
                $result_6 = mysqli_query($con, $update_post_like_3); 
                if(!$result_6) {
                   echo "something wrong"; 
                } else {
                    echo $increase_inserted_like;
                    $increase_like = 1;
                    $decrease_like = 1;
                    $increase_inserted_like = 1;
                }
            }
        }  else {
            echo "something wrong"; 
        }
    } else {
        echo "something wrong"; 
    }
}

    ?>
    
</body>
</html>