<?php 
$id = $_GET['id'];

include 'config.php';
$sql = "DELETE FROM studentclass WHERE id = {$id}";

$result = mysqli_query($conn, $sql) or die('Query Failed');

header("location: http://localhost/phpcore/studclass.php");


mysqli_close($conn);
?>