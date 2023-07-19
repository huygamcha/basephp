<?php

include 'define_bd.php';

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME) or die();
mysqli_query($conn, "set names 'utf8'");
$result = mysqli_query($conn, "SELECT count(*) as count FROM `user` WHERE username = '" . $_POST['username'] . "' AND `password` = '" . $_POST['password'] . "'");

while ($row = mysqli_fetch_array($result)) {
    if ($row['count'] == '1') {
        session_start();
        $_SESSION['username'] = $_POST['username'];
        header("Location:home.php");
    } else {
        header("Location:login.php");
    }
}
?>