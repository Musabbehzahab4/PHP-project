<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $class = $_POST['class'];


    if (empty($name)) {
        $nameError = "Please Select your Name";
    }
    if (empty($class)) {
        $classError = "Please Select your Class";
    }


    if (isset($classError) || isset($nameError)) {
        // echo "asdsa";exit;
    } else {
        include "config.php";
        session_start();

        $sql = "INSERT INTO studentclass(student_name, class_name) VALUES('{$name}','{$class}')";
        $result = mysqli_query($conn, $sql) or die('Query Falied');
        // echo "Thank you for Submitting. Redirecting back to Home Page";
        // header("location: http://localhost/phpcore/index.php");

        $_SESSION['status'] = 'data add successfull';
        // echo $_SESSION['status'];exit;
        $_SESSION['status_code'] = 'success';
        header("location: http://localhost/phpcore/studclass.php");

    }
    // mysqli_close($conn);
}
?>


<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>student Name</label>
            <select name="name" id="">
                <option value="">Select Student</option>
                <?php
                include "config.php";
                $sql = 'SELECT * FROM student';
                $result = mysqli_query($conn, $sql) or die("Query failed");
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?></option>
                <?php
                }
                ?>
            </select>
            <span class='error'><?php if (isset($nameError)) echo $nameError ?></span>
            </div>

            <div class="form-group">
                <label>Class Name</label>
                <select name="class" id="">
                    <option value="">Select Class</option>
                <?php
                include "config.php";
                $sql = 'SELECT * FROM class';
                $result = mysqli_query($conn, $sql) or die("Query failed");
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php
                }
                ?>
            </select>
            <span class='error'><?php if (isset($classError)) echo $classError ?></span>
            </div>
            <input class="submit" id="submit" name="submit" type="submit" value="Save" />
        </form>

    </div>
    </div>
    </body>