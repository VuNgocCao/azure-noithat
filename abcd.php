<?php
require "config.php";
if($_POST)
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password = md5($password);
    $sql_1 = "SELECT * from user where email ='$username' and password = '$password'";
    $result = mysqli_query($conn, $sql_1);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows == 0) {
      echo "Tên đăng nhập hoặc mật khẩu của b không đúng!";
    }else{
      //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
        $_SESSION['username'] = $username;
        header('Location:trang_chủ.php');
    }
}
?>