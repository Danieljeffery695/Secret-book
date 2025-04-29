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
$select_user = "select * from `secret_users` where user_unique_id = $user_unique_id";
$result_user = mysqli_query($con, $select_user);

$row_data = mysqli_fetch_array($result_user);
  $user_username = $row_data["username"];
  $user_picture = $row_data["user_picture"];
  // $_SESSION["username"] = $user_username;

$users_posts = [];
$users_posts_1 = [];
$i = 0;

class HomePost {
  public $unique_id;
  public $name;
  public $post_texts;
  public $post_type;
  public $upload_id;
  public $post_img;
  public $post_like;
  public $post_date;

 public function __construct($unique_id, $name, $post_texts, $post_type, $upload_id, $post_img, $post_like, $post_date) 
  {
    $this->unique_id = $unique_id;
    $this->name = $name;
    $this->post_texts = $post_texts;
    $this->post_type = $post_type;
    $this->upload_id = $upload_id;
    $this->post_img = $post_img;
    $this->post_like = $post_like;
    $this->post_date = $post_date;
  }
}

// user home uploaded

$select_uploaded_post = "select * from `home_uploaded` where user_unique_id = $user_unique_id";
$select_post_result = mysqli_query($con, $select_uploaded_post);

$select_post_result_1 = mysqli_query($con, $select_uploaded_post);

$select_post_result_2 = mysqli_query($con, $select_uploaded_post);


$post_row_count = mysqli_num_rows($select_post_result);

if($post_row_count >= 1) {
  while($post_uploaded_1_data = mysqli_fetch_assoc($select_post_result_2)) { 
  $ffkff = [];
  $post_uploaded_1_user_id = $post_uploaded_1_data["user_unique_id"];
  $post_uploaded_1_username = $post_uploaded_1_data["username"];
  $post_uploaded_1_texts = $post_uploaded_1_data["post_texts"];
  $post_uploaded_1_type = $post_uploaded_1_data["post_type"];
  $post_uploaded_1_id = $post_uploaded_1_data["upload_id"];
  $post_uploaded_1_img = $post_uploaded_1_data["post_img"];
  $post_uploaded_1_like = $post_uploaded_1_data["post_like"];
  $post_uploaded_1_date = $post_uploaded_1_data["post_date"];
  $post_uploaded_1_post_id = $post_uploaded_1_data["post_id"];

  $user_1 = new HomePost($post_uploaded_1_user_id, $post_uploaded_1_username, $post_uploaded_1_texts, $post_uploaded_1_type, $post_uploaded_1_id, $post_uploaded_1_img, $post_uploaded_1_like, $post_uploaded_1_date);
  $ffkff["user_unique_id"] = $user_1->unique_id;
  $ffkff["username"] = $user_1->name;
  $ffkff["post_texts"] = $user_1->post_texts;
  $ffkff["post_type"] = $user_1->post_type;
  $ffkff["post_unique_id"] = $user_1->upload_id;
  $ffkff["post_img"] = $user_1->post_img;
  $ffkff["post_like"] = $user_1->post_like;
  $ffkff["post_date"] = $user_1->post_date;


  $users_posts[$post_uploaded_1_post_id] = $ffkff;
  $users_posts_1[$i] = $post_uploaded_1_post_id;
    $i += 1;
  }
}


// friend home uploaded 

$select_friend_user = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id or friend_unique_id_2 = $user_unique_id";
$result_friend_user = mysqli_query($con, $select_friend_user);
$friend_user_row = mysqli_num_rows($result_friend_user);
if($friend_user_row >= 1) {
  while($friend_user_data = mysqli_fetch_assoc($result_friend_user)) {
    $friend_id = $friend_user_data["friend_unique_id_1"];
    $friend_id_1 = $friend_user_data["friend_unique_id_2"];

    if($friend_id == $user_unique_id) {
      $friend_username = $friend_user_data["friend_username_2"];
      $friend_unique_id = $friend_id_1;
    } else {
      $friend_username = $friend_user_data["friend_username_1"];
      $friend_unique_id = $friend_id;
    }

    $select_friend_upload = "select * from home_uploaded where user_unique_id = $friend_unique_id";
    $select_friend_result = mysqli_query($con, $select_friend_upload);
    $select_friend_upload_row = mysqli_num_rows($select_friend_result);
    if($select_friend_upload_row >= 1) {
      while($select_friend_upload_data = mysqli_fetch_assoc($select_friend_result)) {
      
      $hkkklk = [];
      $post_uploaded_user_id = $select_friend_upload_data["user_unique_id"];
      $post_uploaded_username = $select_friend_upload_data["username"];
      $post_uploaded_texts = $select_friend_upload_data["post_texts"];
      $post_uploaded_type = $select_friend_upload_data["post_type"];
      $post_uploaded_id = $select_friend_upload_data["upload_id"];
      $post_uploaded_img = $select_friend_upload_data["post_img"];
      $post_uploaded_like = $select_friend_upload_data["post_like"];
      $post_uploaded_date = $select_friend_upload_data["post_date"];
      $post_uploaded_post_id = $select_friend_upload_data["post_id"];

      $user = new HomePost($post_uploaded_user_id, $post_uploaded_username, $post_uploaded_texts, $post_uploaded_type, $post_uploaded_id, $post_uploaded_img, $post_uploaded_like, $post_uploaded_date);
      $hkkklk["user_unique_id"] = $user->unique_id;
      $hkkklk["username"] = $user->name;
      $hkkklk["post_texts"] = $user->post_texts;
      $hkkklk["post_type"] = $user->post_type;
      $hkkklk["post_unique_id"] = $user->upload_id;
      $hkkklk["post_img"] = $user->post_img;
      $hkkklk["post_like"] = $user->post_like;
      $hkkklk["post_date"] = $user->post_date;

      $users_posts[$post_uploaded_post_id] = $hkkklk;
      $users_posts_1[$i] = $post_uploaded_post_id;
      $i += 1;
    }
  }
}
}

$post_counts = count($users_posts);
if($post_counts) {
  $post_exist = true;
} else {
  $post_exist = false;
}

rsort($users_posts_1);

// notification number

class Home_Notification {
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

$personal_notification = [];
$personal_notification_1 = [];

$home_notification = [];
$home_notification_1 = [];



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



if(!$result_user) {
  throw new Exception("Error Processing Request");
}

  
  // If Post Form Data send and no File Upload
if ( empty( $_FILES ) && ! empty( $_POST ) ) {
  // Store Post Form Data in Session Variable
  $_SESSION["POST"] = $_POST;
  // Reload Page if there were no outputs
  if ( ! headers_sent() ) {
      // Build URL to reload with GET Parameters
      // Change https to http if your site has no ssl
      $location = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER['PHP_SELF'];
      // Reload Page
      // header( "location: " . $location, true, 303 );
      echo "<script>
      window.location.href = '$location';
      </script>";
      // Stop any further progress
      die();
  }
}

// Rebuilt POST Form Data from Session Variable
if ( isset( $_SESSION["POST"] ) ) {
  $_POST = $_SESSION["POST"];
  // Tell PHP that POST is sent
  $_SERVER['REQUEST_METHOD'] = 'POST';
}


} catch (Exception $e) {
  echo "<script>alert('Something went wrong. please give us some time to put things in order')</script>";
  echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
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
    <script defer src="user_home.js"></script>
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
  <body class="body">
    <!-- navigation header start here -->
    <div class="navigation-div">
      <div class="navigation-div-1">
        <div class="nav-flex1">
          <img
            src="../user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png"
            alt="pics"
            class="nav-img"
          />
          <input
            type="text"
            placeholder="Search SecretBook"
            name="Search_input"
            class="search-input search-input-div"
            autocomplete="off"
          />
          <i
            class="fa-solid fa-magnifying-glass nav-div search-icon nav-search-icon"
          ></i>
        </div>
      </div>
      <div class="navigation-div-2">
        <div class="div-nav">
          <nav class="nav">
            <li>
              <a href="../user_profile_folder/user_profile.php" target="_self"><i class="fa-solid fa-house"></i></a>
            </li>
            <li>
              <a href="../friends_folder/friends.php" target="_self"><i class="fa-solid fa-user-group"></i></a>
            </li>
            <li>
              <a href="#popup1"><i class="fa-solid fa-users-line"></i></a>
            </li>
          </nav>
        </div>
      </div>
      <div class="navigation-div-3">
        <div class="nav-flex2">
          <div class="div-nav1">
            <div class="find-friend-div">
              <p>Find friends</p>
            </div>
            <div class="nav-div table-cells-icon nav-table-cell">
              <i class="fa-solid fa-table-cells"></i>
            </div>
            <div class="nav-div nav-message-icon nav-message-btn">
              <i class="fa-solid fa-message"></i>
            </div>
            <div class="nav-div nav-message-btn-1"><i class="fa-solid fa-message"></i></div>
            <div class="nav-div nav-notification-icon notification-div-bell">
              <i class="fa-solid fa-bell notification-bell"></i>
              <div class="notification-num <?php if(!$notification_number) { echo 'hidden'; } ?>" > <?php echo $notification_number; ?></div>
            </div>
            <div class="nav-div notification-div-bell-1"><i class="fa-solid fa-bell notification-bell-1"></i> <div class="notification-num <?php if(!$notification_number) { echo 'hidden'; } ?>" > <?php echo $notification_number; ?></div> </div>
            <div class="nav-div search-icon-1 hidden">
              <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="nav-div1"><img src="../sign_up_folder/user_image/<?php echo $user_picture ?>" alt="pics" class="nav-img1"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- navigation header ends here -->

    <div class="too-small-1">
      <h1>Sorry, Move to a bigger devices</h1>
    </div>
    <div class="too-big-1">
      <h1>Sorry, Move to a smaller devices</h1>
    </div>

    <!-- home container start here -->
    <div class="home-container">
      <!-- first div start here -->
      <div class="home-container-div-1">
        <div class="icon-div-1">
          <div class="home-profile-img">
            <img
              src="../sign_up_folder/user_image/<?php echo $user_picture ?>"
              alt="photo"
            />
          </div>
          <p>trying</p>
        </div>

        <!-- first icon on the left start here -->
        <div
          class="icon-div-1 animate__animated"
          onmouseover="iconAnimation(this)"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 48 48"
            class="icon-i-1"
          >
            <defs>
              <style>
                .cls-1 {
                  fill: #192835;
                }
                .cls-2 {
                  fill: #4891d3;
                }
                .cls-3 {
                  fill: #2d72bc;
                }
                .cls-4 {
                  fill: #a1d51c;
                }
              </style>
            </defs>
            <g id="Group">
              <path
                class="cls-1"
                d="M28.24 12.75A6 6 0 0 0 18 17v2a6 6 0 0 0 1.1 3.46 6.21 6.21 0 0 0 .9 1l.08.06a4 4 0 0 0 .34.27l.22.15.19.13a5.22 5.22 0 0 0 1 .47l.49.17a5.56 
                      5.56 0 0 0 1 .2 5.13 5.13 0 0 0 1.24 0 6 6 0 0 0 1.09-.2l.48-.17.49-.21.2-.11a.78.78 0 0 0 .18-.11l.2-.12.17-.11.12-.09c.12-.09.24-.18.35-.28l.08-.06a6.21 
                      6.21 0 0 0 .9-1A6 6 0 0 0 30 19v-2a6 6 0 0 0-1.76-4.25zm-1.66 9.31a.28.28 0 0 1-.08.06l-.13.1-.31.21-.12.06-.1.05.47.88-.56-.84-.29.13-.31.11a4.64 4.64 0 0 
                      1-.76.14 3.09 3.09 0 0 1-.8 0 3.45 3.45 0 0 1-.7-.13 2.39 2.39 0 0 1-.32-.11l-.29-.13-.44.9.35-.95a.94.94 0 0 
                      1-.22-.12l-.09-.05-.12-.08-.13-.1h-.06l-.12-.1-.15-.09a4 4 0 0 1-1.3-3v-2a4 4 0 0 1 6.83-2.84A4 4 0 0 1 28 17v2a4 4 0 0 1-1.3 3 .63.63 0 0 0-.12.06z"
              />
              <path
                class="cls-2"
                d="M28 17v2a4 4 0 0 1-1.3 3 .63.63 0 0 0-.12.11.28.28 0 0 1-.08.06l-.13.1-.31.21-.12.06-.1.05h-.09l-.29.13-.31.11a4.64 4.64 0 0 1-.76.14 
                      3.09 3.09 0 0 1-.8 0 3.45 3.45 0 0 1-.7-.13l-.32-.11-.29-.13h-.08a.94.94 0 0 1-.22-.12l-.09-.05-.12-.08-.13-.1h-.06l-.12-.1-.16-.15a4 4 0 0 
                      1-1.3-3v-2a4 4 0 0 1 6.83-2.84A4 4 0 0 1 28 17z"
              />
              <path
                class="cls-1"
                d="M39.53 15.46A5 5 0 0 0 31 19v2a4.93 4.93 0 0 0 .58 2.32 4.66 4.66 0 0 0 .64.95A5 5 0 0 0 33 25a3 3 0 0 0 .37.25 1.13 1.13 0 0 0 .21.12 
                      4.92 4.92 0 0 0 4.82 0l.21-.12A3 3 0 0 0 39 25a5 5 0 0 0 .79-.73 4.66 4.66 0 0 0 .64-.95A4.93 4.93 0 0 0 41 21v-2a5 5 0 0 0-1.47-3.54zM33 
                      19a3 3 0 1 1 6 0v2a3 3 0 0 1-6 0z"
              />
              <path
                class="cls-3"
                d="M39 19v2a3 3 0 0 1-6 0v-2a3 3 0 1 1 6 0z"
              />
              <path
                class="cls-1"
                d="M40.42 23.32a6.07 6.07 0 0 0-1-.59 1 1 0 0 0-1.21.24 3 3 0 0 1-4.52 0 1 1 0 0 0-1.21-.24 7.16 7.16 0 0 0-1 .59 6.33 6.33 0 0 0-1.69
                       1.92 1 1 0 0 0 0 1A7 7 0 0 1 31 30v2a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3.5a6.4 6.4 0 0 0-2.58-5.18zM41 31h-8v-1a9 9 0 0 0-1.06-4.24 4 4 0 0 1 
                       .9-.88A1.77 1.77 0 0 0 33 25a3 3 0 0 0 .37.25 1.13 1.13 0 0 0 .21.12 5.26 5.26 0 0 0 4.82 0l.21-.12A3 3 0 0 0 39 25l.17-.13A4.46 4.46 0 0 1 41 28.5z"
              />
              <path
                class="cls-3"
                d="M41 28.5V31h-8v-1a9 9 0 0 0-1.06-4.24 4 4 0 0 1 .9-.88A1.77 1.77 0 0 0 33 25a3 3 0 0 0 .37.25 1.13 1.13 0 0 0 .21.12 4.92 4.92 0 0 0 4.82 0l.21-.12A3
                       3 0 0 0 39 25l.17-.13A4.46 4.46 0 0 1 41 28.5z"
              />
              <path
                class="cls-1"
                d="M31.62 25.21a8.43 8.43 0 0 0-1.25-1.58 8.21 8.21 0 0 0-1.47-1.17 7.73 7.73 0 0 0-1.16-.64 1 1 0 0 0-1 .12.63.63 0 0 0-.12.11.28.28 0 0 
                      1-.08.06l-.13.1-.31.21-.12.06-.1.06h-.09l-.29.13-.31.11a4.64 4.64 0 0 1-.76.14 3.09 3.09 0 0 1-.8 0 3.45 3.45 0 0 1-.7-.13l-.32-.11-.29-.13h-.08a.94.94
                       0 0 1-.22-.12l-.09-.05-.12-.08-.13-.1h-.06l-.12-.1-.2-.1a1 1 0 0 0-1-.12 9.13 9.13 0 0 0-3.87 
                  3.37A9 9 0 0 0 15 30v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a8.94 8.94 0 0 0-1.38-4.79zM31 33H17v-3a7.06 7.06 0 0 1 1.09-3.75 6.89 6.89 0 0 1 
                  2.46-2.34l.09.05.19.13a5.22 5.22 0 0 0 1 .47l.49.17a5.56 5.56 0 0 0 1 .2 5.13 5.13 0 0 0 1.24 0 6 6 0 0 0 1.09-.2l.46-.17.49-.21.2-.11a.78.78 0 0 0 
                  .18-.11l.2-.12.17-.11A6.33 6.33 0 0 1 29 25.05a6.27 6.27 0 0 1 1 1.22A7 7 0 0 1 31 30z"
              />
              <path
                class="cls-2"
                d="M31 30v3H17v-3a7.06 7.06 0 0 1 1.09-3.75 6.89 6.89 0 0 1 2.46-2.34l.28.18a5.22 5.22 0 0 0 1 .47l.49.17a5.56 5.56 0 0 0 1 .2 5.13 5.13 0 0 0 1.24
                       0 6 6 0 0 0 1.09-.2l.46-.17.49-.21.2-.11a.78.78 0 0 0 .18-.11l.2-.12.17-.11A6.33 6.33 0 0 1 29 25.05a6.27 6.27 0 0 1 1 1.22A7 7 0 0 1 31 30z"
              />
              <path
                class="cls-1"
                d="M15.53 15.46A5 5 0 0 0 7 19v2a4.93 4.93 0 0 0 .58 2.32 4.66 4.66 0 0 0 .64.95A5 5 0 0 0 9 25a3 3 0 0 0 .37.25l.21.12a4.92 4.92 0 0 0 4.82
                       0l.21-.12A3 3 0 0 0 15 25a5 5 0 0 0 .79-.73 4.66 4.66 0 0 0 .64-.95A4.93 4.93 0 0 0 17 21v-2a5 5 0 0 0-1.47-3.54zM9 19a3 3 0 1 1 6 0v2a3 3 0 0 1-6 0z"
              />
              <path
                class="cls-3"
                d="M15 19v2a3 3 0 0 1-6 0v-2a3 3 0 1 1 6 0z"
              />
              <path
                class="cls-1"
                d="M18.11 25.22a6.39 6.39 0 0 0-2.64-2.49 1 1 0 0 0-1.21.24 3 3 0 0 1-4.52 0 1 1 0 0 0-1.21-.24 6.07 6.07 0 0 0-.95.59A6.43 6.43 0 0 0 5 
                      28.5V32a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-2a7.06 7.06 0 0 1 1.09-3.75 1 1 0 0 0 .02-1.03zM15 30v1H7v-2.5a4.46 4.46 0 0 1 1.84-3.63L9 25a3 3 0 0 0 
                      .37.25l.21.12a5.26 5.26 0 0 0 4.82 0l.21-.12A3 3 0 0 0 15 25l.17-.13a4.42 4.42 0 0 1 .9.88A9.13 9.13 0 0 0 15 30z"
              />
              <path
                class="cls-3"
                d="M16.06 25.75A9.13 9.13 0 0 0 15 30v1H7v-2.5a4.46 4.46 0 0 1 1.84-3.63L9 25a3 3 0 0 0 .37.25l.21.12a4.92 4.92 0 0 0 4.82 0l.21-.12A3
                       3 0 0 0 15 25l.17-.13a4.42 4.42 0 0 1 .89.88z"
              />
              <path
                class="cls-4"
                d="M24 42a17.88 17.88 0 0 1-12.73-5.27 1 1 0 1 1 1.42-1.42 16 16 0 0 0 22.62 0 1 1 0 0 1 1.42 1.42A17.88 17.88 0 0 1 24 42zM12
                       13a1 1 0 0 1-.71-.29 1 1 0 0 1 0-1.42 18 18 0 0 1 25.46 0 1 1 0 0 1-1.42 1.42 16 16 0 0 0-22.62 0A1 1 0 0 1 12 13z"
              />
            </g>
          </svg>
          <p>Find friends</p>
        </div>

        <!-- first icon on the left ends here -->
        <!-- second icon on the left start here -->
         <a href="#popup1" class="pop-up-1-a">
        <div
          class="icon-div-1 animate__animated"
          onmouseover="iconAnimation(this)"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 48 48"
            class="icon-i-1"
          >
            <defs>
              <style>
                .cls-1 {
                  fill: #dad7e5;
                }
                .cls-2 {
                  fill: #edebf2;
                }
                .cls-3 {
                  fill: #84b749;
                }
                .cls-4 {
                  fill: #9dcc6b;
                }
                .cls-7 {
                  fill: #7c7d7d;
                }
              </style>
            </defs>
            <g id="Time_duration" data-name="Time duration">
              <path
                class="cls-1"
                d="M43 24A19 19 0 1 1 15 7.27 19 19 0 0 1 43 24z"
              />
              <path
                class="cls-2"
                d="M43 24a18.94 18.94 0 0 1-7 14.73A18.83 18.83 0 0 1 27 41C9.14 41 1.21 18.49 15 7.27A19 19 0 0 1 43 24z"
              />
              <path
                class="cls-3"
                d="M47 24h-4C43 7 22.41-1.3 10.57 10.57l1.93 1.93L5 13c.43-3 .75-5.25 1-7l1.74 1.74C22.13-6.65 47 3.51 47 24z"
              />
              <path
                class="cls-4"
                d="M47 24h-2A23 23 0 0 0 12.78 3.93C27.79-4.55 47 6.23 47 24z"
              />
              <path
                d="M39 24a14.93 14.93 0 0 1-5.43 11.54C23.89 43.55 9 36.76 9 24c0-3.87 1.71-7.82 3.46-9.57C21.37 3.63 39 10 39 24z"
                style="fill: #5b9ad8"
              />
              <path
                d="M37 26c0 5.2-3 9.36-3.46 9.57C23.89 43.55 9 36.76 9 24c0-3.87 1.71-7.82 3.46-9.57C22.11 6.45 37 13.24 37 26z"
                style="fill: #6fabe6"
              />
              <path
                class="cls-3"
                d="m43 35-1 7-1.74-1.74C25.77 54.75 1 44.38 1 24h4c0 17 20.59 25.3 32.43 13.43L35.5 35.5z"
              />
              <path
                class="cls-4"
                d="m42 42-1.74-1.74a23 23 0 0 1-7 4.8A23 23 0 0 0 42.7 35c.42 0 .45-1-.7 7z"
              />
              <path
                class="cls-1"
                d="M24.1 14a1 1 0 0 0-.2-2 1 1 0 0 0 .2 2zM31.15 17a1 1 0 0 0 1.26-1.55A1 1 0 0 0 31.15 17zM34 24.1a1 1 0 0 0 2-.2 1 1 0 0 0-2
                       .2zM31 31.15a1 1 0 0 0 1.55 1.26A1 1 0 0 0 31 31.15zM23.9 34a1 1 0 0 0 .2 2 1 1 0 0 0-.2-2zM16.85 31a1 1 0 0 0-1.26 1.55A1 1 0 0 0 
                       16.85 31zM14 23.9a1 1 0 0 0-2 .2 1 1 0 0 0 2-.2zM17 16.85a1 1 0 0 0-1.55-1.26A1 1 0 0 0 17 16.85z"
              />
              <path
                class="cls-7"
                d="M23 22v-5a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0zM19 30a1 1 0 0 1-.71-1.71l4-4a1 1 0 0 1 1.42 1.42C19.34 30.08 19.56 30 19 30z"
              />
              <path
                class="cls-1"
                d="M24 22a2 2 0 1 0 1.82 2.82A2 2 0 0 0 24 22z"
              />
              <path
                class="cls-2"
                d="M23.18 22.18a2 2 0 0 0 2.64 2.64 2 2 0 0 0-2.64-2.64z"
              />
            </g>
          </svg>
          <p>Memories</p>
        </div>
        </a>
        <!-- second icon on the left ends here -->

        <!-- third icon on the left start here -->
        <a href="#popup1" class="pop-up-1-a">
        <div
          class="icon-div-1 animate__animated"
          onmouseover="iconAnimation(this)"
        >
          <svg
            version="1.1"
            id="Layer_1"
            xmlns="http://www.w3.org/2000/svg"
            x="0"
            y="0"
            viewBox="0 0 512 512"
            style="enable-background: new 0 0 512 512"
            xml:space="preserve"
            class="icon-i-1"
          >
            <style>
              .st1 {
                fill: #edf3fc;
              }
              .st2 {
                fill: #330d84;
              }
              .st3 {
                fill: #ffbe1b;
              }
              .st10 {
                fill: #5d8ef9;
              }
            </style>
            <path
              class="st1"
              d="M255.999 40.928c-118.778 0-215.071 96.294-215.071 215.074 0 118.776 96.292 215.067 215.071 215.067S471.07 374.778 471.07 256.002c0-118.78-96.293-215.074-215.071-215.074z"
            />
            <path
              class="st1"
              d="M255.999 1C115.391 1 1 115.392 1 256.002 1 396.609 115.391 511 255.999 511S511 396.609 511 256.002C511 115.392 396.607 1 255.999 1zm0 501.831c-136.103 0-246.83-110.727-246.83-246.829 0-136.104
                     110.727-246.833 246.83-246.833 136.102 0 246.832 110.729 246.832 246.833 0 136.102-110.73 246.829-246.832 246.829z"
            />
            <path
              class="st3"
              d="m334.334 326.506-52.836 61.649c-2.89 3.371-8.105 3.371-10.995 0l-52.836-61.649c-4.025-4.696-.688-11.951 5.497-11.951h12.519v-75.032a7.206 7.206 0 0 1 7.206-7.206h66.223a7.206
                     7.206 0 0 1 7.206 7.206v75.032h12.519c6.185 0 9.522 7.255 5.497 11.951z"
            />
            <path
              class="st10"
              d="M338.645 222.757c-.643 0-1.276.032-1.897.054a64.22 64.22 0 0 0 2.376-17.297c0-35.456-28.742-64.197-64.198-64.197-33.047 0-60.262 24.992-63.783 57.113a63.951
                     63.951 0 0 0-23.401-4.425c-35.456 0-64.198 28.742-64.198 64.197 0 35.445 28.742 64.187 64.198 64.187h28.203c-.307-3.933 2.683-7.833 7.218-7.833h12.519v-75.032a7.206
                      7.206 0 0 1 7.206-7.206h66.223a7.206 7.206 0 0 1 7.206 7.206v75.032h12.519c4.536
                     0 7.525 3.901 7.218 7.833h3.07v-.011c27.281-.261 49.33-22.453 49.33-49.799.001-27.512-22.299-49.822-49.809-49.822zM427.316 211.984l1.987.498-1.987.498a32.496 32.496
                      0 0 0-23.624 23.628l-.5 1.984-.498-1.984a32.498 32.498 0 0 0-23.629-23.628l-1.979-.498 1.979-.498a32.5 32.5 0 0 0 23.629-23.624l.498-1.983.5 1.983a32.5 32.5 0 0 0 23.624 23.624z"
            />
            <path
              class="st2"
              d="m218.852 139.816 1.987.498-1.987.498a32.496 32.496 0 0 0-23.624 23.628l-.5 1.984-.498-1.984a32.498 32.498 0 0 0-23.629-23.628l-1.979-.498 1.979-.498a32.5 32.5
                     0 0 0 23.629-23.624l.498-1.983.5 1.983a32.5 32.5 0 0 0 23.624 23.624zM260.554 108.256l1.257.315-1.257.315a20.557 20.557 0 0 0-14.946 14.949l-.316 
                    1.255-.315-1.255a20.559 20.559 0 0 0-14.95-14.949l-1.252-.315 1.252-.315a20.565 20.565 0 0 0 14.95-14.946l.315-1.254.316 1.254a20.56 20.56 0 0 0 14.946 14.946z"
            />
            <path
              class="st3"
              d="m202.135 368.4 2.458.616-2.458.616a40.192 40.192 0 0 0-29.222 29.227l-.619 2.454-.617-2.454a40.195 40.195 0 0 0-29.229-29.227l-2.448-.617 2.448-.616a40.201
                     40.201 0 0 0 29.229-29.222l.617-2.452.619 2.452a40.202 40.202 0 0 0 29.222 29.223zM249.149 392.311l1.169.293-1.169.293a19.12 19.12 0 0 0-13.901 13.903l-.294
                      1.168-.293-1.168a19.122 19.122
                     0 0 0-13.904-13.903l-1.165-.293 1.165-.293a19.123 19.123 0 0 0 13.904-13.901l.293-1.167.294 1.167a19.125 19.125 0 0 0 13.901 13.901z"
            />
          </svg>
          <p>Saved</p>
        </div>
        </a>
        <!-- third icon on the left ends here -->

        <!-- fourth icon on the left start here -->
         <a href="#popup1" class="pop-up-1-a">
        <div
          class="icon-div-1 animate__animated"
          onmouseover="iconAnimation(this)"
        >
          <svg
            version="1.1"
            id="Layer_1"
            xmlns="http://www.w3.org/2000/svg"
            x="0"
            y="0"
            viewBox="0 0 64 64"
            style="enable-background: new 0 0 64 64"
            xml:space="preserve"
            class="icon-i-1"
          >
            <style>
              .st1,
              .st12,
              .st16,
              .st2,
              .st5 {
                fill: #78909c;
                stroke: #37474f;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
              }
              .st12,
              .st16,
              .st2,
              .st5 {
                fill: #eceff1;
              }
              .st12,
              .st16,
              .st5 {
                fill: none;
              }
              .st12,
              .st16 {
                fill: #ef5350;
              }
              .st16 {
                fill: #d32f2f;
              }
            </style>
            <path
              class="st16"
              d="M20 60.5H3C1.6 60.5.5 59.4.5 58v-3c0-4.1 3.4-7.5 7.5-7.5h7c4.1 0 7.5 3.4 7.5 7.5v3c0 1.4-1.1 2.5-2.5 2.5zM61 60.5H44c-1.4 0-2.5-1.1-2.5-2.5v-3c0-4.1 3.4-7.5 7.5-7.5h7c4.1 0 7.5 3.4 7.5 7.5v3c0 1.4-1.1 2.5-2.5 2.5z"
            />
            <path
              class="st16"
              d="M36.5 47.5h-9c-5.5 0-10 4.5-10 10V61c0 1.4 1.1 2.5 2.5 2.5h24c1.4 0 2.5-1.1 2.5-2.5v-3.5c0-5.5-4.5-10-10-10z"
            />
            <path
              d="M4.5 9.5V13c0 2.8 2.2 5 5 5h3l3.2 3.5c.4.5 1.2.5 1.6 0l3.2-3.5H28l3.2 3.5c.4.5 1.2.5 1.6 0L36 18h7.5l3.2 3.5c.4.5 1.2.5 1.6 0l3.2-3.5h3c2.8 0 5-2.2 5-5V9.5c0-2.8-2.2-5-5-5h-45c-2.8 0-5 2.2-5 5z"
              style="
                fill: #0097a7;
                stroke: #37474f;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
              "
            />
            <path
              d="M4.5 5.5V9c0 2.8 2.2 5 5 5h3l3.2 3.5c.4.5 1.2.5 1.6 0l3.2-3.5H28l3.2 3.5c.4.5 1.2.5 1.6 0L36 14h7.5l3.2 3.5c.4.5 1.2.5 1.6 0l3.2-3.5h3c2.8 0 5-2.2 5-5V5.5c0-2.8-2.2-5-5-5h-45c-2.8 0-5 2.2-5 5z"
              style="
                fill: #26c6da;
                stroke: #37474f;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
              "
            />
            <path
              d="M6.5 7.5v-2c0-1.7 1.3-3 3-3h2"
              style="
                fill: none;
                stroke: #80deea;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
              "
            />
            <path
              class="st12"
              d="M20 56.5H3C1.6 56.5.5 55.4.5 54v-3c0-4.1 3.4-7.5 7.5-7.5h7c4.1 0 7.5 3.4 7.5 7.5v3c0 1.4-1.1 2.5-2.5 2.5z"
            />
            <path class="st2" d="M15.7 43.5h-8c0 2.2 1.8 4 4 4s3.9-1.8 4-4z" />
            <path class="st5" d="M5.5 56.5v-5" />
            <circle class="st2" cx="11.6" cy="34.5" r="9" />
            <path class="st5" d="M14.8 37.7c-1.8 1.8-4.6 1.8-6.4 0" />
            <path
              class="st1"
              d="M18.9 29.3 2.8 32.5c.9-4 4.5-7 8.8-7 3 0 5.7 1.5 7.3 3.8z"
            />
            <path
              class="st1"
              d="M17.5 27.7h0c1.9 1.7 3.1 4.1 3.1 6.8h0c-1.7 0-3.1-1.4-3.1-3.1v-3.7z"
            />
            <circle class="st2" cx="52.5" cy="34.5" r="9" />
            <path class="st5" d="M55.7 37.7c-1.8 1.8-4.6 1.8-6.4 0" />
            <path
              class="st1"
              d="m59.9 29.3-16.1 3.1c.9-4 4.5-7 8.8-7 2.9.1 5.6 1.6 7.3 3.9z"
            />
            <path
              class="st1"
              d="M58.4 27.7h0c1.9 1.7 3.1 4.1 3.1 6.8h0c-1.7 0-3.1-1.4-3.1-3.1v-3.7z"
            />
            <path
              class="st12"
              d="M61 56.5H44c-1.4 0-2.5-1.1-2.5-2.5v-3c0-4.1 3.4-7.5 7.5-7.5h7c4.1 0 7.5 3.4 7.5 7.5v3c0 1.4-1.1 2.5-2.5 2.5z"
            />
            <path class="st2" d="M56.5 43.5h-8c0 2.2 1.8 4 4 4s4-1.8 4-4z" />
            <path class="st5" d="M58.5 56.5v-5" />
            <path
              class="st12"
              d="M36.5 43.5h-9c-5.5 0-10 4.5-10 10V57c0 1.4 1.1 2.5 2.5 2.5h24c1.4 0 2.5-1.1 2.5-2.5v-3.5c0-5.5-4.5-10-10-10z"
            />
            <path
              class="st2"
              d="M37.1 43.5H27.1c0 2.8 2.2 5 5 5 2.7 0 5-2.2 5-5z"
            />
            <path class="st5" d="M14 5h36M17 9h30" />
            <path class="st2" d="M23.5 59.5v-6M40.5 59.5v-6" />
            <circle class="st2" cx="32.1" cy="33.5" r="10" />
            <path class="st5" d="M35.6 37c-2 2-5.1 2-7.1 0" />
            <path
              class="st1"
              d="m40.3 27.7-17.9 3.5c1-4.4 5-7.7 9.7-7.7 3.4 0 6.3 1.7 8.2 4.2z"
            />
            <path
              class="st1"
              d="M38.6 25.9h0c2.1 1.8 3.5 4.5 3.5 7.6h0c-1.9 0-3.5-1.6-3.5-3.5v-4.1z"
            />
          </svg>
          <p>Groups</p>
        </div>
        </a>
        <!-- fourth icon on the left ends here -->

        <!-- fifth icon on the left start here -->
        <a href="#popup1" class="pop-up-1-a">
          <div
            class="icon-div-1 animate__animated"
            onmouseover="iconAnimation(this)"
          >
            <svg
              version="1.1"
              id="Layer_1"
              xmlns="http://www.w3.org/2000/svg"
              x="0"
              y="0"
              viewBox="0 0 500 500"
              style="enable-background: new 0 0 500 500"
              xml:space="preserve"
              class="icon-i-1"
            >
              <style>
                .st1 {
                  fill: #1c1d21;
                }
              </style>
              <path
                d="M40 333.5V60c0-11 9-20 20-20h380c11 0 20 9 20 20v273.5c0 11-9 20-20 20H60c-11 0-20-9-20-20z"
                style="fill: #83e1e5"
              />
              <path
                d="M186.6 144.2v105c0 20 22.4 31.8 38.9 20.5l77-52.5c14.5-9.9 14.5-31.2 0-41.1l-77-52.5c-16.5-11.2-38.9.7-38.9 20.6z"
                style="fill: #fddf7f"
              />
              <path
                class="st1"
                d="M211.6 279.2c-4.8 0-9.5-1.2-14-3.5-10-5.3-15.9-15.1-15.9-26.4v-105c0-11.3 5.9-21.1 15.9-26.4 10-5.3 21.5-4.6 30.8 1.7l77 
              52.5c8.2 5.6 13 14.8 13 24.7s-4.9 19.1-13 24.7l-77 52.5c-5.2 3.4-11 5.2-16.8 5.2zm-.1-154.9c-3.2 0-6.3.8-9.3 2.4-6.6 3.5-10.6 10.1-10.6 
              17.6v105c0 7.5 4 14.1 10.6 17.6 6.6 3.5 14.3 3.1 20.5-1.1l77-52.5c5.5-3.8 8.7-9.7 8.7-16.4s-3.2-12.7-8.7-16.4l-77-52.5c-3.4-2.5-7.3-3.7-11.2-3.7z"
              />
              <path
                class="st1"
                d="M370.8 500H129.2c-2.8 0-5-2.2-5-5v-10c0-22.1 17.9-40 40-40h24.9c9.4 0 17.1-7.7 17.1-17.1v-13.5c0-11.5-9.4-20.9-20.9-20.9H35c-19.3
                         0-35-15.7-35-35V35C0 15.7 15.7 0 35 0h430c19.3 0 35 15.7 35 35v323.5c0 19.3-15.7 35-35 35H314.6c-11.5 0-20.9 9.4-20.9 20.9v13.5c0 9.4 7.7 
                         17.1 17.1 17.1h24.9c22.1 0 40 17.9 40 40v10c.1 2.8-2.2 5-4.9 5zm-236.6-10h231.5v-5c0-16.5-13.5-30-30-30h-24.9c-15 0-27.1-12.2-27.1-27.1v-13.5c0-17 
                         13.9-30.9 30.9-30.9H465c13.8 0 25-11.2 25-25V35c0-13.8-11.2-25-25-25H35c-13.8 0-25 11.2-25 25v323.5c0 13.8 11.2 25 25 25h150.4c17 0 30.9 13.9 30.9 30.9v13.5c0 15-12.2 27.1-27.1 27.1h-24.9c-16.5 0-30 13.5-30 30v5z"
              />
              <path
                class="st1"
                d="M224.6 393.5H179c-2.8 0-5-2.2-5-5s2.2-5 5-5h45.6c2.8 0 5 2.2 5 5s-2.3 5-5 5zM259.5 393.5H250c-2.8 0-5-2.2-5-5s2.2-5 
                        5-5h9.5c2.8 0 5 2.2 5 5s-2.2 5-5 5zM317.7 455h-55.3c-2.8 0-5-2.2-5-5s2.2-5 5-5h55.3c2.8 0 5 2.2 5 5s-2.3 5-5 5zM440 358.5h-17.3c-2.8 0-5-2.2-5-5s2.2-5 
                        5-5H440c8.3 0 15-6.7 15-15 0-2.8 2.2-5 5-5s5 2.2 5 5c0 13.8-11.2 25-25 25zM460 311.8c-2.8 0-5-2.2-5-5v-74c0-2.8 2.2-5 5-5s5 2.2 5 5v74c0 2.8-2.2 5-5 5zM400.5 358.5H393c-2.8 0-5-2.2-5-5s2.2-5 5-5h7.5c2.8 0 5 2.2 5 5s-2.2 5-5 5z"
              />
              <g>
                <path
                  class="st1"
                  d="M40 65c-2.8 0-5-2.2-5-5 0-13.8 11.2-25 25-25h17.3c2.8 0 5 2.2 5 5s-2.2 5-5 5H60c-8.3 0-15 6.7-15 15 0 2.8-2.2 5-5 5z"
                />
              </g>
              <g>
                <path
                  class="st1"
                  d="M40 165.7c-2.8 0-5-2.2-5-5v-74c0-2.8 2.2-5 5-5s5 2.2 5 5v74c0 2.7-2.2 5-5 5z"
                />
              </g>
              <g>
                <path
                  class="st1"
                  d="M107 45h-7.5c-2.8 0-5-2.2-5-5s2.2-5 5-5h7.5c2.8 0 5 2.2 5 5s-2.2 5-5 5z"
                />
              </g>
            </svg>
            <p>Video</p>
          </div>
        </a>
        <!-- fifth icon on the left ends here -->

        <!-- sixth icon on the left start here -->
         <a href="#popup1" class="pop-up-1-a">
        <div
          class="icon-div-1 animate__animated"
          onmouseover="iconAnimation(this)"
        >
          <svg
            version="1.1"
            id="Layer_1"
            xmlns="http://www.w3.org/2000/svg"
            x="0"
            y="0"
            viewBox="0 0 64 64"
            style="enable-background: new 0 0 64 64"
            xml:space="preserve"
            class="icon-i-1"
          >
            <style>
              .st1,
              .st13,
              .st15,
              .st17 {
                fill: #81d4fa;
                stroke: #0277bd;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
              }
              .st13,
              .st15,
              .st17 {
                fill: none;
                stroke: #e1f5fe;
              }
              .st15,
              .st17 {
                stroke: #29b6f6;
              }
              .st17 {
                stroke: #0277bd;
              }
            </style>
            <g id="Feedback">
              <path
                d="M44 45.7c-.1-1.3-1.3-2.2-2.6-2.2H31c-.6 0-1-.4-1-1v-6.7c0-1.6-1.3-2.8-2.8-2.8h0c-1 0-2 .5-2.6 1.4L19 43.5v20h19.4c1.3 0 2.5-.9 2.6-2.2.1-1.5-1-2.8-2.5-2.8h.9c1.3 0 2.5-.9 2.6-2.2.1-1.5-1-2.8-2.5-2.8h.9c1.3 0 2.5-.9 2.6-2.2.1-1.5-1-2.8-2.5-2.8h1c1.5 0 2.6-1.3 2.5-2.8z"
                style="
                  fill: #eee;
                  stroke: #0277bd;
                  stroke-linecap: round;
                  stroke-linejoin: round;
                  stroke-miterlimit: 10;
                "
              />
              <path
                d="m21 44.1 5.3-8.6"
                style="
                  fill: none;
                  stroke: #fff;
                  stroke-linecap: round;
                  stroke-linejoin: round;
                  stroke-miterlimit: 10;
                "
              />
              <path
                class="st1"
                d="M10 63.5h8c.6 0 1-.4 1-1v-18c0-.6-.4-1-1-1h-8c-.6 0-1 .4-1 1v18c0 .6.4 1 1 1z"
              />
              <path class="st13" d="M11 45.5h6" />
              <path class="st15" d="M11 61.5h6" />
              <path
                style="
                  fill: none;
                  stroke: #bdbdbd;
                  stroke-linecap: round;
                  stroke-linejoin: round;
                  stroke-miterlimit: 10;
                "
                d="M21 61.5h18"
              />
              <path
                class="st1"
                d="M30 3.5v24c0 1.7 1.3 3 3 3h5c.6 0 1 .4 1 1v5.6c0 .9 1.1 1.3 1.7.7l6.4-6.4c.6-.6 1.3-.9 2.1-.9h11.3c1.7 0 3-1.3 3-3v-24c0-1.7-1.3-3-3-3H33c-1.7 0-3 1.3-3 3z"
              />
              <path class="st17" d="M36 9.5h21.5M36 15.5h21.5M36 21.5h10.8" />
              <path
                d="M26 11.5v16c0 1.7-1.3 3-3 3h-3c-.6 0-1 .4-1 1v6l-6.1-6.1c-.6-.6-1.3-.9-2.1-.9H3.5c-1.7 0-3-1.3-3-3v-16c0-1.7 1.3-3 3-3H23c1.7 0 3 1.3 3 3z"
                style="
                  fill: #ffa726;
                  stroke: #0277bd;
                  stroke-linecap: round;
                  stroke-linejoin: round;
                  stroke-miterlimit: 10;
                "
              />
              <path class="st13" d="M33 2.5h27.5" />
              <path
                class="st15"
                d="M60.5 28.5H49.2c-1.3 0-2.6.5-3.5 1.5L41 34.7v-3.2c0-1.7-1.3-3-3-3h-5"
              />
              <path
                d="M3.5 10.5H23"
                style="
                  fill: none;
                  stroke: #ffcc80;
                  stroke-linecap: round;
                  stroke-linejoin: round;
                  stroke-miterlimit: 10;
                "
              />
              <path
                d="M23 28.5h-3c-1.7 0-3 1.3-3 3v1.2L14.3 30c-.9-.9-2.2-1.5-3.5-1.5H3.5"
                style="
                  fill: none;
                  stroke: #f57c00;
                  stroke-linecap: round;
                  stroke-linejoin: round;
                  stroke-miterlimit: 10;
                "
              />
              <path class="st17" d="M4.8 15.5h17M8.9 21.5h8.5" />
            </g>
          </svg>
          <p>Feeds</p>
        </div>
        </a>
        <!-- sixth icon on the left ends here -->

        <!-- seventh icon on the left start here -->
        <a href="#popup1" class="pop-up-1-a">
          <div
            class="icon-div-1 animate__animated"
            onmouseover="iconAnimation(this)"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 64 64"
              class="icon-i-1"
            >
              <path
                d="M58 10h-2a1 1 0 0 0-1 1v3a2 2 0 0 1-2.147 2A2.13 2.13 0 0 1 51 13.831V11a1 1 0 0 0-1-1h-8a1 1 0 0 0-1 1v3a2 2 0 0 1-2.147 2A2.13 2.13 0 0 1 37 
                        13.831V11a1 1 0 0 0-1-1h-8a1 1 0 0 0-1 1v3a1.983 1.983 0 0 1-.587 1.413 2.006 2.006 0 0 1-1.56.582A2.13 2.13 0 0 1 23 13.831V11a1 1 0 0 0-1-1h-8a1 1 0 0 0-1 
                        1v3a1.983 1.983 0 0 1-.587 1.413 2 2 0 0 1-1.56.582A2.13 2.13 0 0 1 9 13.831V11a1 1 0 0 0-1-1H6a6.006 6.006 0 0 0-6 6v38a6.006 6.006 0 0 0 6 6h45a13.015 13.015 0 0 0 13-13V16a6.006 6.006 0 0 0-6-6z"
                style="fill: #e6edff"
              />
              <path
                d="M58 10h-2a1 1 0 0 0-1 1v3a2 2 0 0 1-2.147 2A2.13 2.13 0 0 1 51 13.831V11a1 1 0 0 0-1-1h-8a1 1 0 0 0-1 1v3a2 2 0 0 1-2.147 2A2.13 2.13 0 0 1 37 
                        13.831V11a1 1 0 0 0-1-1h-8a1 1 0 0 0-1 1v3a1.983 1.983 0 0 1-.587 1.413 2.006 2.006 0 0 1-1.56.582A2.13 2.13 0 0 1 23 13.831V11a1 1 0 0 0-1-1h-8a1 1 0 0 0-1 
                        1v3a1.983 1.983 0 0 1-.587 1.413 2 2 0 0 1-1.56.582A2.13 2.13 0 0 1 9 13.831V11a1 1 0 0 0-1-1H6a6.006 6.006 0 0 0-6 6v4h64v-4a6.006 6.006 0 0 0-6-6z"
                style="fill: #e63b47"
              />
              <path
                d="M11 4a4 4 0 0 0-4 4v6a4 4 0 0 0 8 0V8a4 4 0 0 0-4-4zM25 4a4 4 0 0 0-4 4v6a4 4 0 0 0 8 0V8a4 4 0 0 0-4-4zM39 4a4 4 0 0 0-4 4v6a4 4 0 0 0 8 0V8a4 4 0 0 0-4-4zM53 
                        4a4 4 0 0 0-4 4v6a4 4 0 0 0 8 0V8a4 4 0 0 0-4-4z"
                style="fill: #4aa4f2"
              />
              <rect
                x="29"
                y="49"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="21"
                y="49"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="13"
                y="49"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="5"
                y="49"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="29"
                y="41"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="21"
                y="41"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="13"
                y="41"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="5"
                y="41"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="29"
                y="33"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="21"
                y="33"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="13"
                y="33"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <rect
                x="5"
                y="33"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <path
                d="M58 29H6a1 1 0 0 0 0 2h52a1 1 0 0 0 0-2zM6 27h4a1 1 0 0 0 0-2H6a1 1 0 0 0 0 2zM14 27h4a1 1 0 0 0 0-2h-4a1 1 0 0 0 0 2zM22 27h4a1 1 0 0 0 0-2h-4a1 1 0 0 0 0 
                        2zM30 27h4a1 1 0 0 0 0-2h-4a1 1 0 0 0 0 2zM38 27h4a1 1 0 0 0 0-2h-4a1 1 0 0 0 0 2zM46 27h4a1 1 0 0 0 0-2h-4a1 1 0 0 0 0 2zM54 27h4a1 1 0 0 0 0-2h-4a1 1 0 0 0 0 2z"
                style="fill: #a8b7d4"
              />
              <rect
                x="37"
                y="33"
                width="6"
                height="6"
                rx="1"
                ry="1"
                style="fill: #a8b7d4"
              />
              <circle cx="51" cy="47" r="13" style="fill: #4aa4f2" />
              <path
                d="M56 46h-4v-4a1 1 0 0 0-2 0v4h-4a1 1 0 0 0 0 2h4v4a1 1 0 0 0 2 0v-4h4a1 1 0 0 0 0-2z"
                style="fill: #2a72db"
              />
            </svg>
            <p>Events</p>
          </div>
        </a>

        <!-- seventh icon on the left ends here -->

        <!-- tenth icon on the left start here -->
        <a href="#popup1" class="pop-up-1-a">
          <div
            class="icon-div-1 animate__animated"
            onmouseover="iconAnimation(this)"
          >
            <svg
              version="1.1"
              id="Icon_Set"
              xmlns="http://www.w3.org/2000/svg"
              x="0"
              y="0"
              viewBox="0 0 64 64"
              style="enable-background: new 0 0 64 64"
              xml:space="preserve"
              class="icon-i-1"
            >
              <style>
                .st1 {
                  fill: #263238;
                }
              </style>
              <path
                d="M26 25H10a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1z"
                style="fill: #40c4ff"
              />
              <path
                class="st1"
                d="M26 25.5H10c-.827 0-1.5-.673-1.5-1.5v-9c0-.827.673-1.5 1.5-1.5h16c.827 0 1.5.673 1.5 1.5v9c0 .827-.673 1.5-1.5 1.5zm-16-11a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 
                        .5.5h16a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5H10z"
              />
              <path
                style="fill: #ffd740"
                d="m9.5 38.5 5-4.5 5 1 5-5 5 1.5 5-6 5 13.5 5-5.5 5 2 5-15v30h-45z"
              />
              <path
                class="st1"
                d="M57.5 55h-51c-1.654 0-3-1.398-3-3.116V12.116C3.5 10.398 4.846 9 6.5 9h51c1.654 0 3 1.398 3 3.116v39.768c0 1.718-1.346 3.116-3 3.116zm-51-45c-1.103 0-2 
                        .949-2 2.116v39.768c0 1.167.897 2.116 2 2.116h51c1.103 0 2-.949 2-2.116V12.116c0-1.167-.897-2.116-2-2.116h-51z"
              />
              <path
                class="st1"
                d="M21 17.5H11a.5.5 0 0 1 0-1h10a.5.5 0 0 1 0 1zM21 20H11a.5.5 0 0 1 0-1h10a.5.5 0 0 1 0 1zM16 22.5h-5a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1zM39.5 39.5a.5.5 0 0 
                        1-.469-.326l-4.7-12.69-4.447 5.336a.5.5 0 0 1-.528.159l-4.714-1.414-4.789 4.789a.509.509 0 0 1-.452.137l-4.754-.951-4.813 4.332a.5.5 0 0 1-.669-.743l5-4.5a.51.51 
                        0 0 1 .433-.119l4.737.947 4.811-4.811a.5.5 0 0 1 .497-.125l4.684 1.405 4.789-5.747a.5.5 0 0 1 .853.147l4.714 12.729 4.447-4.892a.5.5 0 0 1 .556-.128l4.508 1.803 
                        4.833-14.497a.5.5 0 1 1 .948.316l-5 15a.5.5 0 0 1-.66.306l-4.678-1.871-4.767 5.243a.498.498 0 0 1-.37.165z"
              />
              <path
                class="st1"
                d="M14.5 51a.5.5 0 0 1-.5-.5V34a.5.5 0 0 1 1 0v16.5a.5.5 0 0 1-.5.5zM19.5 51a.5.5 0 0 1-.5-.5V35a.5.5 0 0 1 1 0v15.5a.5.5 0 0 1-.5.5zM24.5 51a.5.5 0 0 
                        1-.5-.5V30a.5.5 0 0 1 1 0v20.5a.5.5 0 0 1-.5.5zM29.5 51a.5.5 0 0 1-.5-.5v-19a.5.5 0 0 1 1 0v19a.5.5 0 0 1-.5.5zM34.5 51a.5.5 0 0 1-.5-.5v-25a.5.5 0 0 1 1 
                        0v25a.5.5 0 0 1-.5.5zM39.5 51a.5.5 0 0 1-.5-.5V39a.5.5 0 0 1 1 0v11.5a.5.5 0 0 1-.5.5zM44.5 51a.5.5 0 0 1-.5-.5v-17a.5.5 0 0 1 1 0v17a.5.5 0 0 1-.5.5zM49.5 
                        51a.5.5 0 0 1-.5-.5v-15a.5.5 0 0 1 1 0v15a.5.5 0 0 1-.5.5zM39 59h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 0 1zM35 59H15a.5.5 0 0 1 0-1h20a.5.5 0 0 1 0 1zM32 
                        6h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 0 1z"
              />
              <g>
                <path
                  class="st1"
                  d="M54 6H34a.5.5 0 0 1 0-1h20a.5.5 0 0 1 0 1z"
                />
              </g>
            </svg>
            <p>Ads Manager</p>
          </div>
        </a>

        <!-- tenth icon on the left ends here -->

        <!-- eighth icon on the left start here -->
        <a href="#popup1" class="pop-up-1-a">
          <div
            class="icon-div-1 animate__animated"
            onmouseover="iconAnimation(this)"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink"
              viewBox="0 0 512 512"
              style="enable-background: new 0 0 512 512"
              xml:space="preserve"
              class="icon-i-1"
            >
              <style>
                .st0 {
                  fill: #efefef;
                }
                .st7 {
                  fill: #ffdbc5;
                }
                .st8 {
                  fill: #e8b494;
                }
                .st30 {
                  fill: #f7c8ab;
                }
              </style>
              <g id="Layer_7">
                <path
                  d="M441.9 187.5c-.5-52.8-43.6-95.2-96.4-94.7-43.4.4-79.7 29.6-91 69.3-12-39.5-48.9-68-92.2-67.7-52.8.5-95.2 43.6-94.7 96.4.3 29.2 13.6 55.2 34.4 72.5.8 1 1.5
                           2 2.4 3l109.8 130.5c24.2 28.8 63.4 28.4 87.1-.8l107.5-132.5c2.5-3.1 4.6-6.1 6.3-9.1 16.8-17.2 27.1-40.9 26.8-66.9z"
                  style="fill: #db4646"
                />
                <defs>
                  <path
                    id="SVGID_9_"
                    d="M442.9 187.5c-.5-52.8-43.6-95.2-96.4-94.7-43.4.4-79.7 29.6-91 69.3-12-39.5-48.9-68-92.2-67.7-52.8.5-95.2 43.6-94.7 96.4.3 29.2 13.6 55.2 34.4
                             72.5.8 1 1.5 2 2.4 3l109.8 130.5c24.2 28.8 63.4 28.4 87.1-.8l107.5-132.5c2.5-3.1 4.6-6.1 6.3-9.1 16.8-17.2 27.1-40.9 26.8-66.9z"
                  />
                </defs>
                <clipPath id="SVGID_2_">
                  <use xlink:href="#SVGID_9_" style="overflow: visible" />
                </clipPath>
                <g style="clip-path: url(#SVGID_2_)">
                  <path
                    class="st7"
                    d="M344.9 163.9c3.6-2.6 4.4-7.6 1.8-11.3-2.6-3.6-7.6-4.4-11.2-1.8L275 194.4c-3.6 2.6-4.4 7.6-1.8 11.2 2.6 3.6 7.6 4.4 11.2 1.8l60.5-43.5z"
                  />
                  <path
                    class="st7"
                    d="M280.1 228.7c2.8 3.1 7.6 3.4 10.7.6l46.5-41.6c3.1-2.8 3.4-7.6.6-10.7l-.1-.1c-2.8-3.1-7.6-3.4-10.7-.6l-46.5 41.6c-3.1 2.8-3.4 7.6-.6
                             10.7l.1.1zM360.9 151.3c4.4-.7 7.3-4.9 6.6-9.3-.7-4.4-4.9-7.3-9.3-6.6l-48.3 8.1c-4.4.7-7.3 4.9-6.6 9.3.7 4.4 4.9 7.3 9.3 6.6l48.3-8.1z"
                  />
                  <path
                    class="st7"
                    d="M352.4 193.1c2.9-3.4 2.5-8.5-.9-11.3-3.4-2.9-8.5-2.5-11.3.9l-40.2 47c-2.9 3.4-2.5 8.5.9 11.3 3.4 2.9 8.5 2.5 11.3-.9l40.2-47z"
                  />
                  <path
                    class="st7"
                    d="M377.7 180.2c2.3-3.3 1.4-7.8-1.8-10-3.3-2.3-7.8-1.4-10 1.8l-42.6 61.6c-2.3 3.3-1.4 7.8 1.8 10 3.3 2.3 7.8 1.4 10-1.8l42.6-61.6z"
                  />
                  <path
                    class="st7"
                    d="M349.1 205c3.5 3.9 9.4 4.2 13.3.7l30.5-27.3c3.9-3.5 4.2-9.4.7-13.3l-25-28c-3.5-3.9-9.4-4.2-13.3-.7l-30.5 27.3c-3.9 3.5-4.2 9.4-.7 13.3l25 28z"
                  />
                  <path
                    transform="rotate(-41.84 393.095 142.55)"
                    class="st7"
                    d="M361.9 120.2h62.4v44.6h-62.4z"
                  />
                  <path
                    transform="rotate(-41.83 400.255 136.162)"
                    class="st8"
                    d="M386.3 113.9h27.8v44.6h-27.8z"
                  />
                  <path
                    class="st0"
                    d="m437.8 139.7-14.6 13.1c-4.5 4-11.3 3.6-15.3-.8l-22.4-25c-4-4.5-3.6-11.3.8-15.3l14.6-13.1 36.9 41.1z"
                  />
                </g>
                <g style="clip-path: url(#SVGID_2_)">
                  <path
                    class="st30"
                    d="M201.9 305.5c-2.7 3.9-8.1 4.9-12 2.2-3.9-2.7-4.9-8.1-2.2-12l45.3-65.9c2.7-3.9 8.1-4.9 12-2.2 3.9 2.7 4.9 8.1 2.2 12l-45.3 65.9z"
                  />
                  <path
                    class="st30"
                    d="M223.1 296.4c-3.4 3.4-8.9 3.4-12.2 0-3.4-3.4-3.4-8.9 0-12.2l46.7-46.7c3.4-3.4 8.9-3.4 12.2 0 3.4 3.4 3.4 8.9 0 12.2l-46.7 46.7zM189.9
                317.5c-1.1 4.7-5.7 7.6-10.4 6.5-4.7-1.1-7.6-5.7-6.5-10.4l11.5-51.3c1.1-4.7 5.7-7.6 10.4-6.5 4.7 1.1 7.6 5.7 6.5 10.4l-11.5 51.3z"
                  />
                  <path
                    transform="rotate(-45.001 192.26 326.013)"
                    class="st30"
                    d="M146.9 302.5h90.8v47h-90.8z"
                  />
                  <path
                    class="st30"
                    d="M228.7 312c-3.7 3-9.2 2.4-12.2-1.3s-2.4-9.2 1.3-12.2l51.4-41.5c3.7-3 9.2-2.4 12.2 1.3s2.4 9.2-1.3 12.2L228.7 312z"
                  />
                  <path
                    class="st30"
                    d="M213.8 342.5c-3.4 2.6-8.3 1.9-10.9-1.5-2.6-3.4-1.9-8.3 1.5-10.9l64.6-48.9c3.4-2.6 8.3-1.9 10.9 1.5 2.6 3.4 1.9 8.3-1.5 10.9l-64.6 48.9z"
                  />
                  <path
                    transform="rotate(-45.001 168.442 349.826)"
                    class="st8"
                    d="M155.4 326.3h26.1v47h-26.1z"
                  />
                  <path
                    class="st0"
                    d="m171.5 394.4 16.5-16.5c5-5 5-13.2 0-18.3l-28.2-28.2c-5-5-13.2-5-18.3 0L125 347.9l46.5 46.5z"
                  />
                </g>
              </g>
            </svg>
            <p>Fundraiser</p>
          </div>
        </a>

        <!-- eighth icon on the left ends here -->

        <!-- ninth icon on the left start here -->
        <a href="#popup1" class="pop-up-1-a">
          <div
            class="icon-div-1 animate__animated"
            onmouseover="iconAnimation(this)"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
              style="enable-background: new 0 0 512 512"
              xml:space="preserve"
              class="icon-i-1"
            >
              <circle style="fill: #00bbf0" cx="256" cy="256" r="256" />
              <path
                style="fill: #fcb5a9"
                d="M490.357 376.254h5.418v.002h-5.42z"
              />
              <path
                style="fill: #fff"
                d="M379.269 172.05H128.435c-61.375 0-111.129 49.754-111.129 111.129 0 61.375 49.754 111.129 111.129 111.129 37.178 0 70.088-18.26 90.262-46.298h70.31c20.174 28.038 
                        53.083 46.298 90.262 46.298 61.375 0 111.129-49.754 111.129-111.129 0-61.375-49.754-111.129-111.129-111.129z"
              />
              <path
                style="fill: #d3d3d3"
                d="M490.398 284.148c0 61.375-49.754 111.129-111.129 111.129-37.181 0-70.085-18.267-90.258-46.304h-70.318c-20.173 28.036-53.077 46.304-90.258 46.304-61.375 0-111.129-49.754-111.129-111.129
                         0-6.805.614-13.462 1.789-19.929 9.388 51.86 54.771 91.189 109.34 91.189 37.181 0 70.085-18.257 90.258-46.293h70.318c20.173 28.036 53.077 46.293 90.258 46.293 54.57 0 99.953-39.329 109.34-91.189a111.365 
                         111.365 0 0 1 1.789 19.929z"
              />
              <circle
                style="fill: #3e436d"
                cx="387.736"
                cy="269.42"
                r="68.794"
              />
              <circle
                style="fill: #3e436d"
                cx="123.143"
                cy="269.42"
                r="68.794"
              />
              <path
                style="fill: #d3d3d3"
                d="M168.334 247.531H154.17a9.138 9.138 0 0 1-9.138-9.138v-14.164a9.138 9.138 0 0 0-9.138-9.138h-25.503a9.138 9.138 0 0 0-9.138 9.138v14.164a9.138 
                        9.138 0 0 1-9.138 9.138H77.951a9.138 9.138 0 0 0-9.138 9.138v25.503a9.138 9.138 0 0 0 9.138 9.138h14.164a9.138 9.138 0 0 1 9.138 9.138v14.164a9.138 
                        9.138 0 0 0 9.138 9.138h25.503a9.138 9.138 0 0 0 9.138-9.138v-14.164a9.138 9.138 0 0 1 
                      9.138-9.138h14.164a9.138 9.138 0 0 0 9.138-9.138v-25.503c.001-5.047-4.091-9.138-9.138-9.138z"
              />
              <circle
                style="fill: #f8d572"
                cx="386.403"
                cy="228.107"
                r="22.215"
              />
              <circle
                style="fill: #f9bd38"
                cx="386.403"
                cy="228.107"
                r="18.422"
              />
              <path
                style="fill: #e2c06d"
                d="M377.103 228.107c0 7.667 3.882 14.426 9.791 18.416a21.955 21.955 0 0 0 5.969 2.842 22.114 22.114 0 0 1-6.458.956c-12.27 0-22.215-9.945-22.215-22.215 0-.192.003-.382.008-.574.003-.125.005-.252.014-.377 
                      0-.019 0-.038.003-.06.003-.084.008-.171.014-.255.653-11.682 10.335-20.949 22.177-20.949 2.246 0 4.416.333 6.458.956a21.994 21.994 0 0 0-5.968 2.842c-5.911 3.992-9.793 10.751-9.793 18.418z"
              />
              <path
                style="fill: #dda636"
                d="M386.893 246.523c-.163.003-.328.005-.49.005-10.173 0-18.422-8.247-18.422-18.422 0-10.173 8.249-18.422 18.422-18.422.163 0 .328.003.49.005-5.909 3.99-9.791 10.75-9.791 18.416s3.883 14.428 9.791 18.418z"
              />
              <circle
                style="fill: #3588cd"
                cx="348.432"
                cy="271.543"
                r="22.215"
              />
              <path
                style="fill: #3385bc"
                d="M339.132 271.542c0 7.667 3.882 14.426 9.791 18.416a21.955 21.955 0 0 0 5.969 2.842 22.114 22.114 0 0 1-6.458.956c-12.27 0-22.215-9.945-22.215-22.215
                         0-.192.003-.382.008-.574.003-.125.005-.252.014-.377 0-.019 0-.038.003-.06.003-.084.008-.171.014-.255.653-11.682 
                      10.335-20.949 22.177-20.949 2.246 0 4.416.333 6.458.956a21.994 21.994 0 0 0-5.968 2.842c-5.911 3.992-9.793 10.752-9.793 18.418z"
              />
              <circle
                style="fill: #366fcc"
                cx="348.432"
                cy="271.543"
                r="18.422"
              />
              <path
                style="fill: #3268b7"
                d="M355.513 289.003a18.195 18.195 0 0 1-5.863.959c-10.17 0-18.422-8.243-18.422-18.422 0-10.17 8.252-18.422 18.422-18.422 2.054 0 4.026.335 5.863.959-7.302 2.443-12.559 9.347-12.559 17.463 0 8.125 5.257 15.02 12.559 17.463z"
              />
              <circle
                style="fill: #ed4f4f"
                cx="427.039"
                cy="271.542"
                r="22.215"
              />
              <circle
                style="fill: #dd1b1b"
                cx="427.039"
                cy="271.542"
                r="18.422"
              />
              <path
                style="fill: #cc4a4a"
                d="M417.739 271.542c0 7.667 3.882 14.426 9.791 18.417a21.955 21.955 0 0 0 5.969 2.842 22.114 22.114 0 0 1-6.458.956c-12.27 0-22.215-9.945-22.215-22.215 0-.192.003-.382.008-.574.003-.125.005-.252.014-.377 0-.019
                       0-.038.003-.06.003-.084.008-.171.014-.255.653-11.682 10.335-20.949 22.177-20.949 2.246 0 4.416.333 6.458.956a21.994 21.994 0 0 0-5.968 2.842c-5.911 3.991-9.793 10.751-9.793 18.417z"
              />
              <path
                style="fill: #bc1b1b"
                d="M427.53 289.959c-.163.003-.328.005-.49.005-10.173 0-18.422-8.247-18.422-18.422 0-10.173 8.249-18.422 18.422-18.422.163 0 .328.003.49.005-5.909
                         3.991-9.791 10.75-9.791 18.416 0 7.668 3.882 14.427 9.791 18.418z"
              />
              <circle
                style="fill: #03e277"
                cx="386.403"
                cy="310.734"
                r="22.215"
              />
              <circle
                style="fill: #00b764"
                cx="386.403"
                cy="310.734"
                r="18.422"
              />
              <path
                style="fill: #05cc68"
                d="M377.103 310.734c0 7.667 3.882 14.426 9.791 18.416a21.955 21.955 0 0 0 5.969 2.842 22.114 22.114 0 0 1-6.458.956c-12.27 0-22.215-9.945-22.215-22.215 0-.192.003-.382.008-.574.003-.125.005-.252.014-.377 0-.019 
                      0-.038.003-.06.003-.084.008-.171.014-.255.653-11.682 10.335-20.949 22.177-20.949 2.246 0 4.416.333 6.458.956a21.994 21.994 0 0 0-5.968 2.842c-5.911 3.992-9.793 10.751-9.793 18.418z"
              />
              <path
                style="fill: #049e54"
                d="M386.893 329.15c-.163.003-.328.005-.49.005-10.173 0-18.422-8.246-18.422-18.422 0-10.173 8.249-18.422 18.422-18.422.163 0 .328.003.49.005-5.909 3.991-9.791 10.75-9.791 18.416s3.883 14.428 9.791 18.418z"
              />
              <path
                style="fill: #27273d"
                d="M235.218 288.519h-23.06c-6.053 0-10.961-4.907-10.961-10.961 0-6.053 4.907-10.961 10.961-10.961h23.06c6.053 0 10.961 4.907 10.961
                         10.961s-4.908 10.961-10.961 10.961zM295.545 288.519h-23.06c-6.053 0-10.961-4.907-10.961-10.961 0-6.053 
                      4.907-10.961 10.961-10.961h23.06c6.053 0 10.961 4.907 10.961 10.961s-4.908 10.961-10.961 10.961z"
              />
              <path
                style="fill: #c1c1c1"
                d="M303.86 212.653H203.844c-7.453 0-13.494-6.042-13.494-13.494 0-7.453 6.042-13.494 13.494-13.494H303.86c7.453 0 13.494 6.042 13.494 13.494 0 7.453-6.042 13.494-13.494 13.494z"
              />
              <path
                style="fill: #afafaf"
                d="M299.023 205.159h-86.712a5.945 5.945 0 0 1-5.945-5.945v-1.604a5.945 5.945 0 0 1 5.945-5.945h86.712a5.945 5.945 0 0 1 5.945 5.945v1.604a5.945 5.945 0 0 1-5.945 5.945z"
              />
              <g>
                <circle
                  style="fill: #f8c952"
                  cx="256.667"
                  cy="113.503"
                  r="87.383"
                />
                <path
                  style="fill: #f9bd38"
                  d="M251.231 177.911c9.103 8.35 19.986 14.801 31.998 18.703a87.286 87.286 0 0 1-27.053 4.278c-48.254
                           0-87.388-39.134-87.388-87.388s39.134-87.388 87.388-87.388a87.281 87.281 0 0 1 27.053 4.278c-12.012 3.901-22.895 10.352-31.998
                            18.703h-.017c-17.402 15.982-28.319 38.928-28.319 64.407s10.917 48.425 28.319 64.407h.017z"
                />
                <circle
                  style="fill: #ea8032"
                  cx="256.667"
                  cy="113.503"
                  r="64.595"
                />
                <circle
                  style="fill: #f9dc93"
                  cx="256.667"
                  cy="113.503"
                  r="55.073"
                />
                <path
                  style="fill: #f8d572"
                  d="M272.622 166.233a55.142 55.142 0 0 1-15.948 2.344c-30.424 0-55.081-24.657-55.081-55.081 0-30.407 24.657-55.064 55.081-55.064 5.544 0 10.9.821 15.948
                           2.344-22.655 6.845-39.134 27.857-39.134 52.72.001 24.879 16.479 45.892 39.134 52.737z"
                />
                <path
                  style="fill: #fff2d4"
                  d="M239.628 111.792c0 3.169-23.572 10.032-22.643 12.892.962 2.964 24.094-5.351 25.89-2.884 1.813 2.491-13.228 21.924-10.736 23.737 2.467
                           1.795 16.295-18.496 19.258-17.533 2.86.929 2.101 25.504 5.27 25.504 3.169 0 2.411-24.576 5.271-25.504 2.964-.962 16.792 19.328 19.259 
                        17.533 2.491-1.813-12.55-21.245-10.737-23.737 1.795-2.467 24.927 5.847 25.89 2.883.929-2.86-22.643-9.722-22.643-12.891 0-3.169 23.572-10.032 22.643-12.892-.962-2.964-24.094
                         5.351-25.89 2.884-1.813-2.491 13.228-21.924 10.736-23.737-2.467-1.795-16.295 18.496-19.258 17.533-2.86-.929-2.101-25.504-5.27-25.504-3.169 0-2.411 24.576-5.271 
                        25.504-2.964.962-16.792-19.328-19.259-17.533-2.491 1.813 12.55 21.245 10.737 23.737-1.795 2.467-24.927-5.847-25.89-2.883-.929 2.86 22.643 9.722 22.643 12.891z"
                />
              </g>
            </svg>
            <p>Play games</p>
          </div>
        </a>
        <!-- ninth icon on the left ends here -->
      </div>
      <!-- first div ends here -->
      <!-- second div start here -->
      <div class="home-container-div-2">
        <div class="create-story-div">
          <div class="create-story-div-1">
            <label for="create-story-form" class="create-story-label">
              <i class="fa-solid fa-plus"></i>
            </label>
          </div>
          <div class="create-story-div-2">
            <h4>Create Story</h4>
            <p class="create-story-p">Share Photo and Write something</p>
            <div class="create-story-form-div"></div>
          </div>
        </div>
        <div class="what-on-div">
          <div class="what-on-div-1">
            <div><img src="" alt="photo" /></div>
              <input type="text" placeholder="What's on your mind" class="what-on-input" readonly />
          </div>
          <div class="what-on-div-2">
            <div>
              <i class="fa-solid fa-video what-on-icon-1"></i
              ><span class="what-on-text">Live Video</span>
            </div>
            <div>
              <i class="fa-solid fa-images what-on-icon-2"></i
              ><span class="what-on-text">Photo/Video</span>
            </div>
            <div>
              <i class="fa-solid fa-face-smile what-on-icon-3"></i
              ><span class="what-on-text">Feeling/activity</span>
            </div>
          </div>
        </div>

        <?php 
        if($post_exist) { 
          $posts_numbers = 0;
       
         while($posts_numbers < $post_counts) { 
          $jjkks = $users_posts_1[$posts_numbers];
          $post_user_id = $users_posts[$jjkks]["post_unique_id"];
          $post_unique_id = htmlspecialchars($users_posts[$jjkks]["user_unique_id"]);
          $post_username = htmlspecialchars($users_posts[$jjkks]["username"]);
          $post_user_caption = htmlspecialchars($users_posts[$jjkks]["post_texts"]);
          $post_user_img = htmlspecialchars($users_posts[$jjkks]["post_img"]);
          $post_user_like = htmlspecialchars($users_posts[$jjkks]["post_like"]);
          $post_user_date = htmlspecialchars($users_posts[$jjkks]["post_date"]);
          $post_type = htmlspecialchars($users_posts[$jjkks]["post_type"]);

          if($post_type == "story-post") {

            $select_story_img = "select * from `secret_users` where username = '$post_username' and user_unique_id = $post_unique_id";
            $select_story_img_result = mysqli_query($con, $select_story_img);
            $story_img_data = mysqli_fetch_assoc($select_story_img_result);
            $story_img = htmlspecialchars($story_img_data["user_picture"]);

          $select_comment_story = "select * from `user_home_story` where user_unique_id = $post_unique_id and story_unique_id = $post_user_id";
          $comment_story_result = mysqli_query($con, $select_comment_story);
          $comment_story_fetch = mysqli_fetch_assoc($comment_story_result);
          $story_comment_id = $comment_story_fetch["story_id"];
          $story_comment_username = $comment_story_fetch["username"];
          $story_comment_user_id = $comment_story_fetch["user_unique_id"];
      
          $select_comment_row_1 = "select * from `user_home_story_comment` where post_id = $story_comment_id and user_unique_id = $story_comment_user_id and username = '$story_comment_username'";
          $comment_row_result_1 = mysqli_query($con, $select_comment_row_1);
          $comment_number_1 = mysqli_num_rows($comment_row_result_1);
          if($comment_number_1 >= 1) {
            $cm = $comment_number_1;
          } else {
            $cm = 0;
          }

            echo "
            <div class='post-div '>
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
            ";
            if($post_unique_id == $user_unique_id) {
              echo "
              <i class='fa-solid fa-circle-xmark fake-x'></i>
              <i class='fa-solid fa-circle-xmark x-delete-story delete-story hidden' data-story-id='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'></i>
              ";
            } 
            echo "
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
            <i class='fa-solid fa-bell story-comment-btn' data-user-comment='$post_user_id' data-comment-owner-id='$user_unique_id' data-user-story-post='$post_user_img'></i>
          </div>
          <div class='post-input-div'>
            <div class='post-input-img-div'>
              <img src='../sign_up_folder/user_image/$user_picture' alt='photo'>
            </div>
            <form action='../function_folder/common_function_1.php' target='the-iframe' method='post' class='story-input-form story-form' data-user-form='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'>
            <input type='text' name='story-input-text' placeholder='Write a public comment...' class='post-input story-text-input' autocomplete='off'>
            <input type='submit' name='story-comment-submit' value='&#8594;' class='post-comment-btn story-btn'>
            </form>
            </div>
          </div>";
        } else {    

          $select_comment_post = "select * from `secret_users_home_post` where user_id = $post_unique_id and post_unique_id = $post_user_id";
          $comment_post_result = mysqli_query($con, $select_comment_post);
          $comment_post_fetch = mysqli_fetch_assoc($comment_post_result);
          $post_comment_id = $comment_post_fetch["id"];
          $post_comment_username = $comment_post_fetch["username"];
          $post_comment_user_id = $comment_post_fetch["user_id"];

          $select_user_home_pic = "select * from secret_users where username = '$post_username' and user_unique_id = $post_unique_id";
          $select_user_pic_result = mysqli_query($con, $select_user_home_pic);
          $user_home_pic_data = mysqli_fetch_assoc($select_user_pic_result);
          $user_home_post_pic = $user_home_pic_data["user_picture"];
      
          $select_comment_row = "select * from `secret_user_home_comment` where post_id = $post_comment_id and user_unique_id = $post_comment_user_id and username = '$post_comment_username'";
          $comment_row_result = mysqli_query($con, $select_comment_row);
          $comment_number = mysqli_num_rows($comment_row_result);
          if($comment_number >= 1) {
            $cm = $comment_number;
          } else {
            $cm = 0;
          }
     


          echo
         "<div class='post-div post-available'>
           <div class='post-div-nav'>
          <div class='first-post-div'>
            <div class='post-nav-img-div'>
              <img src='../sign_up_folder/user_image/$user_home_post_pic' alt='photo'>
            </div>
            <div class='post-nav-caption-div'>
            <h3>$post_username</h3>
            <p>$post_user_date</p>
            </div>
            </div>
            <div class='second-post-div'>
            <i class='fa-solid fa-bell'></i>
            ";
            if($post_unique_id == $user_unique_id) {
              echo " 
              <i class='fa-solid fa-circle-xmark fake-xx'></i>
              <i class='fa-solid fa-circle-xmark x-delete-post delete-post hidden' data-post-id='$post_user_id' data-comment-owner-id='$user_unique_id' data-user-story-post='$post_user_img'></i>
              ";
            }
            echo "
          </div>
        </div>
        <div class='post-caption-div'>
          <p>$post_user_caption</p>
          </div>
          <div class='post-img-div'>
          <img src='./user_home_post_img/$post_user_img' alt='photo'>
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
          <img src='../sign_up_folder/user_image/$user_picture' alt='photo'>
          </div>
          <form action='../function_folder/common_function_1.php' target='the-iframe' method='POST' class='post-input-form post-form' data-user-form='$post_user_id'  data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'>
          <input type='text' name='post-input' placeholder='Write a public comment...' class='post-input post-text-input' autocomplete='off'>
          <input type='submit' name='post-comment-submit' value='&#8594;' class='post-comment-btn'>
          </form>
          </div>
          </div>
          ";
         }
         $posts_numbers += 1;
        } 
         } else { 
         echo " 
        <div class='post-div no-available-post'>
          <div class='post-div-nav'>
            <div class='first-post-div'>
              <div class='post-nav-img-div'>
                <img
                  src='pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png'
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
              src='pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png'
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
        
    </div>
    <!-- second div ends here -->
    <!-- third div start here -->
      <div class="home-container-div-3">
        <div class="create-group-div">
          <div class="create-group-div-1">
            <div class="create-group-icon-div">
              <i class="fa-solid fa-plus create-group-icon"></i>
            </div>
            <span class="create-group-span">Create New Group</span>
          </div>
        </div>
        <div class="group-row hidden">
          <div class="group-row-div-1">
            <div class="group-img-div">
              <img src="" alt="" />
            </div>
            <div class="group-name-div">
              <h3>Group name</h3>
              <p>Group Bio</p>
            </div>
          </div>
        </div>
      </div>
      <!-- third div ends here -->
    </div>

    <!-- home container ends here -->

    <!-- home container 1 start here-->
    <div class="home-container-1">
      <div class="home-container_div_1">
        <div class="home-container-div-nav">
          <nav class="home-nav">
            <li><i class="fa-solid fa-house-chimney-crack"></i></li>
            <li><a href="../friends_folder/friends.php" target="_self"><i class="fa-solid fa-user-group"></i></a></li>
            <li><i class="fa-solid fa-message nav-message-btn-2"></i></li>
            <li><a href="#popup1"><i class="fa-solid fa-tv"></i></a></li>
            <li>
              <div class="notification-num-2 <?php if(!$notification_number) { echo 'hidden'; } ?>" > <?php echo $notification_number; ?></div>
              <a href=".././notification.php" target="_self"><i class="fa-solid fa-bell"></i></a>
          </li>
            <li><a href="#popup1"><i class="fa-solid fa-people-group"></i></a></li>
          </nav>
        </div>
        <div class="home-container_div_2">
          <div class="photo__div_1"><img src="" alt="photo" /></div>
          <input type="text" name="" id="" class="what-on-input-1" placeholder="What's on your mind?" readonly/>
          <div class="what-on-div-input-div hidden"></div>
          <div class="icon-div__1"><i class="fa-solid fa-face-smile"></i></div>
        </div>
        <div class="home-container_div_3">
          <div class="add-story-div">
            <label for="create-story-form" class="add-story-label">
              <i class="fa-solid fa-plus"></i>
              <!-- <input type="file" name="story-input" id="add-story-inp" class="hidden add-story-inp" /> -->
            </label>
          </div>
        </div>
      </div>

      <?php 
         if($post_exist) { 
          $posts_numbers = 0;
         while($posts_numbers < $post_counts) {

          $jjkkss = $users_posts_1[$posts_numbers];
          $post_user_id = $users_posts[$jjkkss]["post_unique_id"];
          $post_unique_id = htmlspecialchars($users_posts[$jjkkss]["user_unique_id"]);
          $post_username = htmlspecialchars($users_posts[$jjkkss]["username"]);
          $post_user_caption = htmlspecialchars($users_posts[$jjkkss]["post_texts"]);
          $post_user_img = htmlspecialchars($users_posts[$jjkkss]["post_img"]);
          $post_user_like = htmlspecialchars($users_posts[$jjkkss]["post_like"]);
          $post_user_date = htmlspecialchars($users_posts[$jjkkss]["post_date"]);
          $post_type = htmlspecialchars($users_posts[$jjkkss]["post_type"]);
    

          if($post_type == "story-post") {

            $select_story_img = "select * from `secret_users` where username = '$post_username' and user_unique_id = $post_unique_id";
            $select_story_img_result = mysqli_query($con, $select_story_img);
            $story_img_data = mysqli_fetch_assoc($select_story_img_result);
            $story_img = htmlspecialchars($story_img_data["user_picture"]);

          $select_comment_story = "select * from `user_home_story` where user_unique_id = $post_unique_id and story_unique_id = $post_user_id";
          $comment_story_result = mysqli_query($con, $select_comment_story);
          $comment_story_fetch = mysqli_fetch_assoc($comment_story_result);
          $story_comment_id = $comment_story_fetch["story_id"];
          $story_comment_username = $comment_story_fetch["username"];
          $story_comment_user_id = $comment_story_fetch["user_unique_id"];
      
          $select_comment_row_1 = "select * from `user_home_story_comment` where post_id = $story_comment_id and user_unique_id = $story_comment_user_id and username = '$story_comment_username'";
          $comment_row_result_1 = mysqli_query($con, $select_comment_row_1);
          $comment_number_1 = mysqli_num_rows($comment_row_result_1);
          if($comment_number_1 >= 1) {
            $cm = $comment_number_1;
          } else {
            $cm = 0;
          }

            echo "
            <div class='post-div-1'>
          <div class='post-div-nav-1'>
          <div class='first-post-div-1'>
            <div class='post-nav-img-div-1'>
            <img src='../sign_up_folder/user_image/$story_img' alt='photo'>
            </div>
            <div class='post-nav-caption-div-1'>
            <h3>$post_username</h3>
            <p>$post_user_date</p>
            </div>
            </div>
            <div class='second-post-div-1'>
            <i class='fa-solid fa-bell'></i>
            ";
            if($post_unique_id = $user_unique_id) {
              echo "
              <i class='fa-solid fa-circle-xmark fake-x'></i>
              <i class='fa-solid fa-circle-xmark x-delete-story delete-story-1 hidden' data-story-id='$post_user_id' data-comment-owner-id='$user_unique_id' data-user-story-post='$post_user_img'></i>
              ";
            }
            echo " 
          </div>
          </div>
          <div class='post-img-div-1 story-color-div'>
          <div class='post-story-div normal-background story-color-div $post_user_img'><p>$post_user_caption</p></div>
          </div>
          <div class='post-reaction-div-1'>
          <div class='first-post-reaction-div-1'>
              <i class='fa-solid fa-face-smile'></i>
              <i class='fa-solid fa-face-smile reaction-i'><sup>$post_user_like</sup></i>
            </div>
            <div class='second-post-reaction-div-1'>
            <p>$cm comments</p>
            </div>
          </div>
          <div class='post-like-div'>
            <i class='fa-solid fa-plus story-like-i' data-user-id='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'><sup class='like-sup'></sup></i>
            <i class='fa-solid fa-bell story-comment-btn' data-user-comment='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'></i>
          </div>
          <div class='post-input-div-1'>
            <div class='post-input-img-div'>
              <img src='' alt='photo'>
            </div>
            <form action='../function_folder/common_function_1.php'  method='post' target='the-iframe' class='story-input-form story-form-1' data-user-form='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'>
            <input type='text' name='story-input-text' placeholder='Write a public comment...' class='post-input-1 story-text-input-1' autocomplete='off'>
            <input type='submit' name='story-comment-submit' value='&#8594;' class='post-comment-btn'>
            </form>
            </div>
          </div>";

          } else {

          $select_comment_post = "select * from `secret_users_home_post` where user_id = $post_unique_id and post_unique_id = $post_user_id";
          $comment_post_result = mysqli_query($con, $select_comment_post);
          $comment_post_fetch = mysqli_fetch_assoc($comment_post_result);
          $post_comment_id = $comment_post_fetch["id"];
          $post_comment_username = $comment_post_fetch["username"];
          $post_comment_user_id = $comment_post_fetch["user_id"];

          $select_user_home_pic_1 = "select * from secret_users where username = '$post_username' and user_unique_id = $post_unique_id";
          $select_user_pic_result_1 = mysqli_query($con, $select_user_home_pic_1);
          $user_home_pic_data_1 = mysqli_fetch_assoc($select_user_pic_result_1);
          $user_home_post_pic_1 = $user_home_pic_data_1["user_picture"];
      
          $select_comment_row = "select * from `secret_user_home_comment` where post_id = $post_comment_id and user_unique_id = $post_comment_user_id and username = '$post_comment_username'";
          $comment_row_result = mysqli_query($con, $select_comment_row);
          $comment_number = mysqli_num_rows($comment_row_result);
          if($comment_number >= 1) {
            $cm = $comment_number;
          } else {
            $cm = 0;
          } 

            echo
            "<div class='post-div-1 post-available-1'>
            <div class='post-div-nav-1'>
            <div class='first-post-div-1'>
            <div class='post-nav-img-div-1'>
            <img src='../sign_up_folder/user_image/$user_home_post_pic_1' alt='photo'>
            </div>
            <div class='post-nav-caption-div-1'>
            <h3>$post_username</h3>
            <p>$post_user_date</p>
            </div>
            </div>
            <div class='second-post-div-1'>
            <i class='fa-solid fa-bell'></i>
            ";
            if($post_unique_id == $user_unique_id) {
              echo "
              <i class='fa-solid fa-circle-xmark fake-xx'></i>
              <i class='fa-solid fa-circle-xmark x-delete-post delete-post-1 hidden' data-post-id='$post_user_id' data-comment-owner-id='$user_unique_id' data-user-story-post='$post_user_img'></i>
              ";
            }
            echo " 
            </div>
            </div>
            <div class='post-caption-div-1'>
            <p>$post_user_caption</p>
            </div>
          <div class='post-img-div-1'>
          <img src='user_home_post_img/$post_user_img' alt='photo'>
          </div>
          <div class='post-reaction-div-1'>
          <div class='first-post-reaction-div-1'>
          <i class='fa-solid fa-face-smile'></i>
          <i class='fa-solid fa-face-smile reaction-i'><sup>$post_user_like</sup></i>
          </div>
          <div class='second-post-reaction-div-1'>
          <p>$cm comments</p>
          </div>
          </div>
          <div class='post-like-div'>
          <i class='fa-solid fa-plus post-like-i' data-user-id='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'><sup class='like-sup'></sup></i>
          <i class='fa-solid fa-bell comment-btn' data-user-comment='$post_user_id' data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'></i>
          </div>
          <div class='post-input-div-1'>
          <div class='post-input-img-div'>
          <img src='../sign_up_folder/user_image/$user_picture' alt='photo'>
          </div>
          <form action='../function_folder/common_function_1.php' method='post' target='the-iframe' class='post-input-form post-form-1' data-user-form='$post_user_id'  data-comment-owner-id='$post_unique_id' data-user-story-post='$post_user_img'>
          <input type='text' name='post-input' placeholder='Write a public comment...' class='post-input-1 post-text-input-1' autocomplete='off'>
          <input type='submit' name='post-comment-submit' value='&#8594;' class='post-comment-btn'>
          </form>
          </div>
          </div>
          ";} 

          $posts_numbers += 1;
          }
         } else { 
         echo " 
        <div class='post-div-1 no-available-post-1'>
          <div class='post-div-nav-1'>
            <div class='first-post-div-1'>
              <div class='post-nav-img-div-1'>
                <img
                  src='pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png'
                  alt='photo'
                />
              </div>
              <div class='post-nav-caption-div-1'>
                <h3>Peter Drury Football Community</h3>
                <p>14 july 2024</p>
              </div>
            </div>
            <div class='second-post-div-1'></div>
          </div>
          <div class='post-caption-div-1'>
            <p>Don't call me</p>
          </div>
          <div class='post-img-div-1'>
            <img
              src='pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png'
              alt='photo'
            />
          </div>
          <div class='post-reaction-div-1'>
            <div class='first-post-reaction-div-1'>
              <i class='fa-solid fa-face-smile'></i>
              <i class='fa-solid fa-face-smile reaction-i'><sup>2.1k</sup></i>
            </div>
            <div class='second-post-reaction-div-1'>
              <p>83 comments</p>
            </div>
          </div>
          <div class='post-like-div post-like-div-1'>
            <i class='fa-solid fa-plus'></i>
          </div>
        </div>";
         };


         ?>
     
    </div>
    <!-- home container 1 ends here -->

    <!-- modal start here -->

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
        $v = 0;
        $iv = 0;
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
                   $v += 1;
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
  
                  $user_notification = new Home_Notification($notification_unique_id, $notification_username, $notification_type_1, $notification_date);
                  $pffhh["username"] = $user_notification->name;
                  $pffhh["user_unique_id"] = $user_notification->unique_id;
                  $pffhh["notification_type"] = $user_notification->type;
                  $pffhh["notification_date"] = $user_notification->date;
  
                  $home_notification[$notification_id] = $pffhh;
                  $home_notification_1[$iv] = $notification_id;
                  $iv += 1;

                }

              }

            }

            $notification_count = count($home_notification);
            rsort($home_notification_1);
            $iiv = 0;
            if($notification_count >= 1) {
              while($iiv < $notification_count) {
                $ffttd = $home_notification_1[$iiv];
                $notification_username_22 = $home_notification[$ffttd]["username"];
                $notification_type_1_22 = $home_notification[$ffttd]["notification_type"];
                $notification_unique_id_22 = $home_notification[$ffttd]["user_unique_id"];
                $notification_date_22 = $home_notification[$ffttd]["notification_date"];
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
              $iiv += 1;
          }
        } else { if ($v > 1) {$no_notification_true = 2;}
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
                     <img src='../user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='pics' class='notification-img'>
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
            $select_personal_notification_1 = "select * from `secret_notification_table` where friend_unique_id = $user_unique_id";
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
                 <img src='../user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='pics' class='notification-img'>
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

    <div class="modal-2" id="popup2">
      <div class="modal-2-div">
        <form
          action=""
          method="post"
          class="modal-2-form"
          id="post-upload-form"
          data-post-form="<?php echo $user_unique_id ?>"
          enctype="multipart/form-data"
        >
          <input
            type="text"
            name="post-caption"
            id="post-caption-input"
            placeholder="Write something about your new post!"
            class="post-caption-input"
            autocomplete="off"
          />
          <input
            type="file"
            name="story-input"
            id="create-story-form"
            class="hidden create-story-input"
          />
          <input
            type="submit"
            name="story-submit"
            value="&#8594;"
            class="story-submit"
          />
        </form>
      </div>
      <div class="modal-2-div-1">
        <i class="fa-solid fa-xmark"></i>
      </div>
    </div>

    <div class="modal-div-5 hidden">
      <div class="comment-div">
        <div class="comment-owner-div">  
          <i class="fa-solid fa-circle-xmark more-cancel"></i>
        </div>
          <div class="comment-container-div">
          <div class='comment-owner-div-1'>
           <p class='comment-owner'>SECRET-BOOK</p>
          </div>
          </div>
      </div>
    </div>

    <div class="modal-div-6 hidden">
      <div class="modal-6-div">
        <div class="modal-6-div-nav">
          <div class="modal-6-div-nav-1">
            <h3>Create post</h3>
          </div>
          <i class="fa-solid fa-circle-xmark modal-6-cancel"></i>
        </div>
        <div class="modal-6-div-body">
        <form action="" method="post" class="modal-6-form">
          <input type="text" name="modal-6-input" class="modal-6-input" placeholder="What on your Mind?" autocomplete="off">
          <input type="submit" value="post" name="modal-6-submit" class="modal-6-btn">
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

    <div class="modal-div-7 hidden">
      <div class="modal-div-7-first">
        <div class="cancel-modal-7-div">
          <i class='fa-solid fa-circle-xmark x-cancel-fake'></i>
        </div>
        <div class="modal-7-info-div">
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
            $select_recent_query_1 = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$user_username' limit $limit";
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
                    <div class='search-text-div search-text-div-1' data-search-value='$search_recent_result_1' data-user-id='$user_unique_id' data-username='$user_username' data-search-value-1='$search_user_id_2'><p>$search_recent_result_1</p></div>
                    <div class='search-remove-div remove-recent-x' data-recent-id='$search_id_1' data-recent-user-id='$search_user_id_1' data-recent-username='$search_username_1'><i class='fa-solid fa-xmark'></i></div>
                  </div>";
              }
            }
          
          ?>
        </div>
        <div class="see-all-search">
          <?php 
          $select_see_recent = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$user_username'";
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

            $select_recent_query_2 = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$user_username'";
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
                        <div class='see-all-result-div-1 search-text-div-1' data-search-value='$search_recent_result_2' data-user-id='$user_unique_id' data-username='$user_username' data-search-value-1='$search_user_id_3'>
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
    <!-- modal ends here -->

    <iframe name="the-iframe" class="the-iframe-class"></iframe>
  </body>
</html>

 <?php
 include("./home_data_control/user_home_data_control.php");
?> 
