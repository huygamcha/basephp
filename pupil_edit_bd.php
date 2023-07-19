<?php

include 'define_bd.php';
$error = '';
$value = false;

if ($_POST['full_name'] == '') {
    $error .= '&error_full_name=empty';
    $value = true;
} else {
    // lấy lại giá trị cũ
    $error .= '&full_name=' . $_POST['full_name'];
}

if ($_POST['married'] == '') {
    $error .= '&error_married=empty';
    $value = true;

} else {
    // lấy lại giá trị cũ
    $error .= '&married=' . $_POST['married'];
}

if ($_POST['sex'] == '') {

    $error .= '&error_sex=empty';
    $value = true;

} else {
    // lấy lại giá trị cũ

    $error .= '&sex=' . $_POST['sex'];
}

if ($_POST['birthday'] == '') {

    $error .= '&error_birthday=empty';
    $value = true;

} else {
    // lấy lại giá trị cũ

    $error .= '&birthday=' . $_POST['birthday'];
}
// nếu có lỗi thì dẫn đến url mới
if ($value == true) {
    $error = ltrim($error, '$');
    header('Location: pupil_edit.php?' . $error);
    exit();
}

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME) or die();
mysqli_query($conn, "set names 'utf8'");
mysqli_query($conn, "UPDATE pupil SET full_name = '" . $_POST['full_name'] . "' , sex = '" . $_POST['sex'] . "' , married = '" . $_POST['married'] . "', birthday = '" . $_POST['birthday'] . "'   WHERE id = '" . $_POST['id'] . "'");

header("Location:pupil_list.php");

?>