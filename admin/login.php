<?php
include("../php/connect.php");
session_start();

if(isset($_POST['login'])) {
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];

    $_SESSION['admin_email'] = $admin_email;

    $admin_login = " SELECT * FROM pzp_admin_masters WHERE `email_id` = '$admin_email' && `password` = '$admin_password' ";
    $run_admin_query = mysqli_query($conn, $admin_login);

    $total_rows_data_admin = mysqli_num_rows($run_admin_query);

    if ($total_rows_data_admin == 1) {

        $adminpanel = "./adminpanel.php";
        header('location: ' . $adminpanel);
        exit();

    } else if ($total_rows_data_admin > 1) {
        echo
        "
        <script>
            alert('Error. Multiple admin emails found.');
        </script>
        ";
    } else {
        echo
        "
        <script>
            alert('admin email or password not found');
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body class="flex justify-center items-center w-full h-screen">
    <section class="bg-blue-200 w-2/5 p-10 rounded-md shadow-lg">
        <form action="" method="post" class="flex flex-col justify-center items-center gap-6 mb-6">
            <h1 class="font-extrabold text-2xl">Login - Admin</h1>
            <input type="email" name="email" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your email">
            <input type="password" name="password" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your password">

            <button type="submit" name="login" class="px-4 py-2 bg-blue-600 hover:bg-blue-800 rounded-sm text-white font-semibold shadow-md">Login</button>

        </form>

        <hr>

        <a href="../login.php" class="underline text-yellow-800 font-bold w-full flex justify-center my-6 text-lg">Go to customer login</a>
        <a href="../pgowner/login.php" class="underline text-gray-500 font-bold w-full flex justify-center text-sm">Are you a PG Owner?</a>
    </section>
</body>

</html>