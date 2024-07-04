<?php
include('../php/connect.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Owner - Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body class="flex justify-center items-center w-full h-screen">
    <section class="bg-blue-200 w-2/5 p-10 rounded-md shadow-lg">
        <form action="./insert-owner.php" method="POST" class="flex flex-col justify-center items-center gap-3">
            <h1 class="font-extrabold text-2xl mb-3">PG Owner - Signup</h1>
            <input type="text" name="name" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your full name" required>
            <input type="tel" name="phone" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your phone number (+91)" maxlength="10" required>
            <input type="email" name="email" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your email" required>
            <input type="password" name="password" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your password" required>
            <input type="text" name="address" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your address i.e, House No., Landmark" required>
            <input type="text" name="locality" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your locality i.e, Area" required>
            <input type="text" name="pgname" class="w-3/5 border border-blue-300 shadow-md focus:outline focus:outline-blue-600 px-3 py-2 text-sm rounded-sm" placeholder="Enter your PG name" required>

            <button type="submit" name="signup" class="px-4 py-2 my-4 bg-blue-600 hover:bg-blue-800 rounded-sm text-white font-semibold shadow-md">Sign up</button>
        </form>

        <a href="./login.php" class="underline text-indigo-500 font-medium w-full flex justify-center mt-6 text-sm">Already have an account?</a>
    </section>
</body>

</html>