<?php 
declare(strict_types=1);
session_start();

if(isset($_POST["story_background_1"])) {
    $_SESSION["story_color"] = $_POST["story_background_1"];
    echo $_SESSION["story_color"];
  } elseif(isset($_POST["story_background_2"])) {
    $_SESSION["story_color"] = $_POST["story_background_2"];
    echo $_SESSION["story_color"];
  } elseif(isset($_POST["story_background_3"])) { 
    $_SESSION["story_color"] = $_POST["story_background_3"];
    echo $_SESSION["story_color"];
  } elseif(isset($_POST["story_background_4"])) { 
    $_SESSION["story_color"] = $_POST["story_background_4"];
    echo $_SESSION["story_color"];
  } elseif(isset($_POST["story_background_5"])) { 
    $_SESSION["story_color"] = $_POST["story_background_5"];
    echo $_SESSION["story_color"];
  } elseif(isset($_POST["story_background_6"])) { 
    $_SESSION["story_color"] = $_POST["story_background_6"];
    echo $_SESSION["story_color"];
  }