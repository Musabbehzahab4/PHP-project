<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

    if (empty($name)) {
        $nameError = "Please Enter your Name";
    }else{
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $nameError = "Invalid name.";
        // echo $nameError;
        // header('location:add.php?message=Enter you name');
        // exit;
    }}

    if (empty($email)) {
        $emailError = "Please Enter your Email";
    }else{
    if (!preg_match($pattern, $email)) {
        $emailError = "Email is not valid.";
        // echo $emailError;
        // header('location:add.php?message=Email is not valid');
        // exit;
    }}

    if (isset($emailError) || isset($nameError)) {
        // echo "asdsa";exit;
    } else {
        if ($email != "") {
            include 'config.php';
            $email_check = "SELECT * FROM teacher WHERE email = '" . $email . "'";
            $result_email = mysqli_query($conn, $email_check) or die('Query Falied');
            $emails = mysqli_fetch_assoc($result_email);
            session_start();

            if ($emails) {

                $_SESSION['status'] = 'Email already taken';
                $_SESSION['status_code'] = 'error';
                header("location: http://localhost/phpcore/teacher.php");


            } else {

                $sql = "INSERT INTO teacher(name, email) VALUES('{$name}','{$email}')";
                $result = mysqli_query($conn, $sql) or die('Query Falied');
                // echo "Thank you for Submitting. Redirecting back to Home Page";
                // header("location: http://localhost/phpcore/index.php");

                $_SESSION['status'] = 'data add successfull';
                // echo $_SESSION['status'];exit;
                $_SESSION['status_code'] = 'success';
                header("location: http://localhost/phpcore/teacher.php");

            }
            mysqli_close($conn);
        }
    }
}
?>

<!------------------------------------FORM --------------------------------------------->

<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?php if (isset($name)) echo $name ?>" />
            <span class='error'><?php if (isset($nameError)) echo $nameError ?></span>
        </div>
       
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php if (isset($email)) echo $email ?>" />
            <span class='error'><?php if (isset($emailError)) echo $emailError ?></span>
        </div>
        <input class="submit" id="submit" name="submit" type="submit" value="Save" />
    </form>

</div>
</div>
</body>

</html>