<?php

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $nameError = "Invalid name.";
        echo $nameError;
        exit;
    }

    if (!preg_match($pattern, $email)) {
        $ErrMsg = "Email is not valid.";
        echo $ErrMsg;
        exit;
    }

}

include 'config.php';

$sql = "UPDATE student SET name = '{$name}',  email = '{$email}' WHERE id = '{$id}'";
$result = mysqli_query($conn, $sql) or die('Connection Failed');

header("location: http://localhost/phpcore/index.php");

mysqli_close($conn);

?>