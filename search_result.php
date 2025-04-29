<?php

include("./include_folder/include.php");
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
    <!-- <link rel="stylesheet" href="search_file.css"> -->
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
            <div class='search-recent-result-div current-search-div result-div-search' data-search-value='$search_result' data-user-id='$user_unique_id' data-username='$search_data' data-search-value-1='$search_data_1'>
                <div class='recent-result-div'>
                    <div class='search-recent-icon'><i class='fa-solid fa-magnifying-glass'></i></div>
                    <div class='search-result'><p>$search_result</p></div>
                </div>
                
            </div>
            "; 
        } else {
            //  echo "User not found";
             echo "
              <div class='search-recent-result-div'>
                <div class='recent-result-div'>
                    <div class='search-recent-icon'><i class='fa-solid fa-magnifying-glass'></i></div>
                    <div class='search-result'><p>No Matches</p></div>
                </div>
                <div class='remove-search-recent'><i class='fa-solid fa-xmark'></i></div>
            </div>
             ";
        }
    } else {
        echo "Nothing here to see..!!!";
    } ?>

    <div class="recent-result-div"></div>

    <?php



} else {
  echo "<script>window.open('./sign_up_folder/sign_in.php', '_self')</script>";
}

?>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {

    function searchData_2() {
      $(".result-div-search").click(function() {
        var user_name = $(this).data("username");
        var user_id_1 = $(this).data("search-value-1");

        $.post("./function_folder/common_function_1.php", {all_friend_id: user_id_1, all_friend_username: user_name}, function() {
          window.open("./friend_profile_folder/friend_profile1.php", "_self");
        });
      });
    }
    
    searchData_2();
    
  });
</script>