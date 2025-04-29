 <?php  
include("../include_folder/include.php");
include("../function_folder/common_function.php");

// session_start();
if(isset($_SESSION["username"])) {
    $username_1 = $_SESSION["username"];
} else {
    echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}

if(isset($_SESSION["user_unique_id"])) {
    $user_unique_id_1 = $_SESSION["user_unique_id"];
} else {
    echo "<script>window.open('../sign_up_folder/sign_in.php', '_self')</script>";
}

$select_query_2 = "select * from `secret_users` where user_unique_id = $user_unique_id_1";
$result_query_2 = mysqli_query($con, $select_query_2);
if($result_query_2) {
    $row = mysqli_fetch_array($result_query_2);
    
    if(does_userLocation_exit($result_query_2)) {
        $user_location = $row["location"];
    } else {
        $user_location = "<i class='fa-solid fa-circle-plus add-icon'></i> Current Location";
    }

}

if(isset($_POST["location-btn"])) {
    $user_location_1 = htmlspecialchars($_POST["user-workplace"]);
    if(empty($user_location_1)) {
        echo "<script>alert('something went wrong...!!')</script>";
    } else {
        $update_query = "update `secret_users` set location = '$user_location_1' where user_unique_id = $user_unique_id_1";
        $result_query_3 = mysqli_query($con, $update_query);
        if($result_query_3) {
            echo "<script>alert('Location successful updated..!!')</script>";
            echo "<script>window.open('user_about.php')</script>";
        } else {
            echo "<script>alert('update location failed!!')</script>";
        }
    }
}
$select_query_3 = "select * from `secret_users_about` where user_unique_id = $user_unique_id_1";
$result_query_4 = mysqli_query($con, $select_query_3);
$row_1 = mysqli_num_rows($result_query_4);

if($row_1 > 0) {
        add_about();
        add_about_1();
        add_about_2();
        add_about_3();
        add_about_4();
        $data_1 = add_about_5();
        $user_work = $data_1["user_work"];
        $user_place_lived = $data_1["user_place_lived"];
        $user_relationship = $data_1["user_relationship"];
        $user_home_town = $data_1["user_home_town"];
        $user_details = $data_1["user_details"];    
} else {

    $user_work = "&plus; Add a WorkPlace";
    $user_place_lived = "&plus; Visited Places";
    $user_relationship = "&plus; Relationship Status";
    $user_home_town = "&plus; Home Town";
    $user_details = "&plus; Something people need to know!!";
    
    $insert_query_1 = "insert into `secret_users_about` (user_unique_id, username, user_work, user_place_lived, user_relationship, user_home_town, user_details)
    values ($user_unique_id_1, '$username_1', '$user_work', '$user_place_lived', '$user_relationship', '$user_home_town', '$user_details')";
    $result_query_6 = mysqli_query($con, $insert_query_1);
}

 ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" href="user_about.css">
    <script defer src="user_about.js"></script>

</head>
<body>
    <div class="div-about">
        <div class="div-about-1">
            <div class="div-about-2">
                <h3>About</h3>
                <h5>Overview</h5>
                <p class="user-about-1">location</p>
                <p class="user-about-2">Work and education</p>
                <p class="user-about-3">Places lived</p>
                <p class="user-about-4">Relationship status</p>
                <p class="user-about-5">Home Town</p>
                <p class="user-about-6">Details about you</p>
            </div>
            <div class="div-about-3">
                <div class="about-div">
                    <form action="" method="post" class="user-about-form hiddens">
                        <input type="text" name="user-workplace" placeholder="Current Location..." class="user-about-input" autocomplete="off">
                        <br>
                        <button class="user-about-cancel-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                        <input type="submit" value="&#8599;" class="user-about-send-btn" name="location-btn">
                    </form>
                    <h4 class="div-about-h4-1"><?php echo $user_location; ?></h4>
                </div>
            </div>
            <!-- div 4 -->
            <div class="div-about-4 hiddens">
                <div class="about-div">
                    <form action="" method="post" class="user-about-form1 hiddens">
                        <input type="text" name="user-workplace" placeholder="Current workplace..." class="user-about-input1" autocomplete="off">
                        <br>
                        <button class="user-about-cancel-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                        <input type="submit" value="&#8599;" class="user-about-send-btn" name="workplace-btn">
                    </form>
                    <h4  class="div-about-h4-2"><?php echo $user_work; ?></h4>
                </div>
            </div>
            <!-- div 5 -->
            <div class="div-about-5 hiddens">
                <div class="about-div">
                    <form action="" method="post" class="user-about-form3 hiddens">
                        <input type="text" name="user-visited-places" placeholder="Visited Places..." class="user-about-input3" autocomplete="off">
                        <br>
                        <button class="user-about-cancel-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                        <input type="submit" value="&#8599;" class="user-about-send-btn" name="visited-btn">
                    </form>
                    <h4 class="about-h4-3"><?php echo $user_place_lived; ?></h4>
                </div>
            </div>
            <!-- div 6 -->
            <div class="div-about-6 hiddens">
                <div class="about-div">
                    <form action="" method="post" class="user-about-form4 hiddens">
                        <input type="text" name="user-relationship" placeholder="Current Status..." class="user-about-input4" autocomplete="off">
                        <br>
                        <button class="user-about-cancel-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                        <input type="submit" value="&#8599;" class="user-about-send-btn" name="relationship-btn">
                    </form>
                    <h4 class="about-h4-4"><?php echo $user_relationship; ?></h4>
                </div>
            </div>
            <!-- div 7 -->
            <div class="div-about-7 hiddens">
                <div class="about-div">
                    <form action="" method="post" class="user-about-form5 hiddens">
                        <input type="text" name="user-Hometown" placeholder="Home Town..." class="user-about-input5" autocomplete="off">
                        <br>
                        <button class="user-about-cancel-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                        <input type="submit" value="&#8599;" class="user-about-send-btn" name="hometown-btn">
                    </form>
                    <h4 class="about-h4-5"><?php echo $user_home_town; ?></h4>
                </div>
            </div>
            <!-- div 8 -->
            <div class="div-about-8 hiddens">
                <div class="about-div">
                    <form action="" method="post" class="user-about-form6 hiddens">
                        <input type="text" name="user-describe" placeholder="Describe Yourself..." class="user-about-input6" autocomplete="off">
                        <br>
                        <button class="user-about-cancel-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                        <input type="submit" value="&#8599;" class="user-about-send-btn" name="describe-btn">
                    </form>
                    <h4 class="about-h4-6"><?php echo $user_details; ?></h4>
                </div>
            </div>
            <!-- div 9 -->
        </div>
    </div>

    <div class="too-small-1">
        <h1>Sorry, move to a bigger devices</h1>
    </div>
    <div class="too-big-1">
        <h1>Sorry, move to a small devices</h1>
    </div>
</body>
</html>

<!-- <php 

?> -->