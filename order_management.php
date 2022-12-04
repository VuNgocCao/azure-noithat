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
<body>
    <div class="container">
        <div class="container">
            <h1 style="text-align: center; margin-top: 50px; color: #FF6600">Thông tin đặt hàng</h1>
            <table style="margin-top: 50px" class="table table-striped">
                <tr>
                    <th>Mã đặt hàng</th>
                    <th>Mã người dùng</th>
                    <th>Mã sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                </tr>
                <tr>
                    <?php 
                        require "config.php";
                        $sql = "select * from tbl_order order by user_id DESC";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td>".$row['order_id']."</td>";
                                echo "<td>".$row['user_id']."</td>";
                                echo "<td>".$row['product_id']."</td>";
                                echo "<td>".$row['price']."</td>";
                                echo "<td>".$row['num']."</td>";
                                echo "<td>".$row['total_price']."</td>";
                                echo "</tr>";
                            }
                        }
                    ?>    
                </tr>
            </table>
        </div>
    </div>
    
</body>
</html>
