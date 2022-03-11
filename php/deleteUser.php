<?php

require("_connect.php");

$sql = "DELETE FROM `tblWorkouts` WHERE `entryID` = ?;";

$stmt = mysqli_prepare($connect, $sql);

mysqli_stmt_bind_param($stmt, 's', $_POST['userID']);

//Executes the prepared query.
if (mysqli_stmt_execute($stmt))
{
    echo true;
    return;
}
else
{
    echo "Error: " . mysqli_error($connect);
}

//Closes the prepared statement.
mysqli_stmt_close($stmt);

?>