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
            <input class="submit" id="submit" name="classdata" type="submit" value="submit"
                style="float: inline-end; margin-left: 10px;" />
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
                        <option value="<?php echo $row['id']; ?>" <?php if (isset($_POST['class']) && $_POST['class'] == $row['id']) { ?> selected <?php } ?>>
                            <?php echo $row['name']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </form>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <table>
                <thead>
                    <th>id</th>
                    <th>Student Name</th>
                    <th>Class Name</th>
                    <th>Action</th>
                </thead>
                <?php
                if (isset($_POST['classdata'])) {
                    if (isset($_POST['class'])) {


                        $class = $_POST['class'];

                        include "config.php";

                        $sql = "SELECT class.name as classname,student.name as studentname,student.id, student.name, studentclass.class_name FROM student LEFT JOIN studentclass ON student.id = studentclass.student_name LEFT JOIN class on studentclass.class_name = class.id where studentclass.class_name= " . $class;
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
                                    <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                                    <?php echo $row['studentname']; ?>
                                </td>
                                <td>
                                    <input type="hidden" name="class_id" value="<?php echo $class; ?>">
                                    <?php echo $row['classname']; ?>
                                </td>
                                <td>
                                    <label><input type="radio" name="attendance" value="P">Present</label><br>
                                    <label><input type="radio" name="attendance" value="A">Absent</label>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
            <input class="submit" id="submit" name="save" type="submit" value="SUBMIT" style="float:inline-end;" />
        </form>
        <?php
        if (isset($_POST['save'])) {
            $student_id = $_POST['student_id'];
            $class_id = $_POST['class_id'];
            $attend = $_POST['attendance'];
            // $date = $_POST['Y-m-d'];
            $date = date('Y-m-d', time());
            $sql = "INSERT INTO attendance(student_id, class_id, attendence,date) VALUES('{$student_id}','{$class_id}','{$attend}','{$date}')";
            $result = mysqli_query($conn, $sql) or die('Query failed');
            // print_r($result);exit;
    


        }

        ?>
    <?php } else {
        echo "<h2>no record founded</h2>";
    }
    mysqli_close($conn);

    ?>
</div>
</body>

</html>