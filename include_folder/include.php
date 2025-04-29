<?php

try {
    $con = mysqli_connect('localhost', 'root', '', 'secret_book');
    if(!$con) {
        throw new Exception("Can not connect to database");
    }
} catch (Exception $err) {
    echo "Bad Connection: "  .$err->getMessage();
    die(mysqli_error($con));
}
