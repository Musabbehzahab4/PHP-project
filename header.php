<?php 
    session_start();
if (!isset( $_SESSION['email'])) {
    header("location: http://localhost/phpcore/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="wrapper">
        <div id="header">
        <h1>User</h1>
        </div>
        <div id="menu">
            <ul>
                <li>
                    <a href="index.php">User</a>
                </li>
                <li>
                    <a href="teacher.php">teacher</a>
                </li>
                <li>
                    <a href="student.php">Student</a>
                </li>
                <li>
                    <a href="class.php">Classes</a>
                </li>
                <li>
                    <a href="studclass.php">studentclass</a>
                </li>
                <li>
                    <a href="teacherclass.php">teacherclass</a>
                </li>
                <li>
                    <a href="attendance.php">attendance</a>
                </li>
                <li>
                    <a href="show.php">show</a>
                </li>
                <li style="float: inline-end;">
                    <a href="logout.php">LOGOUT</a>
                </li>
            </ul>
        </div>