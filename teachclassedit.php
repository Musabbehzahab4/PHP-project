<?php
include 'header.php';
?>
<div id='main-content'>
<h2>Update Record</h2>
<?php 
include 'config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM teacherclass WHERE id = {$id}";
$result = mysqli_query($conn, $sql) or die('Query Failed');

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

?>
<form class="post-form" action="updateteachclass.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="hidden" name='id' value='<?php echo $row['id']; ?>'/>
            <input type="text" name="name"  value='<?php echo $row['teacher_name']; ?>' />
        </div>
        <div class="form-group">
            <label>class name</label>
            <input type="text" name="class"  value='<?php echo $row['class_name']; ?>' />
        </div>
       
        <input class="submit" id="submit" type="submit" name="update" value="Update"/>
    </form>

<?php
    }
}
?>
</div>
</body>
</html>