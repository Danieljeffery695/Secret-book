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

if(isset($_POST["user_post_id"])) {
    // $post_id = $_POST["user_post_id"];
    $_SESSION["user_post_id_1"] = $_POST["user_post_id"];
    $_SESSION["user_comment_owner_id"] = $_POST["home_post_comment_id"];
    $_SESSION["user_story_post"] = $_POST["home_comment_post"]; 
}

if(isset($_POST["story_comment_id"])) {
    $_SESSION["story_comment_id_1"] = $_POST["story_comment_id"];
    $_SESSION["story_comment_owner_id"] = $_POST["story_comment_owner_id"];
    $_SESSION["story_post"] = $_POST["user_story_post"];    
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["story-comment-submit"])) {
        $story_comment = $_POST["story-input-text"];
        if(!empty($story_comment)) {
          $story_post_id = $_SESSION["story_comment_id_1"];
          $story_post = $_SESSION["story_post"];
          $story_comment_owner_id = $_SESSION["story_comment_owner_id"];
      
          $select_story_id = "select * from `user_home_story` where story_unique_id = $story_post_id and user_unique_id = $story_comment_owner_id and user_color = '$story_post'";
          $select_story_result_1 = mysqli_query($con, $select_story_id);
          if($select_story_result_1) {
            $story_post_data = mysqli_fetch_assoc($select_story_result_1);
            $story_id_data = htmlspecialchars($story_post_data["story_id"]);
            $story_user_unique_id = htmlspecialchars($story_post_data["user_unique_id"]);
            $story_username_1 = htmlspecialchars($story_post_data["username"]);
            $story_post_img = htmlspecialchars($story_post_data["user_color"]);
      
            $insert_story_1 = ("insert into `user_home_story_comment` (user_unique_id, username, comment_owner_username, comment_owner_id, comment, post_image, post_id,
             user_comment_post, comment_date) values (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $story_stmt_1 = $con->prepare($insert_story_1);
            $story_stmt_1->bind_param("ississis", $user_unique_id, $user_username, $story_username_1, $story_user_unique_id, $story_comment, $story_post_img, $story_id_data,
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
            $user_post_id = $_SESSION["user_post_id_1"];
            $post_comment_owner_id = $_SESSION["user_comment_owner_id"];
            $user_story_post = $_SESSION["user_story_post"];
            $select_home_post = "select * from `secret_users_home_post` where post_unique_id = $user_post_id and user_id = $post_comment_owner_id and user_post_img = '$user_story_post'";
            $result_home_post = mysqli_query($con, $select_home_post);
          if($result_home_post) {
            $post_result = mysqli_fetch_assoc($result_home_post);
            $post_id = $post_result["id"];
            $post_username_1 = $post_result["username"];
            $post_unique_id_1 = $post_result["user_id"];
            $post_img = $post_result["user_post_img"];
              
            $insert_comment = ("insert into `secret_user_home_comment` (user_unique_id, username, comment_owner_username, comment_owner_id, 
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
            echo "<script>window.open('user_home.php', '_self')</script>";
        }
    }     

         
}

if(isset($_POST["search_data"])) {
  $search_data = html_entity_decode($_POST["search_data"]);
  $search_unique_id = $_POST["search_unique_id"];
  $search_username = $_POST["search_username"];
  $insert_recent_search = ("insert into `search_recent_table` (user_unique_id, username, search_result, search_date) values (?, ?, ?, NOW())");
  $insert_recent_search = $con->prepare($insert_recent_search);
  $insert_recent_search->bind_param("iss", $search_unique_id, $search_username, $search_data);
  $insert_recent_search->execute();
}

if(isset($_POST["search_id_1"])) {
  $search_id = $_POST["search_id_1"];
  $search_user_id = $_POST["search_user_id_1"];
  $search_username = $_POST["search_username_2"];

  $delete_recent_search = "delete from `search_recent_table` where search_id = $search_id and user_unique_id = $search_user_id and username = '$search_username'";
  $delete_recent_search_result = mysqli_query($con, $delete_recent_search);
}

if(isset($_POST["all_friend_id"])) {
  $_SESSION["friend_unique_id"] = $_POST["all_friend_id"];
  $_SESSION["friend_username"] = $_POST["all_friend_username"];
} else {
  $_SESSION["friend_unique_id"] = $_SESSION["user_unique_id"];
}

} catch (Exception $e) {
  echo "<script>alert('Sorry something went wrong')</script>";
}

