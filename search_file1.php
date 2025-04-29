<?php 
include("./include_folder/include.php");
session_start();

if(isset($_SESSION["user_unique_id"])) {
  $user_unique_id = $_SESSION["user_unique_id"];
  $select_user_info = "select * from `secret_users` where user_unique_id = $user_unique_id";
  $select_user_info_result = mysqli_query($con, $select_user_info);
  $select_user_info_num = mysqli_num_rows($select_user_info_result);

  if($select_user_info_num >= 1) {
    $info_data = mysqli_fetch_assoc($select_user_info_result);
    $username = $info_data["username"];
  }

  $limit = 5;

  $select_search_history = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$username' limit $limit";
  $select_search_history_1 = "select * from `search_recent_table` where user_unique_id = $user_unique_id and username = '$username'";
  $select_search_history_result = mysqli_query($con, $select_search_history);
  $select_search_history_result_1 = mysqli_query($con, $select_search_history_1);
  $select_search_history_result_2 = mysqli_query($con, $select_search_history_1);
  $search_history_num = mysqli_num_rows($select_search_history_result);
  if($search_history_num >= 1) {
    $history_true = true;
  } else {
    $history_true = false;
  }
} else {
  echo "<script>window.open('./sign_up_folder/sign_in.php', '_self')</script>";
}

$select_user_friend = "select * from `secret_friend_table` where friend_unique_id_1 = $user_unique_id or friend_unique_id_2 = $user_unique_id";
$select_user_friend_result = mysqli_query($con, $select_user_friend);
$select_friend_num = mysqli_num_rows($select_user_friend_result);
if($select_friend_num >= 1) {
  while($friend_data = mysqli_fetch_assoc($select_user_friend_result)) {
    $friend_unique_id_1 = $friend_data["friend_unique_id_1"];
    $friend_unique_id_2 = $friend_data["friend_unique_id_2"];

    if($friend_unique_id_1 == $user_unique_id) {
      $friend_unique_id_3 = $friend_unique_id_2;
    } else {
      $friend_unique_id_3 = $friend_unique_id_1;
    }

    $select_people = "select * from `secret_users` where not user_unique_id = $friend_unique_id_3 limit $limit";
    $select_people_result = mysqli_query($con, $select_people);
    $people_num = mysqli_num_rows($select_people_result);
    if($people_num >= 1) {
      $people_true = true;
    } else {
      $people_true = false;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search-page</title>
     <!-- font awesome links start here -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
     integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
 <!-- ends here -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Karla:ital,wght@0,200..800;1,200..800&family=Kode+Mono:wght@400..700&family=Pacifico&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- ends here -->
    <link rel="stylesheet" href="search_file1.css">
    <script defer src="search_file1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="search-navigation-div">
        <div class="back-div" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></div>
        <div class="search-nav-input-div">
            <input type="text" placeholder="Search SecretBook" class="nav-input" autocomplete="off">
        </div>
    </div>
    <div class="search-container">
        <div class="search-container-nav">
            <p>Recent</p>
            <p class="see-all-p">See all</p>
        </div>
        <div class="search-recent-result">

        <div class="result-cover-div hidden"></div>

          <?php 
          
          if($history_true) {
            while($search_history_data = mysqli_fetch_assoc($select_search_history_result)) {
              $search_result = $search_history_data["search_result"];
              $search_date = $search_history_data["search_date"];
              $search_id = $search_history_data["search_id"];
              $search_unique_id = $search_history_data["user_unique_id"];
              $search_username = $search_history_data["username"];

              $search_user_1 = "select * from `secret_users` where username = '$search_result'";
              $search_result_2 = mysqli_query($con, $search_user_1);
              $search_num_1 = mysqli_num_rows($search_result_2);
  
              if($search_num_1) {
                while($recent_data_3 = mysqli_fetch_array($search_result_2)) {
                  $search_user_id_1 = $recent_data_3["user_unique_id"];
                }
              }

              echo "
              <div class='search-recent-result-div'>
                <div class='recent-result-div result-div-search' data-search-value='$search_result' data-user-id='$user_unique_id' data-username='$username' data-search-value-1='$search_user_id_1'>
                    <div class='search-recent-icon'><i class='fa-solid fa-magnifying-glass'></i></div>
                    <div class='search-result'>
                      <p>$search_result</p>
                      <p>$search_date</p>
                    </div>
                </div>
                <div class='remove-search-recent remove-recent-x' data-recent-id='$search_id' data-recent-user-id='$search_unique_id' data-recent-username='$search_username'><i class='fa-solid fa-xmark'></i></div>
              </div>

              ";
            }
          } else {
            echo "
              <div class='search-recent-result-div'>
                <div class='recent-result-div'>
                    <div class='search-recent-icon'><i class='fa-solid fa-magnifying-glass'></i></div>
                    <div class='search-result'><p>Try Finding your secret friends...</p></div>
                </div>
            </div>
            ";
          }
          
          ?>
          
        </div>

        <!-- second container start here -->

        <div class="search-recent-result-1 second-recent-container">
        
          <div class="result-cover-div hidden"></div>
        
          <?php 
          
          if($history_true) {
            while($search_history_data = mysqli_fetch_assoc($select_search_history_result_2)) {
              $search_result = $search_history_data["search_result"];
              $search_date = $search_history_data["search_date"];
              $search_id = $search_history_data["search_id"];
              $search_unique_id = $search_history_data["user_unique_id"];
              $search_username = $search_history_data["username"];
        
              $search_user_1 = "select * from `secret_users` where username = '$search_result'";
              $search_result_2 = mysqli_query($con, $search_user_1);
              $search_num_1 = mysqli_num_rows($search_result_2);
        
              if($search_num_1) {
                while($recent_data_3 = mysqli_fetch_array($search_result_2)) {
                  $search_user_id_1 = $recent_data_3["user_unique_id"];
                }
              }
        
              echo "
              <div class='search-recent-result-div'>
                <div class='recent-result-div result-div-search' data-search-value='$search_result' data-user-id='$user_unique_id' data-username='$username' data-search-value-1='$search_user_id_1'>
                    <div class='search-recent-icon'><i class='fa-solid fa-magnifying-glass'></i></div>
                    <div class='search-result'>
                      <p>$search_result</p>
                      <p>$search_date</p>
                    </div>
                </div>
                <div class='remove-search-recent remove-recent-x' data-recent-id='$search_id' data-recent-user-id='$search_unique_id' data-recent-username='$search_username'><i class='fa-solid fa-xmark'></i></div>
              </div>
        
              ";
            }
          } else {
            echo "
              <div class='search-recent-result-div'>
                <div class='recent-result-div'>
                    <div class='search-recent-icon'><i class='fa-solid fa-magnifying-glass'></i></div>
                    <div class='search-result'><p>Try Finding your secret friends...</p></div>
                </div>
            </div>
            ";
          }
          
          ?>
        
        </div>



        <!-- second container ends here -->

        <!-- people div start here -->
        <div class="people-know-container">
            <p class="people-p">People you may know</p>
            <div class="people-know-div">

            <?php 

            if($people_true) {
              while($people_data = mysqli_fetch_assoc($select_people_result)) {
                $people_username = $people_data["username"];
                $people_unique_id = $people_data["user_unique_id"];
                $people_pic = $people_data["user_picture"];

                $select_already_sent_request_out = "select * from `secret_friend_request` where request_unique_id = $user_unique_id 
                and user_unique_id = $people_unique_id or request_unique_id = $people_unique_id and user_unique_id = $user_unique_id";
                $already_sent_request_out_result = mysqli_query($con, $select_already_sent_request_out);
                $already_sent_request_out_row = mysqli_num_rows($already_sent_request_out_result);

                $select_remove_friend_1 = "select * from `suggestion_remove_table` where user_unique_id = $user_unique_id and remove_user_unique_id = $people_unique_id";
                $remove_friend_result_1 = mysqli_query($con, $select_remove_friend_1);
                $remove_friend_row_1 = mysqli_num_rows($remove_friend_result_1);


                if($people_unique_id == $user_unique_id) {
                  continue;
                } else {
                  if($already_sent_request_out_row >= 1) continue;
                  if($remove_friend_row_1 >= 1) continue;

                echo " 
                <div class='people-div'>
                    <div class='people-img-div'><img src='./sign_up_folder/user_image/$people_pic' alt='photo'></div>
                    <div class='people-btn-div'>
                        <p>$people_username</p>
                        <div class='people-btn-div-1'>
                            <button class='add-btn add-people-btn' data-username='$people_username'>Add friend</button>
                            <button class='remove-btn remove-people-btn' data-username='$people_username'>Remove</button>
                        </div>
                        <div class='cancel-request-div hidden'>
                          <button class='cancel-add-btn cancel-people-add-btn' data-request-id-1='$people_unique_id' data-request-id-2='$user_unique_id'>Cancel</button>
                        </div> 
                        <div class='cancel-request-div-1 hidden'>
                          <button class='cancel-add-btn-1 cancel-people-remove-btn' data-request-id-1='$people_unique_id' data-request-id-2='$user_unique_id'>Cancel</button>
                        </div>  
                    </div>
                </div>

                ";
                }
              }
            }
          
            
            ?>

                <!-- <div class="people-div ">
                    <div class="people-img-div"><img src="" alt="photo"></div>
                    <div class="people-btn-div">
                        <p>username</p>
                    <div class="cancel-request-div">
                        <div class="people-btn-div-1 hidden">
                            <button class="add-btn">Add friend</button>
                            <button class="remove-btn">Remove</button>
                        </div>
                        <div class="cancel-request-div ">
                          <button class="cancel-add-btn">Cancel</button>
                        </div>                      
                    </div>
                </div> -->

                
            </div>
        </div>
        <div class="people-know-see-all-div">
            <button class="people-see-all-btn">See All</button>
        </div>

        <!-- people div ends here -->

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

                  if($history_true) {
                    while($search_history_data_1 = mysqli_fetch_assoc($select_search_history_result_1)) {
                      $search_result_1 = $search_history_data_1["search_result"];
                      $search_date_1 = $search_history_data_1["search_date"];

                      $search_id_1 = $search_history_data_1["search_id"];
                      $search_unique_id_1 = $search_history_data_1["user_unique_id"];
                      $search_username_1 = $search_history_data_1["username"];

                      $search_user_2 = "select * from `secret_users` where username = '$search_result_1'";
                      $search_result_3 = mysqli_query($con, $search_user_2);
                      $search_num_2 = mysqli_num_rows($search_result_3);
  
                      if($search_num_2) {
                        while($recent_data_2 = mysqli_fetch_array($search_result_3)) {
                          $search_user_id_2 = $recent_data_2["user_unique_id"];
                        }
                      }
                      
                      echo " 
                      <div class='see-all-result-div result-recent-result-div'> 
                      <div class='see-all-result-div-1 result-div-search' data-search-value='$search_result_1' data-user-id='$user_unique_id' data-username='$username' data-search-value-1='$search_user_id_2'>
                      <p>$search_result_1</p>
                      <p>$search_date_1</p>
                      </div>
                      <div class='search-remove-div'>
                      <div class='search-remove-div-1 remove-recent-x' data-recent-id='$search_id_1' data-recent-user-id='$search_unique_id_1' data-recent-username='$search_username_1'><i class='fa-solid fa-xmark'></i></div>
                      </div>
                      </div>";
                    }
                  }
            
            
  
            ?>
  
  
          </div>
        </div>
      </div>
</body>
</html>

<script type="text/javascript">
  $(document).ready(function() {
    function searchInput() {
      $(".nav-input").keyup(function() {
        var search_value = $("input:text").val();
        $(".result-cover-div").removeClass("hidden")
        $(".result-cover-div").load("search_result.php", {search_result: search_value});
      });
    }

    function deleteRecentSearch() {
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

    function searchData_1() {
      $(".result-div-search").click(function() {
        var user_name = $(this).data("username");
        var user_id_1 = $(this).data("search-value-1");

        $.post("./function_folder/common_function_1.php", {all_friend_id: user_id_1, all_friend_username: user_name}, function() {
          window.open("./friend_profile_folder/friend_profile1.php", "_self");
        });
      });
    }

    function gettingUsername() {
        $(".add-people-btn").click(function() {
            var username = $(this).data("username");
            $.post("", {friend_username: username}, function() {
                console.log("SecretBook is the best!!");
            })
        });
    };

    function removingUsername() {
        $(".remove-people-btn").click(function() {
            var username = $(this).data("username");
            $.post("", {friend_remove_username: username}, function() {
                console.log("SecretBook is the best!!");
            })
        })
    }

    function cancelFriendRequest() {
        $(".cancel-people-add-btn").click(function() {
            var firstId = $(this).data("request-id-1");
            var secondId = $(this).data("request-id-2");
            $.post("", {first_id: firstId, second_id: secondId}, function() {
                console.log("SecretBook is the best!!");
            });
        });
    };

    function cancelRemoveRequest() {
        $(".cancel-people-remove-btn").click(function () {
            var firstId = $(this).data("request-id-1");
            var secondId = $(this).data("request-id-2");
            $.post("", {Remove_first_id: firstId, Remove_second_id: secondId}, function() {
                console.log("SecretBook is the best!!");
            });
        })
    }


    searchData_1();
    deleteRecentSearch();
    searchInput();
    gettingUsername();
    removingUsername();
    cancelFriendRequest();
    cancelRemoveRequest();
  });
</script>

<?php 

if(isset($_POST["friend_username"])) {
  $friend_username = $_POST["friend_username"];
  $select_add_friend = "select * from `secret_users` where username = '$friend_username'";
  $result_add_friend = mysqli_query($con, $select_add_friend);
  $add_friend_row = mysqli_num_rows($result_add_friend);
  if($add_friend_row >= 1) {
      $add_friend_data = mysqli_fetch_assoc($result_add_friend);
      $request_friend_username = $add_friend_data["username"];
      $request_friend_id = $add_friend_data["user_unique_id"];
      $request_status = "Not accepted";
      $post_comment = "friend request";
      $post_unseen = "unseen";
      $notification_post_id = 000;

      $add_request = ("insert into `secret_friend_request` (user_unique_id, username, request_username, request_unique_id, request_status, request_date) 
      values (?, ?, ?, ?, ?, NOW())");
      $add_request_stmt = $con->prepare($add_request);
      $add_request_stmt->bind_param("issis", $request_friend_id, $request_friend_username, $username, $user_unique_id, $request_status);
      $add_request_stmt->execute();
      echo "<script>alert('successfully uploaded')</script>";

      $insert_notification = ("insert into `secret_notification_table` (user_unique_id, username, friend_unique_id, friend_username, notification_type, notification_seen, 
      notification_post_id, notification_date) values (?, ?, ?, ?, ?, ?, ?, NOW())");
      $insert_notification_stmt = $con->prepare($insert_notification);
      $insert_notification_stmt->bind_param("isisssi", $user_unique_id, $username, $request_friend_id, $request_friend_username, $post_comment, $post_unseen, $notification_post_id);
      $insert_notification_stmt->execute();
  } 
}

if(isset($_POST["friend_remove_username"])) {
  $friend_username = $_POST["friend_remove_username"];
  $select_add_friend = "select * from `secret_users` where username = '$friend_username'";
  $result_add_friend = mysqli_query($con, $select_add_friend);
  $add_friend_row = mysqli_num_rows($result_add_friend);
  if($add_friend_row >= 1) {
      $add_friend_data = mysqli_fetch_assoc($result_add_friend);
      $request_friend_username = $add_friend_data["username"];
      $request_friend_id = $add_friend_data["user_unique_id"];

      $add_request = ("insert into `suggestion_remove_table` (user_unique_id, username, remove_user_unique_id, remove_username, remove_date) 
      values (?, ?, ?, ?, NOW())");
      $add_request_stmt = $con->prepare($add_request);
      $add_request_stmt->bind_param("isis", $user_unique_id, $username, $request_friend_id, $request_friend_username);
      $add_request_stmt->execute();
      echo "<script>alert('successfully uploaded')</script>";
  } 
}

if(isset($_POST["first_id"])) {
  $first_id = $_POST["first_id"];
  $second_id = $_POST["second_id"];
  $post_comment = "friend request";
  $delete_friend_request = "delete from `secret_friend_request` where user_unique_id = $first_id and request_unique_id = $second_id";
  $delete_request_result = mysqli_query($con, $delete_friend_request);
  if($delete_request_result) {
      echo "<script>alert('request Cancel successfully')</script>";
  } else {
      echo "<script>alert('something went wrong')</script>";
  }

  $delete_notification = "delete from `secret_notification_table` where user_unique_id = $user_unique_id and friend_unique_id = $first_id and notification_type = '$post_comment'";
  $delete_notification_request = mysqli_query($con, $delete_notification);
}

if(isset($_POST["Remove_first_id"])) {
  $first_id = $_POST["Remove_first_id"];
  $second_id = $_POST["Remove_second_id"];
  $delete_friend_request = "delete from `suggestion_remove_table` where user_unique_id = $second_id and remove_user_unique_id = $first_id";
  $delete_request_result = mysqli_query($con, $delete_friend_request);
  if($delete_request_result) {
      echo "<script>alert('request Cancel successfully')</script>";
  } else {
      echo "<script>alert('something went wrong')</script>";
  }
}

?>