<?php 
$id = $_GET['id'];

include 'config.php';
$sql = "DELETE FROM class WHERE id = {$id}";

$result = mysqli_query($conn, $sql) or die('Query Failed');

header("location: http://localhost/phpcore/class.php");


mysqli_close($conn);
?>