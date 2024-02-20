<?php 
    session_start();
if (isset( $_SESSION['email'])) {
    header("location: http://localhost/phpcore/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <title>Document</title>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1>login</h1>
        </div>
    </div>
    <div id="main-content">
        <!-- <h2>Add New Record</h2> -->
        <form class="post-form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" />
            </div>
            <input class="submit" id="submit" name="login" type="submit" value="login" /> 
        </form>

        <?php
        if (isset($_POST['login'])) {
            include "config.php";
            $email = $_POST['email'];
            $pass = md5($_POST['password']);

            $sql = "SELECT id, email FROM user WHERE email = '{$email}' AND password = '{$pass}' ";
            $result = mysqli_query($conn, $sql) or die('Query Failed');

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    session_start();
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];

                    header("location: http://localhost/phpcore/index.php");

                }
            } else {
                echo "<div style='margin-top: -45px; color:red; margin-left: 45rem;'>Email and password do not match</div>";
                // header("location: http://localhost/phpcore/add.php");
                
            }
        }
        ?>
    </div>
    </div>
</body>

</html>