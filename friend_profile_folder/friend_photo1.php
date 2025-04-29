<?php
declare(strict_types=1);
@session_start();
include("../include_folder/include.php");

if(isset($_SESSION["friend_unique_id"])) {
  $user_unique_id_2 = $_SESSION["friend_unique_id"];
} else {
    echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}

try {
  $select_photo = "select * from `secret_user_post` where user_unique_id = $user_unique_id_2";
  $photo_result = mysqli_query($con, $select_photo);
  if(!$photo_result) {
    throw new Exception("Something Went wrong. can't get photo");
  }
} catch (Exception $err) {
  echo "<script>alert('Something went wrong')</script>";
  echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photos</title>
    <link rel="stylesheet" href="friend_photo1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script defer src="friend_photo1.js"></script>
</head>
<body>

     <!-- Swiper -->
<div class="photo-container">

    <div class="swiper mySwiper first-photo-div">
        <div class="swiper-wrapper">
          <?php
          $photo_count = 0; 
          while($photo_row = mysqli_fetch_assoc($photo_result))  {
            $user_photo_img = $photo_row["user_post_img"];
            echo "
            <div class='swiper-slide'><img src='../user_profile_folder/user_post_img/$user_photo_img' class='photo-img' alt='Uploaded Images'></div>";  
            $photo_count++;
            if($photo_count > 7) break;
          };
          ?>
          </div>
          <div class="swiper-pagination"></div>
    </div>

    <div class='more-photo-div first-btn-div'>
    <?php 
    $photo_row_1 = mysqli_num_rows($photo_result);
    if($photo_row_1 > 8) {
      echo "
        <button class='more-pics-btn'>More Pics</button>
        <script>
        const btnHide = document.querySelector('.more-photo-div');
        btnHide.classList.remove('hide-photo');
        </script>
        ";
      } else {
        echo "<p>Post More to get people attention..</p>";
      }
      ?>
    </div>
    
    <div class="more-photo-div first-btn-div hide-photo">
      <button class="more-pics-btn">More Pics</button>
    </div>

    <div class="more-photo-container second-photo-div">
    <?php 
    while($photo_more = mysqli_fetch_assoc($photo_result)) {
      $user_photo_more = $photo_more["user_post_img"];
      echo "
      <div class='more-photo-div-1'><img src='../user_profile_folder/user_post_img/$user_photo_more' alt='more photos' class='photo-img-1'></div>
      ";
    };
      ?>
      
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      direction: "vertical",
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
</body>
</html>