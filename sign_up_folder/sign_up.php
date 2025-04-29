<?php
include("../include_folder/include.php");
include("../function_folder/common_function.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font awesome links start here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ends here -->
    <!-- font text start here -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Karla:ital,wght@0,200..800;1,200..800&family=Kode+Mono:wght@400..700&family=Pacifico&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- ends here -->
    <!-- link css start here -->
    <link rel="stylesheet" href="sign_up.css">
    <!-- ends here -->
    <!-- link javascript start here -->
    <script defer src="../app_p.js"></script>
    <!-- ends here -->
</head>
<body>
    <div class="too-small-1">
        <h1>Sorry, Move to a bigger devices</h1>
    </div>
    <div class="too-big-1">
        <h1>Sorry, Move to a smaller devices</h1>
    </div>

    <div class="container1">
        <div class="row3">
            <h1>SecretBook</h1>
            <p>SecretBook helps connect and share</p>
            <p>with the people in your diary.</p>
        </div>
        <div class="row4">
            <form action="" method="post" class="row-form1" enctype="multipart/form-data">
                <input type="text" name="user_name" placeholder="Username" class="input1" autocomplete="off">
                <input type="text" name="user_email" placeholder="Email address" class="input1" autocomplete="off">
                <input type="password" name="user_password" placeholder="password" class="input1 user-password" autocomplete="off">
                <label for="check-pwd" class="show-pwd">show password
                    <input type="checkbox" name="check_box" id="check-pwd" class="check-pwd" onclick="showPwd()">
                </label>
                <input type="month" name="user_age" placeholder="Date of Birth" class="input1">
                <input type="text" name="user_location" placeholder="Where do you live" class="input1" autocomplete="off">
                <label for="user-pic" class="user-pic"> Add image <i class="fa-solid fa-plus sign-up-plus"></i>
                    <input type="file" id="user-pic" name="user_picture" class="input1_1 hidden">
                </label>
                <input type="submit" value="Sign up" name="sign_up" class="submit-btn">
                <a class="row-a" href="sign_in.php">Already have an account?</a>
            </form>
            <div class="error-div hidden">
                <div class="error">
                    <p>Wrong</p>
                    <p>Credentials</p>
                </div>
            </div>
            <!-- error one -->
            <div class="error-div1 hidden">
                <div class="error">
                    <p>Invalid</p>
                    <p>Email</p>
                </div>
            </div>
            <!-- error two -->
            <div class="error-div2 hidden">
                <div class="error">
                    <p>Username</p>
                    <p>Taken</p>
                </div>
            </div>
            <!-- error three -->
            <div class="error-div3 hidden">
                <div class="error">
                    <p>Email</p>
                    <p>Taken</p>
                </div>
            </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST["sign_up"])) {
        $username = $_POST["user_name"];
        $user_email = $_POST["user_email"];
        $user_password = $_POST["user_password"];
        $hashed_pwd = password_hash($user_password, PASSWORD_BCRYPT, $arrayName = array(12));
        $age = $_POST["user_age"];
        $user_location = $_POST["user_location"];
        $user_pic = $_FILES["user_picture"]["name"];
        $user_pic_tmp = $_FILES["user_picture"]["tmp_name"];
        $user_unique_id = mt_rand();
        $online = "online";

    $errors = [];
    
    
    if(!is_input_empty($username, $user_email, $user_password, $age, $user_location, $user_pic)) {
        echo "<script>
        const error = document.querySelector('.error-div');
    
        function wrongDetail() {
            setTimeout(() => {
                error.classList.remove('hidden');
        }, 1000);
    
        setTimeout(() => {
            error.classList.add('hidden');
        }, 3000);
    }
    
    wrongDetail();
    </script>";
    $errors[0] = "error0";
    }

    if(is_email_valid($user_email)) {
        echo "<script>
        const error = document.querySelector('.error-div1');
    
    function wrongDetail() {
        setTimeout(() => {
            error.classList.remove('hidden');
        }, 1000);
    
        setTimeout(() => {
            error.classList.add('hidden');
        }, 3000);
    }
    
    wrongDetail();
    </script>";
    $errors[1] = "error1";
    }

    if(is_username_taken($username)) {
        echo "<script>
        const error = document.querySelector('.error-div2');
    
    function wrongDetail() {
        setTimeout(() => {
            error.classList.remove('hidden');
        }, 1000);
    
        setTimeout(() => {
            error.classList.add('hidden');
        }, 3000);
    }
    
    wrongDetail();
    </script>";
    $errors[2] = "error2";
    }

    if(is_Email_taken($user_email)) {
        echo "<script>
        const error = document.querySelector('.error-div3');
    
    function wrongDetail() {
        setTimeout(() => {
            error.classList.remove('hidden');
        }, 1000);
    
        setTimeout(() => {
            error.classList.add('hidden');
        }, 3000);
    }
    
    wrongDetail();
    </script>";
    $errors[3] = "error3";
    }

    if(empty($errors)) {
        move_uploaded_file($user_pic_tmp, "./user_image/$user_pic");
        $insert_query = "insert into `secret_users` (username, user_email, password, age, location, user_picture, user_unique_id, user_online, date)
        values ('$username', '$user_email', '$hashed_pwd', '$age', '$user_location', '$user_pic', $user_unique_id, '$online', NOW())";
        $result_query = mysqli_query($con, $insert_query);
        if($result_query) {
            $_SESSION["username"] = $username;
            $_SESSION["user_unique_id"] = $user_unique_id;
            $_SESSION["user_bio"] = "Add Some details to let friends know about you better..";
            $_SESSION["email"] = $user_email;
            echo "<script>alert('Successful joined SecretBook!!!')</script>";
            echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
        } else {
            echo "<script>alert('something goes wrong')</script>";
            exit();        
        }
    }
} 
?>