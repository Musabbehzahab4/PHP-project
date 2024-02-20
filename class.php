<?php

include 'header.php';
?>

<div class="container-fluid" id='main-content'>

    <?php include 'config.php';

    $sql = 'SELECT * FROM class';

    $result = mysqli_query($conn, $sql) or die('Query Failed');

    if (mysqli_num_rows($result) > 0) {
        ?>
        <table>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['id'] ?>
                        </td>
                        <td>
                            <?php echo $row['name'] ?>
                        </td>
                        <td>
                            <a href="EDITCLASS.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="deleteclass.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    <?php } else {
        echo "<h2>no record founded</h2>";
    }
    mysqli_close($conn);

    ?>
    <a href="addclass.php"><button style="float: inline-end;">ADD CLASS</button></a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
// session_start();
//     echo $_SESSION['status'];
//     die;
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