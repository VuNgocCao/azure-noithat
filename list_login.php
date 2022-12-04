<?php
    require "config.php";
    	session_start();
	if(!$_SESSION["email"])
	{
		header("Location:login_admin.php");
	}
	else
	{
        echo '<div style="right: 0;position: absolute;top: 10px;display: flex;flex-direction: column;align-items: center">
                <h4 style="color: #FF6600">Xin chào: '.$_SESSION["email"].'</h4>
                <a style="background-color: #f7941d; padding: 10px 20px;width: 200px; border-radius: 10px; text-decoration: none;text-align: center; font-size: 18px; color: #fff" href="login_admin.php?task=logout">Đăng xuất</a>
            </div>';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<style>
    .list_login a{
        display: block;
        margin-top:20px;
        text-decoration: none;
        color: #fff;
        font-size: 20px;
        text-align:center;
        padding: 10px 0;
        background-color: #FF6600;
        border-radius: 20px;
        border: 1px solid #FF6600;
        font-weight: 700;
    }
    .list_login a:hover{
        color: #FF6600;
        background-color: #fff;
    }
</style>
<body>
    <div class="container">
        <h1 style="text-align: center; margin-top: 50px; color: #FF6600">Tất cả các trang admin</h1>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 list_login">
                <a href="category.php">Đến trang danh mục sản phẩm</a>
                <a href="product.php">Đến trang quản trị sản phẩm</a>
                <a href="user_management.php">Đến trang thông tin khách hàng</a>
                <a href="order_management.php">Đến trang thông tin đặt hàng</a>
                <a href="bill_management.php">Đến trang thông tin thanh toán</a>
                <a href="contact_management.php">Đến trang phản hồi người dùng</a>
            </div>
            <div class="col-3"></div>
        </div>
        
        
    </div>

</body>
</html>
