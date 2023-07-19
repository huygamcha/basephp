<?php

include 'define_bd.php';

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME) or die();
mysqli_query($conn, "set names 'utf8'");
// id được lấy từ bên result của pupil_list
$result = mysqli_query($conn, "delete FROM `pupil` WHERE id = " . $_GET['id']);

?>