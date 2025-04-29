<?php

declare(strict_types=1);
session_start();
include("../include_folder/include.php");
if(isset($_SESSION["user_unique_id"])) {
    $user_unique_id = $_SESSION["user_unique_id"];
} else {
    echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}

$select_user = "select * from `secret_users` where user_unique_id = $user_unique_id";
$result_user = mysqli_query($con, $select_user);

$row_data = mysqli_fetch_array($result_user);
  $user_username = $row_data["username"];
  $user_picture = $row_data["user_picture"];

try {

if(isset($_POST["user_id_comment"])) {
    // $post_id = $_POST["user_post_id"];
    $_SESSION["profile_post_id"] = $_POST["user_id_comment"];
    $_SESSION["profile_comment_owner_id"] = $_POST["post_comment_id"];
    $_SESSION["user_profile_post"] = $_POST["profile_post"]; 

  if(isset($_SESSION["friend_unique_id"])) {
  $notification_post_id = $_POST["user_id_comment"];

  $user_unique_id = $_SESSION["user_unique_id"];
  $username = $_SESSION["username"];
  $friend_id = $_SESSION["friend_unique_id"];
  $friend_username = $_SESSION["friend_username"];
  $post_comment = "post comment";
  $post_unseen = "unseen";

  $insert_notification = ("insert into `secret_notification_table` (user_unique_id, username, friend_unique_id, friend_username, notification_type, notification_seen, 
  notification_post_id, notification_date) values (?, ?, ?, ?, ?, ?, ?, NOW())");
  $insert_notification_stmt = $con->prepare($insert_notification);
  $insert_notification_stmt->bind_param("isisssi", $user_unique_id, $username, $friend_id, $friend_username, $post_comment, $post_unseen, $notification_post_id);
  $insert_notification_stmt->execute();
    }
}

if(isset($_POST["story_comment_id"])) {
    $_SESSION["profile_story_comment_id"] = $_POST["story_comment_id"];
    $_SESSION["profile_story_comment_owner_id"] = $_POST["story_comment_owner_id"];
    $_SESSION["profile_story_post"] = $_POST["user_story_post"];    

    if(isset($_SESSION["friend_unique_id"])) {
      $notification_post_id = $_POST["story_comment_id"];
    
      $user_unique_id = $_SESSION["user_unique_id"];
      $username = $_SESSION["username"];
      $friend_id = $_SESSION["friend_unique_id"];
      $friend_username = $_SESSION["friend_username"];
      $post_comment = "story comment";
      $post_unseen = "unseen";
    
      $insert_notification = ("insert into `secret_notification_table` (user_unique_id, username, friend_unique_id, friend_username, notification_type, notification_seen, 
      notification_post_id, notification_date) values (?, ?, ?, ?, ?, ?, ?, NOW())");
      $insert_notification_stmt = $con->prepare($insert_notification);
      $insert_notification_stmt->bind_param("isisssi", $user_unique_id, $username, $friend_id, $friend_username, $post_comment, $post_unseen, $notification_post_id);
      $insert_notification_stmt->execute();
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["story-comment-submit"])) {
        $story_comment = $_POST["story-input-text"];
        if(!empty($story_comment)) {
          $story_post_id = $_SESSION["profile_story_comment_id"];
          $story_post = $_SESSION["profile_story_post"];
          $story_comment_owner_id = $_SESSION["profile_story_comment_owner_id"];
      
          $select_story_id = "select * from `profile_story` where story_unique_id = $story_post_id and user_unique_id = $story_comment_owner_id and user_color = '$story_post'";
          $select_story_result_1 = mysqli_query($con, $select_story_id);
          if($select_story_result_1) {
            $story_post_data = mysqli_fetch_assoc($select_story_result_1);
            $story_id_data = htmlspecialchars($story_post_data["story_id"]);
            $story_user_unique_id = htmlspecialchars($story_post_data["user_unique_id"]);
            $story_username_1 = htmlspecialchars($story_post_data["username"]);
            $story_post_img = htmlspecialchars($story_post_data["user_color"]);
      
            $insert_story_1 = ("insert into `profile_story_comment` (user_unique_id, username, comment_owner_username, comment_owner_id, comment, post_image, post_id,
             user_comment_post, comment_date) values (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $story_stmt_1 = $con->prepare($insert_story_1);
            $story_stmt_1->bind_param("ississis", $story_user_unique_id, $user_unique_id, $user_username, $story_username_1, $story_comment, $story_post_img, $story_id_data,
            $user_picture);
            $story_stmt_1->execute();
      
            echo "<script>alert('Comment Added successfully')</script>";
          } else {
            throw new Exception("Error Processing Request");
          }
        } else {
          echo "<script>alert('Something went wrong 1')</script>";
        }
    }    
  
    if(isset($_POST["post-comment-submit"])) {

        $comment = $_POST["post-input"];    
        if(!empty($comment)) {
            $user_post_id = $_SESSION["profile_post_id"];
            $post_comment_owner_id = $_SESSION["profile_comment_owner_id"];
            $user_story_post = $_SESSION["user_profile_post"];
            $select_home_post = "select * from `secret_user_post` where post_unique_id = $user_post_id and user_unique_id = $post_comment_owner_id and user_post_img = '$user_story_post'";
            $result_home_post = mysqli_query($con, $select_home_post);
          if($result_home_post) {
            $post_result = mysqli_fetch_assoc($result_home_post);
            $post_id = $post_result["user_id"];
            $post_username_1 = $post_result["username"];
            $post_unique_id_1 = $post_result["user_unique_id"];
            $post_img = $post_result["user_post_img"];
              
            $insert_comment = ("insert into `secret_users_comment` (user_unique_id, username, comment_owner_username, comment_owner_id, 
            comment, post_img, post_id, user_comment_post, comment_date) values (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt_1 = $con->prepare($insert_comment);
            $stmt_1->bind_param("ississis", $post_unique_id_1, $post_username_1, $user_username, $user_unique_id, $comment, $post_img, $post_id, $user_picture);
            $stmt_1->execute();
            echo "<script>alert('Comment Added successfully')</script>";
          } else {
            throw new Exception("Error Processing Request");
          }
        }else {
            echo "<script>alert('Something went wrong')</script>";
        }
    }     

    
    if(isset($_POST["message-submit"])) {
      $message = $_POST["message-input"];
      if(!empty($message)) {
        $receiver_id = $_SESSION["friend_unique_id"];
        $receiver_username = $_SESSION["friend_username"];
        $insert_message = ("insert into `users_chat` (sender_id, sender_username, receiver_id, receiver_username, msg_content, msg_status, msg_date)
        values (?, ?, ?, ?, ?, 'later', NOW())");
        $msg_result = $con->prepare($insert_message);
        $msg_result->bind_param("isiss", $user_unique_id, $user_username, $receiver_id, $receiver_username, $message);
        $msg_result->execute();
      }
    } 
         
}

} catch (Exception $e) {
  echo "<script>alert('Sorry something went wrong')</script>";
  echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}

