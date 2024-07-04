<?php
include('./php/connect.php');

$user_name = $_POST['username'];
$user_full_name = $_POST['fullname'];
$user_phone = $_POST['phone'];
$user_email = $_POST['email'];
$user_password = $_POST['password'];
$user_age = $_POST['age'];


if (!$conn) {
    echo "connection error" . mysqli_connect_error();
} else {
    $user_check = " SELECT * FROM pzp_user_masters WHERE user_email = '$user_email' ";
    $run_user_check = mysqli_query($conn, $user_check);
    $total_rows_user_check = mysqli_num_rows($run_user_check);

    if ($total_rows_user_check > 0) {
        echo
        "
        <script> alert('Email already exists!'); </script>
        ";

        $login_page = "./login.php";
        header('Location: ' . $login_page);
        exit();
    } else {
        $user_insert = " INSERT INTO pzp_user_masters (`user_name`,`user_full_name`,`user_phone`,`user_email`,`password`,`user_age`) VALUES ('$user_name', '$user_full_name', '$user_phone', '$user_email', '$user_password', '$user_age') ";

        $run_user_insert = mysqli_query($conn, $user_insert);

        // check if the user is inserted or not
        $run_user_check_2 = mysqli_query($conn, $user_check);
        $available_rows = mysqli_num_rows($run_user_check_2);

        if ($available_rows == 1) {
            echo "<script> alert('Account Created Successfully.') </script>";

            // $_SESSION['user_email'] = $user_email;

?>

            <meta http-equiv="refresh" content="0; url = http://localhost/book-pg-project/index.php" />

<?php
        }
    }
}

?>