<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
    </style>
    
</head>
</html>

<script type="text/javascript">
    $(document).ready(function() {

 function ajaxCallRequest() {
    $(".comment-btn").click(function() {
        var user_id = $(this).data("user-comment");
        var user_comment_id = $(this).data("comment-owner-id");
        var user_story_post = $(this).data("user-story-post")
        $(".comment-container-div").load("./friend_profile_control/friend_profile_post_comment.php",
         { user_comment_id: user_id, post_comment_id: user_comment_id, profile_post: user_story_post } );
    })
 }      

 function ajaxCallRequest_1(url) {
     $(".post-input-form").submit(function() {
         var user_id = $(this).data("user-form");
         var user_comment_id = $(this).data("comment-owner-id");
         var user_story_post = $(this).data("user-story-post");
         $.post(url, { user_id_comment: user_id, post_comment_id: user_comment_id, profile_post: user_story_post }, function(data) {
             console.log("Not Good");
        }, "json")
    });
}

function ajaxCallRequest_2(url) {
      $(".story-input-form").submit(function() {
        var user_id = $(this).data("user-form");
        var user_comment_id = $(this).data("comment-owner-id");
        var profile_story_post = $(this).data("user-story-post");
        $.post(url, { story_comment_id: user_id, story_comment_owner_id: user_comment_id, user_story_post: profile_story_post }, function(data) {
          console.log("SecretBook is the best communication app");
        });
      })
}

    function ajaxCallRequest_3() {
        $(".post-like-i").click(function() {
          var user_id = $(this).data("user-id");
          var user_comment_id = $(this).data("comment-owner-id");
          var user_story_post = $(this).data("user-story-post");
          var user_element = $(this).parent().find("sup").addClass("reaction_sup");
          user_element.load("./friend_profile_control/friend_profile_post_like.php", {user_profile_like: user_id, profile_post_comment_id: user_comment_id, profile_comment_post: user_story_post })  
        });
    };

    
    function ajaxCallFunction11() {
      $(".story-comment-btn").click(function() {
        var user_story_comment = $(this).data("user-comment");
        var user_comment_id = $(this).data("comment-owner-id");
        var user_story_post = $(this).data("user-story-post");
        $(".comment-container-div").load("./friend_profile_control/friend_profile_story_comment.php", 
          { profile_story_comment: user_story_comment, profile_story_comment_id: user_comment_id, profile_comment_story: user_story_post }
        )
      })
    }

    function ajaxCallFunction12() {
        $(".story-like-i").click(function() {
          var user_id = $(this).data("user-id");
          var user_comment_id = $(this).data("comment-owner-id");
          var user_story_post = $(this).data("user-story-post");
          var user_element = $(this).parent().find("sup").addClass("reaction_sup");
          user_element.load("./friend_profile_control/friend_profile_story_like.php", {user_profile_like: user_id, profile_story_comment_id: user_comment_id, profile_comment_story: user_story_post })  
        });
    };

    function gettingUsername_1() {
        $(".add-friend-btn").click(function() {
            var username = $(this).data("friend-username");
            $.post("./friend_profile_control/friend_profile.php", {friend_username_11: username}, function() {
                console.log("SecretBook is the best!!");
            })
        });
    };

    function cancelFriendRequest_1() {
        $(".cancel-friend-btn").click(function() {
            var firstId = $(this).data("request-id-1");
            var secondId = $(this).data("request-id-2");
            $.post("./friend_profile_control/friend_profile.php", {first_id_11: firstId, second_id_11: secondId}, function() {
                console.log("SecretBook is the best!!");
            });
        });
    };

    

    ajaxCallRequest();
    ajaxCallRequest_1("../function_folder/common_function_2.php");
    ajaxCallRequest_2("../function_folder/common_function_2.php");
    ajaxCallRequest_3();
    
    ajaxCallFunction11();
    ajaxCallFunction12();
    gettingUsername_1();
    cancelFriendRequest_1();
 });

</script>


<?php 

try {

if(isset($_POST["friend_username_11"])) {
  $friend_username = $_POST["friend_username_11"];
  $select_add_friend = "select * from `secret_users` where username = '$friend_username'";
  $result_add_friend = mysqli_query($con, $select_add_friend);
  $add_friend_row = mysqli_num_rows($result_add_friend);
  if($add_friend_row >= 1) {
      $add_friend_data = mysqli_fetch_assoc($result_add_friend);
      $request_friend_username = $add_friend_data["username"];
      $request_friend_id = $add_friend_data["user_unique_id"];
      $request_status = "Not accepted";
      $post_comment = "friend request";
      $post_unseen = "unseen";
      $notification_post_id = 000;

      $add_request = ("insert into `secret_friend_request` (user_unique_id, username, request_username, request_unique_id, request_status, request_date) 
      values (?, ?, ?, ?, ?, NOW())");
      $add_request_stmt = $con->prepare($add_request);
      $add_request_stmt->bind_param("issis", $request_friend_id, $request_friend_username, $owner_username, $owner_unique_id, $request_status);
      $add_request_stmt->execute();
      echo "<script>alert('successfully uploaded')</script>";

      $insert_notification = ("insert into `secret_notification_table` (user_unique_id, username, friend_unique_id, friend_username, notification_type, notification_seen, 
      notification_post_id, notification_date) values (?, ?, ?, ?, ?, ?, ?, NOW())");
      $insert_notification_stmt = $con->prepare($insert_notification);
      $insert_notification_stmt->bind_param("isisssi", $owner_unique_id, $owner_username, $request_friend_id, $request_friend_username, $post_comment, $post_unseen, $notification_post_id);
      $insert_notification_stmt->execute();
  } 
}

if(isset($_POST["first_id_11"])) {
  $first_id = $_POST["first_id_11"];
  $second_id = $_POST["second_id_11"];
  $post_comment = "friend request";
  $delete_friend_request = "delete from `secret_friend_request` where user_unique_id = $first_id and request_unique_id = $second_id";
  $delete_request_result = mysqli_query($con, $delete_friend_request);
  if($delete_request_result) {
      echo "<script>alert('request Cancel successfully')</script>";
  } else {
      echo "<script>alert('something went wrong')</script>";
  }

  $delete_notification = "delete from `secret_notification_table` where user_unique_id = $owner_unique_id and friend_unique_id = $first_id and notification_type = '$post_comment'";
  $delete_notification_request = mysqli_query($con, $delete_notification);
}

} catch (Exception $e) {
  echo "<script>alert('Something went wrong')</script>";
  echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}

?>

