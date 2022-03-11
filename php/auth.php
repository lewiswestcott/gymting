<?php

    //Connect to the database.
    require("_connect.php");

    //Ensure that the user has provided all required fields.
    if (!isset($_POST['txtEmail'], $_POST['txtPassword']))
    {
        die("Missing values!");
    }

    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    session_start();
    
    if (isset($_SESSION['attempts']))
    {
        $attempts = $_SESSION['attempts'];
    }
    else
    {
        $attempts = 0;
    }

    if ($attempts >=3)
    {
        die("Too many attempts!");
    }

    //Validating the email address.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        die("Invalid Email Address");
    }

    //Gets the user from the database.
    $SQL = "SELECT * FROM `tblUsers` WHERE `email` = '$email'";



    //Makes the query.
    $query = mysqli_query($connect, $SQL);

    //Checks if the query was successful.
    if (mysqli_num_rows($query) === 0)
    {
        die("Invalid Email or Password");
    }

    //Fetch the user's data.
    $USER = mysqli_fetch_assoc($query);

    //Check if the password is correct.
    if (password_verify($password, $USER['Password']))
    {

        $_SESSION['userID'] = $USER['userID'];
        $_SESSION['firstName'] = $USER['firstName'];
        $_SESSION['lastName'] = $USER['lastName'];

        header("Location:../index.php");
    }
    else
    {
        die("Invalid Email or Password");
    }

?>