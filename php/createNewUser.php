<?php

session_start();

require("_connect.php");

$password = $_POST['txtPassword'];
$password = password_hash($password, PASSWORD_DEFAULT);

//The SQL statement
$SQL = "INSERT INTO `tblUsers` (`userID`, `email`, `firstName`, `lastName`, `Password`) VALUES (NULL, ?, ?, ?, ?)";

//Prepares the SQL statement for execution.
$stmt = mysqli_prepare($connect, $SQL);

mysqli_stmt_bind_param($stmt, 'ssss', $_POST['txtEmail'], $_POST['txtFirst'], $_POST['txtLast'], $password);


//Executes the prepared query.
if (mysqli_stmt_execute($stmt))
{
    header("Location:../index.php");
}
else
{
    echo "Error: " . mysqli_error($connect);
}

//Closes the prepared statement.
mysqli_stmt_close($stmt);