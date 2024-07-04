<?php
include("./php/connect.php");
session_start();

if (isset($_POST['login'])) {
    $user_email = $_POST['email'];
    $user_pass = $_POST['password'];

    $_SESSION['user_email'] = $user_email; // we have stored the email id here in session and we can use the session variable anywhere

    $user_login = " SELECT * FROM pzp_user_masters WHERE `user_email` = '$user_email' && `password` = '$user_pass' ";
    $run_user_query = mysqli_query($conn, $user_login);

    $total_rows_data_user = mysqli_num_rows($run_user_query);

    if ($total_rows_data_user == 1) {

        $indexpage = "./index.php";
        header('location: ' . $indexpage);
        exit();

    } else if ($total_rows_data_user > 1) {
        echo
        "
        <script>
            alert('Error. Multiple emails found.');
        </script>
        ";
    } else {
        echo
        "
        <script>
            alert('username or password not found');
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
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body class="flex justify-center items-center w-full h-screen">
    <section class="bg-blue-200 w-2/5 p-10 rounded-md shadow-lg">
        <form action="" method="POST" class="flex flex-col justify-center items-center gap-6">
            <h1 class="font-extrabold text-2xl">Login - PG GO</h1>
            <input type="email" name="email" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your email">
            <input type="password" name="password" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your password">
            <button type="submit" name="login" class="px-4 py-2 bg-blue-600 hover:bg-blue-800 rounded-sm text-white font-semibold shadow-md shadow-blue-500">Login</button>
        </form>

        <a href="./signup.php" class="underline text-indigo-500 font-medium w-full flex justify-center mt-6 text-sm">Create an account</a>

        <hr class="mt-6">

        <div class="flex justify-between mt-6 items-center">
            <a href="./pgowner/login.php" class="px-4 text-red-700 font-bold underline">Are you a PG Owner? Click here</a>
            <a href="./admin/login.php" class="py-2 px-3 font-bold bg-lime-100 text-yellow-900 border rounded-md border-lime-700 shadow-md shadow-green-700">Admin Login</a>
        </div>
    </section>
</body>

</html>