<?php 
$id = $_GET['id'];

include 'config.php';
$sql = "DELETE FROM student WHERE id = {$id}";

$result = mysqli_query($conn, $sql) or die('Query Failed');

header("location: http://localhost/phpcore/student.php");


mysqli_close($conn);
?>