<?php
include('./php/connect.php');

session_start();

while(array_key_exists('user_email', $_SESSION) == 1) {
    $session_mail = $_SESSION['user_email'];

    if (!$session_mail) {
        echo "<script>console.log('Not logged in.')</script>";
    } else if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
    
        $index_page = "./index.php";
        header('location: ' . $index_page);
        die();
    
        // echo "<script>console.log('session closed');</script>";
    
    } else {
        echo "<script>console.log('user email is : $session_mail')</script>";

    }

    function redirect_payment_page() {
        
        // $paymentpage = "./payment.php";
        // header('Location: ' . $paymentpage);
        // die();

        ?>

        <meta http-equiv="refresh" content="0; url = http://localhost/book-pg-project/payment.php" />

        <?php
        
    }

    break;

} 

while(!array_key_exists('user_email', $_SESSION)){
    if(isset($_POST['rh-pg-book'])) {
        echo "<script>alert('Please Log In First.');</script>";
    } else if(isset($_POST['kalita-pg-book'])) {
        echo "<script>alert('Please Log In First.');</script>";
    }
    break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - PG Booking System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body class="w-full text-gray-700 bg-blue-50">
    <header class="px-20 flex w-full bg-blue-500 py-6 text-white shadow-md shadow-blue-200 rounded-sm justify-between items-center">
        <h1 class="font-extrabold text-4xl"><a href="./index.php">PG GO</a></h1>
        <h3 class="font-bold text-xl">Welcome to PG GO</h3>

        <form method='POST'>
            <button type='submit' id='header-logout-btn' name='logout' class='hidden logout rounded-md border hover:border-white hover:bg-white hover:shadow-none text-white hover:text-blue-900 font-medium text-md px-4 py-2 bg-blue-700 border-blue-700 shadow-lg shadow-blue-600'>Logout - <span id="logout-span"></span></button>
        </form>
    </header>

    <main class="px-20 flex flex-col justify-center w-full" id="main">

        <!-- Space to show login signup if the user hasn't logged in yet -->
        <div class='flex justify-center w-full' id='no-account'>
            <div class='flex w-fit gap-6 my-4 items-center'>
                <h3 class='font-semibold'>Don't have an account?</h3>
                <a href='./signup.php' class='px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md rounded-sm'>Signup</a>
                <span class='font-semibold'>or</span>
                <a href='./login.php' class='px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md rounded-sm'>Login</a>
            </div>
        </div>
        <hr class='my-4' id='h-line'>

        <?php

        while(array_key_exists('user_email', $_SESSION) == 1) {
            $session_mail = $_SESSION['user_email'];

            $check_user = " SELECT * FROM pzp_user_masters WHERE `user_email` = '$session_mail' ";
            $run_check_user = mysqli_query($conn, $check_user);
            $result = mysqli_num_rows($run_check_user);

            // get all the data from table stored in a variable
            $all_data = mysqli_fetch_assoc($run_check_user);

            if ($session_mail) {
                echo "<script>
                    let logoutBtn = document.getElementById('header-logout-btn');
                    logoutBtn.classList.remove('hidden');
                    logoutBtn.classList.add('flex');
    
                    document.getElementById('no-account').classList.remove('flex');
                    document.getElementById('no-account').classList.add('hidden');
                    document.getElementById('h-line').classList.add('hidden');
                </script>";

                while($all_data) {
                    $_SESSION['username'] = $all_data['user_name']; // got the username from database and stored in the session variable
                    $sess_usernm = $_SESSION['username']; // stored in a normal variable for better usability

                    // echo "<script>console.log('$sess_usernm');</script>";

                    echo "<script>document.getElementById('logout-span').innerHTML = '$sess_usernm';</script>";

                    break;
                }
            }
            break;
        }

        ?>

        <h1 class="font-extrabold text-2xl w-full py-6">Choose your desired PG</h1>
        <div class="flex gap-4 items-center">
            <p class="text-lg w-fit font-bold py-1 bg-blue-400 px-3 rounded text-white my-2">Available Paying Guest Homes: </p>
            <p class="text-md font-bold border-b border-black">Location -Guwahati</p>
        </div>

        <section class="homes w-full flex flex-col gap-8">
            <div class='grid grid-cols-2 py-4 gap-6'>

                <?php

                $load_pgs = " SELECT * FROM `pzp_pg_master` ";
                $run_load_pgs = mysqli_query($conn, $load_pgs);
                

                while($result_load_pgs = mysqli_fetch_array($run_load_pgs)) {

                    $pgid = $result_load_pgs['id'];
                    $pgname = $result_load_pgs['pg_name'];
                    $ownermail = $result_load_pgs['owner_email'];
                    $pgphone = $result_load_pgs['pg_phone'];
                    $address1 = $result_load_pgs['address1'];
                    $address2 = $result_load_pgs['address2'];
                    $pgtype = $result_load_pgs['pgtype'];
                    $wifi = $result_load_pgs['wifi'];
                    $food = $result_load_pgs['food'];
                    $pgctgry = $result_load_pgs['pg_category'];
                    $pgimg = $result_load_pgs['image'];
                    $price = $result_load_pgs['price'];

                    foreach($result_load_pgs as $result_row) {

                        echo "
                    
                        <div class='flex w-full h-80 border border-blue-200 rounded-sm shadow-lg p-6 bg-white gap-4'>
                            <div class='w-1/2 h-full flex flex-col gap-4 justify-between'>
                                <h3 class='font-bold text-xl'>$pgname</h3>
                                <p class='rating flex w-full gap-0.5 items-center'>
                                    <span class='text-xs mr-2 font-bold'>Rating: </span>
                                    <span class='text-xs mr-2 font-bold'>3.2</span>
                                    <img src='./img/star-fill.png' alt='' class='w-4'>
                                    <img src='./img/star-fill.png' alt='' class='w-4'>
                                    <img src='./img/star-fill.png' alt='' class='w-4'>
                                </p>

                                <ol class='text-sm font-bold'>
                                    <li>$pgtype</li>
                                    <li>$wifi</li>
                                    <li>$food</li>
                                </ol>

                                <span class='font-normal text-sm'>$pgctgry: $address1, $address2</span>

                                <form method='post' class='buttons flex gap-10 items-center'>
                                    <p class='font-bold'>Price: <span>$price</span> Rs</p>
                                    <button type='submit' name='$pgid' class='bg-blue-600 px-4 py-2 text-white rounded-md shadow-md hover:shadow-lg hover:bg-blue-800 hover:shadow-blue-400'>Book Now</button>
                                </form>
                            </div>

                            <div class='flex flex-col w-1/2 gap-4 h-full text-white'>
                                <picture class='h-full'>
                                    <img src='./img/image1.jpg' alt='' class='object-cover w-full h-full'>
                                </picture>

                                

                            </div>
                        </div>
                    
                        ";
                        
                        if(isset($_POST[$pgid])){
                            
                            if(array_key_exists('user_email', $_SESSION) == 0) {
                                echo "<script>alert('Please Log in to start booking.');</script>";
                            } else if (array_key_exists('user_email', $_SESSION) == 1) {
                                // echo "<script>alert('$pgid');</script>";

                                $_SESSION['pgid'] = $pgid; // use this in the payment page to fetch according data about the PG
                                
                                redirect_payment_page();
                            }
                        }
                        

                        break;
                    }

                    // break;  // if u uncomment this break it won't iterate between the rows and only one PG will pe shown in the index

                }

                ?>
                    
                </div>
               
                <?php

            ?>


        </section>
    </main>

    <div class="flex justify-center my-6">
        <h5 class="text-lg text-gray-400">Oh! This is the end!</h5>
    </div>

    <div class="flex justify-center">
        <a href="#main" class="px-8 py-5 border border-blue-500 hover:border-blue-800 rounded-full font-bold text-xl text-blue-600 hover:text-blue-900 my-4">Go to top</a>
    </div>



    <?php

        

    ?>




    <!-- component -->
    <!-- <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css"> -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"> 

    <footer class="relative bg-blue-100 mt-6 pt-8 pb-4">
        <div class="container mx-auto">
            <div class="flex flex-wrap text-left lg:text-left">
                <div class="w-full lg:w-6/12 px-4">
                    <h4 class="text-3xl fonat-semibold text-blueGray-700">Let's keep in touch!</h4>
                    <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
                        Find us on any of these platforms, we respond 1-2 business days.
                    </h5>
                    <div class="mt-6 lg:mb-0 mb-6">
                        <button class="bg-white text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
                        <a href="https://www.facebook.com" target="_blank">
                        <i class="fab fa-linkedin"></i>
                        </button>
                        <button class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
                        <a href="https://www.instagram.com/its_gaurisinghal/">
                        <i class="fab fa-instagram-square"></i>
                        </button>
                        <button class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
                        <a href="https://github.com/gauri26singhal">
                        <i class="fab fa-github"></i>
                        </button>
                    </div>
                </div>
                <div class="w-full lg:w-6/12 px-4">
                    <div class="flex flex-wrap items-top mb-6">
                        <div class="w-full lg:w-4/12 px-4 ml-auto">
                            <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Useful Links</span>
                            <ul class="list-unstyled">
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/gauri26singhal">About Us</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/gauri26singhal">Github</a>
                                </li>
                            </ul>
                        </div>
                        <div class="w-full lg:w-4/12 px-4">
                            <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Other Resources</span>
                            <ul class="list-unstyled">
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/gauri26singhal">Terms &amp; Conditions</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/gauri26singhal">Privacy Policy</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/gauri26singhal">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-3 border-blueGray-300">
            <div class="flex flex-wrap items-center md:justify-between justify-center">
                <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                    <div class="text-sm text-blueGray-500 font-semibold py-1">
                        Copyright ©
                        <span>2024</span> A Project by
                        <a href="" class="text-blueGray-500 hover:text-blueGray-800">Gauri</a>.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>