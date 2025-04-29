<?php 
include("../include_folder/include.php");
session_start();

if(isset($_SESSION["user_unique_id"])) {
  $user_unique_id = $_SESSION["user_unique_id"];
  $cookie_email = $_SESSION["email"];
  $hashed_cookie_pwd = password_hash($user_unique_id, PASSWORD_BCRYPT, $arrayName = array(12));
  setcookie("SecretBook", $hashed_cookie_pwd, time() + (86400 * 7), "/");
  setcookie("SecretBook1", $cookie_email, time() + (86400 * 7), "/");
  $select_statement_1 = "select * from `secret_users_bio` where user_unique_id = $user_unique_id";
  $bio_query_1 = mysqli_query($con, $select_statement_1);
  $data_row_bio = mysqli_num_rows($bio_query_1);
  if($data_row_bio > 0) {
      $data = mysqli_fetch_assoc($bio_query_1);
      $user_bio = $data["user_bio"];
      $_SESSION["user_bio"] = $user_bio;
  } else {
      $_SESSION["user_bio"] = "Add Some details to let friends know about you better..";
  }

  $online = "online";
  $coming_online = "update `secret_users` set user_online = '$online' where user_unique_id = $user_unique_id";
  $coming_online_result = mysqli_query($con, $coming_online);

} elseif(isset($_COOKIE["SecretBook"]) && isset($_COOKIE["SecretBook1"])) {
  $cookie_value = $_COOKIE["SecretBook"];
  $cookie_value1 = $_COOKIE["SecretBook1"];
  $select_statement_email ="select * from `secret_users` where user_email = '$cookie_value1'";
  $result_query_email = mysqli_query($con, $select_statement_email);
  $row_email = mysqli_fetch_assoc($result_query_email);
  $_SESSION["email"] = $_COOKIE["SecretBook1"];
  $_SESSION["user_unique_id"] = $row_email["user_unique_id"];
  $_SESSION["username"] = $row_email["username"];
  $cookie_value_id = $_SESSION["user_unique_id"];
  if(password_verify($cookie_value_id, $cookie_value)) {
    $user_unique_id = $_SESSION["user_unique_id"];
  } else {
    echo "<script>alert('sorry we cannot log you')</script>";
    echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
  }
  $select_statement_1 = "select * from `secret_users_bio` where user_unique_id = $user_unique_id";
  $bio_query_1 = mysqli_query($con, $select_statement_1);
  $data_row_bio = mysqli_num_rows($bio_query_1);
  if($data_row_bio > 0) {
      $data = mysqli_fetch_assoc($bio_query_1);
      $user_bio = $data["user_bio"];
      $_SESSION["user_bio"] = $user_bio;
  } else {
      $_SESSION["user_bio"] = "Add Some details to let friends know about you better..";
  }

  $select_query1 = "select * from `secret_users` where user_unique_id = $user_unique_id";
  $result_query1 = mysqli_query($con, $select_query1);

  if($result_query1) {
    $data = mysqli_fetch_assoc($result_query1);
    $_SESSION["user_unique_id"] = $user_unique_id;
  }

  $online = "online";
  $coming_online = "update `secret_users` set user_online = '$online' where user_unique_id = $user_unique_id";
  $coming_online_result = mysqli_query($con, $coming_online);

} else {
  echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}

try {
$select_query = "select * from `secret_users` where user_unique_id = $user_unique_id";
$result_query = mysqli_query($con, $select_query);

if($result_query) {
    $data = mysqli_fetch_assoc($result_query);
    $age = $data["age"];
    $location = $data["location"];
    $user_picture = $data["user_picture"];
    $username_num_1 = $data["username"];
} else {
  throw new Exception("Error Processing Request");
}

$select_uploaded_post = "select * from `profile_uploaded` where user_unique_id = $user_unique_id order by post_id desc";
$select_post_result = mysqli_query($con, $select_uploaded_post);

$select_post_result_1 = mysqli_query($con, $select_uploaded_post);


$post_row_count = mysqli_num_rows($select_post_result);
$post_exist = false;

if($post_row_count >= 1) {
  $post_exist = true;
} else {
  $post_exist = false;
}

// notification number

class Notification {
  public $unique_id;
  public $name;
  public $type;
  public $date;

  public function __construct($unique_id, $name, $type, $date)
  {
    $this->unique_id = $unique_id;
    $this->name = $name;
    $this->type = $type;
    $this->date = $date;
  }
}

class Personal_Notification {
  public $unique_id_1;
  public $name_1;
  public $notification_type;
  public $notification_post_id;
  public $date_1;

  public function __construct($unique_id_1, $name_1, $notification_type, $notification_post_id, $date_1)
  {
    $this->unique_id_1 = $unique_id_1;
    $this->name_1 = $name_1;
    $this->notification_type = $notification_type;
    $this->notification_post_id = $notification_post_id;
    $this->date_1 = $date_1;
  }
}

$profile_notification = [];
$profile_notification_1 = [];
$personal_notification = [];
$personal_notification_1 = [];


$notification_number = 0;
$personal_number = 0;

$select_friend_4 = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id or friend_unique_id_2 = $user_unique_id";
$select_friend_result_4 = mysqli_query($con, $select_friend_4);
$select_friend_row_4 = mysqli_num_rows($select_friend_result_4);
// $select_friend_result_22 = mysqli_query($con, $select_friend_1);
if($select_friend_row_4 >= 1) {
  while($select_friend_data_4 = mysqli_fetch_assoc($select_friend_result_4)) {
    $friend_notification_id_7 = $select_friend_data_4["friend_unique_id_1"];
    $friend_notification_id_8 = $select_friend_data_4["friend_unique_id_2"];
    if($user_unique_id == $friend_notification_id_7) {
      $friend_notification_id_9 = $friend_notification_id_8;
     } else {
      $friend_notification_id_9 = $friend_notification_id_7;
     }
     
       $select_friend_notification_12 = "select * from `friend_notification_table` where user_unique_id = $friend_notification_id_9";
       $select_friend_result_12 = mysqli_query($con, $select_friend_notification_12);
       $select_friend_notification_row_12 = mysqli_num_rows($select_friend_result_12);
       if($select_friend_notification_row_12 >= 1) {
        $notification_number += $select_friend_notification_row_12; 
      }

      $select_personal_notification_1 = "select * from `secret_notification_table` where user_unique_id = $friend_notification_id_9 AND friend_unique_id = $user_unique_id OR friend_unique_id = $user_unique_id";
      $personal_notification_result_1 = mysqli_query($con, $select_personal_notification_1);
      $personal_notification_row_1 = mysqli_num_rows($personal_notification_result_1);
      if($personal_notification_row_1 >= 1) {
        $personal_number = $personal_notification_row_1;
      }
  }
}

// notification number ends here

 // If Post Form Data send and no File Upload
 if ( empty( $_FILES ) && ! empty( $_POST ) ) {
    // Store Post Form Data in Session Variable
    $_SESSION["POST_1"] = $_POST;
    // Reload Page if there were no outputs
    if ( ! headers_sent() ) {
        // Build URL to reload with GET Parameters
        // Change https to http if your site has no ssl
        $location_1 = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER['PHP_SELF'];
        // Reload Page
        echo "<script>
        window.location.href = '$location_1';
        </script>";
        // Stop any further progress
        die();
    }
  }


  
  // Rebuilt POST Form Data from Session Variable
  if ( isset( $_SESSION["POST_1"] ) ) {
    $_POST = $_SESSION["POST_1"];
    // Tell PHP that POST is sent
    $_SERVER['REQUEST_METHOD'] = 'POST';
  }


} catch (Exception $e) {
  echo "<script>alert('Something went wrong. please give us some time to put things in order')</script>";
  echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}
 ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <script defer src="user_profile.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>

    </style>
    
</head>

<body>

    <div class="too-small-1">
        <h1>Sorry, Move to a bigger devices</h1>
    </div>
    <div class="too-big-1">
        <h1>Sorry, Move to a smaller devices</h1>
    </div>


    <div class="navigation-div">
        <div class="navigation-div-1">
            <div class="nav-flex1">
                <img src="./user_profile_images/secretbook-high-resolution-logo-transparent.png" alt="pics"
                    class="nav-img">
                <input type="text" placeholder="Search SecretBook" name="Search_input" class="search-input search-input-div" autocomplete="off">
                <i class="fa-solid fa-magnifying-glass nav-div search-icon"></i>
            </div>
        </div>
        <div class="navigation-div-2">
            <div class="div-nav">
                <nav class="nav">
                    <li><a href="../user_home_folder/user_home.php" target="_self"><i class="fa-solid fa-house"></i></a></li>
                    <li><a href="../friends_folder/friends.php" target="_self"><i class="fa-solid fa-user-group"></i></a></li>
                    <li><a href="#popup1"><i class="fa-solid fa-users-line"></i></a></li>
                </nav>
            </div>
        </div>
        <div class="navigation-div-3">
            <div class="nav-flex2">
                <div class="div-nav1">
                    <div class="find-friend-div">
                        <p>Find friends</p>
                    </div>
                    <div class="nav-div table-cells-icon"><i class="fa-solid fa-table-cells"></i></div>
                    <div class="nav-div nav-message-btn"><i class="fa-solid fa-message"></i></div>
                    <div class="nav-div nav-message-btn-1"><i class="fa-solid fa-message"></i></div>
                    <div class="nav-div notification-div-bell"><i class="fa-solid fa-bell notification-bell"></i> <div class="notification-num <?php if(!$notification_number) { echo 'hidden'; } ?>" > <?php echo $notification_number; ?></div></div>
                    <div class="nav-div notification-div-bell-1"><i class="fa-solid fa-bell notification-bell-1"></i> <div class="notification-num <?php if(!$notification_number) { echo 'hidden'; } ?>" > <?php echo $notification_number; ?></div> </div>
                    <div class="nav-div1"><img src="../sign_up_folder/user_image/<?php echo $user_picture ?>" alt="pics" class="nav-img1"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- navigation ends here -->
    <!-- header start here -->
    <div class="header-container">
        <div class="header-img-div">
            <img src="../sign_up_folder/user_image/<?php echo $user_picture ?>" alt="" class="header-img1">
        </div>
        <div class="header-img-div-1">
            <div class="header-div">
                <div class="header-img-div-2">
                    <img src="../sign_up_folder/user_image/<?php echo $user_picture ?>" alt="pic" class="header-img2">
                </div>
              <h1><?php echo $username_num_1; ?></h1>
            </div>
            <div class="header-div1">
                <button class="header-btn1"><i class="fa-solid fa-plus"></i> Add Stories</button>
                <button class="header-btn2"><i class="fa-solid fa-pen"></i> Edit Profile</button>
                <button class="header-btn3"><i class="fa-solid fa-chevron-left"></i></button>
            </div>
        </div>
        <div class="line-up">
            <nav class="line-up-nav">
                <li class="li-1"><a href="user_profile.php">Post</a></li>
                <li class="li-2"><a href="user_profile.php?user_about_view">About</a></li>
                <li class="li-3"><a href="user_profile.php?user_friends_view">Friends</a></li>
                <li class="li-4"><a href="user_profile.php?user_photos_view">Photos</a></li>
                <li class="li-5"><a href="user_profile.php?user_videos_view">Videos</a></li>
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
                        <p class="p-bio"><?php echo $_SESSION["user_bio"]; ?></p>
                    </div>
                </div>
                <div class="body-intro-div1">
                    <h3>Intro</h3>
                    <form action="" method="post" class="bio-form hidden">
                        <input type="text" name="bio-input" placeholder="Write your bio" class="bio-input" autocomplete='off'>
                        <br>
                        <button class="bio-cancel-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                        <input type="submit" value="&#8599;" class="bio-send-btn" name="bio-btn">
                    </form>
                    <button class="add-bio-btn">Add bio</button>
                    <button class="edit-detail-btn">Edit details</button>
                </div>
                <div class="body-intro-div2">
                    <h3>Photos</h3>
                    <a href="./user_photo.php" target="_self">See All Photos</a>
                </div>
                <div class="body-intro-div3">
                    <h3>Friends</h3>
                    <a href="./user_friend.php" target="_self">See All Friends</a>
                </div>
            </div>
            <div class="body-div2">
                <form action="" method="post" class="body-div-form">
                    <div class="body-div-form1">
                        <img src="../sign_up_folder/user_image/<?php echo $user_picture ?>" alt="pics" class="body-img1">
                    </div>
                    <input type="text" name="what_on_mind" placeholder="What's on your mind?" class="form-input-1" readonly>
                    <!-- <button class="send-btn"><i class="fa-solid fa-paper-plane"></i></button> -->
                    <input type="submit" value="&#8599;" class="send-btn" name="user-mindset">
                </form>
            
                <div class="born-div">
                    <div class="born-div-1">
                        <div class="born-div-2">
                            <div class="born-div-span">
                                <img src="../sign_up_folder/user_image/<?php echo $user_picture ?>" alt="pics" class="born-img1">
                                <span class="born-name">
                                    <?php echo $username_num_1; ?>
                                </span>
                            </div>
                            <span class="born-date">date</span>
                            <span class="born-icon"><i class="fa-solid fa-clock"></i></span>
                            <span class="born-icon"><i class="fa-solid fa-people-group"></i></span>
                        </div>
                        <div class="born-div-3">
                            <i class="fa-solid fa-cake-candles"></i>
                            <p>
                                <?php echo $age; ?>
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
                               <img src='../sign_up_folder/user_image/$user_picture' alt='photo' />
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
       <div class='second-post-div'>
       <i class='fa-solid fa-bell'></i>
       <i class='fa-solid fa-circle-xmark fake-x'></i>
       <i class='fa-solid fa-circle-xmark x-delete-story delete-story hidden' data-story-id='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'></i>
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
         <img src='../sign_up_folder/user_image/$user_picture' alt='photo'>
       </div>
       <div class='post-nav-caption-div'>
       <h3>$post_username</h3>
       <p>$post_user_date</p>
       </div>
       </div>
       <div class='second-post-div'>
       <i class='fa-solid fa-bell'></i>
       <i class='fa-solid fa-circle-xmark fake-xx'></i>
       <i class='fa-solid fa-circle-xmark x-delete-post delete-post hidden' data-post-id='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'></i>
     </div>
   </div>
   <div class='post-caption-div'>
     <p>$post_user_caption</p>
     </div>
     <div class='post-img-div'>
     <img src='user_post_img/$post_user_img' alt='photo'>
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
     <div class='post-caption-div'>
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
    </div>

    <?php 
     if(isset($_GET["user_about_view"])) {
        include('user_about.php');
        echo "<script>
        const bodyCoin = document.querySelector('.body-container');
        bodyCoin.classList.add('hidden');
        </script>";
     }

     if(isset($_GET["user_photos_view"])) {
        include('user_photo.php');
        echo "<script>
        const bodyCoin = document.querySelector('.body-container');
        bodyCoin.classList.add('hidden');
        </script>";
     }

     if(isset($_GET["user_friends_view"])) {
      include("user_friend.php");
      echo "<script>
      const bodyCoin = document.querySelector('.body-container');
      bodyCoin.classList.add('hidden');
      </script>";
     }
     ?>


    <!-- Modal start here -->
    <div class="modal-div-1 hidden">
      <div class="notification-div">
            <div class="notification-div-3">
                <h3>Notifications</h3>
                <i class="fa-solid fa-circle-xmark cancel-notification"></i>
            </div>
        <div class="notification-div-1">
            <button class="notification-btn notification-see-all-btn">See All</button>
            <div class="notification-btn1">Personal <div class="notification-num-1 <?php if(!$personal_number) { echo 'hidden'; } ?>" > <?php echo $personal_number; ?></div></div>
        </div>

        <?php
        $no_notification_true = 0;
        $i = 0;
        $ii = 0;
        $select_friend_1 = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id or friend_unique_id_2 = $user_unique_id";
        $select_friend_result_1 = mysqli_query($con, $select_friend_1);
        $select_friend_row_1 = mysqli_num_rows($select_friend_result_1);
        $select_friend_result_22 = mysqli_query($con, $select_friend_1);
        if($select_friend_row_1 >= 1) {
          while($select_friend_data_1 = mysqli_fetch_assoc($select_friend_result_1)) {
            $friend_notification_id_1 = $select_friend_data_1["friend_unique_id_1"];
            $friend_notification_id_2 = $select_friend_data_1["friend_unique_id_2"];
            if($user_unique_id == $friend_notification_id_1) {
              $friend_notification_id_3 = $friend_notification_id_2;
             } else {
              $friend_notification_id_3 = $friend_notification_id_1;
             }
             
             while($select_friend_data_11 = mysqli_fetch_assoc($select_friend_result_22)) {
              $friend_notification_id_5 = $select_friend_data_11["friend_unique_id_1"];
              $friend_notification_id_6 = $select_friend_data_11["friend_unique_id_2"];
              if($user_unique_id == $friend_notification_id_6) {
                $friend_notification_id_4 = $friend_notification_id_5;
               } else {
                $friend_notification_id_4 = $friend_notification_id_6;
               }
               $select_friend_notification_11 = "select * from `friend_notification_table` where user_unique_id = $friend_notification_id_4";
               $select_friend_result_11 = mysqli_query($con, $select_friend_notification_11);
               $select_friend_notification_row_11 = mysqli_num_rows($select_friend_result_11);
               if($select_friend_notification_row_11 >= 1) {
                 while($select_friend_notification_data_11 = mysqli_fetch_assoc($select_friend_result_11)) {
                   $i += 1;
                  }
                }
              }


              $select_friend_notification = "select * from `friend_notification_table` where user_unique_id = $friend_notification_id_3";
              $select_friend_result = mysqli_query($con, $select_friend_notification);
              $select_friend_notification_row = mysqli_num_rows($select_friend_result);

              if($select_friend_notification_row >= 1) {
                while($select_friend_notification_data = mysqli_fetch_assoc($select_friend_result)) {
                  $pffhh = [];
                  $notification_username = $select_friend_notification_data["username"];
                  $notification_type_1 = $select_friend_notification_data["notification_type"];
                  $notification_unique_id = $select_friend_notification_data["user_unique_id"];
                  $notification_date = $select_friend_notification_data["notification_date"];
                  $notification_id = $select_friend_notification_data["notification_id"];
  
                  $user_notification = new Notification($notification_unique_id, $notification_username, $notification_type_1, $notification_date);
                  $pffhh["username"] = $user_notification->name;
                  $pffhh["user_unique_id"] = $user_notification->unique_id;
                  $pffhh["notification_type"] = $user_notification->type;
                  $pffhh["notification_date"] = $user_notification->date;
  
                  $profile_notification[$notification_id] = $pffhh;
                  $profile_notification_1[$ii] = $notification_id;
                  $ii += 1;

                }

              }

            }

            $notification_count = count($profile_notification);
            rsort($profile_notification_1);
            $iii = 0;
            if($notification_count >= 1) {
              while($iii < $notification_count) {
                $ffttd = $profile_notification_1[$iii];
                $notification_username_22 = $profile_notification[$ffttd]["username"];
                $notification_type_1_22 = $profile_notification[$ffttd]["notification_type"];
                $notification_unique_id_22 = $profile_notification[$ffttd]["user_unique_id"];
                $notification_date_22 = $profile_notification[$ffttd]["notification_date"];
                // $notification_id_22 = $$profile_notification[$ffttd];
                
            $select_notification_pic = "select * from `secret_users` where user_unique_id = $notification_unique_id_22 and username = '$notification_username_22'";
            $select_notification_pic_result = mysqli_query($con, $select_notification_pic);
            $select_notification_pic_row = mysqli_num_rows($select_notification_pic_result);
            if($select_notification_pic_row >= 1) {
              $select_notification_pic_data = mysqli_fetch_assoc($select_notification_pic_result);
              $notification_pic = $select_notification_pic_data["user_picture"];
            }

              echo "
               <div class='notification-div2'>
                <div class='notification-div-2'>
                   <div class='notification-div-img'>
                     <img src='../sign_up_folder/user_image/$notification_pic' alt='pics' class='notification-img'>
                     <div class='notification-icon-div'><i class='fa-solid fa-cloud'></i></div>
                    </div>
                  <div class='notification-div-4'>
                     <p>$notification_username_22 just post a new <b>story</b></p>
                     <p>$notification_date_22</p>
                  </div>
                 </div>
                <div class='notification-recent'>
                  <div class='update-div'></div>
                  </div>
              </div>  ";
              // $no_notification_true += 1;
              $iii += 1;
          }
        } else { if ($i > 1) {$no_notification_true = 2;}
          ?>
          <div class='notification-div2 <?php if ($no_notification_true >= 1) { echo "hidden"; }; ?> '>
          <div class='notification-div-2'>
                   <div class='notification-div-img'>
                   <img src='./user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='pics' class='notification-img'>
                   <div class='notification-icon-div'></div>
                   </div>
                   <div class='notification-div-4'>
                   <p>Welcome to SecretBook! Tap here to find people you know and add them as friends</p>
                   <p>12.2020.23</p>
                   </div>
                   </div>
                   <div class='notification-recent'>
                   <div class='update-div'></div>
                   </div>
                   </div>

                   <?php

              }

          } else {
            echo "
            <div class='notification-div2'>
            <div class='notification-div-2'>
                     <div class='notification-div-img'>
                     <img src='./user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='pics' class='notification-img'>
                     <div class='notification-icon-div'></div>
                     </div>
                     <div class='notification-div-4'>
                     <p>Welcome to SecretBook! Get out there and gather some companions</p>
                     <p>12.2020.23</p>
                     </div>
                     </div>
                     <div class='notification-recent'>
                     <div class='update-div'></div>
                     </div>
                     </div> ";
          }
        ?>


     </div>
     <div class="notification-personal-div hidden">
      <div class="personal-div-nav">
      <i class="fa-solid fa-arrow-left personal-back-btn"></i>
      </div>
      <?php 
      $p = 0;
      $pp = 0;
      $ppp = 0;
      $no_personal_true = 0;
      $notification_limit = 3;
      $select_friend_10 = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id OR friend_unique_id_2 = $user_unique_id";
      $select_friend_result_10 = mysqli_query($con, $select_friend_10);
      $select_friend_row_10 = mysqli_num_rows($select_friend_result_10);
      // $select_friend_result_22 = mysqli_query($con, $select_friend_1);
      if($select_friend_row_10 >= 1) {
        while($personal_select_friend_data = mysqli_fetch_assoc($select_friend_result_10)) {
          $friend_unique_id_21 = $personal_select_friend_data["friend_unique_id_1"];
          $friend_unique_id_22 = $personal_select_friend_data["friend_unique_id_2"];
          if($user_unique_id == $friend_unique_id_21) {
            $friend_unique_id_23 = $friend_unique_id_22; 
          } else {
            $friend_unique_id_23 = $friend_unique_id_21;
          }

          $select_personal_notification = "select * from `secret_notification_table` where user_unique_id = $friend_unique_id_23 AND friend_unique_id = $user_unique_id";
          $personal_notification_result = mysqli_query($con, $select_personal_notification);
          $personal_notification_row = mysqli_num_rows($personal_notification_result);
          if($personal_notification_row >= 0) {
           
            while($personal_notification_data_1 = mysqli_fetch_assoc($personal_notification_result_1)) {
              $pttyh = [];
              $personal_unique_id = $personal_notification_data_1["user_unique_id"];
              $personal_username = $personal_notification_data_1["username"];
              $personal_type = $personal_notification_data_1["notification_type"];
              $personal_post_id = $personal_notification_data_1["notification_post_id"];
              $personal_date = $personal_notification_data_1["notification_date"];
              $personal_notification_id = $personal_notification_data_1["notification_id"];
              
              $personal_user = new Personal_Notification($personal_unique_id, $personal_username, $personal_type, $personal_post_id, $personal_date);
              $pttyh["user_unique_id"] = $personal_user->unique_id_1;
              $pttyh["username"] = $personal_user->name_1;
              $pttyh["type"] = $personal_user->notification_type;
              $pttyh["post_id"] = $personal_user->notification_post_id;
              $pttyh["date"] = $personal_user->date_1;

              $personal_notification[$personal_notification_id] = $pttyh;
              $personal_notification_1[$p] = $personal_notification_id;
              $p += 1;
              $ppp += 1;
            }
          } else {
            $select_personal_notification_1 = "select * from `secret_notification_table` where friend_unique_id = $user_unique_id ";
            $personal_notification_result_1 = mysqli_query($con, $select_personal_notification_1);
            $personal_notification_row_1 = mysqli_num_rows($personal_notification_result_1);

            
            while($personal_notification_data = mysqli_fetch_assoc($personal_notification_result)) {
              $pttyh = [];
              $personal_unique_id = $personal_notification_data["user_unique_id"];
              $personal_username = $personal_notification_data["username"];
              $personal_type = $personal_notification_data["notification_type"];
              $personal_post_id = $personal_notification_data["notification_post_id"];
              $personal_date = $personal_notification_data["notification_date"];
              $personal_notification_id = $personal_notification_data["notification_id"];
              
              $personal_user = new Personal_Notification($personal_unique_id, $personal_username, $personal_type, $personal_post_id, $personal_date);
              $pttyh["user_unique_id"] = $personal_user->unique_id_1;
              $pttyh["username"] = $personal_user->name_1;
              $pttyh["type"] = $personal_user->notification_type;
              $pttyh["post_id"] = $personal_user->notification_post_id;
              $pttyh["date"] = $personal_user->date_1;

              $personal_notification[$personal_notification_id] = $pttyh;
              $personal_notification_1[$p] = $personal_notification_id;
              $p += 1;
              $ppp += 1;
            }
          }
        }

        $personal_notification_count = count($personal_notification);
        // echo $personal_notification_count;
        rsort($personal_notification_1);
        if($personal_notification_count >= 1) {
          while($pp < 3) {
            $pttyh = $personal_notification_1[$pp];
                $notification_username_25 = $personal_notification[$pttyh]["username"];
                $notification_type_1_25 = $personal_notification[$pttyh]["type"];
                $notification_unique_id_25 = $personal_notification[$pttyh]["user_unique_id"];
                $notification_date_25 = $personal_notification[$pttyh]["date"];
                // $notification_id_225= $$personal_notification[$pttyh];
                
            $select_notification_pic_1 = "select * from `secret_users` where user_unique_id = $notification_unique_id_25 and username = '$notification_username_25'";
            $select_notification_pic_result_1 = mysqli_query($con, $select_notification_pic_1);
            $select_notification_pic_row_1 = mysqli_num_rows($select_notification_pic_result_1);
            if($select_notification_pic_row_1 >= 1) {
              $select_notification_pic_data_1 = mysqli_fetch_assoc($select_notification_pic_result_1);
              $notification_pic_1 = $select_notification_pic_data_1["user_picture"];
            }

              echo "
               <div class='notification-div2'>
                <div class='notification-div-2'>
                   <div class='notification-div-img'>
                     <img src='../sign_up_folder/user_image/$notification_pic_1' alt='pics' class='notification-img'>"; ?> <?php 
                           if($notification_type_1_25 == "post comment") {
                              echo "<div class='notification-icon-div'><i class='fa-solid fa-user-pen'></i></div>";
                          } elseif($notification_type_1_25 == "story comment") {
                              echo "<div class='notification-icon-div'><i class='fa-solid fa-user-pen'></i></div>";
                          } elseif($notification_type_1_25 == "post like") {
                              echo "<div class='notification-icon-div'><i class='fa-solid fa-user-check'></i></div>"; 
                          } elseif($notification_type_1_25 == "friend request") {
                              echo "<div class='notification-icon-div'><i class='fa-solid fa-user-clock'></i></div>";
                          } elseif($notification_type_1_25 == "friend accepted") {
                              echo "<div class='notification-icon-div'><i class='fa-solid fa-people-arrows'></i></div>";
                          } else {
                              echo "<div class='notification-icon-div'><i class='fa-solid fa-user-check'></i></div>"; 
                          }
                          echo "  
                    </div>
                  <div class='notification-div-4'>"; ?>
                  <?php 
                  if($notification_type_1_25 == "post comment") {
                    echo "<p>$notification_username_25 commented on your <b>post</b></p>";
                  } elseif($notification_type_1_25 == "story comment") {
                    echo "<p>$notification_username_25 commented on your <b>story</b></p>";
                  } elseif($notification_type_1_25 == "post like") {
                    echo "<p>$notification_username_25 liked your <b>post</b></p>";
                  } elseif($notification_type_1_25 == "friend request") {
                    echo "<p>$notification_username_25 sent you a friend request</p>";
                  } elseif($notification_type_1_25 == "friend accepted") {
                    echo "<p>$notification_username_25 accept your friend request</p>";
                  } else {
                    echo "<p>$notification_username_25 liked your <b>story</b></p>";
                  }
                     echo " 
                     <p>$notification_date_25</p>
                  </div>
                 </div>
                <div class='notification-recent'>
                  <div class='update-div'></div>
                  </div>
              </div>  ";
              $pp += 1;
          }
      } else { if($ppp > 1) {$no_personal_true = 2;};
      ?>
      <div class='notification-div2 <?php if ($no_personal_true >= 1) {echo "hidden"; }; ?>'>
          <div class='notification-div-2'>
            <div class='notification-div-img'>
              <img src='./user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='pics' class='notification-img'>
              <div class='notification-icon-div'></div>
            </div>
            <div class='notification-div-4'>
              <p>Welcome to SecretBook! Tap here to find people you know and add them as friends</p>
              <p>12.2020.23</p>
            </div>
            </div>
            <div class='notification-recent'>
              <div class='update-div'></div>
            </div>
       </div>
       <?php }
      } else {
        echo "
        <div class='notification-div2'>
        <div class='notification-div-2'>
                 <div class='notification-div-img'>
                 <img src='./user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='pics' class='notification-img'>
                 <div class='notification-icon-div'></div>
                 </div>
                 <div class='notification-div-4'>
                 <p>Welcome to SecretBook! Get out there and gather some companions</p>
                 <p>12.2020.23</p>
                 </div>
                 </div>
                 <div class='notification-recent'>
                 <div class='update-div'></div>
                 </div>
                 </div> ";
      }
       ?>

     </div>
  </div>

  <div class="modal-div-2 hidden">
    <div class="pop-up-div">
        <img src="../sign_up_folder/user_image/<?php echo $user_picture ?>" alt="pics" class="pop-up-img">
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
        <li><a href="../user_home_folder/user_home.php" target="_self"><i class="fa-solid fa-house"></i></a></li>
        <li><a href="../friends_folder/friends.php"><i class="fa-solid fa-user-group"></i></a></li>
        <li><a href="#popup1"><i class="fa-solid fa-users-line"></i></a></li>
    </div>
  </div>

  <!-- <div class="modal-div-7 hidden">
    <div class="edit-profile-div">
        <form action="" method="post" enctype="multipart/form-data" class="edit-profile-form">
            <label for="edit-cover" class="edit-cover-label"> <i class="fa-solid fa-plus edit-cover-plus"></i>
                <input type="file" name="edit-cover-input" class="edit-cover-input hidden" id="edit-cover">
            </label>
            <label for="edit-profile" class="edit-profile-label"> <i class="fa-solid fa-plus edit-profile-plus"></i>
                <input type="file" name="edit-profile-input" class="edit-profile-input hidden" id="edit-profile">
            </label>
            <div class="edit-profile-div1">
                <div class="edit-profile-div2">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                    <input type="submit" name="add-story-btn" value="&#8599;" class="edit-profile-btn">
            </div>
        </form>
    </div>
  </div> -->

  <div class="modal-div-8 hidden">
    <div class="add-story-div">
        <form action="" method="post" enctype="multipart/form-data" class="add-story-form">
            <label for="add-pic" class="add-story-label"> <i class="fa-solid fa-plus add-story-plus"></i>
                <input type="file" name="add-story-pics" id="add-pic" class="add-story-pics hidden">
            </label>
            <div>
                <input type="text" name="add-story-caption" placeholder="Description" class="add-story-caption" autocomplete="off">
                <div class="add-story-div2">
                    <div class="add-story-div1">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <input type="submit" name="add-story-btn" value="&#8599;" class="add-story-btn">
                </div>
            </div>
        </form>
    </div>
  </div>

  <div class="modal-div-9 hidden">
      <div class="modal-9-div">
        <div class="modal-9-div-nav">
          <div class="modal-9-div-nav-1">
            <h3>Create post</h3>
          </div>
          <i class="fa-solid fa-circle-xmark modal-9-cancel"></i>
        </div>
        <div class="modal-9-div-body">
        <form action="" method="post" class="modal-9-form">
          <input type="text" name="modal-9-input" class="modal-9-input" placeholder="What on your Mind?" autocomplete="off">
          <input type="submit" value="post" name="modal-9-submit" class="modal-9-btn">
        </form>
        <div class="color-picker-div">
          <div class="color-pick-1 color-div color-pick-1-i"></div>
          <div class="color-pick-2 color-div color-pick-2-i"></div>
          <div class="color-pick-3 color-div color-pick-3-i"></div>
          <div class="color-pick-4 color-div color-pick-4-i"></div>
          <div class="color-pick-5 color-div color-pick-5-i"></div>
          <div class="color-pick-6 color-div color-pick-6-i"></div>
        </div>
        <p>Choose Color</p>
        </div>
      </div>
    </div>

    <div class="modal-div-10 hidden">
      <div class="modal-div-10-first">
        <div class="cancel-modal-10-div">
          <i class='fa-solid fa-circle-xmark x-cancel-fake'></i>
        </div>
        <div class="modal-10-info-div">
          <p>Do you want to <b>Permanently delete this post??</b>/if Yes click the red x button to delete</p>
        </div>
      </div>
    </div>

    <div class="modal-div-11 hidden">
      <div class="search-div-1">
        <div class="search-div-nav">
          <p>Recent</p>
          <!-- <p>...</p> -->
          <i class="fa-solid fa-xmark search-cancel-x"></i>
        </div>
        <div class="search-result-div">
          <?php 
            $limit = 3;
            $select_recent_query_1 = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$username_num_1' limit $limit";
            $recent_result_1 = mysqli_query($con, $select_recent_query_1);
            $recent_num_row_1 = mysqli_num_rows($recent_result_1);
            if($recent_num_row_1 >= 1) {
              while($recent_data_1 = mysqli_fetch_assoc($recent_result_1)){
                $search_recent_result_1 = $recent_data_1["search_result"];
                $search_id_1 = $recent_data_1["search_id"];
                $search_user_id_1 = $recent_data_1["user_unique_id"];
                $search_username_1 = $recent_data_1["username"];

                $search_user_2 = "select * from `secret_users` where username = '$search_recent_result_1'";
                $search_result_3 = mysqli_query($con, $search_user_2);
                $search_num_2 = mysqli_num_rows($search_result_3);
    
                if($search_num_2) {
                  while($recent_data_4 = mysqli_fetch_array($search_result_3)) {
                    $search_user_id_2 = $recent_data_4["user_unique_id"];
                  }
                }

                  echo " <div class='result-div result-recent-result-div'>
                  <div class='search-icon-div'><i class='fa-solid fa-clock'></i></div>
                    <div class='search-text-div search-text-div-1' data-search-value='$search_recent_result_1' data-user-id='$user_unique_id' data-username='$username_num_1' data-search-value-1='$search_user_id_2'><p>$search_recent_result_1</p></div>
                    <div class='search-remove-div remove-recent-x' data-recent-id='$search_id_1' data-recent-user-id='$search_user_id_1' data-recent-username='$search_username_1'><i class='fa-solid fa-xmark'></i></div>
                  </div>";
              }
            }
          
          ?>
        </div>
        <div class="see-all-search">
          <?php 
          $select_see_recent = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$username_num_1'";
          $see_recent_result = mysqli_query($con, $select_see_recent);
          $see_recent_num = mysqli_num_rows($see_recent_result);
          if($see_recent_num > 3) {
            echo "<p class='search-see-all-p'>See all</p>";
          }
          ?>
        </div>  
      </div>
    </div>

    <div class="modal-div-12 hidden">
      <div class="search-recent-div">
        <div class="search-recent-nav-div">
          <h2>Search Result</h2>
          <div class="remove-recent-div">
            <i class="fa-solid fa-xmark search-see-all-x"></i>
          </div>
        </div>
        <div class="search-recent-div-1">
          


          <?php 

            $select_recent_query_2 = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$username_num_1'";
            $recent_result_2 = mysqli_query($con, $select_recent_query_2);
            $recent_num_row_2 = mysqli_num_rows($recent_result_2);
            if($recent_num_row_2 >= 1) {
              while($recent_data_2 = mysqli_fetch_assoc($recent_result_2)){
                $search_recent_result_2 = $recent_data_2["search_result"];
                $search_id_2 = $recent_data_2["search_id"];
                $search_user_id_2 = $recent_data_2["user_unique_id"];
                $search_username_2 = $recent_data_2["username"];
                $search_date_2 = $recent_data_2["search_date"];

                $search_user_3 = "select * from `secret_users` where username = '$search_recent_result_2'";
                $search_result_4 = mysqli_query($con, $search_user_3);
                $search_num_3 = mysqli_num_rows($search_result_4);
    
                if($search_num_3) {
                  while($recent_data_5 = mysqli_fetch_array($search_result_4)) {
                    $search_user_id_3 = $recent_data_5["user_unique_id"];
                  }
                }

               
                echo "
                    <div class='see-all-result-div result-recent-result-div'>
                        <div class='see-all-result-div-1 search-text-div-1' data-search-value='$search_recent_result_2' data-user-id='$user_unique_id' data-username='$username_num_1' data-search-value-1='$search_user_id_3'>
                          <p>$search_recent_result_2</p>
                          <p>$search_date_2</p>
                        </div>
                      <div class='search-remove-div'>
                        <div class='search-remove-div remove-recent-x' data-recent-id='$search_id_2' data-recent-user-id='$search_user_id_2' data-recent-username='$search_username_2'><i class='fa-solid fa-xmark'></i></div>
                      </div>
                    </div>";
              }
            } else {
              echo "
                    <div class='see-all-result-div'>
                        <div class='see-all-result-div-1'>
                          <p>Sorry, no search history found.</p>
                          <p>12.17.2020</p>
                        </div>
                      <div class='search-remove-div'>
                      </div>
                    </div>";
            }
          

          ?>
        


        </div>
      </div>
    </div>

    <div id="popup1" class="overlay">
      <div class="popup">
        <h2>SecretBook</h2>
        <a class="close" href="#">&times;</a>
        <div class="content">
          Thanks for using SecretBook, the feature you're currently looking for
          is not available at the moment. Try again Later..!!!
        </div>
      </div>
    </div>

    <div class="modal-div-13 hidden">

      <div class="message-inbox-div">

        <div class="message-nav-div">
           <h2>Chats</h2>
          <div class="new-chat-div">
            <i class="fa-solid fa-pen-to-square new-message-i"></i>
            <i class="fa-solid fa-xmark close-message-x"></i>
          </div>
        </div>
        <div class="message-input-div">
          <input type="text" name="message-inbox-input" class="message-search-input" placeholder="Search Messenger" readonly>
        </div>
        <div class="message-category-div"><p>Inbox</p></div>

        <div class="message-users-div">

          
        </div>
      </div>


    </div>
    <!-- Modal ends here -->
    <iframe name="the-iframe" class="the-iframe-class"></iframe>

</body>

</html>

<?php 

include("./profile_data_control/profile_data_control.php");
?>