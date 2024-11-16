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
    <link rel="stylesheet" href="sign_up.css">
    <script defer src="../app.js"></script>
</head>
<body>
    <form action="" method="post" class="form2">
        <label for="user-email" class="show-pwd">Email used for login</label>
        <input type="text" id="user-email" placeholder="Email" name="forgotten_email" class="forgotten-input">
        <label for="user-password" class="show-pwd">New password</label>
        <input type="password" placeholder="Password" name="new_password" class="forgotten-input user-password">
        <label for="show-pwd" class="show-pwd">Show Password
            <input type="checkbox" name="check-pwd" id="show-pwd" class="check-pwd" onclick="showPwd()">
        </label>
        <input type="submit" value="Submit" name="submit" class="submit">
    </form>
</body>
</html>

<?php 
if(isset($_POST["submit"])) {
    $forgotten_email = $_POST["forgotten_email"];
    $new_password = $_POST["new_password"];
    $new_hashed_pwd = password_hash($new_password, PASSWORD_BCRYPT, $arrayName = array(12));

    $errors = [];

    if(!is_signup_empty($forgotten_email, $new_password)) {
        echo "<script>alert('Field cannot be empty')</script>";
        $errors[0] = "error0";
        exit();
    } 

    if(is_email_valid($forgotten_email)) {
        echo "<script>alert('not a valid email')</script>";
        $errors[1] = "error1";
        exit();
    }

    if(!does_Email_exit($forgotten_email)) {
        echo "<script>alert('sorry but no user with that email found. Please Register and start chatting!!')</script>";
        $errors[2] = "error2";
        exit();
    }

    if(empty($errors)) {
        $update = "update `secret_users` set password = '$new_hashed_pwd' where user_email = '$forgotten_email'";
        $result = mysqli_query($con, $update);
        if($result) {
            echo "<script>alert('Successful changes your password')</script>";
            echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>";
        }
    }
}

?>