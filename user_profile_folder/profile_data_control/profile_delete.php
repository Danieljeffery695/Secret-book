<?php

declare(strict_types=1);
include("../../include_folder/include.php");
session_start();

if (isset($_SESSION["user_unique_id"])) {
    $user_unique_id = $_SESSION["user_unique_id"];
} else {
    echo "<script>window.open('../../sign_up_folder/sign_in.php', '_self')</script>";
}

if (isset($_POST["user_delete_id"])) {
    $delete_id = $_POST["user_delete_id"];
    $home_story_delete_id = $_POST["profile_story_comment_id"];
    $home_delete_story = $_POST["profile_comment_story"];

    $select_story_post = "select * from `profile_story` where story_unique_id = $delete_id and user_unique_id = $home_story_delete_id and user_color = '$home_delete_story'";
    $result = mysqli_query($con, $select_story_post);

    if ($result) {
        $row_count = mysqli_num_rows($result);
        if ($row_count >= 1) {

            $row = mysqli_fetch_assoc($result);
            $story_id = $row["story_id"];

            $delete_story_post = "delete from `profile_story` where story_id = $story_id and story_unique_id = $delete_id and user_unique_id = $home_story_delete_id and user_color = '$home_delete_story'";
            $delete_result = mysqli_query($con, $delete_story_post);

            $delete_story_post_1 = "delete from `profile_uploaded` where upload_id = $delete_id and user_unique_id = $home_story_delete_id and post_img = '$home_delete_story'";
            $delete_result_1 = mysqli_query($con, $delete_story_post_1);

            $select_post_like = "select * from `profile_story_like` where post_id = $story_id";
            $result_1 = mysqli_query($con, $select_post_like);
            $row_count_1 = mysqli_num_rows($result_1);

            if ($row_count_1 >= 1) {
                $delete_story_post_like = "delete from `profile_story_like` where post_id = $story_id";
                $delete_result_2 = mysqli_query($con, $delete_story_post_like);
            }

            $select_post_comment = "select * from `profile_story_comment` where post_id = $story_id and user_unique_id = $home_story_delete_id and post_image = '$home_delete_story'";
            $result_2 = mysqli_query($con, $select_post_comment);
            $row_count_2 = mysqli_num_rows($result_2);

            if ($row_count_2 >= 1) {
                $delete_story_comment = "delete from `profile_story_comment` where post_id = $story_id and user_unique_id = $home_story_delete_id and post_image = '$home_delete_story'";
                $delete_result_3 = mysqli_query($con, $delete_story_comment);
            }

        }
    }
}


if (isset($_POST["user_delete_post_id"])) {
    $delete_id = $_POST["user_delete_post_id"];
    $home_story_delete_id = $_POST["profile_story_comment_id"];
    $home_delete_story = $_POST["profile_comment_story"];

    $select_story_post = "select * from `secret_user_post` where post_unique_id = $delete_id and user_unique_id = $home_story_delete_id and user_post_img = '$home_delete_story'";
    $result = mysqli_query($con, $select_story_post);

    if ($result) {
        $row_count = mysqli_num_rows($result);
        if ($row_count >= 1) {

            $row = mysqli_fetch_assoc($result);
            $post_id = $row["user_id"];
            $user_post_img = $row["user_post_img"];

            $delete_story_post = "delete from `secret_user_post` where user_id = $post_id and post_unique_id = $delete_id and user_unique_id = $home_story_delete_id and user_post_img = '$home_delete_story'";
            $delete_result = mysqli_query($con, $delete_story_post);

            $delete_story_post_1 = "delete from `profile_uploaded` where upload_id = $delete_id and user_unique_id = $home_story_delete_id and post_img = '$home_delete_story'";
            $delete_result_1 = mysqli_query($con, $delete_story_post_1);

            $select_post_like = "select * from `user_profile_like` where post_id = $post_id";
            $result_1 = mysqli_query($con, $select_post_like);
            $row_count_1 = mysqli_num_rows($result_1);

            if ($row_count_1 >= 1) {
                $delete_story_post_like = "delete from `user_profile_like` where post_id = $post_id";
                $delete_result_2 = mysqli_query($con, $delete_story_post_like);
            }

            $select_post_comment = "select * from `secret_users_comment` where post_id = $post_id and user_unique_id = $home_story_delete_id and post_img = '$home_delete_story'";
            $result_2 = mysqli_query($con, $select_post_comment);
            $row_count_2 = mysqli_num_rows($result_2);

            if ($row_count_2 >= 1) {
                $delete_story_comment = "delete from `secret_users_comment` where post_id = $post_id and user_unique_id = $home_story_delete_id and post_img = '$home_delete_story'";
                $delete_result_3 = mysqli_query($con, $delete_story_comment);

                $file_pointer = "../user_post_img/$user_post_img";

                unlink($file_pointer);


            }

        }
    }
}

