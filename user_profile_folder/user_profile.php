<?php 
include("../include_folder/include.php");
session_start();

if(isset($_SESSION["user_unique_id"])) {
  $user_unique_id = $_SESSION["user_unique_id"];
  $cookie_email = $_SESSION["email"];
  $hashed_cookie_pwd = password_hash($user_unique_id, PASSWORD_BCRYPT, $arrayName = array(12));
  setcookie("SecretBook", $hashed_cookie_pwd, time() + (86400 * 7), "/");
  setcookie("SecretBook1", $cookie_email, time() + (86400 * 7), "/");
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
  // echo "Error Message ".$e->getMessage();
  echo "<script>alert('Something went wrong. please give us some time to put things in order')</script>";
  // header("location: ../user_profile_folder/user_profile.php");
}
 ?> 

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
                <input type="text" placeholder="Search SecretBook" name="Search_input" class="search-input">
                <i class="fa-solid fa-magnifying-glass nav-div search-icon"></i>
            </div>
        </div>
        <div class="navigation-div-2">
            <div class="div-nav">
                <nav class="nav">
                    <li><a href="../index.php"><i class="fa-solid fa-house"></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-user-group"></i></a></li>
                    <li><a href="#"><i class="fa-solid fa-users-line"></i></a></li>
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
                    <div class="nav-div"><i class="fa-solid fa-message"></i></div>
                    <div class="nav-div"><i class="fa-solid fa-bell notification-bell"></i></div>
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
                <button class="header-btn3"><a href="../log_out_folder/log_out.php"><i class="fa-solid fa-chevron-left"></i></a></button>
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
                    <a href="#">See All Photos</a>
                </div>
                <div class="body-intro-div3">
                    <h3>Friends</h3>
                    <a href="#">See All Friends</a>
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
// if ($result_query_4) {
//     while ($row_data = mysqli_fetch_assoc($result_query_4)) {
//         $user_post_pic = htmlspecialchars($row_data["user_post_img"]);
//         $user_post_caption = htmlspecialchars($row_data["user_post_caption"]);
//         $user_post_like = htmlspecialchars($row_data["user_post_like"]);
//         $username_post = htmlspecialchars($row_data["username"]);
//         $post_date = htmlspecialchars($row_data["post_date"]);
//         $user_id = htmlspecialchars($row_data["user_id"]);
//         $post_unique_id_1 = htmlspecialchars(($row_data["user_unique_id"]));

//         $select_post_username_pics = "select * from `secret_users` where user_unique_id = $post_unique_id_1";
//         $post_result_1 = mysqli_query($con, $select_post_username_pics);
//         $user_post_data = mysqli_fetch_assoc($post_result_1);
//         $user_post_username_pic = $user_post_data["user_picture"]; 
//         echo "
//          <div class='post-div'>
//                     <div class='post-div-nav'>
//                       <div class='first-post-div'>
//                         <div class='post-nav-img-div'>
//                           <img src='../sign_up_folder/user_image/$user_post_username_pic' alt='photo' />
//                         </div>
//                         <div class='post-nav-caption-div'>
//                           <h3>$username_post</h3>
//                           <p>$post_date</p>
//                         </div>
//                       </div>
//                       <div class='second-post-div'>
//                         <i class='fa-solid fa-bell'></i>
//                         <i class='fa-solid fa-house-chimney-crack'></i>
//                       </div>
//                     </div>
//                     <div class='post-caption-div'>
//                       <p>$user_post_caption</p>
//                     </div>
//                     <div class='post-img-div'>
//                       <img src='./user_post_img/$user_post_pic' alt='photo' />
//                     </div>
//                     <div class='post-reaction-div'>
//                       <div class='first-post-reaction-div'>
//                         <i class='fa-solid fa-face-smile'></i>
//                         <i class='fa-solid fa-face-smile reaction-i'><sup>$user_post_like</sup></i>
//                       </div>
//                       <div class='second-post-reaction-div'>
//                         <p>83 comments</p>
//                       </div>
//                     </div>
//                     <div class='post-like-div'>
//                       <i class='fa-solid fa-plus post-like-i' data-user-id='$user_id'><sup class='like-sup'></sup></i>
//                       <i class='fa-solid fa-bell comment-btn comment-view' data-user-comment='$user_id'></i>
//                     </div>
//                     <div class='post-input-div'>
//                       <div class='post-input-img-div'>
//                         <img src='../sign_up_folder/user_image/$user_picture' alt='photo' />
//                       </div>
//                       <form action='' method='post' class='post-input-form' data-user-form='$user_id'>
//                         <input
//                           type='text'
//                           name='post-input'
//                           placeholder='Write a public comment...'
//                           class='post-input'
//                           autocomplete='off'
//                         />
//                         <input
//                           type='submit'
//                           name='post-comment-submit'
//                           value='&#8594;'
//                           class='post-comment-btn'
//                         />
//                       </form>
//                     </div>
//                   </div>";
//     }
// }

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
       <p>83 comments</p>
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
     <p>83 comments</p>
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
     ?>


    <!-- Modal start here -->
    <div class="modal-div-1 hidden">
        <div class="notification-div">
            <div class="notification-div-3">
                <h3>Notifications</h3>
                <i class="fa-solid fa-circle-xmark cancel-notification"></i>
            </div>
        <div class="notification-div-1">
            <button class="notification-btn">All</button>
            <button class="notification-btn1">Unread</button>
        </div>
        <div class="notification-div-2">
            <div class="notification-div-img">
                <img src="./user_profile_images/secretbook-high-resolution-logo-transparent.png" alt="pics" class="notification-img">
            </div>
            <div class="notification-div-4">
                <p>Welcome to SecretBook! Tap here to find people you know and add them as friends</p>
                <p>date</p>
            </div>
        </div>
     </div>
  </div>

  <div class="modal-div-2 hidden">
    <div class="pop-up-div">
        <img src="../sign_up_folder/user_image/<?php echo $user_picture ?>" alt="pics" class="pop-up-img">
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

  <div class="modal-div-7 hidden">
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
  </div>

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
    <!-- Modal ends here -->
    <iframe name="the-iframe" class="the-iframe-class"></iframe>

</body>

</html>

<?php 

include("./profile_data_control/profile_data_control.php");
?>