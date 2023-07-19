<?php
session_start();
if (!isset($_SESSION['username'])) { //chưa khởi tạo session
    echo "";
    exit;
}
include 'define_bd.php';
$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME) or die();
mysqli_query($conn, "set names 'utf8'");
$result = mysqli_query($conn, "SELECT * FROM `pupil` WHERE id = " . $_GET['id']);


while ($row = mysqli_fetch_array($result)) {
    $fullname = $row['full_name'];
    $married = $row['married'];
    $sex = $row['sex'];
    $birthday = $row['birthday'];
    // $birthday = date('d/m/Y', strtotime($datetime));
}

?>
<form action="pupil_edit_bd.php" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <div>
        <input type="text" name="full_name" placeholder="full-name" value="<?php echo $fullname; ?>">
    </div>
    <div>
        <label for="gender">Marred:</label><br>
        <input type="radio" id="male" name="married" value="1" <?php if ($married == '1')
            echo " checked" ?>>
            <label for="male">Đã lập gia đình</label><br>
            <input type="radio" id="female" name="married" value="0" <?php if ($married == '0')
            echo " checked" ?>>
            <label for="female">Đang cô đơn nè</label><br>
        </div>
        <div>
            <label for="gender">Sex:</label><br>
            <input type="radio" id="male" name="sex" value="1" <?php if ($sex == '1')
            echo " checked" ?>>
            <label for="male">Nam</label><br>
            <input type="radio" id="female" name="sex" value="0" <?php if ($sex == '0')
            echo " checked" ?>>
            <label for="female">Nữ</label><br>
        </div>
        <div>
            <input type="date" name="birthday" placeholder="birthday"
                value="<?php echo date('Y-m-d', strtotime($birthday)); ?>">


    </div>
    <div>
        <input type="submit" value="Update">
    </div>
</form>