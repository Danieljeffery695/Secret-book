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
    <!-- ends here -->
    <!-- font text start here -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Karla:ital,wght@0,200..800;1,200..800&family=Kode+Mono:wght@400..700&family=Pacifico&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- ends here -->
    <link rel="stylesheet" href="user_profile.css">
</head>
<body>
    <?php 
    // if(isset($_POST["user_comment_id"])) {
    //     $comment_id = $_POST["user_comment_id"];
    //     $select_comment = "select * from `secret_users_comment` where post_user_id = $comment_id order by user_id desc";
    //     $result_select = mysqli_query($con, $select_comment);
    //     $row_count = mysqli_num_rows($result_select);
    //     if($row_count >= 1) {
    //         while($row_data = mysqli_fetch_assoc($result_select)) {
    //             $username = $row_data["username"];
    //             // $user_unique_id = $row_data["unique_id"];
    //             $user_pics = $row_data["user_pics"];
    //             $comment = $row_data["comment"];
    //             $comment_date = $row_data["comment_date"];

    //             echo "
    //             <div class='comment-div-1'>
    //               <div class='comment-div-pics'>
    //                 <img
    //                   src='../sign_up_folder/user_image/$user_pics'
    //                   alt='user pics'
    //                   class='comment-profile-pics'
    //                 />
    //               </div>
    //               <div class='comment-div-2'>
    //                 <span>$username</span>
    //                 <p>$comment</p>
    //               </div>
    //             </div>
    //             <div class='comment-div-date'>
    //               <p>$comment_date</p>
    //             </div>";
    //         }
    //     } else {
    //         echo "
    //     <div class='comment-div-1'>
    //       <div class='comment-div-pics'>
    //         <img
    //           src='../user_home_folder/pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png'
    //           alt='user pics'
    //           class='comment-profile-pics'
    //         />
    //       </div>
    //       <div class='comment-div-2'>
    //         <span>Comment Manager</span>
    //         <p>NO COMMENT ADDED</p>
    //       </div>
    //     </div>
    //     <div class='comment-div-date'>
    //       <p>Starting of Time</p>
    //     </div>";
    //     }
    // }

    if(isset($_POST["user_comment_id"])) {
      $user_comment = $_POST["user_comment_id"];
      $home_post_comment_id = $_POST["post_comment_id"];
      // $post_comment = $_POST["home_story_comment"];
      $home_post = $_POST["profile_post"];

      $select_comment_1 = "select * from `secret_user_post` where post_unique_id = $user_comment and user_unique_id = $home_post_comment_id and user_post_img = '$home_post'";
      $select_result = mysqli_query($con, $select_comment_1);
      $select_row_count = mysqli_num_rows($select_result);
      if($select_row_count >= 1) {
        $select_row_data = mysqli_fetch_assoc($select_result);
        $post_id = htmlspecialchars($select_row_data["user_id"]);
      } else {
        echo "nothing returned";
      }

      $select_comment = "select * from `secret_users_comment` where post_id = $post_id order by user_id desc";
      $comment_result = mysqli_query($con, $select_comment);
      $comment_row = mysqli_num_rows($comment_result);
      if($comment_row >= 1) {
        while($comment_row_data = mysqli_fetch_assoc($comment_result)) {
          $comment_username = htmlspecialchars($comment_row_data["comment_owner_username"]);
          $comment = htmlspecialchars($comment_row_data["comment"]);
          $comment_owner_post = htmlspecialchars($comment_row_data["user_comment_post"]);
          $comment_date = htmlspecialchars($comment_row_data["comment_date"]);

          echo "
        <div class='comment-div-1'>
          <div class='comment-div-pics'>
            <img
              src='../sign_up_folder/user_image/$comment_owner_post'
              alt='user pics'
              class='comment-profile-pics'
            />
          </div>
          <div class='comment-div-2'>
            <span>$comment_username</span>
            <p>$comment</p>
          </div>
        </div>
        <div class='comment-div-date'>
          <p>$comment_date</p>
        </div>";
        }
      } else {
        echo "
        <div class='comment-div-1'>
          <div class='comment-div-pics'>
            <img
              src='../user_home_folder/pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png'
              alt='user pics'
              class='comment-profile-pics'
            />
          </div>
          <div class='comment-div-2'>
            <span>Comment Manager</span>
            <p>NO COMMENT ADDED</p>
          </div>
        </div>
        <div class='comment-div-date'>
          <p>Starting of Time</p>
        </div>";
      }


    }
    
    
    ?>
    
</body>
</html>