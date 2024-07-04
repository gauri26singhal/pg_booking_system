<?php
include('../php/connect.php');
session_start();

$ownermail = $_SESSION['owner_email'];
echo "<script>console.log('$ownermail')</script>";

$pg_name = $_POST['pgname'];
$phone = $_POST['pgphone'];
$addrs1 = $_POST['addrs1'];
$addrs2 = $_POST['addrs2'];
$pgtype = $_POST['pgtype'];
$wifi = $_POST['wifi'];
$food = $_POST['food'];
$pgcate = $_POST['pgcate'];
$pgphoto = $_POST['pgphoto'];
$pgprice = $_POST['pgprice'];


if (isset($_POST['submit'])) {
    $pg_insert = " INSERT INTO `pzp_pg_details` (`owner_mail`,`pg_phone`,`pg_name`,`address1`,`address2`,`pgtype`,`wifi`,`food`,`pg_category`,`image`,`price`) VALUES ('$ownermail','$phone','$pg_name','$addrs1','$addrs2','$pgtype','$wifi','$food','$pgcate','$pgphoto','$pgprice'); ";

    $run_pg_insert = mysqli_query($conn, $pg_insert); // pg inserted.

    echo "<script>alert('PG Request submitted by $ownermail. Wait for approval. Thank you.');</script>";

    ?>
    <meta http-equiv="refresh" content="0; url = http://localhost/prerna/pgowner/registerpg.php" />
    <?php

}