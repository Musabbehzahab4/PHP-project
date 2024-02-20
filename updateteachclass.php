<?php

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $class = $_POST['class'];
   
}

include 'config.php';

$sql = "UPDATE teacherclass SET teacher_name = '{$name}', class_name = '{$class}' WHERE id = '{$id}'";
$result = mysqli_query($conn, $sql) or die('Connection Failed');

header("location: http://localhost/phpcore/studclass.php");

mysqli_close($conn);

?>