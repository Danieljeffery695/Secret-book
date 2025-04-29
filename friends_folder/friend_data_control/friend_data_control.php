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

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- ends here -->
     <link rel="stylesheet" href="friends.css">
    <!-- css link ends here -->
</head>
</html>

<script type="text/javascript">
$(document).ready(function() {

    function gettingUsername() {
        $(".add-know-friend").click(function() {
            var username = $(this).data("username");
            $.post("", {friend_username: username}, function() {
                console.log("SecretBook is the best!!");
            })
        });
    };

    function removingUsername() {
        $(".remove-know-friend").click(function() {
            var username = $(this).data("username");
            $.post("", {friend_remove_username: username}, function() {
                console.log("SecretBook is the best!!");
            })
        })
    }

    function suggestionUsername() {
        $(".suggestion-add-btn").click(function() {
            var username = $(this).data("suggestion-username");
            $.post("", {suggestion_username: username}, function() {
                console.log("secretBook is the best!!");
            });
        })
    }

    function removingSuggestion() {
        $(".remove-suggestion-friend").click(function() {
            var username = $(this).data("suggestion-username");
            $.post("", {suggestion_remove_username: username}, function() {
                console.log("secretBook is the best!!");
            });
        })
    }

    function cancelRemoveRequest() {
        $(".cancel-remove-request").click(function () {
            var firstId = $(this).data("request-id-1");
            var secondId = $(this).data("request-id-2");
            $.post("", {Remove_first_id: firstId, Remove_second_id: secondId}, function() {
                console.log("SecretBook is the best!!");
            });
        })
    }

    function cancelRemoveSuggestionRequest() {
        $(".cancel-remove-suggestion-btn").click(function() { 
            var firstId = $(this).data("suggestion-id-1");
            var secondId = $(this).data("suggestion-id-2");
            $.post("", {remove_first_id_1: firstId, remove_second_id_1: secondId}, function() {
                console.log("SecretBook is the best!!");
            });
        });
    }

    function cancelFriendRequest() {
        $(".cancel-friend-request").click(function() {
            var firstId = $(this).data("request-id-1");
            var secondId = $(this).data("request-id-2");
            $.post("", {first_id: firstId, second_id: secondId}, function() {
                console.log("SecretBook is the best!!");
            });
        });
    };

    function cancelSuggestionRequest() {
        $(".cancel-suggestion-btn").click(function() { 
            var firstId = $(this).data("suggestion-id-1");
            var secondId = $(this).data("suggestion-id-2");
            $.post("", {first_id_1: firstId, second_id_1: secondId}, function() {
                console.log("SecretBook is the best!!");
            });
        });
    };

    function acceptFriendRequest() {
        $(".accept-friend-btn").click(function() {
            var sendId = $(this).data("sent-id");
            var ownerId = $(this).data("owner-id");
            $.post("", {sender_id: sendId, owner_id: ownerId}, function() {
                console.log("SecretBook is the best!!");
            });
        });
    }

    function removeFriendRequest() {
        $(".remove-friend-request").click(function() {
            var sendId = $(this).data("sent-id");
            var ownerId = $(this).data("owner-id");
            $.post("", {remove_sender_id: sendId, remove_owner_id: ownerId}, function() {
                console.log("SecretBook is the best!!");
            });
        })
    }
    

    function getUserProfile1(url) {
        $(".all-friend-name-div-1").click(function() {
            var user_friend_id = $(this).data("view-all-friend-profile");
            var user_friend_username = $(this).data("all-username-friend-profile");
            $(".friend-profile-container").load(url, {all_friend_id: user_friend_id, all_friend_username: user_friend_username });
        })
    }

    function getUserProfile2(url) {
        $(".all-friend-name-div-2").click(function() {
            var user_friend_id = $(this).data("view-all-friend-profile");
            var user_friend_username = $(this).data("all-username-friend-profile");
            $(".friend-profile-container").load(url, {all_friend_id: user_friend_id, all_friend_username: user_friend_username });
        })
    }

    function getUserProfile3(url) {
        $(".friend-view").click(function() {
            var user_friend_id = $(this).data("view-all-friend-profile");
            var user_friend_username = $(this).data("all-username-friend-profile");
            $.post("", {all_friend_id: user_friend_id, all_friend_username: user_friend_username}, function() {
                console.log("SecretBook is the Best");
                window.open("../friend_profile_folder/friend_profile1.php", "_self");
            })
        });
    }

    function getUserProfile4(url) {
        $(".friend-view-1").click(function() {
            var user_friend_id = $(this).data("view-all-friend-profile");
            var user_friend_username = $(this).data("all-username-friend-profile");
            $.post("", {all_friend_id: user_friend_id, all_friend_username: user_friend_username}, function() {
                console.log("SecretBook is the Best");
                window.open("../friend_profile_folder/friend_profile1.php", "_self");
            });
        });
    };

    function searchFunction() {
      $(".search-input-div").keyup(function() {
        var search_value = $("input:text").val();
        $(".search-result-div").load("friend_search_file.php", {search_result: search_value});
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


    acceptFriendRequest();
    suggestionUsername();
    cancelSuggestionRequest();
    cancelFriendRequest();
    gettingUsername();
    removingUsername();
    removingSuggestion();
    cancelRemoveRequest();
    cancelRemoveSuggestionRequest();
    removeFriendRequest();
    getUserProfile1("./friend_profile_control/friend_profile.php")
    getUserProfile2("./friend_profile_control/friend_profile.php")
    getUserProfile3();
    getUserProfile4();
    searchFunction();
    deleteRecentSearch1();
    searchData_3();
    showMessage();

});

</script>

<?php 
try {
    
if(isset($_POST["friend_username"])) {
    $friend_username = $_POST["friend_username"];
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
        $add_request_stmt->bind_param("issis", $request_friend_id, $request_friend_username, $detail_username, $user_unique_id, $request_status);
        $add_request_stmt->execute();
        echo "<script>alert('successfully uploaded')</script>";

        $insert_notification = ("insert into `secret_notification_table` (user_unique_id, username, friend_unique_id, friend_username, notification_type, notification_seen, 
        notification_post_id, notification_date) values (?, ?, ?, ?, ?, ?, ?, NOW())");
        $insert_notification_stmt = $con->prepare($insert_notification);
        $insert_notification_stmt->bind_param("isisssi", $user_unique_id, $detail_username, $request_friend_id, $request_friend_username, $post_comment, $post_unseen, $notification_post_id);
        $insert_notification_stmt->execute();
    } 
}

if(isset($_POST["friend_remove_username"])) {
    $friend_username = $_POST["friend_remove_username"];
    $select_add_friend = "select * from `secret_users` where username = '$friend_username'";
    $result_add_friend = mysqli_query($con, $select_add_friend);
    $add_friend_row = mysqli_num_rows($result_add_friend);
    if($add_friend_row >= 1) {
        $add_friend_data = mysqli_fetch_assoc($result_add_friend);
        $request_friend_username = $add_friend_data["username"];
        $request_friend_id = $add_friend_data["user_unique_id"];

        $add_request = ("insert into `suggestion_remove_table` (user_unique_id, username, remove_user_unique_id, remove_username, remove_date) 
        values (?, ?, ?, ?, NOW())");
        $add_request_stmt = $con->prepare($add_request);
        $add_request_stmt->bind_param("isis", $user_unique_id, $detail_username, $request_friend_id, $request_friend_username);
        $add_request_stmt->execute();
        echo "<script>alert('successfully uploaded')</script>";
    } 
}

if(isset($_POST["suggestion_remove_username"])) {
    $friend_username = $_POST["suggestion_remove_username"];
    $select_add_friend = "select * from `secret_users` where username = '$friend_username'";
    $result_add_friend = mysqli_query($con, $select_add_friend);
    $add_friend_row = mysqli_num_rows($result_add_friend);
    if($add_friend_row >= 1) {
        $add_friend_data = mysqli_fetch_assoc($result_add_friend);
        $request_friend_username = $add_friend_data["username"];
        $request_friend_id = $add_friend_data["user_unique_id"];

        $add_request = ("insert into `suggestion_remove_table` (user_unique_id, username, remove_user_unique_id, remove_username, remove_date) 
        values (?, ?, ?, ?, NOW())");
        $add_request_stmt = $con->prepare($add_request);
        $add_request_stmt->bind_param("isis", $user_unique_id, $detail_username, $request_friend_id, $request_friend_username);
        $add_request_stmt->execute();
        echo "<script>alert('successfully uploaded')</script>";
    } 
}

if(isset($_POST["suggestion_username"])) {
    $suggestion_username = $_POST["suggestion_username"];
    $select_add_friend_1 = "select * from `secret_users` where username = '$suggestion_username'";
    $result_add_friend_1 = mysqli_query($con, $select_add_friend_1);
    $add_friend_row_1 = mysqli_num_rows($result_add_friend_1);
    if($add_friend_row_1 >= 1) {
        $add_friend_data_1 = mysqli_fetch_assoc($result_add_friend_1);
        $request_friend_username_1 = $add_friend_data_1["username"];
        $request_friend_id_1 = $add_friend_data_1["user_unique_id"];
        $request_status_1 = "Not accepted";
        $post_comment = "friend request";
        $post_unseen = "unseen";
        $notification_post_id = 00;

        $add_suggestion = "insert into `secret_friend_request` (user_unique_id, username, request_username, request_unique_id, request_status, request_date) 
        values (?, ?, ?, ?, ?, NOW())";
        $add_suggestion_stmt = $con->prepare($add_suggestion);
        $add_suggestion_stmt->bind_param("issis", $request_friend_id_1, $request_friend_username_1, $detail_username, $user_unique_id, $request_status_1);
        $add_suggestion_stmt->execute();
        echo "<script>alert('successfully uploaded')</script>";

        $insert_notification = ("insert into `secret_notification_table` (user_unique_id, username, friend_unique_id, friend_username, notification_type, notification_seen, 
        notification_post_id, notification_date) values (?, ?, ?, ?, ?, ?, ?, NOW())");
        $insert_notification_stmt = $con->prepare($insert_notification);
        $insert_notification_stmt->bind_param("isisssi", $user_unique_id, $detail_username, $request_friend_id_1, $request_friend_username_1, $post_comment, $post_unseen, $notification_post_id);
        $insert_notification_stmt->execute();
    } 
}

if(isset($_POST["first_id"])) {
    $first_id = $_POST["first_id"];
    $second_id = $_POST["second_id"];
    $post_comment = "friend request";
    $delete_friend_request = "delete from `secret_friend_request` where user_unique_id = $first_id and request_unique_id = $second_id";
    $delete_request_result = mysqli_query($con, $delete_friend_request);
    if($delete_request_result) {
        echo "<script>alert('request Cancel successfully')</script>";
    } else {
        echo "<script>alert('something went wrong')</script>";
    }

    $delete_notification = "delete from `secret_notification_table` where user_unique_id = $user_unique_id and friend_unique_id = $first_id and notification_type = '$post_comment'";
    $delete_notification_request = mysqli_query($con, $delete_notification);
}

if(isset($_POST["Remove_first_id"])) {
    $first_id = $_POST["Remove_first_id"];
    $second_id = $_POST["Remove_second_id"];
    $delete_friend_request = "delete from `suggestion_remove_table` where user_unique_id = $second_id and remove_user_unique_id = $first_id";
    $delete_request_result = mysqli_query($con, $delete_friend_request);
    if($delete_request_result) {
        echo "<script>alert('request Cancel successfully')</script>";
    } else {
        echo "<script>alert('something went wrong')</script>";
    }
}

if(isset($_POST["first_id_1"])) {
    $first_id_1 = $_POST["first_id_1"];
    $second_id_1 = $_POST["second_id_1"];
    $post_comment = "friend request";
    $delete_friend_request_1 = "delete from `secret_friend_request` where user_unique_id = $first_id_1 and request_unique_id = $second_id_1";
    $delete_request_result_1 = mysqli_query($con, $delete_friend_request_1);
    if($delete_request_result_1) {
        echo "<script>alert('request Cancel successfully')</script>";
    } else {
        echo "<script>alert('something went wrong')</script>";
    }

    $delete_notification = "delete from `secret_notification_table` where user_unique_id = $user_unique_id and friend_unique_id = $first_id and notification_type = '$post_comment'";
    $delete_notification_request = mysqli_query($con, $delete_notification);
}

if(isset($_POST["remove_first_id_1"])) {
    $first_id_1 = $_POST["remove_first_id_1"];
    $second_id_1 = $_POST["remove_second_id_1"];
    $delete_friend_request_1 = "delete from `suggestion_remove_table` where user_unique_id = $second_id_1 and remove_user_unique_id = $first_id_1";
    $delete_request_result_1 = mysqli_query($con, $delete_friend_request_1);
    if($delete_request_result_1) {
        echo "<script>alert('request Cancel successfully')</script>";
    } else {
        echo "<script>alert('something went wrong')</script>";
    }
}

if(isset($_POST["sender_id"])) {
    $sender_id = $_POST["sender_id"];
    $owner_id = $_POST["owner_id"];
    $select_request_email = "select * from `secret_users` where user_unique_id = $sender_id";
    $select_request_email_1 = "select * from `secret_users` where user_unique_id = $owner_id";
    $result_email = mysqli_query($con, $select_request_email);
    $result_email_1 = mysqli_query($con, $select_request_email_1);
    $request_email_row = mysqli_num_rows($result_email);
    $request_email_row_1 = mysqli_num_rows($result_email_1);

    if($request_email_row >= 1 && $request_email_row_1 >= 1) {
        $request_sent_detail = mysqli_fetch_assoc($result_email);
        $sender_username = $request_sent_detail["username"];
        $sender_email = $request_sent_detail["user_email"];
        $request_owner_detail = mysqli_fetch_assoc($result_email_1);
        $owner_username = $request_owner_detail["username"];
        $owner_email = $request_owner_detail["user_email"];
        $source_of_friendship = "$sender_username add $owner_username";

        $insert_friendship = ("insert into `secret_friend_table` (friend_unique_id_1, friend_username_1, friend_email_1, 
        friend_unique_id_2, friend_username_2, friend_email_2, source_of_friendship, date_of_friendship) values (?, ?, ?, ?, ?, ?, ?, NOW())");
        $insert_friendship_stmt = $con->prepare($insert_friendship);
        $insert_friendship_stmt->bind_param("ississs", $sender_id, $sender_username, $sender_email, $owner_id, $owner_username, $owner_email, $source_of_friendship);
        $insert_friendship_stmt->execute();
        $accepted = "Request accepted";

        $update_friend_request = "update `secret_friend_request` set request_status = '$accepted' where user_unique_id = $owner_id and request_unique_id = $sender_id
        or user_unique_id = $sender_id and request_unique_id = $owner_id";
        $update_request_result = mysqli_query($con, $update_friend_request);
        if($update_request_result) {
            echo "<script>alert(`You're now friends with $sender_id`)</script>";
        }

        $post_comment = "friend accepted";
        $post_unseen = "unseen";
        $notification_post_id = 00;

        $insert_notification = ("insert into `secret_notification_table` (user_unique_id, username, friend_unique_id, friend_username, notification_type, notification_seen, 
        notification_post_id, notification_date) values (?, ?, ?, ?, ?, ?, ?, NOW())");
        $insert_notification_stmt = $con->prepare($insert_notification);
        $insert_notification_stmt->bind_param("isisssi", $owner_id, $owner_username, $sender_id, $sender_username, $post_comment, $post_unseen, $notification_post_id);
        $insert_notification_stmt->execute();
    }
}


if(isset($_POST["remove_sender_id"])) {
    $sender_id = $_POST["remove_sender_id"];
    $owner_id = $_POST["remove_owner_id"];
    $select_request_email = "select * from `secret_users` where user_unique_id = $sender_id";
    $select_request_email_1 = "select * from `secret_users` where user_unique_id = $owner_id";
    $result_email = mysqli_query($con, $select_request_email);
    $result_email_1 = mysqli_query($con, $select_request_email_1);
    $request_email_row = mysqli_num_rows($result_email);
    $request_email_row_1 = mysqli_num_rows($result_email_1);

    if($request_email_row >= 1 && $request_email_row_1 >= 1) {
        $request_sent_detail = mysqli_fetch_assoc($result_email);
        $sender_username = $request_sent_detail["username"];
        $request_owner_detail = mysqli_fetch_assoc($result_email_1);
        $owner_username = $request_owner_detail["username"];

        $delete_friend_request_1 = "delete from `secret_friend_request` where user_unique_id = $owner_id and username = '$owner_username' and request_unique_id = $sender_id and request_username = '$sender_username'";
        $delete_request_result_1 = mysqli_query($con, $delete_friend_request_1);
        if($delete_request_result_1) {
            echo "<script>alert('request Cancel successfully')</script>";
        } else {
            echo "<script>alert('something went wrong')</script>";
        }

    }
}


if(isset($_POST["all_friend_id"])) {
    $_SESSION["friend_unique_id"] = $_POST["all_friend_id"];
    $_SESSION["friend_username"] = $_POST["all_friend_username"];
} else {
    $_SESSION["friend_unique_id"] = $_SESSION["user_unique_id"];
}

} catch (Exception $e) {
    echo "<script>alert('Something went wrong')</script>";
    echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}

?>
