<?php

include 'header.php';   
?>

<div class="container-fluid" id='main-content'>

    <?php include 'config.php';

    $sql = 'SELECT studentclass.id, studentclass.student_name, studentclass.class_name, student.name as studentname, class.name FROM studentclass LEFT JOIN student ON studentclass.student_name = student.id LEFT JOIN class ON studentclass.class_name = class.id';
    // print_r($sql);exit;
    
    $result = mysqli_query($conn, $sql) or die('Query Failed');

    if (mysqli_num_rows($result) > 0) {
        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input class="submit" id="submit" name="classdata" type="submit" value="submit" style="float: inline-end; margin-left: 10px;"/>
        <div class="form-group" style=" float: inline-end; margin-bottom: 10px;">
            <label>Classes</label>
            <select name="class" id="">
                <option value="">Select Class</option>
            <?php
                include "config.php";
                $sql = "SELECT * FROM class";
                $result = mysqli_query($conn, $sql) or die("Query failed");
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row['id']; ?>"<?php if(isset($_POST['class']) && $_POST['class'] == $row['id']){ ?> selected <?php } ?>><?php echo $row['name']; ?></option>
                <?php
                }
                ?>
            </select>
            </div>
            </form>
    
        <table>
            <thead>
                <th>id</th>
                <th>Student Name</th>
                <th>Class Name</th>
                <th>Action</th>
            </thead>
            <?php 
            if (isset($_POST['classdata'])) {
                if(isset($_POST['class'])){

                
                $class = $_POST['class'];
                
                include "config.php";
                
                $sql = "SELECT class.name as classname,student.name as studentname,student.id, student.name, studentclass.class_name FROM student LEFT JOIN studentclass ON student.id = studentclass.student_name LEFT JOIN class on studentclass.class_name = class.id where studentclass.class_name= ".$class;
                $result = mysqli_query($conn, $sql) or die('Query Failed');
                // $row = mysqli_fetch_assoc($result);
                // echo "asdsa";
                // echo "<pre>";print_r($row);exit;
                }
            
            ?>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                     ?>
                    <tr>
                        <td>
                            <?php echo $row['id'] ?>
                        </td>
                        <td>
                            <?php echo $row['studentname'] ?>
                        </td>
                        <td>
                            <?php echo $row['classname'] ?>
                        </td>
                        <td>
                            <a href="studclassedit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="deletestudclass.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <?php } ?>
        </table>

    <?php } else {
        echo "<h2>no record founded</h2>";
    }
    mysqli_close($conn);

    ?>
     <!-- <a href="attend.php"><button >ATTENDANCE</button></a> -->
    <a href="addstudclass.php"><button style="float: inline-end;">ADD</button></a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
// session_start();
// echo $_SESSION['status'];
// die;
if (isset($_SESSION['status'])) {
    ?>
    <script>
        Swal.fire({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
            button: 'okay!'
        });
    </script>
    <?php
    unset($_SESSION['status']);
} ?>
</body>

</html>