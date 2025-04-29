<?php 
include("./../../include_folder/include.php");
@session_start();

  if(isset($_POST["all_friend_id"])) {
    $_SESSION["friend_unique_id"] = $_POST["all_friend_id"];
    $_SESSION["friend_username"] = $_POST["all_friend_username"];
  } elseif(isset($_POST["all_friend_id_1"])) {
    $_SESSION["friend_unique_id"] = $_POST["all_friend_id_1"];
    $_SESSION["friend_username"] = $_POST["all_friend_username"];
  } else {
   echo "<script>window.open(./../../user_profile_folder/user_profile.php)</script>";
  }


  $friend_id = $_SESSION["friend_unique_id"];
  $select_statement_1 = "select * from `secret_users_bio` where user_unique_id = $friend_id";
  $bio_query_1 = mysqli_query($con, $select_statement_1);
  $data_row_bio = mysqli_num_rows($bio_query_1);
  if($data_row_bio > 0) {
      $data = mysqli_fetch_assoc($bio_query_1);
      $friend_user_bio = $data["user_bio"];
      $_SESSION["friend_bio"] = $friend_user_bio;
  } else {
      $_SESSION["friend_bio"] = "Add Some details to let friends know about you better..";
  }

  $select_query1 = "select * from `secret_users` where user_unique_id = $friend_id";
  $result_query1 = mysqli_query($con, $select_query1);

  if($result_query1) {
    $data = mysqli_fetch_assoc($result_query1);
    // $_SESSION["friend_unique_id"] = $friend_id;
  }

$select_query = "select * from `secret_users` where user_unique_id = $friend_id";
$result_query = mysqli_query($con, $select_query);

if($result_query) {
    $friend_data = mysqli_fetch_assoc($result_query);
    $friend_age = $data["age"];
    $friend_location = $data["location"];
    $friend_picture = $data["user_picture"];
    $friend_username_num_1 = $data["username"];
} else {
  echo "end";
}

$select_uploaded_post = "select * from `profile_uploaded` where user_unique_id = $friend_id order by post_id desc";
$select_post_result = mysqli_query($con, $select_uploaded_post);

$select_post_result_1 = mysqli_query($con, $select_uploaded_post);


$post_row_count = mysqli_num_rows($select_post_result);
$post_exist = false;

if($post_row_count >= 1) {
  $post_exist = true;
} else {
  $post_exist = false;
}
 

 ?> 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script defer src="./friend_profile_control/friend_profile.js"></script>
</head>
<body>
  

      <!-- header start here -->
      <div class="header-container">
        <div class="header-img-div">
            <img src="../sign_up_folder/user_image/<?php echo $friend_picture ?>" alt="photo" class="header-img1">
        </div>
        <div class="header-img-div-1">
            <div class="header-div">
                <div class="header-img-div-2">
                    <img src="../sign_up_folder/user_image/<?php echo $friend_picture ?>" alt="pic" class="header-img2">
                </div>
              <h1><?php echo $friend_username_num_1; ?></h1>
            </div>
            <div class="header-div1">
                <button class="header-btn1"><i class="fa-solid fa-user"></i> Friends</button>
                <button class="header-btn2"><i class="fa-solid fa-comments"></i> Message</button>
            </div>
        </div>
        <div class="line-up">
            <nav class="line-up-nav">
                <li class="li-1">Post</li>
                <li class="li-2">About</li>
                <li class="li-3">Friends</li>
                <li class="li-4">Photos</li>
                <li class="li-5">Videos</li>
            </nav>
            <div class="header-menu">
                <p>...</p>
            </div>
        </div>
    </div>
    <!-- header ends here -->
    <!-- body start here -->
    
    <div class="body-container">
        <div class="body-container-div">
            <div class="body-div1">
                <div class="body-intro">
                    <div class="get-started-div">
                        <h3>BIO</h3>
                        <p class="p-bio"><?php echo $_SESSION["friend_bio"]; ?></p>
                    </div>
                </div>
              
                <div class="body-intro-div2">
                    <h3>Photos</h3>
                    <a href="#">See All Photos</a>
                </div>
                <div class="body-intro-div3">
                    <h3>Friends</h3>
                    <a href="#">See All Friends</a>
                </div>
            </div>
            <div class="body-div2">
              
            
                <div class="born-div">
                    <div class="born-div-1">
                        <div class="born-div-2">
                            <div class="born-div-span">
                                <img src="../sign_up_folder/user_image/<?php echo $friend_picture ?>" alt="pics" class="born-img1">
                                <span class="born-name">
                                    <?php echo $friend_username_num_1; ?>
                                </span>
                            </div>
                            <span class="born-date">date</span>
                            <span class="born-icon"><i class="fa-solid fa-clock"></i></span>
                            <span class="born-icon"><i class="fa-solid fa-people-group"></i></span>
                        </div>
                        <div class="born-div-3">
                            <i class="fa-solid fa-cake-candles"></i>
                            <p>
                                <?php echo $friend_age; ?>
                        </p>
                        </div>
                        <div class="caption-div">
                            <span class="like-count">0</span>
                            <p class="caption-p">Just joined SecretBook..!!!</p>
                        </div>
                        <div class="born-div-4">
                            <div class="born-div-4-div">
                                <i class="fa-regular fa-thumbs-up thump-icon like-btn"></i>
                                <i class="fa-regular fa-comment comment-icon"></i>
                            </div>
                            <p class="born-div-p">comment</p>
                            
                            <div class='born-form-div-1'>
                              <div class='born-form-div-2'>
                               <img src='../sign_up_folder/user_image/<>' alt='photo' />
                              </div>
                             <form action='' method='post' class='born-form-div-3'>
                              <input type='text' name='post-input' placeholder='Write a public comment...' class='born-div-input-1' autocomplete='off'/>
                              <input type='submit' name='post-comment-submit' value='&#8594;' class='post-comment-btn' />
                             </form>
                            </div>
                        </div>
                    </div>
                </div>
     




                <!-- Testing  -->
                <?php 

if($post_exist) { 
    while($post_fetch_row = mysqli_fetch_assoc($select_post_result)) {
     $post_user_id = htmlspecialchars($post_fetch_row["upload_id"]);
     $post_unique_id = htmlspecialchars($post_fetch_row["user_unique_id"]);
     $post_username = htmlspecialchars($post_fetch_row["username"]);
     $post_user_caption = htmlspecialchars($post_fetch_row["post_texts"]);
     $post_user_img = htmlspecialchars($post_fetch_row["post_img"]);
     $post_user_like = htmlspecialchars($post_fetch_row["post_like"]);
     $post_user_date = htmlspecialchars($post_fetch_row["post_date"]);
     $post_type = htmlspecialchars($post_fetch_row["post_type"]);


     if($post_type == "story-post") {

       $select_story_img = "select * from `secret_users` where username = '$post_username' and user_unique_id = $post_unique_id";
       $select_story_img_result = mysqli_query($con, $select_story_img);
       $story_img_data = mysqli_fetch_assoc($select_story_img_result);
       $story_img = htmlspecialchars($story_img_data["user_picture"]);

       $select_story_img = "select * from `secret_users` where username = '$post_username' and user_unique_id = $post_unique_id";
       $select_story_img_result = mysqli_query($con, $select_story_img);
       $story_img_data = mysqli_fetch_assoc($select_story_img_result);
       $story_img = htmlspecialchars($story_img_data["user_picture"]);

       $select_comment_story = "select * from `profile_story` where user_unique_id = $post_unique_id and story_unique_id = $post_user_id";
       $comment_story_result = mysqli_query($con, $select_comment_story);
       $comment_story_fetch = mysqli_fetch_assoc($comment_story_result);
       $story_comment_id = $comment_story_fetch["story_id"];
       $story_comment_username = $comment_story_fetch["username"];
       $story_comment_user_id = $comment_story_fetch["user_unique_id"];
   
       $select_comment_row_1 = "select * from `profile_story_comment` where post_id = $story_comment_id";
       $comment_row_result_1 = mysqli_query($con, $select_comment_row_1);
       $comment_number_1 = mysqli_num_rows($comment_row_result_1);
       if($comment_number_1 >= 1) {
         $cm = $comment_number_1;
       } else {
         $cm = 0;
       }

       echo "
       <div class='post-div'>
     <div class='post-div-nav'>
     <div class='first-post-div'>
       <div class='post-nav-img-div'>
       <img src='../sign_up_folder/user_image/$story_img' alt='photo'>
       </div>
       <div class='post-nav-caption-div'>
       <h3>$post_username</h3>
       <p>$post_user_date</p>
       </div>
      </div>
     </div>
     <div class='post-img-div'>
     <div class='post-story-div story-color-div normal-background $post_user_img'><p>$post_user_caption</p></div>
     </div>
     <div class='post-reaction-div'>
     <div class='first-post-reaction-div'>
         <i class='fa-solid fa-face-smile'></i>
         <i class='fa-solid fa-face-smile reaction-i'><sup>$post_user_like</sup></i>
       </div>
       <div class='second-post-reaction-div'>
       <p>$cm comments</p>
       </div>
     </div>
     <div class='post-like-div'>
       <i class='fa-solid fa-plus story-like-i' data-user-id='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'><sup class='like-sup'></sup></i>
       <i class='fa-solid fa-bell story-comment-btn' data-user-comment='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'></i>
     </div>
     <div class='post-input-div'>
       <div class='post-input-img-div'>
         <img src='' alt='photo'>
       </div>
       <form action='../function_folder/common_function_2.php' target='the-iframe' method='post' class='story-input-form story-form' data-user-form='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'>
       <input type='text' name='story-input-text' placeholder='Write a public comment...' class='post-input story-text-input' autocomplete='off'>
       <input type='submit' name='story-comment-submit' value='&#8594;' class='post-comment-btn story-btn'>
       </form>
       </div>
     </div>";
   } else {    

    $select_comment_post = "select * from `secret_user_post` where user_unique_id = $post_unique_id and post_unique_id = $post_user_id";
    $comment_post_result = mysqli_query($con, $select_comment_post);
    $comment_post_fetch = mysqli_fetch_assoc($comment_post_result);
    $post_comment_id = $comment_post_fetch["user_id"];
    $post_comment_username = $comment_post_fetch["username"];
    $post_comment_user_id = $comment_post_fetch["user_unique_id"];

    $select_comment_row = "select * from `secret_users_comment` where post_id = $post_comment_id";
    $comment_row_result = mysqli_query($con, $select_comment_row);
    $comment_number = mysqli_num_rows($comment_row_result);
    if($comment_number >= 1) {
      $cm = $comment_number;
    } else {
      $cm = 0;
    } 

     echo
    "<div class='post-div'>
      <div class='post-div-nav'>
     <div class='first-post-div'>
       <div class='post-nav-img-div'>
         <img src='../sign_up_folder/user_image/$friend_picture' alt='photo'>
       </div>
       <div class='post-nav-caption-div'>
       <h3>$post_username</h3>
       <p>$post_user_date</p>
       </div>
       </div>
   </div>
   <div class='post-caption-div-1'>
     <p>$post_user_caption</p>
     </div>
     <div class='post-img-div'>
     <img src='../user_profile_folder/user_post_img/$post_user_img' alt='photo'>
     </div>
     <div class='post-reaction-div'>
     <div class='first-post-reaction-div'>
     <i class='fa-solid fa-face-smile'></i>
     <i class='fa-solid fa-face-smile reaction-i'><sup>$post_user_like</sup></i>
     </div>
     <div class='second-post-reaction-div'>
     <p>$cm comments</p>
     </div>
     </div>
     <div class='post-like-div'>
     <i class='fa-solid fa-plus post-like-i' data-user-id='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'><sup class='like-sup'></sup></i>
     <i class='fa-solid fa-bell comment-btn' data-user-comment='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'></i>
     </div>
     <div class='post-input-div'>
     <div class='post-input-img-div'>
     <img src='' alt='photo'>
     </div>
     <form action='../function_folder/common_function_2.php' target='the-iframe' method='POST' class='post-input-form post-form' data-user-form='$post_user_id'  data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'>
     <input type='text' name='post-input' placeholder='Write a public comment...' class='post-input post-text-input' autocomplete='off'>
     <input type='submit' name='post-comment-submit' value='&#8594;' class='post-comment-btn'>
     </form>
     </div>
     </div>
     ";
    }
   } 
    } else { 
    echo " 
   <div class='post-div'>
     <div class='post-div-nav'>
       <div class='first-post-div'>
         <div class='post-nav-img-div'>
           <img
             src='../user_home_folder/pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png'
             alt='photo'
           />
         </div>
         <div class='post-nav-caption-div'>
           <h3>Peter Drury Football Community</h3>
           <p>14 july 2024</p>
         </div>
       </div>
       <div class='second-post-div'></div>
     </div>
     <div class='post-caption-div-1'>
       <p>Don't call me</p>
     </div>
     <div class='post-img-div'>
       <img
         src='../user_home_folder/pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png'
         alt='photo'
       />
     </div>
     <div class='post-reaction-div'>
       <div class='first-post-reaction-div'>
         <i class='fa-solid fa-face-smile'></i>
         <i class='fa-solid fa-face-smile reaction-i'><sup>2.1k</sup></i>
       </div>
       <div class='second-post-reaction-div'>
         <p>83 comments</p>
       </div>
     </div>
     <div class='post-like-div post-like-div-1'>
       <i class='fa-solid fa-plus'></i>
     </div>
   </div>";
    };


?>
<!-- Testing Ends -->
            </div>
        </div>
    </div>
    
    <div class="friend-profile-about-div hidden">
      <?php 
         include('friend_about.php');
      ?>
    </div>

    <div class="friend-profile-photo-div hidden">
      <?php include('friend_photo.php'); ?>
    </div>

    <div class="friend-profile-list-div hidden">
      <?php include("friend_profile_list.php"); ?>
    </div>


     
     <!-- if(isset($_GET["friend_photos_view"])) {
        include('friend_photo.php');
        echo "<script>
        const bodyCoin = document.querySelector('.body-container');
        bodyCoin.classList.add('hidden');
    </script>";
     } -->
     

     <!-- Modal start here -->
  
  <div class="modal-div-2 hidden">
    <div class="pop-up-div">
        <img src="../sign_up_folder/user_image/<?php echo $friend_picture ?>" alt="pics" class="pop-up-img">
    </div>
  </div>
  
  <div class="modal-div-3 hidden">
      <div class="search-div">
        <form action="" method="post" class="search-form">
            <i class="fa-solid fa-circle-xmark form-cancel"></i>
            <input type="text" placeholder="Search SecretBook" name="search-input-1" class="search-input-1">
            <input type="submit" value="Search" name="search-btn" class="search-btn">
        </form>
    </div>
</div>

<div class="modal-div-4 hidden">
    <div class="comment-div__1">
        <i class="fa-solid fa-circle-xmark comment-cancel"></i>
        <div class="comment-div-1">
            <div class="comment-div-pics">
                <img src="" alt="" class="comment-profile-pics">
            </div>
            <div class="comment-div-2">
                <p>this is my comment</p>
            </div>
        </div>
    </div>
  </div>
  
<div class="modal-div-5 hidden">
    <div class="comment-div">
        <div class="comment-owner-div">  
          <i class="fa-solid fa-circle-xmark more-cancel"></i>
        </div>
        <div class="comment-container-div">
            <div class='comment-owner-div-1'><p class='comment-owner'>SECRET-BOOK</p></div>
        </div>
    </div>
</div>

<div class="modal-div-6 hidden">
    <div class="shortcut-div">
        <li><a href="../index.php"><i class="fa-solid fa-house"></i></a></li>
        <li><a href="#"><i class="fa-solid fa-user-group"></i></a></li>
        <li><a href="#"><i class="fa-solid fa-users-line"></i></a></li>
    </div>
  </div>
  
  <!-- Modal ends here -->
  <iframe name="the-iframe" class="the-iframe-class"></iframe>






</body>
</html>

<?php 
include("friend_profile_control.php");
?>
