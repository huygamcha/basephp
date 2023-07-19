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
</style>
<?php
session_start();
if (!isset($_SESSION['username'])) { //chưa khởi tạo session
    header("Location:login.php");
}
?>
<ul class="nav d-flex align-items-center">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
    </li>
    <li class="nav-item">
        <a onclick="window.location = 'pupil_list.php';" class="nav-link" href="#">Pupil List</a>
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

<h1>
    Xin chào bạn đến với phần mềm quản lý trường học
</h1>