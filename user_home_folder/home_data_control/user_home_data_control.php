<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- font awesome links start here -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- ends here -->
    <!-- font text start here -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Karla:ital,wght@0,200..800;1,200..800&family=Kode+Mono:wght@400..700&family=Pacifico&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- ends here -->
    <!-- link css start here -->
    <link rel="stylesheet" href="user_home.css" />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    >
  </script>
    <!-- link ends here -->
    <!-- animation link start here -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <!-- animation link ends here -->
  </head>
<script>
  $(document).ready(function () {
    function ajaxCallFunction(url) {
      $(".post-input-form").submit(function () {
        var user_id = $(this).data("user-form");
        var user_comment_id = $(this).data("comment-owner-id");
        var user_story_post = $(this).data("user-story-post");
        $.post(
          url,
          { user_post_id: user_id, home_post_comment_id: user_comment_id, home_comment_post: user_story_post },
          function (data) {
            console.log("hello world");
          });
        });
    }

    function ajaxCallFunction1() {
      $(".comment-btn").click(function() {
        var user_post_comment = $(this).data("user-comment");
        var user_comment_id = $(this).data("comment-owner-id");
        var user_story_post = $(this).data("user-story-post") 
        $(".comment-container-div").load("./home_comment.php", {
          user_comment_show: user_post_comment,
          home_post_comment_id: user_comment_id,
          home_comment_post: user_story_post
        })
      })
    }

    function ajaxCallRequest_3() {
        $(".post-like-i").click(function() {
          var user_id = $(this).data("user-id");
          var user_comment_id = $(this).data("comment-owner-id");
          var user_story_post = $(this).data("user-story-post");
          var user_element = $(this).parent().find("sup").addClass("reaction_sup");
          user_element.load("./user_home_like.php", {user_profile_like: user_id, home_post_comment_id: user_comment_id, home_comment_post: user_story_post })  
        });
    };

    function ajaxCallFunction4(url) {
      $(".color-pick-1").click(function() {
        var backGroundColor = "color-pick-1";
        $.post(url, {story_background_1: backGroundColor }, function(data) {
          console.log("SecretBook is the best communication app");
        })
      })
    }

    function ajaxCallFunction5(url) {
      $(".color-pick-2").click(function() {
        var backGroundColor = "color-pick-2";
        $.post(url, {story_background_2: backGroundColor }, function(data) {
          console.log("SecretBook is the best communication app");
        })
      })
    }

    function ajaxCallFunction6(url) {
      $(".color-pick-3").click(function() {
        var backGroundColor = "color-pick-3";
        $.post(url, {story_background_3: backGroundColor }, function(data) {
          console.log("SecretBook is the best communication app");
        })
      })
    }

    function ajaxCallFunction7(url) {
      $(".color-pick-4").click(function() {
        var backGroundColor = "color-pick-4";
        $.post(url, {story_background_4: backGroundColor }, function(data) {
          console.log("SecretBook is the best communication app");
        })
      })
    }

    function ajaxCallFunction8(url) {
      $(".color-pick-5").click(function() {
        var backGroundColor = "color-pick-5";
        $.post(url, {story_background_5: backGroundColor }, function(data) {
          console.log("SecretBook is the best communication app");
        })
      })
    }

    function ajaxCallFunction9(url) {
      $(".color-pick-6").click(function() {
        var backGroundColor = "color-pick-6";
        $.post(url, {story_background_6: backGroundColor }, function(data) {
          console.log("SecretBook is the best communication app");
        })
      })
    }

    function ajaxCallFunction10(url) {
      $(".story-input-form").submit(function(e) {
        var user_id = $(this).data("user-form");
        var user_comment_id = $(this).data("comment-owner-id");
        var home_story_post = $(this).data("user-story-post");
        $.post(url, { story_comment_id: user_id, story_comment_owner_id: user_comment_id, user_story_post: home_story_post }, function(data) {
          console.log("SecretBook is the best communication app");
        });
      })
    }

    function ajaxCallFunction11() {
      $(".story-comment-btn").click(function() {
        var user_story_comment = $(this).data("user-comment");
        var user_comment_id = $(this).data("comment-owner-id");
        var user_story_post = $(this).data("user-story-post");
        $(".comment-container-div").load("./home_story_comment.php", 
          { home_story_comment: user_story_comment, home_story_comment_id: user_comment_id, home_comment_story: user_story_post }
        )
      })
    }

    function ajaxCallFunction12() {
        $(".story-like-i").click(function() {
          var user_id = $(this).data("user-id");
          var user_comment_id = $(this).data("comment-owner-id");
          var user_story_post = $(this).data("user-story-post");
          var user_element = $(this).parent().find("sup").addClass("reaction_sup");
          user_element.load("./user_home_story_like.php", {user_profile_like: user_id, home_story_comment_id: user_comment_id, home_comment_story: user_story_post })  
        });
    };

    function deleteHomeStory(url) {
        $(".x-delete-story").click(function() {
          var user_id = $(this).data("story-id");
          var user_comment_id = $(this).data("comment-owner-id");
          var user_story_post = $(this).data("user-story-post");
          $.post(url, { user_delete_id: user_id, home_story_comment_id: user_comment_id, home_comment_story: user_story_post }, function(data) {
            console.log("Everything is in good shape");
            location.reload();
          });
        });
    }

    function deleteHomePost(url) {
        $(".x-delete-post").click(function() {
          var user_id = $(this).data("post-id");
          var user_comment_id = $(this).data("comment-owner-id");
          var user_story_post = $(this).data("user-story-post");
          $.post(url, { user_delete_post_id: user_id, home_story_comment_id: user_comment_id, home_comment_story: user_story_post }, function(data) {
            console.log("Everything is in good shape");
            location.reload();
          });
        });
    }

    function searchFunction() {
      $(".search-input-div").keyup(function() {
        var search_value = $("input:text").val();
        $(".search-result-div").load("home_search_file.php", {search_result: search_value});
      });
    }

    function deleteRecentSearch1() {
      $(".remove-recent-x").click(function() {
        var search_id = $(this).data("recent-id");
        var search_user_id = $(this).data("recent-user-id");
        var search_username_1 = $(this).data("recent-username");
        $.post("../function_folder/common_function_1.php", {search_id_1: search_id, search_user_id_1: search_user_id, search_username_2: search_username_1}, function() {
          console.log("secretBook is good");
        });
        $(this).fadeOut("slow");
      });
    }

    function searchData_3() {
      $(".search-text-div-1").click(function() {
        var user_name = $(this).data("username");
        var user_id_1 = $(this).data("search-value-1");

        $.post("../function_folder/common_function_1.php", {all_friend_id: user_id_1, all_friend_username: user_name}, function() {
          window.open("../friend_profile_folder/friend_profile1.php", "_self");
        });
      });
    }

    function showMessage() {
      $(".nav-message-btn").click(function() {
        $(".message-users-div").load("./../message-profile.php");
      });
    }



    ajaxCallFunction1();
    ajaxCallFunction("../function_folder/common_function_1.php");
    ajaxCallRequest_3();
    ajaxCallFunction4("user_story.php");
    ajaxCallFunction5("user_story.php");
    ajaxCallFunction6("user_story.php");
    ajaxCallFunction7("user_story.php");
    ajaxCallFunction8("user_story.php");
    ajaxCallFunction9("user_story.php");
    ajaxCallFunction10("../function_folder/common_function_1.php");
    ajaxCallFunction11();
    ajaxCallFunction12();
    deleteHomeStory("./home_data_control/home_delete.php");
    deleteHomePost("./home_data_control/home_delete.php");
    searchFunction();
    deleteRecentSearch1();
    searchData_3();
    showMessage();
  });
</script>

<?php 
// try {
if(isset($_POST["story-submit"])) {
  $post_unique_id = rand();
  $post_image = $_FILES["story-input"]["name"];
  $post_image_tmp = $_FILES["story-input"]["tmp_name"];
  $post_caption = $_POST["post-caption"];
  $post_type_1 = "main-post";

  move_uploaded_file($post_image_tmp, "./user_home_post_img/$post_image");
  $insert_stmt = ("insert into `secret_users_home_post` (user_id, username, user_post_caption, user_post_img, user_post_like, post_unique_id, user_post_date) 
  VALUES (?, ?, ?, ?, 0, ?, NOW())");
  $stmt = $con->prepare($insert_stmt);
  $stmt->bind_param("isssi", $user_unique_id, $user_username, $post_caption, $post_image, $post_unique_id);
  $stmt->execute();

  $insert_stmt_1 = ("insert into `home_uploaded` (user_unique_id, username, post_texts, post_type, upload_id, post_img, post_like, post_date) values (?, ?, ?, ?, ?, ?, 0, NOW())");
  $insert_stmt_1 = $con->prepare($insert_stmt_1);
  $insert_stmt_1->bind_param("isssis", $user_unique_id, $user_username, $post_caption, $post_type_1, $post_unique_id, $post_image);

  $insert_stmt_1->execute();

  $notification_type = "home new post";
  $insert_notification = ("insert into `friend_notification_table` (user_unique_id, username, notification_type, notification_date) values (?, ?, ?, NOW())");
  $notification_result = $con->prepare($insert_notification);
  $notification_result->bind_param("iss", $user_unique_id, $user_username, $notification_type);
  $notification_result->execute();

  echo "<script>alert('successfully uploaded')</script>";
  echo "<script>window.open('user_home.php', '_self')</script>";
}

if(isset($_POST["modal-6-submit"])) {

  $story_input = $_POST["modal-6-input"];
  if(isset($_SESSION["story_color"])) {
    $user_color = $_SESSION["story_color"];
  } else {
    $user_color = "nothing";
  }

  if(!empty($story_input)) {
    $post_type = "story-post";
    $story_unique_id = rand();
    // $username = $_SESSION["username"];
    $insert_story = ("insert into `user_home_story` (username, user_unique_id, user_story, user_color, user_story_like, story_unique_id, story_date) values (?, ?, ?, ?, 0, ?, NOW())");
    $story_stmt = $con->prepare($insert_story);
    $story_stmt->bind_param("sissi", $user_username, $user_unique_id, $story_input, $user_color, $story_unique_id);
    $story_stmt->execute();

    $insert_story_2 = ("insert into `home_uploaded` (user_unique_id, username, post_texts, post_type, upload_id, post_img, post_like, post_date) values (?, ?, ?, ?, ?, ?, 0, NOW())");
    $story_stmt_2 = $con->prepare($insert_story_2);
    $story_stmt_2->bind_param("isssis", $user_unique_id, $user_username, $story_input, $post_type, $story_unique_id, $user_color);
    $story_stmt_2->execute();
    echo "<script>alert('successfully uploaded')</script>";
    echo "<script>window.open('user_home.php', '_self')</script>";

    $notification_type = "new post";
    $insert_notification = ("insert into `friend_notification_table` (user_unique_id, username, notification_type, notification_date) values (?, ?, ?, NOW())");
    $notification_result = $con->prepare($insert_notification);
    $notification_result->bind_param("iss", $user_unique_id, $user_username, $notification_type);
    $notification_result->execute();

  } else {
    unset( $_SESSION["story_color"] );
    echo "<script>alert('Something went wrong')</script>";
    echo "<script>window.open('user_home.php', '_self')</script>";
  }
}

// Kill Post Form Data Session Variable, so User can reload the Page without sending post data twice
unset( $_SESSION["POST"] );

// } catch (Exception $e) {
//   echo "<script>alert('Something went wrong..!!')</script>";
//   echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
// }

?> 
