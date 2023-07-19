<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .btn:hover {
        cursor: pointer;
        background: #3a1336;
        padding: 10px;
        color: #fff;
    }

    .nav {
        height: 48px;
    }
</style>
<?php
session_start();
if (!isset($_SESSION['username'])) { //chưa khởi tạo session
    header("Location:login.php");
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

$countSql = "SELECT COUNT(*) AS total FROM pupil";
$countResult = $conn->query($countSql);
$row = $countResult->fetch_assoc();
$totalItems = $row['total'];
$totalPages = ceil($totalItems / 10);
$baseUrl = $_SERVER['PHP_SELF'];
?>
<style>
    table,
    tr,
    th,
    td {
        border: 1px solid black;
    }
</style>
<ul class="nav d-flex align-items-center">
    <li class="nav-item">
        <a onclick="window.location = 'home.php';" class="nav-link active" aria-current="page" href="#">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Pupil List</a>
    </li>
    <li class="nav-item">
        <a onclick="window.location = 'pupil_add.php';" class="nav-link" href="#">Add new </a>
    </li>
    <li class="nav-item">
        <div>
            <button class="btn" onclick="window.location = 'logout.php';">Logout</button>
        </div>
    </li>
</ul>
<table style="margin-left: 100px;">
    <thead>
        <tr>
            <th>
                Họ tên
            </th>
            <th>
                Ngày sinh
            </th>
            <th>
                Giới tính
            </th>
            <th>
                Tình trạng hon nhan
            </th>
            <th style='width: 100px'>
                Lớp
            </th>
            <th>

            </th>
        </tr>
    </thead>

    <tbody>
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
                        <a href='pupil_edit.php?id=" . $row['id'] . "'>Sửa</a>
                    </td>
                </tr>";
        }
        ?>

    </tbody>
</table>

<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
echo "<div class='pagination' style='display:block'>";
if ($totalPages > 1) {
    echo "<a data-page='1'>First</a>";
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $current_page) {
            echo "<span class='current'>$i| </span>";
        } else {
            echo "<a data-page='" . $i . "'>$i| </a>";
        }
    }
    echo "<a data-page='" . $totalPages . "'>Last</a>";
}
echo "</div>";

?>

<script>
    $(document).on("click", "button", function () {
        if (confirm("Are you sure you want to delete")) {
            var pupilId = $(this).attr('id');
            var that = $(this);
            $.ajax({
                url: 'delete.php?id=' + pupilId,
                success: function (data) {
                    $(that).parents('tr').remove();
                }
            })
        }

    });

    $(document).on("click", "a", function () {
        var page = $(this).data('page');
        $.ajax({
            url: 'pupil_edit.php?page=' + page,
            success: function (data) {
                $("tbody").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {

            }
        })
    });
</script>