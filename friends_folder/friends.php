<?php 
include("../include_folder/include.php");
session_start();

if(isset($_SESSION["user_unique_id"])) {
    $user_unique_id = $_SESSION["user_unique_id"];
    $select_user_details = "select * from `secret_users` where user_unique_id = $user_unique_id";
    $result_detail = mysqli_query($con, $select_user_details);
    $detail_row = mysqli_num_rows($result_detail);
    if($detail_row >= 1) {
        $user_details = mysqli_fetch_assoc($result_detail);
        $detail_username = $user_details["username"];

        $select_friend_request = "select * from `secret_friend_request` where user_unique_id = $user_unique_id and username = '$detail_username' and request_status = 'Not accepted'";
        $friend_request_result = mysqli_query($con, $select_friend_request);
        $friend_request_row = mysqli_num_rows($friend_request_result);
        if($friend_request_row >= 1) {
            $friend_request = true;
        } else {
            $friend_request = false;
        }
        
        $select_friend_request_1 = "select * from `secret_friend_request` where user_unique_id = $user_unique_id and username = '$detail_username' and request_status = 'Not accepted'";
        $friend_request_result_1 = mysqli_query($con, $select_friend_request_1);
        $friend_request_row_1 = mysqli_num_rows($friend_request_result_1);
        if($friend_request_row_1 >= 1) {
            $friend_request_1 = true;
        } else {
            $friend_request_1 = false;
        }

    }

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
      echo "<script>alert('sorry went wrong')</script>";
      echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
    }   
  
} else {
    echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}

try {

$select_user_location = "select * from `secret_users` where user_unique_id = $user_unique_id";
$select_result_query = mysqli_query($con, $select_user_location);
$location_row = mysqli_num_rows($select_result_query);
if($location_row >= 1) {
    $location_data = mysqli_fetch_assoc($select_result_query);
    $location = $location_data["location"];
    $user_picture = $location_data["user_picture"];
    $select_users = "select * from `secret_users` where location = '$location'";
    $users_result = mysqli_query($con, $select_users);
    $users_location_row = mysqli_num_rows($users_result);
    if($users_location_row >= 1) {
        $users_available = true;
    } else {
        $users_available = false;
    }

    $select_users_1 = "select * from `secret_users` where location = '$location'";
    $users_result_1 = mysqli_query($con, $select_users_1);
    $users_location_row_1 = mysqli_num_rows($users_result_1);
    if($users_location_row_1 >= 1) {
        $users_available_1 = true;
    } else {
        $users_available_1 = false;
    }


    $select_users_2 = "select * from `secret_users` where location = '$location'";
    $users_result_2 = mysqli_query($con, $select_users_2);
    $users_location_row_2 = mysqli_num_rows($users_result_2);
    if($users_location_row_2 >= 1) {
        $users_available_2 = true;
    } else {
        $users_available_2 = false;
    }


}

$select_all_friend = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id or friend_unique_id_2 = $user_unique_id";
$select_all_friend_result = mysqli_query($con, $select_all_friend);
$select_all_friend_row = mysqli_num_rows($select_all_friend_result);
if($select_all_friend_row >= 1) {
    $all_friends = true;
} else {
    $all_friends = false;
}


$select_all_friend_1 = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id or friend_unique_id_2 = $user_unique_id";
$select_all_friend_result_1 = mysqli_query($con, $select_all_friend_1);
$select_all_friend_row_1 = mysqli_num_rows($select_all_friend_result_1);
if($select_all_friend_row_1 >= 1) {
    $all_friends_1 = true;
} else {
    $all_friends_1 = false;
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
  
} catch (Exception $th) {
  echo "<script>alert('Something went wrong')</script>";
  echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>friend</title>
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
    <script defer src="friends.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <!-- css link start here -->
    <link rel="stylesheet" href="friends.css">
    <!-- css link ends here -->
</head>

<body>
    <div class="navigation-div">
        <div class="navigation-div-1">
            <div class="nav-flex1">
                <img src="../user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png"
                    alt="pics" class="nav-img">
                <input type="text" placeholder="Search SecretBook" name="Search_input"
                    class="search-input search-input-div" autocomplete="off">
                <i class="fa-solid fa-magnifying-glass nav-div search-icon"></i>
            </div>
        </div>
        <div class="navigation-div-2">
            <div class="div-nav">
                <nav class="nav">
                    <li><a href="../user_home_folder/user_home.php" target="_self"><i class="fa-solid fa-house"></i></a>
                    </li>
                    <li><a href="#"><i class="fa-solid fa-user-group"></i></a></li>
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
                    <div class="nav-div notification-div-bell"><i class="fa-solid fa-bell notification-bell"></i>
                        <div class="notification-num <?php if(!$notification_number) { echo 'hidden'; } ?>">
                            <?php echo $notification_number; ?></div>
                    </div>
                    <div class="nav-div notification-div-bell-1"><i class="fa-solid fa-bell notification-bell-1"></i>
                        <div class="notification-num <?php if(!$notification_number) { echo 'hidden'; } ?>">
                            <?php echo $notification_number; ?></div>
                    </div>
                    <div class="nav-div1"><img src="../sign_up_folder/user_image/<?php echo $user_picture; ?>"
                            alt="pics" class="nav-img1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-container-div-nav ">
        <nav class="home-nav">
            <li><a href="../user_home_folder/user_home.php" target="_self"><i
                        class="fa-solid fa-house-chimney-crack"></i></a></li>
            <li><i class="fa-solid fa-user-group"></i></li>
            <li><i class="fa-solid fa-message nav-message-btn-2"></i></li>
            <li>
                <a href="#popup1"><i class="fa-solid fa-tv"></i></a>
            </li>
            <li>
                <div class="notification-num-2 <?php if(!$notification_number) { echo 'hidden'; } ?>">
                    <?php echo $notification_number; ?></div>
                <a href=".././notification.php" target="_self"><i class="fa-solid fa-bell"></i></a>
            </li>
            <li><a href="#popup1"><i class="fa-solid fa-people-group"></i></a></li>
        </nav>
    </div>
    <!-- navigation ends here -->
    <!-- main container start here -->
    <div class="main-container">

        <div class="main-container-1">
            <div class="main-container-div">
                <div class="main-div-1">
                    <h2>Friends</h2>
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div class="main-div main-div1">
                    <i class="fa-solid fa-users main-icon-1 home-icon">
                        <p>Home</p>
                    </i>
                </div>
                <div class="main-div main-div2">
                    <i class="fa-solid fa-user-minus main-icon-1">
                        <p>Friend requests</p>
                    </i>
                    <i class="fa-solid fa-chevron-right main-icon"></i>
                </div>
                <div class="main-div main-div3">
                    <i class="fa-solid fa-user-plus main-icon-1">
                        <p>Suggestions</p>
                    </i>
                    <i class="fa-solid fa-chevron-right main-icon"></i>
                </div>
                <div class="main-div main-div4">
                    <i class="fa-solid fa-user-check main-icon-1">
                        <p>All friends</p>
                    </i>
                    <i class="fa-solid fa-chevron-right main-icon"></i>
                </div>
                <div class="main-div main-div5">
                    <i class="fa-solid fa-cake-candles main-icon-1">
                        <p>Birthdays</p>
                    </i>
                    <i class="fa-solid fa-chevron-right main-icon"></i>
                </div>
                <div class="main-div main-div6">
                    <i class="fa-solid fa-user-check main-icon-1">
                        <p>Custom Lists</p>
                    </i>
                    <i class="fa-solid fa-chevron-right main-icon"></i>
                </div>
            </div>


            <div class="main-container-friend-request hidden">
                <div class="friend-request-nav">
                    <div class="friend-nav-1"><i class="fa-solid fa-arrow-left"></i></div>
                    <div class="friend-nav-2">
                        <p>Friends</p>
                        <h2>Friend Requests</h2>
                    </div>
                </div>
                <div class="friend-request-sub-main">
                    <p class="friend-p">Friend Requests</p>
                    <p class="friend-p-1">Lists requests <?php echo $friend_request_row; ?></p>
                </div>
                <div class="friend-request-list">

                    <?php 
                    if($friend_request) {
                        while($friend_request_data = mysqli_fetch_assoc($friend_request_result)) {
                            $friend_request_username = $friend_request_data["request_username"];
                            $friend_request_id = $friend_request_data["request_unique_id"];
                            $select_friend_request_details = "select * from `secret_users` where username = '$friend_request_username' and user_unique_id = $friend_request_id";
                            $request_details = mysqli_query($con, $select_friend_request_details);
                            $request_details_row = mysqli_num_rows($request_details);
                            $accepted_1 = "Request accepted";
                            if($request_details_row >= 1) {
                                $request_detail_data = mysqli_fetch_assoc($request_details);
                                $friend_request_pics = $request_detail_data["user_picture"];
                                $user_request_id_1 = $request_detail_data["user_unique_id"];

                                $select_already_sent_request_out_1 = "select * from `secret_friend_request` where request_unique_id = $user_unique_id 
                                and user_unique_id = $user_request_id_1 and request_status = '$accepted_1' or request_unique_id = $user_request_id_1 and user_unique_id = $user_unique_id and request_status = '$accepted_1'";
                                $already_sent_request_out_result_1 = mysqli_query($con, $select_already_sent_request_out_1);
                                $already_sent_request_out_row_1 = mysqli_num_rows($already_sent_request_out_result_1);    

                                if($already_sent_request_out_row_1 >= 1) continue;


                                echo "
                                       <div class='friend-request-row'>
                                            <div class='friend-request-pic-div'><img src='../sign_up_folder/user_image/$friend_request_pics' alt='photo'></div>
                                            <div class='friend-request-btn-div'>
                                                <p>$friend_request_username</p>
                                                <button class='friend-request-add-btn accept-friend-btn' data-sent-id='$friend_request_id' data-owner-id='$user_unique_id'>Accept friend</button>
                                                <button class='friend-request-remove-btn remove-friend-request' data-sent-id='$friend_request_id' data-owner-id='$user_unique_id'>Remove</button>
                                                <h2 class='hidden accepted-h2'>You're now Friends</h2>
                                                <h2 class='hidden remove-h2'>Friend Request Deleted</h2>
                                            </div>
                                        </div>
                                ";


                            } else {
                                echo "Something went wrong";
                            }
                        }
                    } else {
                        echo "
                                <div class='friend-request-row'></div>
                        ";

                    }
                    
                    
                    ?>

                </div>
            </div>



            <div class="suggestion-container-div hidden">
                <div class="suggestion-nav">
                    <div class="suggestion-nav-1"><i class="fa-solid fa-arrow-left"></i></div>
                    <div class="suggestion-nav-2">
                        <p>Friends</p>
                        <h2>Suggestions</h2>
                    </div>
                </div>
                <div class="suggestion-sub-main">
                    <p class="suggestion-p">People you may know</p>
                </div>
                <div class="suggestion-list">

                    <?php 
                        if($users_available_1) { 
                            $select_user_out_1 = "select * from `secret_users` where user_unique_id = $user_unique_id and location = '$location'";
                            $select_user_result_1 = mysqli_query($con, $select_user_out_1);
                            $select_user_out_row_1 = mysqli_fetch_assoc($select_user_result_1);
                            $user_out_username_1 = $select_user_out_row_1["username"];


                            while($suggestion_available = mysqli_fetch_assoc($users_result_1)) {
                                $suggestion_username = $suggestion_available["username"];
                                $suggestion_pic = $suggestion_available["user_picture"];
                                $suggestion_id = $suggestion_available["user_unique_id"];

                                $select_already_sent_request_out_1 = "select * from `secret_friend_request` where request_unique_id = $user_unique_id 
                                and user_unique_id = $suggestion_id or request_unique_id = $suggestion_id and user_unique_id = $user_unique_id";
                                $already_sent_request_out_result_1 = mysqli_query($con, $select_already_sent_request_out_1);
                                $already_sent_request_out_row_1 = mysqli_num_rows($already_sent_request_out_result_1);            

                                $select_remove_friend = "select * from `suggestion_remove_table` where user_unique_id = $user_unique_id and remove_user_unique_id = $suggestion_id";
                                $remove_friend_result = mysqli_query($con, $select_remove_friend);
                                $remove_friend_row = mysqli_num_rows($remove_friend_result);


                                if ($user_out_username_1 == $suggestion_username) continue;
                                if($already_sent_request_out_row_1 >= 1) continue;
                                if($remove_friend_row >= 1) continue;

                                    echo "  
                                        <div class='suggestion-row'>
                                            <div class='suggestion-pic-div'><img src='../sign_up_folder/user_image/$suggestion_pic' alt='photo'></div>
                                            <div class='suggestion-btn-div'>
                                                <p>$suggestion_username</p>
                                                <button class='suggestion-add-btn suggestion-request-btn' data-suggestion-username='$suggestion_username'>Add friend</button>
                                                <button class='suggestion-remove-btn remove-suggestion-friend' data-suggestion-username='$suggestion_username'>Remove</button>
                                            </div>
                                            <div class='cancel-suggestion-request-div hidden'>
                                                <button class='cancel-suggestion-request-btn cancel-suggestion-btn' data-suggestion-id-1='$suggestion_id' data-suggestion-id-2='$user_unique_id'>Cancel Request</button>
                                            </div>
                                            <div class='cancel-remove-suggestion-div hidden'>
                                                <button class='cancel-remove-suggestion-btn' data-suggestion-id-1='$suggestion_id' data-suggestion-id-2='$user_unique_id'>Cancel</button>
                                            </div>
                                        </div>";


                            }
                        } else {
                                    echo "  
                                        <div class='suggestion-row'></div>";
                        }
            ?>

                </div>
            </div>




            <div class="all-friend-container hidden">
                <div class="all-friend-nav">
                    <div class="all-friend-nav-1"><i class="fa-solid fa-arrow-left"></i></div>
                    <div class="all-friend-nav-2">
                        <p>Friends</p>
                        <h2>All Friends</h2>
                    </div>
                </div>
                <div class="search-all-friend-div">
                    <input type="text" name="" id="" class="search-friend-input" placeholder="Search Friend">
                    <hr>
                </div>
                <p class="count-friend-p"><?php echo $select_all_friend_row ?></p>
                <div class="friend-list">
                    <?php 
                    if($all_friends) {
                        while($all_friends_data = mysqli_fetch_assoc($select_all_friend_result)) {
                            $all_friends_username = $all_friends_data["friend_username_1"];
                            $all_friends_username_1 = $all_friends_data["friend_username_2"];
                            $all_friends_id_1 = $all_friends_data["friend_unique_id_1"];
                            $all_friends_id_2 = $all_friends_data["friend_unique_id_2"];

                           
                            $select_friend_pic = "select * from `secret_users` where user_unique_id = $all_friends_id_1";
                            $select_friend_pic_1 = "select * from `secret_users` where user_unique_id = $all_friends_id_2";
                            $select_friend_pic_result = mysqli_query($con, $select_friend_pic);
                            $select_friend_pic_result_1 = mysqli_query($con, $select_friend_pic_1);
                            $friend_pic_num = mysqli_num_rows($select_friend_pic_result);
                            $friend_pic_num_1 = mysqli_num_rows($select_friend_pic_result_1);
                            if($friend_pic_num >= 1 && $friend_pic_num_1 >= 1) {
                                $all_friend_data_pic = mysqli_fetch_array($select_friend_pic_result);
                                $all_friend_data_pic_1 = mysqli_fetch_assoc($select_friend_pic_result_1);
                                $all_friend_pics = $all_friend_data_pic["user_picture"];
                                $all_friend_pics_1 = $all_friend_data_pic_1["user_picture"];

                                if($all_friends_id_1 == $user_unique_id) {
                                    echo "
                                      <div class='all-friend-div'>
                                        <div class='all-friend-img-div'>
                                            <img src='../sign_up_folder/user_image/$all_friend_pics_1' alt='photo'>
                                        </div>
                                        <div class='all-friend-name-div all-friend-name-div-1' data-view-all-friend-profile='$all_friends_id_2' data-all-username-friend-profile='$all_friends_username_1'>
                                            <p>$all_friends_username_1</p>
                                        </div>
                                    </div>";
                                } else {
                                    echo "
                                    <div class='all-friend-div'>
                                      <div class='all-friend-img-div'>
                                          <img src='../sign_up_folder/user_image/$all_friend_pics' alt='photo'>
                                      </div>
                                      <div class='all-friend-name-div all-friend-name-div-2' data-view-all-friend-profile='$all_friends_id_1' data-all-username-friend-profile='$all_friends_username'>
                                          <p>$all_friends_username</p>
                                      </div>
                                  </div>";
                                }
                            }
                        }
                    }
                    ?>
                    <!-- <div class="all-friend-div">
                        <div class="all-friend-img-div">
                            <img src="" alt="photo">
                        </div>
                        <div class="all-friend-name-div">
                            <p>username</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>


        <?php
        if($users_available) {

                if($users_location_row == 1) {
                    echo "
                <div class='main-container-2'>
                    <div class='no-friend-div'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='no-friend-svg' xml:space='preserve' width='655.359' height='655.359' style='shape-rendering:geometricPrecision;
                        text-rendering:geometricPrecision;image-rendering:optimizeQuality;fill-rule:evenodd;clip-rule:evenodd' viewBox='0 0 6.827 6.827'><defs>
                        <style>.fil8{fill:#2f2f2f}.fil7{fill:#545454}.fil0{fill:#7e7e7e}.fil1{fill:#838383}.fil2{fill:#8e8e8f}.fil3{fill:#bcbcbc}.fil4{fill:#d1d1d1}</style>
                        </defs><g id='Layer_x0020_1'><path class='fil0' d='M4.217 4.034h.478v1.881h-.478zM3.523 4.034h.478v1.881h-.478z'/><path class='fil1' d='M3.153 2.167c.216-.047 
                        1.296-.329 1.416-.195l.029.124-1.375.444-.07-.373z'/><path class='fil2' d='M4.34 2.038h-.462c-.235 0-.427.092-.427.327v1.69h1.317v-1.69c0-.235-.192-.327-.427-.327z'/>
                        <path class='fil3' d='M3.944 1.758h.33v.421h-.33z'/><g id='_530131264'><path id='_530131912' class='fil3' d='M3.754 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/>
                        <path id='_530131816' class='fil3' d='M4.464 1.641s.175-.217.09-.264c0 0-.19.005-.09.264z'/></g><ellipse class='fil4' cx='4.109' cy='1.42' rx='.4' ry='.514'/>
                        <path class='fil3' d='m4.09 2.29-.151.952.17.255.17-.255-.151-.951-.019-.001z'/><path d='M3.78 2.05a.96.96 0 0 1 .133-.012h.03l.166.142.166-.142h.03a.96.96
                        0 0 1 .134.012l-.185.278-.145-.148-.144.148-.186-.278z' style='fill:#6e6e6e'/><path style='fill:#868686' d='m4.046 2.244.063-.064.063.064-.063.066z'/>
                        <path class='fil4' d='M4.959 3.54s0 .035-.03.052c0 0-.035.03-.059.113 0 0-.023.093-.035.128 0 0 .025.047.052-.02 0 0 .022-.083.038-.078 0 0 .014.052
                         0 .111l-.021.107s0 .036.025.032l.04-.13s.008-.049.014-.056c0 0 .007.047-.003.078 0 0-.023.07-.022.1 0 0 .007.039.027.025 0 0 .026-.092.041-.118l.008-.086s.01-.01.007.03c0 
                         0-.002.044.001.048l-.03.078s.006.066.03.022l.038-.09.006-.06s.006-.063.018-.016l.008.03s-.008.055.003.069c0 
                         0 .027.045.036-.076l-.024-.093v-.07s-.011-.07-.023-.082v-.035l-.145-.014z'/><path class='fil2' d='M4.713 2.178c.027-.018.595.71.451 
                         1.44l-.292.012s.078-.734-.226-1.026l.001-.437.066.01z'/><path class='fil7' d='M2.131 4.034h.478v1.881h-.478z'/><path class='fil2' d='M3.658 
                         2.167c-.216-.047-1.295-.329-1.415-.195l-.03.124 1.376.444.07-.373z'/><path class='fil7' d='M2.826 4.034h.478v1.881h-.478z'/><path class='fil1' 
                         d='M2.486 2.038h.463c.235 0 .427.092.427.327v1.69H2.059v-1.69c0-.235.192-.327.427-.327z'/><path class='fil3' d='M2.552 1.758h.33v.421h-.33z'/>
                         <g id='_530129200'><path id='_530129872' class='fil3' d='M3.073 1.641s.174-.217.09-.264c0 0-.19.005-.09.264z'/>
                        <path id='_530130088' class='fil3' d='M2.362 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/><ellipse id='_530129224' class='fil4' cx='2.717' 
                        cy='1.42' rx='.4' ry=''.514'/><path id='_530129056' class='fil8' d='M2.347 1.465s.1-.187.116-.246c0 0 .327.357.595.03l.015.252s.283-.565-.357-.595c0 
                        0-.61.015-.37.559z'/></g><path style='fill:#e1e1e2' d='m2.736 2.29.152.952-.17.255-.171-.255.152-.951.018-.001z'/><path d='M3.047 2.05a.96.96 0 0 
                        0-.133-.012h-.031l-.166.142-.165-.142h-.03a.96.96 0 0 0-.134.012l.185.278.144-.148.145.148.185-.278z' style='fill:#6a6a6a'/><path style='fill:#b3b4b4' 
                        d='m2.78 2.244-.063-.064-.062.064.062.066z'/><path class='fil4' d='M1.868 3.54s0 .035.03.052c0 0 .035.03.058.113 0 0 .024.093.035.128 0 0-.025.047-.052-.02 0 
                        0-.021-.083-.037-.078 0 0-.014.052 0 .111l.02.107s0 .036-.024.032l-.04-.13s-.008-.049-.014-.056c0 0-.007.047.003.078 0 0 .023.07.022.1 0 0-.008.039-.028.025 0 
                        0-.026-.092-.04-.118l-.008-.086s-.01-.01-.008.03c0 0 .003.044 0 .048l.03.078s-.006.066-.03.022l-.038-.09-.006-.06s-.007-.063-.018-.016l-.008.03s.008.055-.003.069c0 
                        0-.027.045-.036-.076l.023-.093v-.07s.012-.07.024-.082v-.035l.145-.014z'/><path class='fil1' d='M2.114 2.178c-.027-.018-.595.71-.451 
                        1.44l.292.012s-.078-.734.226-1.026l-.002-.437-.065.01z'/><path class='fil8' d='M3.716 1.336s.279-.33.437-.19c0 0 .252.22.379.193.243-.725-1.171-.564-.816-.003zM4.456 
                        5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.762 5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 
                        0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.065 5.707c.134 0 .243.099.243.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.005-.046c0-.121.109-.22.244-.22zM2.37 5.707c.135 
                        0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22z'/><path class='fil4' d='M2.372 2.041s-.02.03-.005.06c0 0 .012.045-.014.126 
                        0 0-.033.09-.043.126 0 0-.047.026-.032-.046 0 0 .029-.08.013-.085 0 0-.041.035-.062.093l-.043.1s-.02.03-.038.012l.04-.13s.02-.045.018-.054c0 0-.031.035-.04.066 
                        0 0-.02.071-.038.096 0 0-.028.027-.037.005 0 0 .03-.091.032-.12l.042-.077s-.003-.013-.023.022c0 0-.023.036-.028.038l-.018.082s-.042.052-.037.002l.018-.096.03-.054s.029-.055-.007-.023l-.023.02s-.024.051-.041.056c0
                        0-.048.022.012-.083l.072-.064.04-.058s.048-.052.064-.055l.02-.03.128.071zM4.44 2.041s.02.03.005.06c0 0-.012.045.014.126 0 0 .033.09.043.126 0 0 .047.026.032-.046 
                        0 0-.029-.08-.013-.085 0 0 .04.035.062.093l.042.1s.021.03.04.012l-.04-.13s-.021-.045-.02-.054c0 0 .032.035.041.066 0 0 .02.071.038.096 0 0 .027.027.037.005 
                        0 0-.03-.091-.032-.12l-.042-.077s.003-.013.023.022c0 0 .022.036.027.038l.019.082s.042.052.037.002l-.019-.096-.029-.054s-.03-.055.007-.023l.023.02s.024.051.041.056c0 
                        0 .048.022-.013-.083l-.071-.064-.04-.058S4.605 2.003 4.589 2l-.02-.03-.128.071z'/></g><path style='fill:none' d='M0 0h6.827v6.827H0z'/></svg>
                    </div>
                    <div class='no-friend-div-1'>
                        <p class='no-friend-p-1'>No friend request or friend Suggestions</p>
                        <p class='no-friend-p-2 hidden'>When you have friend request or suggestion, you'll see them here.</p>
                    </div>
                </div>";
                } else {
                    $select_user_out = "select * from `secret_users` where user_unique_id = $user_unique_id and location = '$location'";
                                    $select_user_result = mysqli_query($con, $select_user_out);
                                    $select_user_out_row = mysqli_fetch_assoc($select_user_result);
                                    $user_out_username = $select_user_out_row["username"];
                    
                  
                    echo "  <div class='friend-available-div'>
                                <div class='first-friend-available-div'>
                                   <h2>People you may know</h2>
                                   <p class='see-all-p'>See all</p>
                                </div>
                                <div class='second-friend-available-div'>";
                              while($user_inform = mysqli_fetch_assoc($users_result)) {
                                $user_picture = $user_inform["user_picture"];
                                $username = $user_inform["username"];
                                $user_request_id = $user_inform["user_unique_id"];

                                $select_already_sent_request_out = "select * from `secret_friend_request` where request_unique_id = $user_unique_id 
                                and user_unique_id = $user_request_id or request_unique_id = $user_request_id and user_unique_id = $user_unique_id";
                                $already_sent_request_out_result = mysqli_query($con, $select_already_sent_request_out);
                                $already_sent_request_out_row = mysqli_num_rows($already_sent_request_out_result);    
                                
                                $already_friends = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id and friend_unique_id_2 = $user_request_id
                                or friend_unique_id_1 = $user_request_id and friend_unique_id_2 = $user_unique_id";
                                $already_friends_result = mysqli_query($con, $already_friends);
                                $already_friends_row = mysqli_num_rows($already_friends_result);

                                $select_remove_friend_1 = "select * from `suggestion_remove_table` where user_unique_id = $user_unique_id and remove_user_unique_id = $user_request_id";
                                $remove_friend_result_1 = mysqli_query($con, $select_remove_friend_1);
                                $remove_friend_row_1 = mysqli_num_rows($remove_friend_result_1);


                                    
                                    if($user_out_username == $username) continue;
                                    if($already_sent_request_out_row >= 1) continue;
                                    if($already_friends_row >= 1) continue;
                                    if($remove_friend_row_1 >= 1) continue;

                                echo "    
                                    <div class='friend-card'>
                                        <div class='friend-card-img'>
                                            <img src='../sign_up_folder/user_image/$user_picture' alt='photo'>
                                        </div>
                                        <p>$username</p>
                                        <div class='friend-card-btn-div'>
                                            <button class='add-btn-1 friend-request-btn add-know-friend' data-username='$username'>Add friend</button>
                                            <button class='remove-btn-1 remove-know-friend' data-username='$username'>Remove friend</button>
                                        </div>
                                        <div class='cancel-friend-request-div hidden'>
                                            <button class='cancel-friend-request-btn cancel-friend-request' data-request-id-1='$user_request_id' data-request-id-2='$user_unique_id'>Cancel</button>
                                        </div>
                                        <div class='cancel-remove-request-div hidden'>
                                            <button class='cancel-remove-request-btn cancel-remove-request' data-request-id-1='$user_request_id' data-request-id-2='$user_unique_id'>Cancel</button>
                                        </div>
                                    </div>";

                                }
                echo"           </div>
                            </div>";
                            
            }
        } else {
            echo "
            <div class='main-container-2'>
            <div class='no-friend-div'>
                <svg xmlns='http://www.w3.org/2000/svg' class='no-friend-svg' xml:space='preserve' width='655.359' height='655.359' style='shape-rendering:geometricPrecision;
                text-rendering:geometricPrecision;image-rendering:optimizeQuality;fill-rule:evenodd;clip-rule:evenodd' viewBox='0 0 6.827 6.827'><defs>
                <style>.fil8{fill:#2f2f2f}.fil7{fill:#545454}.fil0{fill:#7e7e7e}.fil1{fill:#838383}.fil2{fill:#8e8e8f}.fil3{fill:#bcbcbc}.fil4{fill:#d1d1d1}</style>
                </defs><g id='Layer_x0020_1'><path class='fil0' d='M4.217 4.034h.478v1.881h-.478zM3.523 4.034h.478v1.881h-.478z'/><path class='fil1' d='M3.153 2.167c.216-.047 
                1.296-.329 1.416-.195l.029.124-1.375.444-.07-.373z'/><path class='fil2' d='M4.34 2.038h-.462c-.235 0-.427.092-.427.327v1.69h1.317v-1.69c0-.235-.192-.327-.427-.327z'/>
                <path class='fil3' d='M3.944 1.758h.33v.421h-.33z'/><g id='_530131264'><path id='_530131912' class='fil3' d='M3.754 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/>
                <path id='_530131816' class='fil3' d='M4.464 1.641s.175-.217.09-.264c0 0-.19.005-.09.264z'/></g><ellipse class='fil4' cx='4.109' cy='1.42' rx='.4' ry='.514'/>
                <path class='fil3' d='m4.09 2.29-.151.952.17.255.17-.255-.151-.951-.019-.001z'/><path d='M3.78 2.05a.96.96 0 0 1 .133-.012h.03l.166.142.166-.142h.03a.96.96
                0 0 1 .134.012l-.185.278-.145-.148-.144.148-.186-.278z' style='fill:#6e6e6e'/><path style='fill:#868686' d='m4.046 2.244.063-.064.063.064-.063.066z'/>
                <path class='fil4' d='M4.959 3.54s0 .035-.03.052c0 0-.035.03-.059.113 0 0-.023.093-.035.128 0 0 .025.047.052-.02 0 0 .022-.083.038-.078 0 0 .014.052
                 0 .111l-.021.107s0 .036.025.032l.04-.13s.008-.049.014-.056c0 0 .007.047-.003.078 0 0-.023.07-.022.1 0 0 .007.039.027.025 0 0 .026-.092.041-.118l.008-.086s.01-.01.007.03c0 
                 0-.002.044.001.048l-.03.078s.006.066.03.022l.038-.09.006-.06s.006-.063.018-.016l.008.03s-.008.055.003.069c0 
                 0 .027.045.036-.076l-.024-.093v-.07s-.011-.07-.023-.082v-.035l-.145-.014z'/><path class='fil2' d='M4.713 2.178c.027-.018.595.71.451 
                 1.44l-.292.012s.078-.734-.226-1.026l.001-.437.066.01z'/><path class='fil7' d='M2.131 4.034h.478v1.881h-.478z'/><path class='fil2' d='M3.658 
                 2.167c-.216-.047-1.295-.329-1.415-.195l-.03.124 1.376.444.07-.373z'/><path class='fil7' d='M2.826 4.034h.478v1.881h-.478z'/><path class='fil1' 
                 d='M2.486 2.038h.463c.235 0 .427.092.427.327v1.69H2.059v-1.69c0-.235.192-.327.427-.327z'/><path class='fil3' d='M2.552 1.758h.33v.421h-.33z'/>
                 <g id='_530129200'><path id='_530129872' class='fil3' d='M3.073 1.641s.174-.217.09-.264c0 0-.19.005-.09.264z'/>
                <path id='_530130088' class='fil3' d='M2.362 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/><ellipse id='_530129224' class='fil4' cx='2.717' 
                cy='1.42' rx='.4' ry=''.514'/><path id='_530129056' class='fil8' d='M2.347 1.465s.1-.187.116-.246c0 0 .327.357.595.03l.015.252s.283-.565-.357-.595c0 
                0-.61.015-.37.559z'/></g><path style='fill:#e1e1e2' d='m2.736 2.29.152.952-.17.255-.171-.255.152-.951.018-.001z'/><path d='M3.047 2.05a.96.96 0 0 
                0-.133-.012h-.031l-.166.142-.165-.142h-.03a.96.96 0 0 0-.134.012l.185.278.144-.148.145.148.185-.278z' style='fill:#6a6a6a'/><path style='fill:#b3b4b4' 
                d='m2.78 2.244-.063-.064-.062.064.062.066z'/><path class='fil4' d='M1.868 3.54s0 .035.03.052c0 0 .035.03.058.113 0 0 .024.093.035.128 0 0-.025.047-.052-.02 0 
                0-.021-.083-.037-.078 0 0-.014.052 0 .111l.02.107s0 .036-.024.032l-.04-.13s-.008-.049-.014-.056c0 0-.007.047.003.078 0 0 .023.07.022.1 0 0-.008.039-.028.025 0 
                0-.026-.092-.04-.118l-.008-.086s-.01-.01-.008.03c0 0 .003.044 0 .048l.03.078s-.006.066-.03.022l-.038-.09-.006-.06s-.007-.063-.018-.016l-.008.03s.008.055-.003.069c0 
                0-.027.045-.036-.076l.023-.093v-.07s.012-.07.024-.082v-.035l.145-.014z'/><path class='fil1' d='M2.114 2.178c-.027-.018-.595.71-.451 
                1.44l.292.012s-.078-.734.226-1.026l-.002-.437-.065.01z'/><path class='fil8' d='M3.716 1.336s.279-.33.437-.19c0 0 .252.22.379.193.243-.725-1.171-.564-.816-.003zM4.456 
                5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.762 5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 
                0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.065 5.707c.134 0 .243.099.243.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.005-.046c0-.121.109-.22.244-.22zM2.37 5.707c.135 
                0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22z'/><path class='fil4' d='M2.372 2.041s-.02.03-.005.06c0 0 .012.045-.014.126 
                0 0-.033.09-.043.126 0 0-.047.026-.032-.046 0 0 .029-.08.013-.085 0 0-.041.035-.062.093l-.043.1s-.02.03-.038.012l.04-.13s.02-.045.018-.054c0 0-.031.035-.04.066 
                0 0-.02.071-.038.096 0 0-.028.027-.037.005 0 0 .03-.091.032-.12l.042-.077s-.003-.013-.023.022c0 0-.023.036-.028.038l-.018.082s-.042.052-.037.002l.018-.096.03-.054s.029-.055-.007-.023l-.023.02s-.024.051-.041.056c0
                0-.048.022.012-.083l.072-.064.04-.058s.048-.052.064-.055l.02-.03.128.071zM4.44 2.041s.02.03.005.06c0 0-.012.045.014.126 0 0 .033.09.043.126 0 0 .047.026.032-.046 
                0 0-.029-.08-.013-.085 0 0 .04.035.062.093l.042.1s.021.03.04.012l-.04-.13s-.021-.045-.02-.054c0 0 .032.035.041.066 0 0 .02.071.038.096 0 0 .027.027.037.005 
                0 0-.03-.091-.032-.12l-.042-.077s.003-.013.023.022c0 0 .022.036.027.038l.019.082s.042.052.037.002l-.019-.096-.029-.054s-.03-.055.007-.023l.023.02s.024.051.041.056c0 
                0 .048.022-.013-.083l-.071-.064-.04-.058S4.605 2.003 4.589 2l-.02-.03-.128.071z'/></g><path style='fill:none' d='M0 0h6.827v6.827H0z'/></svg>
            </div>
            <div class='no-friend-div-1'>
                <p class='no-friend-p-1'>No friend request or friend Suggestions</p>
                <p class='no-friend-p-2 hidden'>When you have friend request or suggestion, you'll see them here.</p>
            </div>
        </div>";
        }
        ?>

        <div class="main-container-4 hidden friend-profile-div">
            <div class="no-friend-div friend-profile-div-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="no-friend-svg" xml:space="preserve" width="655.359"
                    height="655.359" style="shape-rendering:geometricPrecision;
                text-rendering:geometricPrecision;image-rendering:optimizeQuality;fill-rule:evenodd;clip-rule:evenodd"
                    viewBox="0 0 6.827 6.827">
                    <defs>
                        <style>
                        .fil8 {
                            fill: #2f2f2f
                        }

                        .fil7 {
                            fill: #545454
                        }

                        .fil0 {
                            fill: #7e7e7e
                        }

                        .fil1 {
                            fill: #838383
                        }

                        .fil2 {
                            fill: #8e8e8f
                        }

                        .fil3 {
                            fill: #bcbcbc
                        }

                        .fil4 {
                            fill: #d1d1d1
                        }
                        </style>
                    </defs>
                    <g id="Layer_x0020_1">
                        <path class="fil0" d="M4.217 4.034h.478v1.881h-.478zM3.523 4.034h.478v1.881h-.478z" />
                        <path class="fil1" d="M3.153 2.167c.216-.047 
                1.296-.329 1.416-.195l.029.124-1.375.444-.07-.373z" />
                        <path class="fil2"
                            d="M4.34 2.038h-.462c-.235 0-.427.092-.427.327v1.69h1.317v-1.69c0-.235-.192-.327-.427-.327z" />
                        <path class="fil3" d="M3.944 1.758h.33v.421h-.33z" />
                        <g id="_530131264">
                            <path id="_530131912" class="fil3"
                                d="M3.754 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z" />
                            <path id="_530131816" class="fil3"
                                d="M4.464 1.641s.175-.217.09-.264c0 0-.19.005-.09.264z" />
                        </g>
                        <ellipse class="fil4" cx="4.109" cy="1.42" rx=".4" ry=".514" />
                        <path class="fil3" d="m4.09 2.29-.151.952.17.255.17-.255-.151-.951-.019-.001z" />
                        <path d="M3.78 2.05a.96.96 0 0 1 .133-.012h.03l.166.142.166-.142h.03a.96.96
                0 0 1 .134.012l-.185.278-.145-.148-.144.148-.186-.278z" style="fill:#6e6e6e" />
                        <path style="fill:#868686" d="m4.046 2.244.063-.064.063.064-.063.066z" />
                        <path class="fil4" d="M4.959 3.54s0 .035-.03.052c0 0-.035.03-.059.113 0 0-.023.093-.035.128 0 0 .025.047.052-.02 0 0 .022-.083.038-.078 0 0 .014.052
                 0 .111l-.021.107s0 .036.025.032l.04-.13s.008-.049.014-.056c0 0 .007.047-.003.078 0 0-.023.07-.022.1 0 0 .007.039.027.025 0 0 .026-.092.041-.118l.008-.086s.01-.01.007.03c0 
                 0-.002.044.001.048l-.03.078s.006.066.03.022l.038-.09.006-.06s.006-.063.018-.016l.008.03s-.008.055.003.069c0 
                 0 .027.045.036-.076l-.024-.093v-.07s-.011-.07-.023-.082v-.035l-.145-.014z" />
                        <path class="fil2" d="M4.713 2.178c.027-.018.595.71.451 
                 1.44l-.292.012s.078-.734-.226-1.026l.001-.437.066.01z" />
                        <path class="fil7" d="M2.131 4.034h.478v1.881h-.478z" />
                        <path class="fil2" d="M3.658 
                 2.167c-.216-.047-1.295-.329-1.415-.195l-.03.124 1.376.444.07-.373z" />
                        <path class="fil7" d="M2.826 4.034h.478v1.881h-.478z" />
                        <path class="fil1"
                            d="M2.486 2.038h.463c.235 0 .427.092.427.327v1.69H2.059v-1.69c0-.235.192-.327.427-.327z" />
                        <path class="fil3" d="M2.552 1.758h.33v.421h-.33z" />
                        <g id="_530129200">
                            <path id="_530129872" class="fil3"
                                d="M3.073 1.641s.174-.217.09-.264c0 0-.19.005-.09.264z" />
                            <path id="_530130088" class="fil3"
                                d="M2.362 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z" />
                            <ellipse id="_530129224" class="fil4" cx="2.717" cy="1.42" rx=".4" ry=".514" />
                            <path id="_530129056" class="fil8" d="M2.347 1.465s.1-.187.116-.246c0 0 .327.357.595.03l.015.252s.283-.565-.357-.595c0 
                0-.61.015-.37.559z" />
                        </g>
                        <path style="fill:#e1e1e2" d="m2.736 2.29.152.952-.17.255-.171-.255.152-.951.018-.001z" />
                        <path d="M3.047 2.05a.96.96 0 0 
                0-.133-.012h-.031l-.166.142-.165-.142h-.03a.96.96 0 0 0-.134.012l.185.278.144-.148.145.148.185-.278z"
                            style="fill:#6a6a6a" />
                        <path style="fill:#b3b4b4" d="m2.78 2.244-.063-.064-.062.064.062.066z" />
                        <path class="fil4" d="M1.868 3.54s0 .035.03.052c0 0 .035.03.058.113 0 0 .024.093.035.128 0 0-.025.047-.052-.02 0 
                0-.021-.083-.037-.078 0 0-.014.052 0 .111l.02.107s0 .036-.024.032l-.04-.13s-.008-.049-.014-.056c0 0-.007.047.003.078 0 0 .023.07.022.1 0 0-.008.039-.028.025 0 
                0-.026-.092-.04-.118l-.008-.086s-.01-.01-.008.03c0 0 .003.044 0 .048l.03.078s-.006.066-.03.022l-.038-.09-.006-.06s-.007-.063-.018-.016l-.008.03s.008.055-.003.069c0 
                0-.027.045-.036-.076l.023-.093v-.07s.012-.07.024-.082v-.035l.145-.014z" />
                        <path class="fil1" d="M2.114 2.178c-.027-.018-.595.71-.451 
                1.44l.292.012s-.078-.734.226-1.026l-.002-.437-.065.01z" />
                        <path class="fil8" d="M3.716 1.336s.279-.33.437-.19c0 0 .252.22.379.193.243-.725-1.171-.564-.816-.003zM4.456 
                5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.762 5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 
                0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.065 5.707c.134 0 .243.099.243.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.005-.046c0-.121.109-.22.244-.22zM2.37 5.707c.135 
                0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22z" />
                        <path class="fil4" d="M2.372 2.041s-.02.03-.005.06c0 0 .012.045-.014.126 
                0 0-.033.09-.043.126 0 0-.047.026-.032-.046 0 0 .029-.08.013-.085 0 0-.041.035-.062.093l-.043.1s-.02.03-.038.012l.04-.13s.02-.045.018-.054c0 0-.031.035-.04.066 
                0 0-.02.071-.038.096 0 0-.028.027-.037.005 0 0 .03-.091.032-.12l.042-.077s-.003-.013-.023.022c0 0-.023.036-.028.038l-.018.082s-.042.052-.037.002l.018-.096.03-.054s.029-.055-.007-.023l-.023.02s-.024.051-.041.056c0
                0-.048.022.012-.083l.072-.064.04-.058s.048-.052.064-.055l.02-.03.128.071zM4.44 2.041s.02.03.005.06c0 0-.012.045.014.126 0 0 .033.09.043.126 0 0 .047.026.032-.046 
                0 0-.029-.08-.013-.085 0 0 .04.035.062.093l.042.1s.021.03.04.012l-.04-.13s-.021-.045-.02-.054c0 0 .032.035.041.066 0 0 .02.071.038.096 0 0 .027.027.037.005 
                0 0-.03-.091-.032-.12l-.042-.077s.003-.013.023.022c0 0 .022.036.027.038l.019.082s.042.052.037.002l-.019-.096-.029-.054s-.03-.055.007-.023l.023.02s.024.051.041.056c0 
                0 .048.022-.013-.083l-.071-.064-.04-.058S4.605 2.003 4.589 2l-.02-.03-.128.071z" />
                    </g>
                    <path style="fill:none" d="M0 0h6.827v6.827H0z" />
                </svg>
            </div>
            <div class="no-friend-div-1">
                <p class="no-friend-p-4">No friend request or friend Suggestions</p>
                <p class="no-friend-p-5 hidden">When you have friend request or suggestion, you'll see them here.</p>
                <p class="no-friend-p-3 hidden">Select people's names to preview their profile.</p>
            </div>
        </div>


        <!-- friend profile start here -->

        <div class="friend-profile-container hidden">

            <!-- <php include("./friend_profile_control/friend_profile.php"); ?> -->



        </div>

        <!-- </div> -->


        <!-- friend profile ends here -->

        <div class="birthday-container hidden">
            <div class="birthday-div">
                <svg xmlns="http://www.w3.org/2000/svg" class="birthday-svg" width="47.43" height="48.001">
                    <g fill="#ffbd66">
                        <path d="M23.864 0c-.313 2.206-.778 3.175-2.3 4.143-1.878 1.187-1.514 4.751 
                    2.746 4.751 2.834 0 3.689-1.591 3.378-3.519C27.257 2.69 23.864 0 23.864 0zM11.265 0c-.313 2.206-.778 3.175-2.3 4.143-1.878 1.187-1.513 4.751 2.746 4.751 2.834 0 
                    3.689-1.591 3.378-3.519C14.657 2.69 11.265 0 11.265 0zM40.288 5.375C39.856 2.689 36.463 0 36.463 0c-.313 2.206-.778 3.175-2.3 4.143-1.878 1.187-1.513 4.751 2.746 
                    4.751 2.835 0 3.691-1.594 3.379-3.519z" />
                    </g>
                    <g fill="#7a8e9b">
                        <path d="M24.117 6.173a.74.74 0 0 0-.741.741v3.866a.741.741 0 0 0 1.482 0V6.914a.741.741 
                    0 0 0-.741-.741zM11.517 6.173a.741.741 0 0 0-.741.741v3.866a.741.741 0 1 0 1.482 0V6.914a.74.74 0 0 0-.741-.741zM36.716 6.173a.74.74 0 0 0-.741.741v3.866a.741.741 
                    0 0 0 1.482 0V6.914a.739.739 0 0 0-.741-.741z" />
                    </g>
                    <g fill="#e2e2e2">
                        <path d="M20.965 10.782h6.304v10.397h-6.304zM8.366 10.782h6.303v10.397H8.366zM33.564 
                    10.782h6.304v10.397h-6.304z" />
                    </g>
                    <path d="M1.483 30.07v15.847A2.084 2.084 0 0 0 3.567 48h40.3a2.084 2.084 0 0 0 2.084-2.084V30.07z"
                        fill="#f1bb6b" />
                    <path d="M42.288 28.125a3.749 3.749 0 0 1-5.306 0 3.752 3.752 0 0 0-5.307 0 3.75 3.75 0 0 1-5.307 0 3.75 3.75 0 0 0-5.306 0 3.75 3.75 0 0 1-5.307 0 3.752 
                    3.752 0 0 0-5.307 0 3.75 3.75 0 0 1-5.307 0A3.741 3.741 0 0 0 0 27.99v3.71a3.741 3.741 0 0 1 5.141.136 3.75 3.75 0 0 0 5.307 0 3.752 3.752 0 0 1 5.307 0 
                    3.75 3.75 0 0 0 5.307 0 3.75 3.75 0 0 1 5.306 0 3.75 3.75 0 0 0 5.307 0 3.752 3.752 0 0 1 5.307 0 3.749 3.749 0 0 0 5.306 0 3.741 3.741 0 0 1 
                    5.141-.136v-3.711a3.742 3.742 0 0 0-5.141.136z" fill="#525c6b" />
                    <path d="M42.241 21.179H5.189A5.2 5.2 0 0 0 0 26.367v1.623a3.741 3.741 0 0 1 5.141.135 
                    3.75 3.75 0 0 0 5.307 0 3.752 3.752 0 0 1 5.307 0 3.75 3.75 0 0 0 5.307 0 3.75 3.75 0 0 1 5.306 0 3.75 3.75 0 0 0 5.307 0 3.752 3.752 0 0 1 5.307 0 3.749 
                    3.749 0 0 0 5.306 0 3.742 3.742 0 0 1 5.141-.136v-1.622a5.205 5.205 0 0 0-5.188-5.188z"
                        fill="#7a8e9b" />
                    <path fill="#525c6b" d="M1.483 
                    36.618h44.464v1.853H1.483zM1.483 41.806h44.464v1.853H1.483z" />
                </svg>
            </div>
            <div class="birthday-div-1">
                <p class="birthday-p-1">When your friends have birthdays, they will appear here.</p>
            </div>
        </div>

        <div class="custom-container hidden">
            <div class="custom-div">
                <svg xmlns="http://www.w3.org/2000/svg" class="custom-svg" viewBox="0 0 48 48">
                    <defs>
                        <style>
                        .cls-1 {
                            fill: #374f68
                        }

                        .cls-2 {
                            fill: #425b72
                        }

                        .cls-8 {
                            fill: #f26674
                        }
                        </style>
                    </defs>
                    <g id="setting_laptop_with_question_sign" data-name="setting laptop with question sign">
                        <path class="cls-1" d="M44 17v26H28l-1 1h-6l-1-1H4V17a2 2 0 0 1 
                    2-2h36a2 2 0 0 1 2 2z" />
                        <path class="cls-2" d="M44 17v24H10a4 4 0 0 1-4-4V15h36a2 2 0 0 1 2 2z" />
                        <path
                            d="M38 13.64V15H10v-1.36a2 2 0 0 1 1.61-2A2 
                    2 0 0 0 12.9 8.6a2 2 0 0 1 .24-2.54l1.92-1.92a2 2 0 0 1 2.53-.25 2 2 0 0 0 3.08-1.26 2 2 0 0 1 2-1.61c3.25 0 3 0 3.43.13a2 2 0 0 1 1.25 1.48 2 2 0 
                    0 0 3.08 1.26 2 2 0 0 1 2.53.25l1.92 1.92a2 2 0 0 1 .25 2.53 2 2 0 0 0 1.26 3.08A2 2 0 0 1 38 13.64z"
                            style="fill:#7c7d7d" />
                        <path d="M38 13.64V15H14a14 
                    14 0 0 1 5.1-10.8 2 2 0 0 0 1.35-1 14 14 0 0 1 5.62-2.08 2 2 0 0 1 1.25 1.48 2 2 0 0 0 3.08 1.3 2 2 0 0 1 2.54.24l1.92 1.92a2 2 0 0 1 .25 2.53 2 2 0 0 0 
                    1.26 3.08A2 2 0 0 1 38 13.64z" style="fill:#919191" />
                        <path class="cls-1" d="M47 43v2a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-2h19l1 1h6l1-1z" />
                        <path class="cls-2" d="M47 43v2H5a2 2 0 0 1-2-2h17l1 1h6l1-1z" />
                        <path style="fill:#9fdbf3" d="M8 19h32v20H8z" />
                        <path d="M40 19v18H14a4 4 0 0 1-4-4V19z" style="fill:#b2e5fb" />
                        <path d="M31 15H17a7 7 0 0 1 14 0z" style="fill:#dad7e5" />
                        <path class="cls-8"
                            d="M27.94 25.28a4 4 0 0 0-6.51-2.34C20 24.11 19.26 27 21 27a1 1 0 0 0 1-1 2 2 0 1 1 2.76 1.85A2.92 2.92 0 0 0 23 30.58V32a1 1 0 
                    0 0 2 0c0-1.42-.11-2 .53-2.3a4 4 0 0 0 2.41-4.42zM23.62 34.08A1 1 0 1 0 25 35a1 1 0 0 0-1.38-.92z" />
                        <path d="M31 15H19a7 7 0 0 1 6-6.92A7 7 0 0 
                    1 31 15z" style="fill:#edebf2" />
                    </g>
                </svg>
            </div>
            <div class="custom-div-1">
                <p class="custom-p-1">Sorry but this feature is unavailable at the moments.</p>
            </div>
        </div>



    </div>
    </div>
    <!-- main container ends here -->







    <!-- Second main container start here -->
    <div class="main-container1">
        <div class="main-container-3">
            <div class="main-container-div-2">
                <h2>Friends</h2>
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="main-container-div-3">
                <div class="friend-btn-1">
                    <p>Friend Request</p>
                </div>
                <div class="friend-btn-2">
                    <p>Your friends</p>
                </div>
            </div>
            <div class="main-container-notification-1"></div>

            <!-- friend suggestion start here -->
            <?php 
                 if($users_available_2) {
                    if($users_location_row_2 == 1) {
                        echo "
            <div class='main-container-div-5'>
                <div class='no-friend-div'>
                    <svg xmlns='http://www.w3.org/2000/svg' class='no-friend-svg' xml:space='preserve' width='655.359' height='655.359' style='shape-rendering:geometricPrecision;
                    text-rendering:geometricPrecision;image-rendering:optimizeQuality;fill-rule:evenodd;clip-rule:evenodd' viewBox='0 0 6.827 6.827'><defs>
                    <style>.fil8{fill:#2f2f2f}.fil7{fill:#545454}.fil0{fill:#7e7e7e}.fil1{fill:#838383}.fil2{fill:#8e8e8f}.fil3{fill:#bcbcbc}.fil4{fill:#d1d1d1}</style>
                    </defs><g id='Layer_x0020_1'><path class='fil0' d='M4.217 4.034h.478v1.881h-.478zM3.523 4.034h.478v1.881h-.478z'/><path class='fil1' d='M3.153 2.167c.216-.047 
                    1.296-.329 1.416-.195l.029.124-1.375.444-.07-.373z'/><path class='fil2' d='M4.34 2.038h-.462c-.235 0-.427.092-.427.327v1.69h1.317v-1.69c0-.235-.192-.327-.427-.327z'/>
                    <path class='fil3' d='M3.944 1.758h.33v.421h-.33z'/><g id='_530131264'><path id='_530131912' class='fil3' d='M3.754 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/>
                    <path id='_530131816' class='fil3' d='M4.464 1.641s.175-.217.09-.264c0 0-.19.005-.09.264z'/></g><ellipse class='fil4' cx='4.109' cy='1.42' rx='.4' ry='.514'/>
                    <path class='fil3' d='m4.09 2.29-.151.952.17.255.17-.255-.151-.951-.019-.001z'/><path d='M3.78 2.05a.96.96 0 0 1 .133-.012h.03l.166.142.166-.142h.03a.96.96
                    0 0 1 .134.012l-.185.278-.145-.148-.144.148-.186-.278z' style='fill:#6e6e6e'/><path style='fill:#868686' d='m4.046 2.244.063-.064.063.064-.063.066z'/>
                    <path class='fil4' d='M4.959 3.54s0 .035-.03.052c0 0-.035.03-.059.113 0 0-.023.093-.035.128 0 0 .025.047.052-.02 0 0 .022-.083.038-.078 0 0 .014.052
                     0 .111l-.021.107s0 .036.025.032l.04-.13s.008-.049.014-.056c0 0 .007.047-.003.078 0 0-.023.07-.022.1 0 0 .007.039.027.025 0 0 .026-.092.041-.118l.008-.086s.01-.01.007.03c0 
                     0-.002.044.001.048l-.03.078s.006.066.03.022l.038-.09.006-.06s.006-.063.018-.016l.008.03s-.008.055.003.069c0 
                     0 .027.045.036-.076l-.024-.093v-.07s-.011-.07-.023-.082v-.035l-.145-.014z'/><path class='fil2' d='M4.713 2.178c.027-.018.595.71.451 
                     1.44l-.292.012s.078-.734-.226-1.026l.001-.437.066.01z'/><path class='fil7' d='M2.131 4.034h.478v1.881h-.478z'/><path class='fil2' d='M3.658 
                     2.167c-.216-.047-1.295-.329-1.415-.195l-.03.124 1.376.444.07-.373z'/><path class='fil7' d='M2.826 4.034h.478v1.881h-.478z'/><path class='fil1' 
                     d='M2.486 2.038h.463c.235 0 .427.092.427.327v1.69H2.059v-1.69c0-.235.192-.327.427-.327z'/><path class='fil3' d='M2.552 1.758h.33v.421h-.33z'/>
                     <g id='_530129200'><path id='_530129872' class='fil3' d='M3.073 1.641s.174-.217.09-.264c0 0-.19.005-.09.264z'/>
                    <path id='_530130088' class='fil3' d='M2.362 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/><ellipse id='_530129224' class='fil4' cx='2.717' 
                    cy='1.42' rx='.4' ry='.514'/><path id='_530129056' class='fil8' d='M2.347 1.465s.1-.187.116-.246c0 0 .327.357.595.03l.015.252s.283-.565-.357-.595c0 
                    0-.61.015-.37.559z'/></g><path style='fill:#e1e1e2' d='m2.736 2.29.152.952-.17.255-.171-.255.152-.951.018-.001z'/><path d='M3.047 2.05a.96.96 0 0 
                    0-.133-.012h-.031l-.166.142-.165-.142h-.03a.96.96 0 0 0-.134.012l.185.278.144-.148.145.148.185-.278z' style='fill:#6a6a6a'/><path style='fill:#b3b4b4' 
                    d='m2.78 2.244-.063-.064-.062.064.062.066z'/><path class='fil4' d='M1.868 3.54s0 .035.03.052c0 0 .035.03.058.113 0 0 .024.093.035.128 0 0-.025.047-.052-.02 0 
                    0-.021-.083-.037-.078 0 0-.014.052 0 .111l.02.107s0 .036-.024.032l-.04-.13s-.008-.049-.014-.056c0 0-.007.047.003.078 0 0 .023.07.022.1 0 0-.008.039-.028.025 0 
                    0-.026-.092-.04-.118l-.008-.086s-.01-.01-.008.03c0 0 .003.044 0 .048l.03.078s-.006.066-.03.022l-.038-.09-.006-.06s-.007-.063-.018-.016l-.008.03s.008.055-.003.069c0 
                    0-.027.045-.036-.076l.023-.093v-.07s.012-.07.024-.082v-.035l.145-.014z'/><path class='fil1' d='M2.114 2.178c-.027-.018-.595.71-.451 
                    1.44l.292.012s-.078-.734.226-1.026l-.002-.437-.065.01z'/><path class='fil8' d='M3.716 1.336s.279-.33.437-.19c0 0 .252.22.379.193.243-.725-1.171-.564-.816-.003zM4.456 
                    5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.762 5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 
                    0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.065 5.707c.134 0 .243.099.243.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.005-.046c0-.121.109-.22.244-.22zM2.37 5.707c.135 
                    0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22z'/><path class='fil4' d='M2.372 2.041s-.02.03-.005.06c0 0 .012.045-.014.126 
                    0 0-.033.09-.043.126 0 0-.047.026-.032-.046 0 0 .029-.08.013-.085 0 0-.041.035-.062.093l-.043.1s-.02.03-.038.012l.04-.13s.02-.045.018-.054c0 0-.031.035-.04.066 
                    0 0-.02.071-.038.096 0 0-.028.027-.037.005 0 0 .03-.091.032-.12l.042-.077s-.003-.013-.023.022c0 0-.023.036-.028.038l-.018.082s-.042.052-.037.002l.018-.096.03-.054s.029-.055-.007-.023l-.023.02s-.024.051-.041.056c0
                    0-.048.022.012-.083l.072-.064.04-.058s.048-.052.064-.055l.02-.03.128.071zM4.44 2.041s.02.03.005.06c0 0-.012.045.014.126 0 0 .033.09.043.126 0 0 .047.026.032-.046 
                    0 0-.029-.08-.013-.085 0 0 .04.035.062.093l.042.1s.021.03.04.012l-.04-.13s-.021-.045-.02-.054c0 0 .032.035.041.066 0 0 .02.071.038.096 0 0 .027.027.037.005 
                    0 0-.03-.091-.032-.12l-.042-.077s.003-.013.023.022c0 0 .022.036.027.038l.019.082s.042.052.037.002l-.019-.096-.029-.054s-.03-.055.007-.023l.023.02s.024.051.041.056c0 
                    0 .048.022-.013-.083l-.071-.064-.04-.058S4.605 2.003 4.589 2l-.02-.03-.128.071z'/></g><path style='fill:none' d='M0 0h6.827v6.827H0z'/></svg>
                </div>
                <div class='no-friend-div-1'>
                    <p>No friend request or friend Suggestions</p>
                </div>
            </div>
                        ";
                    } else {
                        $select_user_out_2 = "select * from `secret_users` where user_unique_id = $user_unique_id and location = '$location'";
                        $select_user_result_2 = mysqli_query($con, $select_user_out_2);
                        $select_user_out_row_2 = mysqli_fetch_assoc($select_user_result_2);
                        $user_out_username_2 = $select_user_out_row_2["username"];

                        echo "
                        <div class='main-container-div-4'>
                            <div class='friend-row-div'>
                        ";


                        while($user_inform_1 = mysqli_fetch_assoc($users_result_2)) {
                            $user_picture = $user_inform_1["user_picture"];
                            $username = $user_inform_1["username"];
                            $user_request_id = $user_inform_1["user_unique_id"];

                            $select_already_sent_request_out = "select * from `secret_friend_request` where request_unique_id = $user_unique_id 
                            and user_unique_id = $user_request_id or request_unique_id = $user_request_id and user_unique_id = $user_unique_id";
                            $already_sent_request_out_result = mysqli_query($con, $select_already_sent_request_out);
                            $already_sent_request_out_row = mysqli_num_rows($already_sent_request_out_result);    
                            
                            $already_friends = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id and friend_unique_id_2 = $user_request_id
                            or friend_unique_id_1 = $user_request_id and friend_unique_id_2 = $user_unique_id";
                            $already_friends_result = mysqli_query($con, $already_friends);
                            $already_friends_row = mysqli_num_rows($already_friends_result);

                                
                                if($user_out_username == $username) continue;
                                if($already_sent_request_out_row >= 1) continue;
                                if($already_friends_row >= 1) continue;

                                echo "
                                <div class='friend-row'>
                                    <div class='friend-pic-div'><img src='../sign_up_folder/user_image/$user_picture' alt=''></div>
                                    <div class='friend-btn-div friend-card-btn-div-1'>
                                        <p>$username</p>
                                        <button class='add-btn friend-request-btn-1 add-know-friend' data-username='$username'>Add friend</button>
                                        <button class='Remove-btn remove-btn-2 remove-know-friend' data-username='$username'>Remove</button>
                                    </div>
                                    <div class='friend-btn-cancel-div cancel-friend-request-div-1 hidden'>
                                         <button class='cancel-friend-request-btn-1 cancel-friend-request' data-request-id-1='$user_request_id' data-request-id-2='$user_unique_id'>Cancel Request</button>
                                    </div>
                                    <div class='cancel-remove-request-div-1 hidden'>
                                        <button class='cancel-remove-request-btn-1 cancel-remove-request' data-request-id-1='$user_request_id' data-request-id-2='$user_unique_id'>Cancel</button>
                                     </div>
                                </div>
                                ";

                            }
                        echo "
                          </div>
                        </div>
                        ";
                    }
                 } else {
                    echo "
                    <div class='main-container-div-5'>
                        <div class='no-friend-div'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='no-friend-svg' xml:space='preserve' width='655.359' height='655.359' style='shape-rendering:geometricPrecision;
                            text-rendering:geometricPrecision;image-rendering:optimizeQuality;fill-rule:evenodd;clip-rule:evenodd' viewBox='0 0 6.827 6.827'><defs>
                            <style>.fil8{fill:#2f2f2f}.fil7{fill:#545454}.fil0{fill:#7e7e7e}.fil1{fill:#838383}.fil2{fill:#8e8e8f}.fil3{fill:#bcbcbc}.fil4{fill:#d1d1d1}</style>
                            </defs><g id='Layer_x0020_1'><path class='fil0' d='M4.217 4.034h.478v1.881h-.478zM3.523 4.034h.478v1.881h-.478z'/><path class='fil1' d='M3.153 2.167c.216-.047 
                            1.296-.329 1.416-.195l.029.124-1.375.444-.07-.373z'/><path class='fil2' d='M4.34 2.038h-.462c-.235 0-.427.092-.427.327v1.69h1.317v-1.69c0-.235-.192-.327-.427-.327z'/>
                            <path class='fil3' d='M3.944 1.758h.33v.421h-.33z'/><g id='_530131264'><path id='_530131912' class='fil3' d='M3.754 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/>
                            <path id='_530131816' class='fil3' d='M4.464 1.641s.175-.217.09-.264c0 0-.19.005-.09.264z'/></g><ellipse class='fil4' cx='4.109' cy='1.42' rx='.4' ry='.514'/>
                            <path class='fil3' d='m4.09 2.29-.151.952.17.255.17-.255-.151-.951-.019-.001z'/><path d='M3.78 2.05a.96.96 0 0 1 .133-.012h.03l.166.142.166-.142h.03a.96.96
                            0 0 1 .134.012l-.185.278-.145-.148-.144.148-.186-.278z' style='fill:#6e6e6e'/><path style='fill:#868686' d='m4.046 2.244.063-.064.063.064-.063.066z'/>
                            <path class='fil4' d='M4.959 3.54s0 .035-.03.052c0 0-.035.03-.059.113 0 0-.023.093-.035.128 0 0 .025.047.052-.02 0 0 .022-.083.038-.078 0 0 .014.052
                             0 .111l-.021.107s0 .036.025.032l.04-.13s.008-.049.014-.056c0 0 .007.047-.003.078 0 0-.023.07-.022.1 0 0 .007.039.027.025 0 0 .026-.092.041-.118l.008-.086s.01-.01.007.03c0 
                             0-.002.044.001.048l-.03.078s.006.066.03.022l.038-.09.006-.06s.006-.063.018-.016l.008.03s-.008.055.003.069c0 
                             0 .027.045.036-.076l-.024-.093v-.07s-.011-.07-.023-.082v-.035l-.145-.014z'/><path class='fil2' d='M4.713 2.178c.027-.018.595.71.451 
                             1.44l-.292.012s.078-.734-.226-1.026l.001-.437.066.01z'/><path class='fil7' d='M2.131 4.034h.478v1.881h-.478z'/><path class='fil2' d='M3.658 
                             2.167c-.216-.047-1.295-.329-1.415-.195l-.03.124 1.376.444.07-.373z'/><path class='fil7' d='M2.826 4.034h.478v1.881h-.478z'/><path class='fil1' 
                             d='M2.486 2.038h.463c.235 0 .427.092.427.327v1.69H2.059v-1.69c0-.235.192-.327.427-.327z'/><path class='fil3' d='M2.552 1.758h.33v.421h-.33z'/>
                             <g id='_530129200'><path id='_530129872' class='fil3' d='M3.073 1.641s.174-.217.09-.264c0 0-.19.005-.09.264z'/>
                            <path id='_530130088' class='fil3' d='M2.362 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/><ellipse id='_530129224' class='fil4' cx='2.717' 
                            cy='1.42' rx='.4' ry='.514'/><path id='_530129056' class='fil8' d='M2.347 1.465s.1-.187.116-.246c0 0 .327.357.595.03l.015.252s.283-.565-.357-.595c0 
                            0-.61.015-.37.559z'/></g><path style='fill:#e1e1e2' d='m2.736 2.29.152.952-.17.255-.171-.255.152-.951.018-.001z'/><path d='M3.047 2.05a.96.96 0 0 
                            0-.133-.012h-.031l-.166.142-.165-.142h-.03a.96.96 0 0 0-.134.012l.185.278.144-.148.145.148.185-.278z' style='fill:#6a6a6a'/><path style='fill:#b3b4b4' 
                            d='m2.78 2.244-.063-.064-.062.064.062.066z'/><path class='fil4' d='M1.868 3.54s0 .035.03.052c0 0 .035.03.058.113 0 0 .024.093.035.128 0 0-.025.047-.052-.02 0 
                            0-.021-.083-.037-.078 0 0-.014.052 0 .111l.02.107s0 .036-.024.032l-.04-.13s-.008-.049-.014-.056c0 0-.007.047.003.078 0 0 .023.07.022.1 0 0-.008.039-.028.025 0 
                            0-.026-.092-.04-.118l-.008-.086s-.01-.01-.008.03c0 0 .003.044 0 .048l.03.078s-.006.066-.03.022l-.038-.09-.006-.06s-.007-.063-.018-.016l-.008.03s.008.055-.003.069c0 
                            0-.027.045-.036-.076l.023-.093v-.07s.012-.07.024-.082v-.035l.145-.014z'/><path class='fil1' d='M2.114 2.178c-.027-.018-.595.71-.451 
                            1.44l.292.012s-.078-.734.226-1.026l-.002-.437-.065.01z'/><path class='fil8' d='M3.716 1.336s.279-.33.437-.19c0 0 .252.22.379.193.243-.725-1.171-.564-.816-.003zM4.456 
                            5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.762 5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 
                            0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.065 5.707c.134 0 .243.099.243.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.005-.046c0-.121.109-.22.244-.22zM2.37 5.707c.135 
                            0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22z'/><path class='fil4' d='M2.372 2.041s-.02.03-.005.06c0 0 .012.045-.014.126 
                            0 0-.033.09-.043.126 0 0-.047.026-.032-.046 0 0 .029-.08.013-.085 0 0-.041.035-.062.093l-.043.1s-.02.03-.038.012l.04-.13s.02-.045.018-.054c0 0-.031.035-.04.066 
                            0 0-.02.071-.038.096 0 0-.028.027-.037.005 0 0 .03-.091.032-.12l.042-.077s-.003-.013-.023.022c0 0-.023.036-.028.038l-.018.082s-.042.052-.037.002l.018-.096.03-.054s.029-.055-.007-.023l-.023.02s-.024.051-.041.056c0
                            0-.048.022.012-.083l.072-.064.04-.058s.048-.052.064-.055l.02-.03.128.071zM4.44 2.041s.02.03.005.06c0 0-.012.045.014.126 0 0 .033.09.043.126 0 0 .047.026.032-.046 
                            0 0-.029-.08-.013-.085 0 0 .04.035.062.093l.042.1s.021.03.04.012l-.04-.13s-.021-.045-.02-.054c0 0 .032.035.041.066 0 0 .02.071.038.096 0 0 .027.027.037.005 
                            0 0-.03-.091-.032-.12l-.042-.077s.003-.013.023.022c0 0 .022.036.027.038l.019.082s.042.052.037.002l-.019-.096-.029-.054s-.03-.055.007-.023l.023.02s.024.051.041.056c0 
                            0 .048.022-.013-.083l-.071-.064-.04-.058S4.605 2.003 4.589 2l-.02-.03-.128.071z'/></g><path style='fill:none' d='M0 0h6.827v6.827H0z'/></svg>
                        </div>
                        <div class='no-friend-div-1'>
                            <p>No friend request or friend Suggestions</p>
                        </div>
                    </div>";
                 }
                 ?>


            <!-- friend suggestion ends here -->



            <!-- friend request container start here -->
            <div class="back-btn-div hidden">
                <i class="fa-solid fa-arrow-left "></i>
                <p>Friend Request</p>
            </div>

            <div class="second-friend-request-div hidden">
                <div class="friend-row-div">

                    <?php 
            if($friend_request_1) {
                while($friend_request_data_1 = mysqli_fetch_assoc($friend_request_result_1)) {
                    $friend_request_username = $friend_request_data_1["request_username"];
                    $friend_request_id = $friend_request_data_1["request_unique_id"];
                    $select_friend_request_details_1 = "select * from `secret_users` where username = '$friend_request_username' and user_unique_id = $friend_request_id";
                    $request_details_1 = mysqli_query($con, $select_friend_request_details_1);
                    $request_details_row_1 = mysqli_num_rows($request_details_1);
                    $accepted_1 = "Request accepted";
                    if($request_details_row_1 >= 1) {
                        $request_detail_data = mysqli_fetch_assoc($request_details_1);
                        $friend_request_pics = $request_detail_data["user_picture"];
                        $user_request_id_1 = $request_detail_data["user_unique_id"];

                        $select_already_sent_request_out_2 = "select * from `secret_friend_request` where request_unique_id = $user_unique_id 
                        and user_unique_id = $user_request_id_1 and request_status = '$accepted_1' or request_unique_id = $user_request_id_1 and user_unique_id = $user_unique_id and request_status = '$accepted_1'";
                        $already_sent_request_out_result_2 = mysqli_query($con, $select_already_sent_request_out_2);
                        $already_sent_request_out_row_2 = mysqli_num_rows($already_sent_request_out_result_2);    

                        if($already_sent_request_out_row_2 >= 1) continue;

                        echo "
                        <div class='friend-row'>
                            <div class='friend-pic-div'><img src='../sign_up_folder/user_image/$friend_request_pics' alt='photo'></div>
                            <div class='friend-btn-div'>
                                <p>$friend_request_username</p>
                                <button class='add-btn friend-request-add-btn-1 accept-friend-btn' data-sent-id='$friend_request_id' data-owner-id='$user_unique_id'>Accept</button>
                                <button class='Remove-btn friend-request-remove-btn-1 remove-friend-request' data-sent-id='$friend_request_id' data-owner-id='$user_unique_id'>Remove</button>
                                <h2 class='hidden accepted-h2-1'>You're now Friends</h2>
                                <h2 class='hidden remove-h2-1'>Friend Request deleted</h2>
                            </div>
                        </div>
                        ";

                    } else {
                        echo "Something went wrong";
                    }
                }

            } else {
                echo "
                 <div class='main-container-div-6'>
                        <div class='no-friend-div'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='no-friend-svg' xml:space='preserve' width='655.359' height='655.359' style='shape-rendering:geometricPrecision;
                            text-rendering:geometricPrecision;image-rendering:optimizeQuality;fill-rule:evenodd;clip-rule:evenodd' viewBox='0 0 6.827 6.827'><defs>
                            <style>.fil8{fill:#2f2f2f}.fil7{fill:#545454}.fil0{fill:#7e7e7e}.fil1{fill:#838383}.fil2{fill:#8e8e8f}.fil3{fill:#bcbcbc}.fil4{fill:#d1d1d1}</style>
                            </defs><g id='Layer_x0020_1'><path class='fil0' d='M4.217 4.034h.478v1.881h-.478zM3.523 4.034h.478v1.881h-.478z'/><path class='fil1' d='M3.153 2.167c.216-.047 
                            1.296-.329 1.416-.195l.029.124-1.375.444-.07-.373z'/><path class='fil2' d='M4.34 2.038h-.462c-.235 0-.427.092-.427.327v1.69h1.317v-1.69c0-.235-.192-.327-.427-.327z'/>
                            <path class='fil3' d='M3.944 1.758h.33v.421h-.33z'/><g id='_530131264'><path id='_530131912' class='fil3' d='M3.754 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/>
                            <path id='_530131816' class='fil3' d='M4.464 1.641s.175-.217.09-.264c0 0-.19.005-.09.264z'/></g><ellipse class='fil4' cx='4.109' cy='1.42' rx='.4' ry='.514'/>
                            <path class='fil3' d='m4.09 2.29-.151.952.17.255.17-.255-.151-.951-.019-.001z'/><path d='M3.78 2.05a.96.96 0 0 1 .133-.012h.03l.166.142.166-.142h.03a.96.96
                            0 0 1 .134.012l-.185.278-.145-.148-.144.148-.186-.278z' style='fill:#6e6e6e'/><path style='fill:#868686' d='m4.046 2.244.063-.064.063.064-.063.066z'/>
                            <path class='fil4' d='M4.959 3.54s0 .035-.03.052c0 0-.035.03-.059.113 0 0-.023.093-.035.128 0 0 .025.047.052-.02 0 0 .022-.083.038-.078 0 0 .014.052
                             0 .111l-.021.107s0 .036.025.032l.04-.13s.008-.049.014-.056c0 0 .007.047-.003.078 0 0-.023.07-.022.1 0 0 .007.039.027.025 0 0 .026-.092.041-.118l.008-.086s.01-.01.007.03c0 
                             0-.002.044.001.048l-.03.078s.006.066.03.022l.038-.09.006-.06s.006-.063.018-.016l.008.03s-.008.055.003.069c0 
                             0 .027.045.036-.076l-.024-.093v-.07s-.011-.07-.023-.082v-.035l-.145-.014z'/><path class='fil2' d='M4.713 2.178c.027-.018.595.71.451 
                             1.44l-.292.012s.078-.734-.226-1.026l.001-.437.066.01z'/><path class='fil7' d='M2.131 4.034h.478v1.881h-.478z'/><path class='fil2' d='M3.658 
                             2.167c-.216-.047-1.295-.329-1.415-.195l-.03.124 1.376.444.07-.373z'/><path class='fil7' d='M2.826 4.034h.478v1.881h-.478z'/><path class='fil1' 
                             d='M2.486 2.038h.463c.235 0 .427.092.427.327v1.69H2.059v-1.69c0-.235.192-.327.427-.327z'/><path class='fil3' d='M2.552 1.758h.33v.421h-.33z'/>
                             <g id='_530129200'><path id='_530129872' class='fil3' d='M3.073 1.641s.174-.217.09-.264c0 0-.19.005-.09.264z'/>
                            <path id='_530130088' class='fil3' d='M2.362 1.641s-.174-.217-.09-.264c0 0 .19.005.09.264z'/><ellipse id='_530129224' class='fil4' cx='2.717' 
                            cy='1.42' rx='.4' ry='.514'/><path id='_530129056' class='fil8' d='M2.347 1.465s.1-.187.116-.246c0 0 .327.357.595.03l.015.252s.283-.565-.357-.595c0 
                            0-.61.015-.37.559z'/></g><path style='fill:#e1e1e2' d='m2.736 2.29.152.952-.17.255-.171-.255.152-.951.018-.001z'/><path d='M3.047 2.05a.96.96 0 0 
                            0-.133-.012h-.031l-.166.142-.165-.142h-.03a.96.96 0 0 0-.134.012l.185.278.144-.148.145.148.185-.278z' style='fill:#6a6a6a'/><path style='fill:#b3b4b4' 
                            d='m2.78 2.244-.063-.064-.062.064.062.066z'/><path class='fil4' d='M1.868 3.54s0 .035.03.052c0 0 .035.03.058.113 0 0 .024.093.035.128 0 0-.025.047-.052-.02 0 
                            0-.021-.083-.037-.078 0 0-.014.052 0 .111l.02.107s0 .036-.024.032l-.04-.13s-.008-.049-.014-.056c0 0-.007.047.003.078 0 0 .023.07.022.1 0 0-.008.039-.028.025 0 
                            0-.026-.092-.04-.118l-.008-.086s-.01-.01-.008.03c0 0 .003.044 0 .048l.03.078s-.006.066-.03.022l-.038-.09-.006-.06s-.007-.063-.018-.016l-.008.03s.008.055-.003.069c0 
                            0-.027.045-.036-.076l.023-.093v-.07s.012-.07.024-.082v-.035l.145-.014z'/><path class='fil1' d='M2.114 2.178c-.027-.018-.595.71-.451 
                            1.44l.292.012s-.078-.734.226-1.026l-.002-.437-.065.01z'/><path class='fil8' d='M3.716 1.336s.279-.33.437-.19c0 0 .252.22.379.193.243-.725-1.171-.564-.816-.003zM4.456 
                            5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.762 5.707c.135 0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 
                            0 0 1-.006-.046c0-.121.11-.22.244-.22zM3.065 5.707c.134 0 .243.099.243.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.005-.046c0-.121.109-.22.244-.22zM2.37 5.707c.135 
                            0 .244.099.244.22a.2.2 0 0 1-.005.046h-.477a.2.2 0 0 1-.006-.046c0-.121.11-.22.244-.22z'/><path class='fil4' d='M2.372 2.041s-.02.03-.005.06c0 0 .012.045-.014.126 
                            0 0-.033.09-.043.126 0 0-.047.026-.032-.046 0 0 .029-.08.013-.085 0 0-.041.035-.062.093l-.043.1s-.02.03-.038.012l.04-.13s.02-.045.018-.054c0 0-.031.035-.04.066 
                            0 0-.02.071-.038.096 0 0-.028.027-.037.005 0 0 .03-.091.032-.12l.042-.077s-.003-.013-.023.022c0 0-.023.036-.028.038l-.018.082s-.042.052-.037.002l.018-.096.03-.054s.029-.055-.007-.023l-.023.02s-.024.051-.041.056c0
                            0-.048.022.012-.083l.072-.064.04-.058s.048-.052.064-.055l.02-.03.128.071zM4.44 2.041s.02.03.005.06c0 0-.012.045.014.126 0 0 .033.09.043.126 0 0 .047.026.032-.046 
                            0 0-.029-.08-.013-.085 0 0 .04.035.062.093l.042.1s.021.03.04.012l-.04-.13s-.021-.045-.02-.054c0 0 .032.035.041.066 0 0 .02.071.038.096 0 0 .027.027.037.005 
                            0 0-.03-.091-.032-.12l-.042-.077s.003-.013.023.022c0 0 .022.036.027.038l.019.082s.042.052.037.002l-.019-.096-.029-.054s-.03-.055.007-.023l.023.02s.024.051.041.056c0 
                            0 .048.022-.013-.083l-.071-.064-.04-.058S4.605 2.003 4.589 2l-.02-.03-.128.071z'/></g><path style='fill:none' d='M0 0h6.827v6.827H0z'/></svg>
                        </div>
                        <div class='no-friend-div-1'>
                            <p class='no-friend-request-p'>When people send you friend request, they'll appear here.</p>
                        </div>
                    </div>";
            }
            ?>

                </div>
            </div>

            <!-- friend request container ends here -->


            <!-- All friend container start here -->

            <div class="back-btn-div-1 hidden">
                <i class="fa-solid fa-arrow-left"></i>
                <p>Your Friends</p>
            </div>
            <div class="all-friend-container-div hidden">
                <div class="search-all-friend-div-1">
                    <form action="">
                        <input type="text" class="all-friend-search-input" placeholder="Search friends">
                        <input type="submit" value="&#9906;" class="search-all-friend-submit">
                    </form>
                </div>
                <div class="all-friend-list-div">
                    <div class="number-of-friend-div">
                        <p><?php echo $select_all_friend_row_1; ?></p>
                    </div>
                    <?php 
                    if($all_friends_1) {
                        while($all_friends_data_1 = mysqli_fetch_assoc($select_all_friend_result_1)) {
                            $all_friends_username = $all_friends_data_1["friend_username_1"];
                            $all_friends_username_1 = $all_friends_data_1["friend_username_2"];
                            $all_friends_id_1 = $all_friends_data_1["friend_unique_id_1"];
                            $all_friends_id_2 = $all_friends_data_1["friend_unique_id_2"];

                            $select_friend_pic = "select * from `secret_users` where user_unique_id = $all_friends_id_1";
                            $select_friend_pic_1 = "select * from `secret_users` where user_unique_id = $all_friends_id_2";
                            $select_friend_pic_result = mysqli_query($con, $select_friend_pic);
                            $select_friend_pic_result_1 = mysqli_query($con, $select_friend_pic_1);
                            $friend_pic_num = mysqli_num_rows($select_friend_pic_result);
                            $friend_pic_num_1 = mysqli_num_rows($select_friend_pic_result_1);
                            if($friend_pic_num >= 1 && $friend_pic_num_1 >= 1) {
                                $all_friend_data_pic = mysqli_fetch_array($select_friend_pic_result);
                                $all_friend_data_pic_1 = mysqli_fetch_assoc($select_friend_pic_result_1);
                                $all_friend_pics = $all_friend_data_pic["user_picture"];
                                $all_friend_pics_1 = $all_friend_data_pic_1["user_picture"];

                                if($all_friends_id_1 == $user_unique_id) {
                                    echo "
                                    <div class='friend-list-div friend-view' data-view-all-friend-profile='$all_friends_id_2' data-all-username-friend-profile='$all_friends_username_1'>
                                        <div class='all-friend-img-div'><img src='../sign_up_folder/user_image/$all_friend_pics_1' alt='photo'></div>
                                        <div class='all-friend-name-div'>
                                            <p>$all_friends_username_1</p>
                                        </div>
                                    </div>
                                    ";
                                } else {
                                    echo "
                                    <div class='friend-list-div friend-view-1' data-view-all-friend-profile='$all_friends_id_1' data-all-username-friend-profile='$all_friends_username'>
                                        <div class='all-friend-img-div'><img src='../sign_up_folder/user_image/$all_friend_pics' alt='photo'></div>
                                        <div class='all-friend-name-div'>
                                            <p>$all_friends_username</p>
                                        </div>
                                    </div>
                                    ";
                                }
                            }
                        }
                    }
                    ?>
                    <!-- <div class="friend-list-div">
                        <div class="all-friend-img-div"><img src="" alt=""></div>
                        <div class="all-friend-name-div">
                            <p>username</p>
                        </div>
                    </div> -->
                </div>
            </div>


            <!-- All friend container ends here -->


        </div>
    </div>
    <!-- Second main container ends here -->
    <!-- modal start here -->
    <div class="modal-div-1 hidden">
        <div class="notification-div">
            <div class="notification-div-3">
                <h3>Notifications</h3>
                <i class="fa-solid fa-circle-xmark cancel-notification"></i>
            </div>
            <div class="notification-div-1">
                <button class="notification-btn notification-see-all-btn">See All</button>
                <div class="notification-btn1">Personal <div
                        class="notification-num-1 <?php if(!$personal_number) { echo 'hidden'; } ?>">
                        <?php echo $personal_number; ?></div>
                </div>
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
                        <img src='./user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='pics'
                            class='notification-img'>
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
          while($pp < count($personal_notification_1) && $pp < 3) {
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
                        <img src='./user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='pics'
                            class='notification-img'>
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
            $select_recent_query_1 = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$detail_username' limit $limit";
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
                    <div class='search-text-div search-text-div-1' data-search-value='$search_recent_result_1' data-user-id='$user_unique_id' data-username='$detail_username' data-search-value-1='$search_user_id_2'><p>$search_recent_result_1</p></div>
                    <div class='search-remove-div remove-recent-x' data-recent-id='$search_id_1' data-recent-user-id='$search_user_id_1' data-recent-username='$search_username_1'><i class='fa-solid fa-xmark'></i></div>
                  </div>";
              }
            }
          
          ?>
            </div>
            <div class="see-all-search">
                <?php 
          $select_see_recent = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$detail_username'";
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

            $select_recent_query_2 = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$detail_username'";
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
                        <div class='see-all-result-div-1 search-text-div-1' data-search-value='$search_recent_result_2' data-user-id='$user_unique_id' data-username='$detail_username' data-search-value-1='$search_user_id_3'>
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
                <input type="text" name="message-inbox-input" class="message-search-input"
                    placeholder="Search Messenger" readonly>
            </div>
            <div class="message-category-div">
                <p>Inbox</p>
            </div>

            <div class="message-users-div">


            </div>
        </div>


    </div>


    <!-- modal ends here -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>

<?php
include("./friend_data_control/friend_data_control.php");
?>