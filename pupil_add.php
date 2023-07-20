<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

    .error {
        color: red;
    }
</style>
<?php
session_start();
if (!isset($_SESSION['username'])) { //chưa khởi tạo session
    echo "";
    exit;
}
?>
<ul class="nav d-flex align-items-center">
    <li class="nav-item">
        <a onclick="window.location = 'home.php';" class="nav-link active" aria-current="page" href="#">Home</a>
    </li>
    <li class="nav-item">
        <a onclick="window.location = 'pupil_list.php';" class="nav-link" href="#">Pupil List</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Add new </a>
    </li>
    <li class="nav-item">
        <div>
            <button class="btn" onclick="window.location = 'logout.php';">Logout</button>
        </div>
    </li>

</ul>
<form action="pupil_add_db.php" method="post">
    <div>
        <input type="text" name="full_name" placeholder="full-name" value='<?php
        if (isset($_GET['full_name'])) {
            echo $_GET['full_name'];
        }
        ?>'>
        <?php
        if (isset($_GET['error_full_name'])) {
            echo '<div class="error">Vui lòng nhập tên</div>';
        }
        ?>
    </div>
    <div>
        <label for="gender">Marred:</label><br>
        <input type="radio" id="male" name="married" value="1" <?php if (isset($_GET['married']) && $_GET['married'] == '1') {
            echo " checked";
        }
        ?>>
        <label for="male">Đã lập gia đình</label><br>
        <input type="radio" id="female" name="married" value="0" <?php if (isset($_GET['married']) && $_GET['married'] == '0') {
            echo " checked";
        }
        ?>>
        <label for="female">Đang cô đơn nè</label><br>
        <?php
        if (isset($_GET['error_married'])) {
            echo '<div class="error">Vui lòng tình trạng hôn nhân</div>';
        }
        ?>
    </div>
    <div>
        <label for="gender">Sex:</label><br>
        <input type="radio" id="male" name="sex" value="1" <?php if (isset($_GET['sex']) && $_GET['sex'] == '1') {
            echo " checked";
        }
        ?>>
        <label for="male">Nam</label><br>
        <input type="radio" id="female" name="sex" value="0" <?php if (isset($_GET['sex']) && $_GET['sex'] == '0') {
            echo " checked";
        }
        ?>>
        <label for="female">Nữ</label><br>
        <?php
        if (isset($_GET['error_sex'])) {
            echo '<div class="error">Vui lòng chọn giới tính</div>';
        }
        ?>
    </div>
    <div>
        <input type="date" name="birthday" placeholder="birthday" value="<?php if (isset($_GET['birthday'])) {
            echo date('Y-m-d', strtotime($_GET['birthday']));
        } ?>">
        <?php
        if (isset($_GET['error_birthday'])) {
            echo '<div class="error">Vui lòng chọn năm sinh</div>';
        }
        ?>
    </div>
    <div>
        <input type="submit" value="Add new student">
    </div>
</form>