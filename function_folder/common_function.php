<?php

// include("../include_folder/include.php");
declare(strict_types=1);

@session_start();

function is_input_empty($username, $user_email, $password, $age, $location, $image)
{
    if(empty($username) || empty($user_email) || empty($password) || empty($age) || empty($location) || empty($image)) {
        return false;
    } else {
        return true;
    }
}

function is_signup_empty($email, $password)
{
    if(empty($email) || empty($password)) {
        return false;
    } else {
        return true;
    }
}

function is_email_valid($email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken($username)
{
    global $con;
    $select_statement = "select username from `secret_users` where username = '$username'";
    $result = mysqli_query($con, $select_statement);
    $row = mysqli_num_rows($result);
    if($row > 0) {
        return true;
    } else {
        return false;
    }
}

function is_Email_taken($user_email)
{
    global $con;
    $select_statement = "select user_email from `secret_users` where user_email = '$user_email'";
    $result = mysqli_query($con, $select_statement);
    $row = mysqli_num_rows($result);
    if($row > 0) {
        return true;
    } else {
        return false;
    }
}

function does_Email_exit($email)
{
    global $con;
    $select_statement = "select user_email from `secret_users` where user_email = '$email'";
    $result = mysqli_query($con, $select_statement);
    $row = mysqli_num_rows($result);
    if($row > 0) {
        return true;
    } else {
        return false;
    }
}

function does_Password_exit($password, $email)
{
    global $con;
    $select_statement = "select * from `secret_users` where user_email = '$email'";
    $result = mysqli_query($con, $select_statement);
    $row = mysqli_fetch_assoc($result);
    $pwd = $row["password"];
    if(password_verify($password, $pwd)) {
        return true;
    } else {
        return false;
    }
}

function does_userLocation_exit($result)
{
    $row = mysqli_num_rows($result);
    if($row > 0) {
        return true;
    } else {
        return false;
    }
}

function add_about()
{
    global $con;
    global $user_unique_id_1;
    if(isset($_POST["workplace-btn"])) {
        $user_workplace = htmlspecialchars($_POST["user-workplace"]);
        if(empty($user_workplace)) {
            echo "<script>alert('Please fill the field')</script>";
        } else {
            $update_query_1 = "update `secret_users_about` set user_work = '$user_workplace' where user_unique_id = $user_unique_id_1";
            $result_query_5 = mysqli_query($con, $update_query_1);
            if($result_query_5) {
                echo "<script>alert('Workplace successful update..!!')</script>";
            } else {
                echo "<script>alert('Something went wrong..')</script>";
            }
        }
    }
}

function add_about_1()
{
    global $con;
    global $user_unique_id_1;
    if(isset($_POST["visited-btn"])) {
        $user_visited = htmlspecialchars($_POST["user-visited-places"]);
        if(empty($user_visited)) {
            echo "<script>alert('Please fill the field')</script>";
        } else {
            $update_query_1 = "update `secret_users_about` set user_place_lived = '$user_visited' where user_unique_id = $user_unique_id_1";
            $result_query_5 = mysqli_query($con, $update_query_1);
            if($result_query_5) {
                echo "<script>alert('Place visited successful update..!!')</script>";
            } else {
                echo "<script>alert('Something went wrong..')</script>";
            }
        }
    }
}

function add_about_2()
{
    global $con;
    global $user_unique_id_1;
    if(isset($_POST["relationship-btn"])) {
        $user_relationship = htmlspecialchars($_POST["user-relationship"]);
        if(empty($user_relationship)) {
            echo "<script>alert('Please fill the field')</script>";
        } else {
            $update_query_1 = "update `secret_users_about` set user_relationship = '$user_relationship' where user_unique_id = $user_unique_id_1";
            $result_query_5 = mysqli_query($con, $update_query_1);
            if($result_query_5) {
                echo "<script>alert('Relationship status successful update..!!')</script>";
            } else {
                echo "<script>alert('Something went wrong..')</script>";
            }
        }
    }
}

function add_about_3()
{
    global $con;
    global $user_unique_id_1;
    if(isset($_POST["hometown-btn"])) {
        $user_hometown = htmlspecialchars($_POST["user-Hometown"]);
        if(empty($user_hometown)) {
            echo "<script>alert('Please fill the field')</script>";
        } else {
            $update_query_1 = "update `secret_users_about` set user_home_town = '$user_hometown' where user_unique_id = $user_unique_id_1";
            $result_query_5 = mysqli_query($con, $update_query_1);
            if($result_query_5) {
                echo "<script>alert('Hometown successful update..!!')</script>";
            } else {
                echo "<script>alert('Something went wrong..')</script>";
            }
        }
    }
}

function add_about_4()
{
    global $con;
    global $user_unique_id_1;
    if(isset($_POST["describe-btn"])) {
        $user_describe = htmlspecialchars($_POST["user-describe"]);
        if(empty($user_describe)) {
            echo "<script>alert('Please fill the field')</script>";
        } else {
            $update_query_1 = "update `secret_users_about` set user_details = '$user_describe' where user_unique_id = $user_unique_id_1";
            $result_query_5 = mysqli_query($con, $update_query_1);
            if($result_query_5) {
                echo "<script>alert('Descriptions successful update..!!')</script>";
            } else {
                echo "<script>alert('Something went wrong..')</script>";
            }
        }
    }
}

function add_about_5()
{
    global $con;
    global $user_unique_id_1;

    $select_statement = "select * from `secret_users_about` where user_unique_id = $user_unique_id_1";
    $result = mysqli_query($con, $select_statement);
    $row = mysqli_num_rows($result);
    if($row > 0) {
        $data = mysqli_fetch_assoc($result);
        
        return $data;
    } else {
        echo "<script>alert('something went wrong..')</script>";
    }
}

