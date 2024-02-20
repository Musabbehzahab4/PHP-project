<?php
include 'header.php';
?>
<div id='main-content'>
<h2>Update Record</h2>
<?php 
include 'config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE id = {$id}";
$result = mysqli_query($conn, $sql) or die('Query Failed');

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

?>
<form class="post-form" action="updatedata.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="hidden" name='id' value='<?php echo $row['id']; ?>'/>
            <input type="text" name="name"  value='<?php echo $row['name']; ?>' />
        </div>
        <div class="form-group">
            <label>Age</label>
            <input type="text" name="age"  value='<?php echo $row['age']; ?>' />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email"  value='<?php echo $row['email']; ?>' />
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