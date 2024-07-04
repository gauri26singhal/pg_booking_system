<?php
include('./php/connect.php');
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarder Details - PG Booking System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body class="w-full text-gray-700 bg-blue-50">
    <header class="px-20 flex w-full bg-blue-500 py-6 text-white shadow-md shadow-blue-200 rounded-sm justify-between items-center">
        <h1 class="font-extrabold text-4xl"><a href="./index.php">PG GO</a></h1>
        <h3 class="font-bold text-xl">Welcome to PG GO</h3>
        <form action="" method="POST">
            <button type="submit" class="logout rounded-md border hover:border-white hover:bg-white hover:shadow-none text-white hover:text-blue-900 font-medium text-md px-4 py-2 bg-blue-700 border-blue-700 shadow-lg shadow-blue-600">User - Logout</button>
        </form>
    </header>


    <main class="px-20 pt-6 pb-12 w-full flex flex-col items-center">
        <h2 class="font-bold text-2xl mt-4">Your Booking Details - Selected PG :</h2>

        <?php

        if (array_key_exists('user_email', $_SESSION) == 0) {
            echo "<script>alert('Please log in.')</script>";
        } else if (array_key_exists('user_email', $_SESSION) == 1) {

            while (array_key_exists('pgid', $_SESSION)) {
                $pg_id = $_SESSION['pgid'];

                $loadpg = " SELECT * FROM `pzp_pg_master` WHERE `id` = $pg_id ";
                $run_loadpg = mysqli_query($conn, $loadpg);

                while ($pg_result = mysqli_fetch_array($run_loadpg)) {
                    $pgname = $pg_result['pg_name'];
                    $pgtype = $pg_result['pgtype'];
                    $wifi = $pg_result['wifi'];
                    $food = $pg_result['food'];
                    $address1 = $pg_result['address1'];
                    $address2 = $pg_result['address2'];
                    $price = $pg_result['price'];

                    $pgownermail = $pg_result['owner_email'];
                    $_SESSION['pgownermail'] = $pgownermail;
                    $pgphone = $pg_result['pg_phone'];
                    
                    // set the price in session variable, it maybe necessary in showing the price
                    $_SESSION['pgprice'] = $price;

        ?>

                    <div class="flex flex-col w-full items-center">
                        <!-- Booking details -->
                        <div class="booking flex flex-col border border-blue-200 rounded-md p-6 my-4 h-56 justify-between w-2/5 bg-white">
                            <h3 class="font-extrabold text-2xl"><?php echo $pgname; ?></h3>
                            <ol class="text-sm font-medium">
                                <li><?php echo $pgtype; ?></li>
                                <li><?php echo $wifi; ?></li>
                                <li><?php echo $food; ?></li>
                            </ol>
                            <span class="font-bold text-md"><?php echo $address1 . ", " . $address2; ?></span>
                        </div>
                    </div>


        <?php

                    break;
                }

                // echo "<script>console.log('$pg_id')</script>";

                break;
            }
        }

        ?>



        <section class="flex flex-col rounded-md my-4 h-fit justify-between w-2/5 bg-white items-center">

            <form method="POST" action="./send-mail.php" class="py-4 px-6 w-full flex flex-col gap-4 items-center bg-white rounded-md border border-gray-200 shadow-lg">
                <div class="tenacy-details w-full flex flex-col gap-4">
                    <h1 class="font-bold text-2xl mb-2">Enter your tenacy details</h1>
                    <div class="flex gap-4 flex items-center w-full">
                        <label for="fullname" class="text-md font-medium w-[30%]">Full Name *</label>
                        <input type="text" name="fullname" class="w-[70%] px-3 py-2 border border-gray-300 rounded focus:outline-2 focus:outline-blue-400" placeholder="Enter your full name" required>
                    </div>
                    <div class="flex gap-4 flex items-center w-full">
                        <label for="phone" class="text-md font-medium w-[30%]">Phone No. *</label>
                        <input type="tel" name="phone" class="w-[70%] px-3 py-2 border border-gray-300 rounded focus:outline-2 focus:outline-blue-400" placeholder="Enter your phone number" maxlength="10" required>
                    </div>
                    <div class="flex gap-4 flex items-center w-full">
                        <label for="email" class="text-md font-medium w-[30%]">Email *</label>
                        <input type="email" name="email" class="w-[70%] px-3 py-2 border border-gray-300 rounded focus:outline-2 focus:outline-blue-400" placeholder="Enter your email id" required>
                    </div>
                    <div class="flex gap-4 flex items-center w-full">
                        <label for="address" class="text-md font-medium w-[30%]">Address *</label>
                        <input type="text" name="address" class="w-[70%] px-3 py-2 border border-gray-300 rounded focus:outline-2 focus:outline-blue-400" placeholder="Enter your permanent address" required>
                    </div>
                    <div class="flex gap-4 flex items-center w-full">
                        <label for="age" class="text-md font-medium w-[30%]">Age *</label>
                        <input type="text" name="age" class="w-[70%] px-3 py-2 border border-gray-300 rounded focus:outline-2 focus:outline-blue-400" placeholder="Enter your age" required>
                    </div>

                    <input type="hidden" name="pgownermail" value="<?php echo $pgownermail; ?>">
                    <input type="hidden" name="pgname" value="<?php echo $pgname; ?>">
                    <input type="hidden" name="pgtype" value="<?php echo $pgtype; ?>">
                    <input type="hidden" name="wifi" value="<?php echo $wifi; ?>">
                    <input type="hidden" name="food" value="<?php echo $food; ?>">
                    <input type="hidden" name="pgphone" value="<?php echo $pgphone; ?>">
                    <input type="hidden" name="address1" value="<?php echo $address1; ?>">
                    <input type="hidden" name="address2" value="<?php echo $address2; ?>">
                </div>

                <div class="w-full h-[1px] bg-gray-300 my-6"></div>

                <div class="payment-details w-full flex flex-col gap-4">
                    <h1 class="font-extrabold text-3xl mt-0 mb-4">Payment Info :</h1>
                    <!-- <span class="font-bold text-lg my-2 text-gray-500 mb-4">Payment Details</span> -->
                    <div class="flex gap-4 flex items-center w-full">
                        <label for="card" class="text-md font-medium w-[30%]">Card Number *</label>
                        <input type="text" name="card" class="w-[70%] px-3 py-2 border border-gray-300 rounded focus:outline-2 focus:outline-blue-400" placeholder="Enter your 16 digit card number" required>
                    </div>
                    <div class="flex gap-4 flex items-center w-full">
                        <label for="expdate" class="text-md font-medium w-[30%]">Expiration Date *</label>
                        <input type="month" name="expdate" class="w-[70%] px-3 py-2 border border-gray-300 rounded focus:outline-2 focus:outline-blue-400" placeholder="" required>
                    </div>
                    <div class="flex gap-4 flex items-center w-full">
                        <label for="cvv" class="text-md font-medium w-1/2">Security Code (CVV) *</label>
                        <input type="number" name="cvv" class="w-1/2 px-3 py-2 border border-gray-300 rounded focus:outline-2 focus:outline-blue-400" placeholder="3 digits CVV no." required>
                    </div>
                    <div class="flex gap-4 flex items-center w-full">
                        <h6 class="text-md font-medium w-2/5">Payment Amount :</h6>
                        <span class="w-3/5 px-3 py-2 font-bold text-xl"><?php echo $price . " Rs"; ?></span>
                        <input type="hidden" name="amount" value="<?php echo $price; ?>">
                    </div>
                </div>

                <button name="paynow" class="py-3 my-4 px-6 w-full text-center bg-blue-600 text-white rounded-lg hover:bg-blue-900 font-bold text-2xl" type="submit">Pay Now</button>

            </form>

        </section>

    </main>
</body>

</html>