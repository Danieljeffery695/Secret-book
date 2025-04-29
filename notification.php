<?php 
include("./include_folder/include.php");
session_start();

if(isset($_SESSION["user_unique_id"])) {
    $user_unique_id = $_SESSION["user_unique_id"];
} else {
  echo "<script>window.open('./sign_up_folder/sign_in.php', '_self')</script>";
}

try {

$select_query = "select * from `secret_users` where user_unique_id = $user_unique_id";
$result_query = mysqli_query($con, $select_query);

if($result_query) {
    $data = mysqli_fetch_assoc($result_query);
    $user_picture = $data["user_picture"];
    $username_num_1 = $data["username"];
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
      $personal_notification_result_2 = mysqli_query($con, $select_personal_notification_1);
      $personal_notification_row_1 = mysqli_num_rows($personal_notification_result_1);
      if($personal_notification_row_1 >= 1) {
        $personal_number = $personal_notification_row_1;
      }
  }
}

// notification number ends here

 
} catch (Exception $th) {
  echo "<script>alert('Something went wrong..!!')</script>";
  echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}
 ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
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
    <link rel="stylesheet" href="notification.css">
    <script defer src="notification.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

    <!-- navigation start here -->
    <div class="navigation-div">
        <div class="navigation-div-1">
            <div class="nav-flex1">
                <img src="./user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png" alt="pics"
                    class="nav-img">
                <input type="text" placeholder="Search SecretBook" name="Search_input" class="search-input search-input-div" autocomplete="off">
                <i class="fa-solid fa-magnifying-glass nav-div search-icon"></i>
            </div>
        </div>
        <div class="navigation-div-2">
            <div class="div-nav">
                <nav class="nav">
                    <li><a href="./user_home_folder/user_home.php" target="_self"><i class="fa-solid fa-house"></i></a></li>
                    <li><a href="./friends_folder/friends.php" target="_self"><i class="fa-solid fa-user-group"></i></a></li>
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
                    <div class="nav-div hidden"><i class="fa-solid fa-message"></i></div>
                    <div class="nav-div notification-div-bell"><i class="fa-solid fa-bell notification-bell"></i> <div class="notification-num <?php if(!$notification_number) { echo 'hidden'; } ?>" > <?php echo $notification_number; ?></div></div>
                    <!-- <div class="nav-div"><i class="fa-solid fa-bell notification-bell"></i></div> -->
                    <div class="nav-div1"><img src="./sign_up_folder/user_image/<?php echo $user_picture ?>" alt="pics" class="nav-img1"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- navigation ends here -->


    <div class="notification-container-div">
        <div class="notification-nav">
            <h2>Notifications</h2>
            <p>...</p>
        </div>
        <div class="second-notification-nav">
            <div class="second-nav-div">
                <p>All</p>
            </div>
            <div class="second-nav-div-1">
               <div class="notification-btn1"><p>Personal</p> <div class="notification-num-1 <?php if(!$personal_number) { echo 'hidden'; } ?>" > <?php echo $personal_number; ?></div></div>
            </div>
        </div>
        <div class="notification-date-div">
            <p>Earlier</p>
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
              <div class='notification-div usual-div'>
              <div class='notification-info-div'>
                  <div class='notification-info-2'>
                      <div class='notification-image'>
                          <div class='notification-image-div'>
                              <img src='./sign_up_folder/user_image/$notification_pic' alt='photo1'>
                          </div>
                          <div class='notification-icon-div'><i class='fa-solid fa-cloud'></i></div>
                      </div>
                      <div class='notification-image-info-div'>
                          <p>$notification_username_22 just post a new <b>story</b></p>
                          <p>$notification_date_22</p>
                      </div>
                  </div>
                  <div class='notification-recent'>
                      <div class='update-div'></div>
                  </div>
              </div>
            </div>";
              // $no_notification_true += 1;
              $iii += 1;
          }
        } else { if ($i > 1) {$no_notification_true = 2;}
          ?>

                <div class='notification-div usual-div <?php if ($no_notification_true >= 1) {echo "hidden"; }; ?> '>
            <div class="notification-info-div">
                <div class="notification-info-2">
                    <div class="notification-image">
                        <div class="notification-image-div">
                            <img src="./user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png" alt="photo">
                        </div>
                        <div class="notification-icon-div"></div>
                    </div>
                    <div class="notification-image-info-div">
                        <p>Welcome to SecretBook! Tap here to find people you know and add them as friends</p>
                        <p>12.2025.23</p>
                    </div>
                </div>
                <div class="notification-recent">
                    <div class="update-div"></div>
                </div>
              </div>
            </div>

                   <?php

              }

          } else {
            echo "
                 <div class='notification-div usual-div'>
                     <div class='notification-info-div'>
                         <div class='notification-info-2'>
                             <div class='notification-image'>
                                 <div class='notification-image-div'>
                                     <img src='./user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='photo'>
                                 </div>
                                 <div class='notification-icon-div'></div>
                             </div>
                             <div class='notification-image-info-div'>
                                 <p>Welcome to SecretBook! Get out there and gather some companions</p>
                             </div>
                         </div>
                         <div class='notification-recent'>
                             <div class='update-div'></div>
                         </div>
                     </div>
                 </div>";
          }
        ?>


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
            
           
            while($personal_notification_data_1 = mysqli_fetch_assoc($personal_notification_result_2)) {
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
          while($pp < $personal_notification_count) {
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
              <div class='notification-div personal-div hidden'>
                     <div class='notification-info-div'>
                         <div class='notification-info-2'>
                             <div class='notification-image'>
                                 <div class='notification-image-div'>
                                     <img src='./sign_up_folder/user_image/$notification_pic_1' alt='pics' alt='photo'>
                                 </div>"; ?> <?php 
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
                             <div class='notification-image-info-div'>"; ?>
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
                     </div>
                 </div>";
              $pp += 1;
          }
      } else { if($ppp > 1) {$no_personal_true = 2;};
      ?>
       <div class='notification-div personal-div <?php if ($no_personal_true >= 1) {echo "hidden"; }; ?>'>
                     <div class='notification-info-div'>
                         <div class='notification-info-2'>
                             <div class='notification-image'>
                                 <div class='notification-image-div'>
                                     <img src='./user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='photo'>
                                 </div>
                                 <div class='notification-icon-div'></div>
                             </div>
                             <div class='notification-image-info-div'>
                                 <p>Welcome to SecretBook! Tap here to find people you know and add them as friends</p>
                                 <p>12.2025.23</p>
                             </div>
                         </div>
                         <div class='notification-recent'>
                             <div class='update-div'></div>
                         </div>
                     </div>
                 </div>
       <?php }
      } else {
        echo "
             <div class='notification-div personal-div hidden'>
                 <div class='notification-info-div'>
                     <div class='notification-info-2'>
                         <div class='notification-image'>
                             <div class='notification-image-div'>
                                 <img src='./user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='photo'>
                             </div>
                             <div class='notification-icon-div'></div>
                         </div>
                         <div class='notification-image-info-div'>
                             <p>Welcome to SecretBook! Get out there and gather some companions</p>
                         </div>
                     </div>
                     <div class='notification-recent'>
                         <div class='update-div'></div>
                     </div>
                 </div>
             </div> ";
      }
       ?>


        
    </div>


    <!-- notification container second  -->

    <div class="notification-nav-1">
        <h2>Notifications</h2>
        <div class="notification-search" onclick="history.back()"><i class="fa-solid fa-xmark"></i></div>
    </div>

    <div class="notification-date-div-1">
        <p>Earlier</p>
        <div class="second-nav-div-2">
            <!-- <div class="notification-btn1">Personal<div class="notification-num-2">6</div></div> -->
            <div class="notification-btn1 personal-btn"><p>Personal</p> <div class="notification-num-1 <?php if(!$personal_number) { echo 'hidden'; } ?>" > <?php echo $personal_number; ?></div></div>
            <div class="all-btn hidden">All</div>
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

              if($personal_notification_row > 1) {
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
              } else {
                $select_personal_notification_1 = "select * from `secret_notification_table` where friend_unique_id = $user_unique_id";
                $personal_notification_result_1 = mysqli_query($con, $select_personal_notification_1);
                $personal_notification_row_1 = mysqli_num_rows($personal_notification_result_1);
    
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
              <div class='notification-div-1 usual-div'>
              <div class='notification-info-div-2'>
                  <div class='notification-info-1'>
                      <div class='notification-image'>
                          <div class='notification-image-div'>
                              <img src='./sign_up_folder/user_image/$notification_pic' alt='photo1'>
                          </div>
                          <div class='notification-icon-div'><i class='fa-solid fa-cloud'></i></div>
                      </div>
                      <div class='notification-image-info-div'>
                          <p>$notification_username_22 just post a new <b>story</b></p>
                          <p>$notification_date_22</p>
                      </div>
                  </div>
                  <div class='notification-recent'>
                      <div class='update-div'></div>
                  </div>
              </div>
            </div>";

              // $no_notification_true += 1;
              $iii += 1;
          }
        } else { if ($i > 1) {$no_notification_true = 2;}
          ?>

                <div class='notification-div-1 usual-div <?php if ($no_notification_true >= 1) {echo "hidden"; }; ?> '>
            <div class="notification-info-div-2">
                <div class="notification-info-1">
                    <div class="notification-image">
                        <div class="notification-image-div">
                            <img src="./user_profile_images/secretbook-high-resolution-logo-transparent.png" alt="photo">
                        </div>
                        <div class="notification-icon-div"></div>
                    </div>
                    <div class="notification-image-info-div">
                        <p>Welcome to SecretBook! Tap here to find people you know and add them as friends</p>
                        <p>12.2025.23</p>
                    </div>
                </div>
                <div class="notification-recent">
                    <div class="update-div"></div>
                </div>
              </div>
            </div>

                   <?php

              }

          } else {
            echo "
                 <div class='notification-div-1 usual-div'>
                     <div class='notification-info-div-2'>
                         <div class='notification-info-1'>
                             <div class='notification-image'>
                                 <div class='notification-image-div'>
                                     <img src='./user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='photo'>
                                 </div>
                                 <div class='notification-icon-div'></div>
                             </div>
                             <div class='notification-image-info-div'>
                                 <p>Welcome to SecretBook! Get out there and gather some companions</p>
                             </div>
                         </div>
                         <div class='notification-recent'>
                             <div class='update-div'></div>
                         </div>
                     </div>
                 </div>";
          }
        ?>


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
          while($pp < $personal_notification_count) {
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
              <div class='notification-div-1 personal-div hidden'>
                     <div class='notification-info-div-2'>
                         <div class='notification-info-1'>
                             <div class='notification-image'>
                                 <div class='notification-image-div'>
                                     <img src='./sign_up_folder/user_image/$notification_pic_1' alt='pics' alt='photo'>
                                 </div>"; ?> <?php 
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
                             <div class='notification-image-info-div'>"; ?>
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
                     </div>
                 </div>";
              $pp += 1;
          }
      } else { if($ppp > 1) {$no_personal_true = 2;};
      ?>
       <div class='notification-div-1 personal-div <?php if ($no_personal_true >= 1) {echo "hidden"; }; ?>'>
                     <div class='notification-info-div-2'>
                         <div class='notification-info-1'>
                             <div class='notification-image'>
                                 <div class='notification-image-div'>
                                     <img src='./user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='photo'>
                                 </div>
                                 <div class='notification-icon-div'></div>
                             </div>
                             <div class='notification-image-info-div'>
                                 <p>Welcome to SecretBook! Tap here to find people you know and add them as friends</p>
                                 <p>12.2025.23</p>
                             </div>
                         </div>
                         <div class='notification-recent'>
                             <div class='update-div'></div>
                         </div>
                     </div>
                 </div>
       <?php }
      } else {
        echo "
             <div class='notification-div-1 personal-div hidden'>
                 <div class='notification-info-div-2'>
                     <div class='notification-info-1'>
                         <div class='notification-image'>
                             <div class='notification-image-div'>
                                 <img src='./user_profile_folder/user_profile_images/secretbook-high-resolution-logo-transparent.png' alt='photo'>
                             </div>
                             <div class='notification-icon-div'></div>
                         </div>
                         <div class='notification-image-info-div'>
                             <p>Welcome to SecretBook! Get out there and gather some companions</p>
                         </div>
                     </div>
                     <div class='notification-recent'>
                         <div class='update-div'></div>
                     </div>
                 </div>
             </div> ";
      }
       ?>


        
    <!-- </div> -->

    <!-- modal start here -->

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


    <!-- modal ends here -->
</body>
</html>

<script type="text/javascript">
  $(document).ready(function() {
    function searchFunction() {
      $(".search-input-div").keyup(function() {
        var search_value = $("input:text").val();
        $(".search-result-div").load("./notification_search_file.php", {search_result: search_value});
      });
    }

    function deleteRecentSearch1() {
      $(".remove-recent-x").click(function() {
        var search_id = $(this).data("recent-id");
        var search_user_id = $(this).data("recent-user-id");
        var search_username_1 = $(this).data("recent-username");
        $.post("./function_folder/common_function_1.php", {search_id_1: search_id, search_user_id_1: search_user_id, search_username_2: search_username_1}, function() {
          console.log("secretBook is good");
        });
        $(this).fadeOut("slow");
      });
    }

    function searchData_3() {
      $(".search-text-div-1").click(function() {
        var user_name = $(this).data("username");
        var user_id_1 = $(this).data("search-value-1");

        $.post("./function_folder/common_function_1.php", {all_friend_id: user_id_1, all_friend_username: user_name}, function() {
          window.open("./friend_profile_folder/friend_profile1.php", "_self");
        });
      });
    }

    searchFunction();
    searchData_3();
    deleteRecentSearch1();



  });
</script>