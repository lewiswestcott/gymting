<?php

    $host = "plesk.remote.ac";
    $database = "WS233812_WS233812_gymlw";
    $username = "WS233812_Admin";
    $password = "Museum@29";

    $connect = mysqli_connect($host, $username, $password, $database);

    if (!$connect)
    {
        echo "Unable to connect to the database.";
    }

?>