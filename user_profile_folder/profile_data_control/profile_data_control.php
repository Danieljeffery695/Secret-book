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
    <link rel="stylesheet" href="user_profile.css">
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
        $(".comment-container-div").load("user_comment_folder.php",
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
          user_element.load("./user_profile_like.php", {user_profile_like: user_id, profile_post_comment_id: user_comment_id, profile_comment_post: user_story_post })  
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

    function ajaxCallFunction11() {
      $(".story-comment-btn").click(function() {
        var user_story_comment = $(this).data("user-comment");
        var user_comment_id = $(this).data("comment-owner-id");
        var user_story_post = $(this).data("user-story-post");
        $(".comment-container-div").load("./profile_story_comment.php", 
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
          user_element.load("./profile_story_like.php", {user_profile_like: user_id, profile_story_comment_id: user_comment_id, profile_comment_story: user_story_post })  
        });
    };

    function deleteHomeStory(url) {
        $(".x-delete-story").click(function() {
          var user_id = $(this).data("story-id");
          var user_comment_id = $(this).data("comment-owner-id");
          var user_story_post = $(this).data("user-story-post");
          $.post(url, { user_delete_id: user_id, profile_story_comment_id: user_comment_id, profile_comment_story: user_story_post }, function(data) {
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
          $.post(url, { user_delete_post_id: user_id, profile_story_comment_id: user_comment_id, profile_comment_story: user_story_post }, function(data) {
            console.log("Everything is in good shape");
            location.reload();
          });
        });
    }

    function searchFunction() {
      $(".search-input-div").keyup(function() {
        var search_value = $("input:text").val();
        $(".search-result-div").load("search_file.php", {search_result: search_value});
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

    ajaxCallRequest();
    ajaxCallRequest_1("../function_folder/common_function_2.php");
    ajaxCallRequest_2("../function_folder/common_function_2.php");
    ajaxCallRequest_3();
    ajaxCallFunction4("profile_story.php");
    ajaxCallFunction5("profile_story.php");
    ajaxCallFunction6("profile_story.php");
    ajaxCallFunction7("profile_story.php");
    ajaxCallFunction8("profile_story.php");
    ajaxCallFunction9("profile_story.php");
    ajaxCallFunction11();
    ajaxCallFunction12();
    deleteHomeStory("./profile_data_control/profile_delete.php");
    deleteHomePost("./profile_data_control/profile_delete.php");
    searchFunction();
    deleteRecentSearch1();
    searchData_3();
    showMessage();
 });

</script>


<?php

try {



if (isset($_POST["bio-input"])) {
    $bio_text =  htmlspecialchars($_POST["bio-input"]);
    $username = $_SESSION["username"];

    if (empty($bio_text)) {
        echo "<script>alert('Something Went Wrong')</script>";
    } else {

        $insert_query = ("insert into `secret_users_bio` (user_unique_id, username, user_bio) values ($user_unique_id, '$username', 'Add bio so friends can get to know you better...')");
        $result_query_1 = mysqli_query($con, $insert_query);
        $update_query = "update `secret_users_bio` set user_unique_id = $user_unique_id, username = '$username', user_bio = '$bio_text' where user_unique_id = $user_unique_id";
        $result_query_2 = mysqli_query($con, $update_query);
        if ($result_query_2) {
            echo "<script>alert('Bio Updated Successfully..!!')</script>";
            $_SESSION["user_bio"] = $bio_text;
            echo "<script>window.open('user_profile.php', '_self')</script>";
        } else {
            throw new Exception("Error Processing Request");
        }
    }
}


if (isset($_POST["add-story-btn"])) {
    $post_pics = $_FILES["add-story-pics"]["name"];
    $tmp_post_pics = $_FILES["add-story-pics"]["tmp_name"];
    $post_caption = htmlspecialchars($_POST["add-story-caption"]);
    $post_unique_id = rand();
    $post_type_1 = "main-post";
    if (empty($post_pics) || empty($post_caption)) {
        echo "<script>alert('Please fill the field.')</script>";
    } else {
        $username = $_SESSION["username"];
        $insert_query_1 = ("insert into `secret_user_post` (username, user_unique_id, user_post_img, user_post_caption, user_post_like, post_unique_id, post_date)
        values (?, ?, ?, ?, 0, ?, NOW())");
        $result_query_3 = $con->prepare($insert_query_1);
        $result_query_3->bind_param("sissi", $username, $user_unique_id, $post_pics, $post_caption, $post_unique_id);
        $result_query_3->execute();
        if ($result_query_3) {
            move_uploaded_file($tmp_post_pics, "./user_post_img/$post_pics");
            echo "<script>alert('Stories successfully uploaded')</script>";

            $insert_stmt_1 = ("insert into `profile_uploaded` (user_unique_id, username, post_texts, post_type, upload_id, post_img, post_like, post_date) values (?, ?, ?, ?, ?, ?, 0, NOW())");
            $insert_stmt_1 = $con->prepare($insert_stmt_1);
            $insert_stmt_1->bind_param("isssis", $user_unique_id, $username, $post_caption, $post_type_1, $post_unique_id, $post_pics);
            $insert_stmt_1->execute();

            $notification_type = "new post";
            $insert_notification = ("insert into `friend_notification_table` (user_unique_id, username, notification_type, notification_date) values (?, ?, ?, NOW())");
            $notification_result = $con->prepare($insert_notification);
            $notification_result->bind_param("iss", $user_unique_id, $username, $notification_type);
            $notification_result->execute();

            
            echo "<script>window.open('user_profile.php', '_self')</script>";

        } else {
            // echo "<script>alert('Sorry something went wrong..!!')</script>";
            throw new Exception("Error Processing Request");
        }
    }
}

if (isset($_POST["modal-9-submit"])) {

    $story_input = $_POST["modal-9-input"];
    if (isset($_SESSION["profile_story_color"])) {
        $user_color = $_SESSION["profile_story_color"];
    } else {
        $user_color = "nothing";
    }

    if (!empty($story_input)) {
        $post_type = "story-post";
        $story_unique_id = rand();
        $username = $_SESSION["username"];
        $insert_story = ("insert into `profile_story` (username, user_unique_id, user_story, user_color, user_story_like, story_unique_id, story_date) values (?, ?, ?, ?, 0, ?, NOW())");
        $story_stmt = $con->prepare($insert_story);
        $story_stmt->bind_param("sissi", $username, $user_unique_id, $story_input, $user_color, $story_unique_id);
        $story_stmt->execute();

        $insert_story_2 = ("insert into `profile_uploaded` (user_unique_id, username, post_texts, post_type, upload_id, post_img, post_like, post_date) values (?, ?, ?, ?, ?, ?, 0, NOW())");
        $story_stmt_2 = $con->prepare($insert_story_2);
        $story_stmt_2->bind_param("isssis", $user_unique_id, $username, $story_input, $post_type, $story_unique_id, $user_color);
        $story_stmt_2->execute();
        echo "<script>alert('successfully uploaded')</script>";
        echo "<script>window.open('user_profile.php', '_self')</script>";

        $notification_type = "new post";
        $insert_notification = ("insert into `friend_notification_table` (user_unique_id, username, notification_type, notification_date) values (?, ?, ?, NOW())");
        $notification_result = $con->prepare($insert_notification);
        $notification_result->bind_param("iss", $user_unique_id, $username, $notification_type);
        $notification_result->execute();

    } else {
        unset($_SESSION["story_color"]);
        echo "<script>alert('Something went wrong')</script>";
        echo "<script>window.open('user_profile.php', '_self')</script>";
    }
}


unset($_SESSION["POST_1"]);

} catch (Exception $e) {
    echo "<script>alert('Something went wrong 1')</script>";
    echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}
?> 