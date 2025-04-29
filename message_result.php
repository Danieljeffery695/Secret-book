<?php

include("./include_folder/include.php");
session_start();

try {
  //code...

if(isset($_SESSION["friend_unique_id"])) {
    $all_friend_id = $_SESSION["friend_unique_id"];
    $all_username = $_SESSION["friend_username"];
    $user_id = $_SESSION["user_unique_id"];

    $select_friend_pics = "select * from `secret_users` where user_unique_id = $all_friend_id and username = '$all_username'";
    $select_one_result = mysqli_query($con, $select_friend_pics);
    $select_one_row = mysqli_num_rows($select_one_result);
    if($select_one_row >= 1) {
        $select_one_data = mysqli_fetch_assoc($select_one_result);
        $friend_pic = $select_one_data["user_picture"];
    }

    $select_user_pics = "select * from `secret_users` where user_unique_id = $user_id";
    $select_two_result = mysqli_query($con, $select_user_pics);
    $select_two_row = mysqli_num_rows($select_two_result);
    if($select_two_row >= 1) {
        $select_two_data = mysqli_fetch_assoc($select_two_result);
        $user_pic = $select_two_data["user_picture"];
        $user_username = $select_two_data["username"];
    }

  
} else {
    echo "no character";
}

$users_chat = [];
$users_chat_1 = [];
$i = 0;

class Message {
    public $sender_id;
    public $sender_name;
    public $receiver_id;
    public $receiver_name;
    public $msg_content;
    public $msg_status;
    public $msg_date;
  
   public function __construct($sender_id, $sender_name, $receiver_id, $receiver_name, $msg_content, $msg_status, $msg_date) 
    {
      $this->sender_id = $sender_id;
      $this->sender_name = $sender_name;
      $this->receiver_id = $receiver_id;
      $this->receiver_name = $receiver_name;
      $this->msg_content = $msg_content;
      $this->msg_status = $msg_status;
      $this->msg_date = $msg_date;
    }
}
  
  // user chat 
  
  $select_users_chats = "select * from `users_chat` where sender_id = $all_friend_id and sender_username = '$all_username' and receiver_id = $user_id and receiver_username = '$user_username'
  or sender_id = $user_id and sender_username = '$user_username' and receiver_id = $all_friend_id and receiver_username = '$all_username'";
  $select_message_result = mysqli_query($con, $select_users_chats);
  
  $message_row_count = mysqli_num_rows($select_message_result);
  
  if($message_row_count >= 1) {
    while($message_data = mysqli_fetch_assoc($select_message_result)) { 
    $ffkff = [];
    $sender_id = $message_data["sender_id"];
    $sender_username = $message_data["sender_username"];
    $receiver_id = $message_data["receiver_id"];
    $receiver_name = $message_data["receiver_username"];
    $msg_content = $message_data["msg_content"];
    $msg_status = $message_data["msg_status"];
    $msg_date = $message_data["msg_date"];
    $msg_id = $message_data["msg_id"];
  
    $user_1 = new Message($sender_id, $sender_username, $receiver_id, $receiver_name, $msg_content, $msg_status, $msg_date, $msg_id);
    $ffkff["sender_id"] = $user_1->sender_id;
    $ffkff["sender_name"] = $user_1->sender_name;
    $ffkff["receiver_id"] = $user_1->receiver_id;
    $ffkff["receiver_name"] = $user_1->receiver_name;
    $ffkff["msg_content"] = $user_1->msg_content;
    $ffkff["msg_status"] = $user_1->msg_status;
    $ffkff["msg_date"] = $user_1->msg_date;
  
  
    $users_chat[$msg_id] = $ffkff;
    $users_chat_1[$i] = $msg_id;
      $i += 1;
    }
  }

  $message_count = count($users_chat);
  if($message_count) {
    $message_exits = true;
  } else {
    $message_exits = false;
  }

} catch (Exception $e) {
  echo "<script>alert('Something went wrong')</script>";
  echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
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
    <link rel="stylesheet" href="./message.css">
</head>
<body>

<?php 

if($message_exits) {
  $ii = 0;
  while($ii < $message_count) {
    $jjkks = $users_chat_1[$ii];
    // $post_user_id = $users_posts[$jjkks]["post_unique_id"];
    $sender_id = htmlspecialchars($users_chat[$jjkks]["sender_id"]);
    $sender_username = htmlspecialchars($users_chat[$jjkks]["sender_name"]);
    $receiver_id = htmlspecialchars($users_chat[$jjkks]["receiver_id"]);
    $receiver_username = htmlspecialchars($users_chat[$jjkks]["receiver_name"]);
    $msg_content = htmlspecialchars($users_chat[$jjkks]["msg_content"]);
    $msg_status = htmlspecialchars($users_chat[$jjkks]["msg_status"]);
    $msg_date = htmlspecialchars($users_chat[$jjkks]["msg_date"]);

    if($sender_id == $all_friend_id) {
      $select_sender_pic = "select * from `secret_users` where user_unique_id = $sender_id";
      $select_sender_pic_result = mysqli_query($con, $select_sender_pic);
      $sender_pic_row = mysqli_num_rows($select_sender_pic_result);
      if($sender_pic_row >= 1) {
        $sender_pic_data = mysqli_fetch_assoc($select_sender_pic_result);
        $sender_pic = $sender_pic_data["user_picture"];
      }
      echo "
        <div class='message-data-div-1'>
          <div class='message-data-profile-div'>
            <img src='./sign_up_folder/user_image/$sender_pic' alt='photo'>
          </div>
            <div class='message-info-div'>
                <p>$sender_username $msg_date</p>
              <div class='info-div'>
                <p>$msg_content</p>
              </div>
            </div>
        </div>

      ";
    } else {
      echo "
        <div class='message-data-div-2'>
          <div class='message-info-div-1'>
              <p>$receiver_username $msg_date</p>
              <div class='info-div-1'>
                <p>$msg_content</p>
              </div>
            </div>
            <div class='message-data-profile-div'>
              <img src='./sign_up_folder/user_image/$user_pic' alt='photo'>
          </div>
        </div>

      ";
    }

    $ii += 1;
  }
} else {

    echo "
      <div class='message-data-div-1'>
        <div class='message-data-profile-div'>
          <img src='./user_home_folder/pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png' alt='photo'>
        </div>
          <div class='message-info-div'>
              <p>SecretBook 2024-09-23</p>
            <div class='info-div'>
              <p>Hey, you don't have any friends yet...</p>
            </div>
          </div>
      </div>

    ";

    echo "
      <div class='message-data-div-2'>
        <div class='message-info-div-1'>
            <p>SecretBook 2024-08-22</p>
            <div class='info-div-1'>
              <p>Why don't you go out there and make some friends..!!!</p>
            </div>
          </div>
          <div class='message-data-profile-div'>
            <img src='./user_home_folder/pixlr-image-generator-7f4fd879-a2ff-4d59-b38c-968bb6a7ce39.png' alt='photo'>
        </div>
      </div>

    ";
}



?>

</body>
</html>