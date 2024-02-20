<?php 
$id = $_GET['id'];

include 'config.php';
$sql = "DELETE FROM teacherclass WHERE id = {$id}";

$result = mysqli_query($conn, $sql) or die('Query Failed');

header("location: http://localhost/phpcore/teacherclass.php");


mysqli_close($conn);
?>