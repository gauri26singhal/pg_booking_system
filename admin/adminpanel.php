<?php
include('../php/connect.php');
session_start();

if (!array_key_exists('admin_email', $_SESSION)) {
    echo "<script>alert('Initiate Admin Login.');</script>";
?>
    <meta http-equiv="refresh" content="0; url = http://localhost/book-pg-project/admin/login.php" />
<?php
} else {

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();

        $adminlogin = "./login.php";
        header('Location: ' . $adminlogin);
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body class="bg-blue-100 w-full h-screen flex flex-col text-gray-700">
    <header class="flex bg-blue-500 h-24 shadow-md px-20 items-center justify-between border-b border-blue-400">
        <h1 class="font-bold text-xl text-white py-1 border-b-2 border-white">Admin Panel</h1>
        <a href="./adminpanel.php" class="py-2 px-4 text-sm bg-blue-700 hover:bg-blue-700 text-white hover:text-white rounded-sm shadow-md border-b-4 border-gray-900 font-bold">PG Lists</a>
        <a href="./pg-requests.php" class="py-2 px-4 font-medium text-sm bg-blue-100 hover:bg-blue-700 text-black hover:text-white rounded-sm shadow-md">PG Requests</a>
        <form method="POST">
            <button type="submit" name="logout" class="py-2 px-4 font-medium text-sm bg-red-800 hover:bg-blue-100 text-white hover:text-red-900 rounded-sm shadow-md">Logout</button>
        </form>
    </header>

    <main class="px-20 h-fit py-12 flex flex-col gap-6">
        <h2 class="font-extrabold text-xl text-gray-700">List of the existing Paying Guest Homes</h2>

        <div class="overflow-hidden rounded-md w-full border border-blue-500">
            <table class="w-full rounded-lg">
                <tr class="bg-blue-300">
                    <th class="border border-blue-400 py-2 px-3 text-start w-1/5">Name</th>
                    <th class="border border-blue-400 py-2 px-3 text-start">Owner Email</th>
                    <th class="border border-blue-400 py-2 px-3">PG Phone</th>
                    <th class="border border-blue-400 py-2 px-3">Address Line 1</th>
                    <th class="border border-blue-400 py-2 px-3">Address Line 2</th>
                    <th class="border border-blue-400 py-2 px-3">Type</th>
                    <th class="border border-blue-400 py-2 px-3">Wifi</th>
                    <th class="border border-blue-400 py-2 px-3">Food</th>
                    <th class="border border-blue-400 py-2 px-3">PG Category</th>
                    <th class="border border-blue-400 py-2 px-3">Price</th>
                </tr>

                <?php

                while(array_key_exists('admin_email', $_SESSION) == 1) {
                    $approved_pgs = " SELECT * FROM `pzp_pg_master` ";
                    $run_approved_pgs = mysqli_query($conn, $approved_pgs);

                    while($result_pgs = mysqli_fetch_array($run_approved_pgs)) {
                        $pgname = $result_pgs['pg_name'];
                        $ownermail = $result_pgs['owner_email'];
                        $pgphone = $result_pgs['pg_phone'];
                        $address1 = $result_pgs['address1'];
                        $address2 = $result_pgs['address2'];
                        $pgtype = $result_pgs['pgtype'];
                        $wifi = $result_pgs['wifi'];
                        $food = $result_pgs['food'];
                        $pgctgry = $result_pgs['pg_category'];
                        $pgimg = $result_pgs['image'];
                        $price = $result_pgs['price'];
                    

                    ?>

                    <tr class="bg-blue-50 text-sm">
                        <td class="border border-blue-400 py-2 px-3 text-start w-1/5"><?php echo $pgname; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $ownermail; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $pgphone; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $address1; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $address2; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $pgtype; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $wifi; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $food; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $pgctgry; ?></td>
                        <td class="border border-blue-400 py-2 px-3 text-center"><?php echo $price; ?></td>
                    </tr>


                    <?php
                    }

                break;
                }
                ?>
                
            </table>
        </div>
    </main>
</body>

</html>