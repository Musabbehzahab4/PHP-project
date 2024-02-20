<?php

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $nameError = "Invalid name.";
        echo $nameError;
        exit;
    }

}

include 'config.php';

$sql = "UPDATE class SET name = '{$name}' WHERE id = '{$id}'";
$result = mysqli_query($conn, $sql) or die('Connection Failed');

header("location: http://localhost/phpcore/class.php");

mysqli_close($conn);

?>