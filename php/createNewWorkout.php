<?php

session_start();

function GenerateID() {
    $IDData = $IDData ?? random_bytes(16);
    assert(strlen($IDData) == 16);
    $IDData[6] = chr(ord($IDData[6]) & 0x0f | 0x40);
    $IDData[8] = chr(ord($IDData[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($IDData), 4));
}

require("_connect.php");

$uid = $_SESSION['userID'];

//The SQL statement
$SQL = "INSERT INTO `tblWorkouts`(`entryID`, `UID`, `Date`, `Duration`, `Distance`, `CalsBurnt`) VALUES (?,?,?,?,?,?)";

//Prepares the SQL statement for execution.
$stmt = mysqli_prepare($connect, $SQL);

mysqli_stmt_bind_param($stmt, 'ssssss',GenerateID(), $uid, $_POST['date'], $_POST['duration'], $_POST['distance'], $_POST['calsburnt']);


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