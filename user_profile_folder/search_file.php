<?php 
include("../include_folder/include.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- ends here -->
    <!-- font text start here -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Karla:ital,wght@0,200..800;1,200..800&family=Kode+Mono:wght@400..700&family=Pacifico&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- ends here -->
    <link rel="stylesheet" href="search_file.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

<?php
if(isset($_SESSION["user_unique_id"])) {
    $user_unique_id = $_SESSION["user_unique_id"];
    $select_query1 = "select * from `secret_users` where user_unique_id = $user_unique_id";
    $result_query1 = mysqli_query($con, $select_query1);
  
    if($result_query1) {
        $row = mysqli_fetch_assoc($result_query1);
        $user_name = $row["username"];
    };

    $limit = 3;

    if(isset($_POST["search_result"])) {
        $search_result = html_entity_decode($_POST["search_result"]);
        $search_user = "select * from `secret_users` where username = '$search_result'";
        $search_result_1 = mysqli_query($con, $search_user);
        $search_num = mysqli_num_rows($search_result_1);
        $search_data = "aaffoorrkkee";
        if($search_num >= 1) {
            $search_result_data = mysqli_fetch_assoc($search_result_1);
            $search_data = $search_result_data["username"];
            $search_data_1 = $search_result_data["user_unique_id"];
        }
        if($search_data == $search_result) {
            // echo "User found";
            echo "
            <div class='result-div result-div-search' data-search-value='$search_data' data-user-id='$user_unique_id' data-username='$user_name' data-search-value-1='$search_data_1'>
                <div class='search-icon-div'><i class='fa-solid fa-magnifying-glass'></i></div>
                <div class='search-text-div'><p>$search_data</p></div>
            </div>
            "; 
        } else {
            //  echo "User not found";
             echo "
             <div class='result-div'>
                 <div class='search-icon-div'><i class='fa-solid fa-magnifying-glass'></i></div>
                 <div class='search-text-div'><p>No Matches</p></div>
             </div>
             ";
        }
    } else {
        echo "Nothing here to see..!!!";
    } ?>

    <div class="recent-result-div"></div>

    <?php

    $select_recent_query = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$user_name' limit $limit";
    $recent_result = mysqli_query($con, $select_recent_query);
    $recent_num_row = mysqli_num_rows($recent_result);
    if($recent_num_row >= 1) {
        while($recent_data = mysqli_fetch_assoc($recent_result)){
            $search_recent_result = $recent_data["search_result"];
            $search_id = $recent_data["search_id"];
            $search_user_id = $recent_data["user_unique_id"];
            $search_username = $recent_data["username"];

            $search_user_1 = "select * from `secret_users` where username = '$search_recent_result'";
            $search_result_2 = mysqli_query($con, $search_user_1);
            $search_num_1 = mysqli_num_rows($search_result_2);

            if($search_num_1) {
              while($recent_data_3 = mysqli_fetch_array($search_result_2)) {
                $search_user_id_1 = $recent_data_3["user_unique_id"];
              }
            }
            echo " <div class='result-div result-recent-result-div'>
            <div class='search-icon-div'><i class='fa-regular fa-clock'></i></div>
            <div class='search-text-div' data-search-value='$search_recent_result' data-user-id='$user_unique_id' data-username='$user_name' data-search-value-1='$search_user_id_1'><p>$search_recent_result</p></div>
            <div class='search-remove-div remove-recent-xx' data-recent-id='$search_id' data-recent-user-id='$search_user_id' data-recent-username='$search_username'><i class='fa-solid fa-xmark'></i></div>
          </div>";
        }
    }


} else {
  echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}

?>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
    function searchData() {
      $(".result-div-search").click(function() {
        var user_search = $(this).data("search-value");
        var user_id = $(this).data("user-id");
        var user_name = $(this).data("username");
        $.post("../function_folder/common_function_1.php", {search_data: user_search, search_unique_id: user_id, search_username: user_name}, function() {
          console.log("secretBook is good");
        });

      });
    }

    function searchData_1() {
      $(".result-div-search").click(function() {
        var user_name = $(this).data("username");
        var user_id_1 = $(this).data("search-value-1");

        $.post("../function_folder/common_function_1.php", {all_friend_id: user_id_1, all_friend_username: user_name}, function() {
          window.open("../friend_profile_folder/friend_profile1.php", "_self");
        });
      });
    }

    function searchData_2() {
      $(".search-text-div").click(function() {
        var user_name = $(this).data("username");
        var user_id_1 = $(this).data("search-value-1");

        $.post("../function_folder/common_function_1.php", {all_friend_id: user_id_1, all_friend_username: user_name}, function() {
          window.open("../friend_profile_folder/friend_profile1.php", "_self");
        });
      });
    }

    function deleteRecentSearch() {
      $(".remove-recent-xx").click(function() {
        var search_id = $(this).data("recent-id");
        var search_user_id = $(this).data("recent-user-id");
        var search_username_1 = $(this).data("recent-username");
        $.post("../function_folder/common_function_1.php", {search_id_1: search_id, search_user_id_1: search_user_id, search_username_2: search_username_1}, function() {
          console.log("secretBook is good");
        });
        $(this).fadeOut("slow");
      });
    }

    deleteRecentSearch();
    searchData();
    searchData_1();
    searchData_2();
    });
</script>


