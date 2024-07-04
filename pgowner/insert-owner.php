<?php
include('../php/connect.php');

$owner_name = $_POST['name'];
$owner_phone = $_POST['phone'];
$owner_email = $_POST['email'];
$owner_password = $_POST['password'];
$owner_address = $_POST['address'];
$owner_locality = $_POST['locality'];
$owner_pgname = $_POST['pgname'];

if(!$conn) {
    echo 'connection error!'.mysqli_connect_error();
} else {
    $owner_check = " SELECT * FROM pzp_owner_masters WHERE `owner_email` = '$owner_email' ";
    $run_owner_check = mysqli_query($conn, $owner_check);
    $total_rows_owner_check = mysqli_num_rows($run_owner_check);

    if($total_rows_owner_check > 0) {
        echo
        "
        <script> alert('Owner already exists!'); </script>
        ";

        $login_page = "./login.php";
        header('Location: ' . $login_page);
        exit();
    } else {
        $owner_insert = " INSERT INTO pzp_owner_masters (`full_name`,`owner_phone`,`owner_email`,`password`,`address`,`locality`,`pg_name`) VALUES ('$owner_name', '$owner_phone', '$owner_email', '$owner_password', '$owner_address', '$owner_locality', '$owner_pgname') ";

        $run_owner_insert = mysqli_query($conn, $owner_insert);

        $run_owner_check_2 = mysqli_query($conn, $owner_check);
        $available_rows = mysqli_num_rows($run_owner_check_2);

        if($available_rows == 1) {
            echo "<script> alert('Owner Account Created Successfully.') </script>";
            ?>
            <meta http-equiv="refresh" content="0; url = http://localhost/prerna/pgowner/registerpg.php" />
            <?php
        }
    }
}

?>