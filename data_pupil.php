<?php
session_start();
if (!isset($_SESSION['username'])) { //chưa khởi tạo session
    echo "";
    exit;
}

include 'define_bd.php';


$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME) or die();
mysqli_query($conn, "set names 'utf8'");
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if ($page == '1') {
    $index = 0;
} else {
    $index = ($page - 1) * 10;
}
$result = mysqli_query($conn, "SELECT pupil.*,IF(sex = 1, \"Nam\", \"Nữ\") as gioi_tinh,IF(married = 1, \"Đã lập gia đình\", \"Đang cô đơn nè\") as tinh_trang_hon_nhan, class.name as classname from pupil INNER JOIN class ON pupil.class_id = class.id  limit $index, 10");


?>

<?php
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>
                    <td>
                        " . $row['full_name'] . "
                    </td>
                    <td>
                        " . $row['birthday'] . "
                    </td>
                    <td>
                        " . $row['gioi_tinh'] . "
                    </td>
                    <td>
                        " . $row['tinh_trang_hon_nhan'] . "
                    </td>
                    <td style='width: 100px'>
                    " . $row['classname'] . "
                </td>
                    <td>
                        <button id='" . $row['id'] . "'>Xoá</button>
                        <a href='edit.php?id=" . $row['id'] . "'>Sửa</a>
                    </td>
                </tr>";
}
?>