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
    <script defer src="../app.js"></script>
    <!-- ends here -->
    <style>
    .show-pwd {
    font-size: 18px;
    font-family: kode mono, sans-serif;
    padding-right: 5px;
    margin-top: 15px;
    margin-bottom: 15px;
}

  .check-pwd {
    cursor: pointer;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="row1">
            <h1>SecretBook</h1>
            <p>SecretBook helps connect and share</p>
            <p>with the people in your diary.</p>
        </div>
        <div class="row2">
            <form action="" method="post" class="row-form">
                <input type="email" name="user_email" placeholder="Email address" class="input" autocomplete="off">
                <input type="password" name="user_password" placeholder="password" class="input user-password" autocomplete="off">
                <label for="check-pwd" class="show-pwd">show password
                    <input type="checkbox" name="check_box" id="check-pwd" class="check-pwd" onclick="showPwd()">
                </label>
                <input type="submit" value="Log in" name="login" class="submit-btn">
                <a class="row-a" href="">Forgotten password?</a>
                <a class="row-a" href="sign_up.php">Don't have an account?</a>
            </form>
            <div class="error-div hidden">
                <div class="error">
                    <p>Fill</p>
                    <p>Field</p>
                </div>
            </div>
            <!-- error two -->
            <div class="error-div1 hidden">
                <div class="error">
                    <p>Wrong</p>
                    <p>Email</p>
                </div>
            </div>
            <!-- error three -->
            <div class="error-div2 hidden">
                <div class="error">
                    <p>Wrong</p>
                    <p>Password</p>
                </div>
            </div>
        </div>
    </div> 
    <div class="too-small">
        <h1>Sorry, Move to a bigger devices</h1>
    </div>
    <div class="too-big">
        <h1>Sorry, Move to a smaller devices</h1>
    </div>
</body>
</html>

<?php
if(isset($_POST["login"])) {
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];

    $errors = [];

    if(!is_signup_empty($user_email, $user_password)) {
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
    die();
    }

    if(!does_Email_exit($user_email)) {
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
    $errors[0] = "error1";
    die();
    }

    if(!does_Password_exit($user_password, $user_email)) {
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
    $errors[0] = "error2";
    die();
    }

    if(empty($errors)) {
        $select_statement ="select * from `secret_users` where user_email = '$user_email'";
        $result_query = mysqli_query($con, $select_statement);
        $row = mysqli_fetch_assoc($result_query);
        $_SESSION["username"] = $row["username"];
        $_SESSION["email"] = $row["user_email"];
        $username = $_SESSION["username"];
        $_SESSION["user_unique_id"] = $row["user_unique_id"];
        $user_unique_id = $_SESSION["user_unique_id"];
        $select_statement_1 = "select * from `secret_users_bio` where user_unique_id = $user_unique_id";
        $result_query_1 = mysqli_query($con, $select_statement_1);
        $data_row = mysqli_num_rows($result_query_1);
        if($data_row > 0) {
            $data = mysqli_fetch_assoc($result_query_1);
            $user_bio = $data["user_bio"];
            $_SESSION["user_bio"] = $user_bio;
        } else {
            $_SESSION["user_bio"] = "Add Some details to let friends know about you better..";
        }

        echo "<script>alert('successful login')</script>";
        echo "<script>window.open('../user_profile_folder/user_profile.php', '_self')</script>"; 
    } 
}
 ?>
