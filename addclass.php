<?php
if (isset($_POST['submit'])) {
    $name = $_POST['class'];

    if (empty($name)) {
        $nameError = "Please Enter your Name";
    } else {
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $nameError = "Invalid name.";
            // echo $nameError;
            // header('location:add.php?message=Enter you name');
            // exit;
        }
    }


    if (isset($nameError)) {
        // echo "asdsa";exit;
    } else {
        include "config.php";
        session_start();

        $sql = "INSERT INTO class(name) VALUES('{$name}')";
        $result = mysqli_query($conn, $sql) or die('Query Falied');
        // echo "Thank you for Submitting. Redirecting back to Home Page";
        // header("location: http://localhost/phpcore/index.php");

        $_SESSION['status'] = 'data add successfull';
        // echo $_SESSION['status'];exit;
        $_SESSION['status_code'] = 'success';
        header("location: http://localhost/phpcore/class.php");

    }
    mysqli_close($conn);
}
?>

<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>Class Name</label>
            <input type="text" name="class" value="<?php if (isset($name))
                echo $name ?>" />
                <span class='error'>
                <?php if (isset($nameError))
                echo $nameError ?>
                </span>
            </div>
            <input class="submit" id="submit" name="submit" type="submit" value="Save" />
        </form>

    </div>
    </div>
    </body>

    </html>