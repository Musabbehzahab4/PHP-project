<?php
include "header.php";

?>

<div class="container-fluid" id='main-content'>
    <?php
    include "config.php";

    $sql = 'SELECT class.name as classname,attendance.id, attendance.student_id,attendance.class_id,attendance.attendence,student.name AS studentname  FROM attendance LEFT JOIN student ON student.id = attendance.student_id LEFT JOIN class ON class.id = attendance.class_id';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input class="submit" id="submit" name="classdata" type="submit" value="submit"
                style="float: inline-end; margin-left: 10px;" />
            <div class="form-group" style="float:inline-end; margin-left: 10px;">
                <input type="date" name="date" value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date'], ENT_QUOTES) : ''; ?>">
            </div>
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
        <table>
            <thead>
                <th>id</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Action</th>
            </thead>
            <?php
            if (isset($_POST['classdata'])) {
                if (isset($_POST['class'])) {

                    $date = $_POST['date'];
                    $class = $_POST['class'];

                    include "config.php";

                    $sql = 'SELECT class.name as classname, attendance.id, attendance.student_id, attendance.class_id, attendance.attendence, attendance.date, student.name AS studentname FROM attendance LEFT JOIN student ON student.id = attendance.student_id LEFT JOIN class ON class.id = attendance.class_id  WHERE attendance.class_id = ' . $class . ' AND attendance.date = \'' . $date . '\'';
                    // print_r($date);exit;
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
                                <?php echo $row['attendence'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php }
    } else {
        echo "<h2>no record founded</h2>";
    }
    mysqli_close($conn);

    ?>



</div>
</body>

</html>