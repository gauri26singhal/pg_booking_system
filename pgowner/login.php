<?php
include("../php/connect.php");
session_start();

if(isset($_POST['login'])) {
    $owner_email = $_POST['email'];
    $owner_password = $_POST['password'];

    $_SESSION['owner_email'] = $owner_email;

    $owner_login = " SELECT * FROM pzp_owner_masters WHERE `owner_email` = '$owner_email' && `password` = '$owner_password' ";
    $run_owner_query = mysqli_query($conn, $owner_login);

    $total_rows_data_owner = mysqli_num_rows($run_owner_query);

    if ($total_rows_data_owner == 1) {

        $mainpage = "./registerpg.php";
        header('location: ' . $mainpage);
        exit();

    } else if ($total_rows_data_owner > 1) {
        echo
        "
        <script>
            alert('Error. Multiple owner emails found.');
        </script>
        ";
    } else {
        echo
        "
        <script>
            alert('owner email or password not found');
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
    <title>PG Owner - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body class="flex justify-center items-center w-full h-screen">
    <section class="bg-blue-200 w-2/5 p-10 rounded-md shadow-lg">
        <form action="" method="post" class="flex flex-col justify-center items-center gap-6">
            <h1 class="font-extrabold text-2xl">Login - Owners</h1>
            <input type="email" name="email" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your email">
            <input type="password" name="password" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your password">

            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-800 rounded-sm text-white font-semibold shadow-md" name="login" type="submit">Login</button>

        </form>

        <div class="flex justify-center my-6 w-full">
            <a href="./signup.php" class="underline text-indigo-500 font-medium w-fit text-sm">Create an account</a>
        </div>

        <hr>
        
        <div class="flex justify-center my-6 w-full">
            <a href="../login.php" class="underline text-yellow-800 font-bold w-fit text-md">Go to customer login</a>
        </div>
        <div class="flex justify-center my-6 w-full">
            <a href="../admin/login.php" class="underline text-gray-500 font-bold w-fit text-lg">Admin?</a>
        </div>

    </section>
</body>

</html>