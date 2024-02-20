<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);
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

    if (empty($age)) {
        $ageError = "Please Enter your Age";
    }else{
    if (!preg_match("/^\d+$/", $age)) {
        $ageError = "Invalid age.";
        // echo $ageError;
        // header('location:add.php?message=Invalid age');
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
    
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
        $passError = 'Password should be at least 8 characters.';
    }
    // echo $pass;exit;

    if (isset($emailError) || isset($nameError) || isset($ageError)) {
        // echo "asdsa";exit;
    } else {
        if ($email != "") {
            include 'config.php';
            $email_check = "SELECT * FROM user WHERE email = '" . $email . "'";
            $result_email = mysqli_query($conn, $email_check) or die('Query Falied');
            $emails = mysqli_fetch_assoc($result_email);
            session_start();

            if ($emails) {

                $_SESSION['status'] = 'Email already taken';
                $_SESSION['status_code'] = 'error';
                header("location: http://localhost/phpcore/index.php");


            } else {

                $sql = "INSERT INTO user(name, age, email,password) VALUES('{$name}','{$age}','{$email}','{$pass}')";
                $result = mysqli_query($conn, $sql) or die('Query Falied');
                // echo "Thank you for Submitting. Redirecting back to Home Page";
                // header("location: http://localhost/phpcore/index.php");

                $_SESSION['status'] = 'data add successfull';
                // echo $_SESSION['status'];exit;
                $_SESSION['status_code'] = 'success';
                header("location: http://localhost/phpcore/index.php");

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
            <label>Age</label>
            <input type="text" name="age" value="<?php if (isset($age)) echo $age ?>" />
            <span class='error'>
                <?php if (isset($ageError)) echo $ageError ?></span>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php if (isset($email)) echo $email ?>" />
            <span class='error'><?php if (isset($emailError)) echo $emailError ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" />
            <span class='error'><?php if (isset($passError)) echo $passError ?></span>
        </div>
        <input class="submit" id="submit" name="submit" type="submit" value="Save" />
    </form>

</div>
</div>
</body>

</html>