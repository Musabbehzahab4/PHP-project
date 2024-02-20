<?php 
$id = $_GET['id'];

include 'config.php';
$sql = "DELETE FROM user WHERE id = {$id}";

$result = mysqli_query($conn, $sql) or die('Query Failed');

header("location: http://localhost/phpcore/index.php");


mysqli_close($conn);
?>