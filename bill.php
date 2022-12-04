<?php
    session_start();
    ?>
    <?php 
	if(isset($_GET["task"]) && $_GET["task"]=="logout")
	{
		session_destroy();
		header("Location:trang_chủ.php");
	}
?>
<?php  
    require "config.php";
    if(isset($_POST["submit"])){
        $sql = "select * FROM tbl_order inner join user on tbl_order.user_id = user.user_id where email ='".$_SESSION["username"]."'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $user_id=$row['user_id'];
        $sql1 = "select * from tbl_order inner join product on tbl_order.product_id = product.product_id where tbl_order.user_id ='".$user_id."'";
        $result1 = mysqli_query($conn,$sql1);
            if(mysqli_num_rows($result1)>0){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $order_id = $row1['order_id']; 
                    $title = $row1['title'];
                    $product_id = $row1['product_id'];
                    $price = $row1['price'];
                    $num = $row1['num'];
                    $total = $row1['total_price'];
                    $name = $_POST["name"];
                    $phone_number = $_POST["phone_number"];
                    $address = $_POST["address"];
                    $date = $_POST["date"];
                    $sql5 = "insert into bill(order_id, full_name,product_id,title,phone_number,adress,bill_date,price,num,total_price) values('".$order_id."',N'".$name."','".$product_id."',N'".$title."','".$phone_number."',N'".$address."','".$date."','".$price."','".$num."','".$total."')";
                    if (mysqli_query($conn, $sql5)) {
                        $sql6 = "delete from tbl_order where order_id='".$order_id."'";
                        mysqli_query($conn, $sql6);
                        header("Location:trang_chủ.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
            header("Location: bill.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="./fontawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./icon-web/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="style_link.css">
    <link rel="stylesheet" href="./fontawesome-free-5.15.4-web/css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

    <title>DNMC</title>
</head>
<body>
    <!-- Header -->
        <div class="fui-container all">
            <div class="container">
                    <!-- search and login -->
                    <div class="all-list">
                    <div class="row nav">
                        <div class="col-1"></div>
                        <div class="col-2 nav-left">
                            <a href="trang_chủ.php"><img src="./images/logo.png" alt=""></a>
                        </div>
                        
                        <div class="col-6 nav-center">
                            <form action="TimKiem.php" method="GET">
                                <input  type="text" id="form-input" class="form-control" placeholder="Nhập từ khóa tìm kiếm" name="tukhoa">
                                <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>    
                            </form>
                        </div>
                
                        <div class="col-2 nav-right">
                            <div class="login">
                                <?php
                                    require "config.php";
                                    
                                    if(!$_SESSION)
                                    {
                                        echo '<a href="đăng_kí.php">Đăng kí</a>
                                                |
                                                <a href="đăng_nhập.php">Đăng nhập</a>';
                                    }
                                    else
                                    {
                                        echo "<div>
                                            <ion-icon name='person' style='float: left;margin-right: 10px; color: #f7941d;'></ion-icon>
                                                <h6 style='width: 120px; overflow: hidden;text-overflow: ellipsis; '>".$_SESSION['username']."</h6>
                                            </div>
                                        ";
                                        echo '
                                            <form  style="float: left;"  action="trang_chủ.php" >
                                                <a href="trang_chủ.php?task=logout">Đăng xuất</a>
                                            </form>
                                            ';   
                                    }   
                                ?>
                                <a class="dolly" href="cart.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <!-- menu -->
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-2"></div>
                        <div class="col-6 menu">
                            <div>
                                <ul class="nav-menu">
                                <li class="nav-menu-list"><a href="trang_chủ.php">trang chủ <span></span></a></li>
                                <li class="nav-menu-list"><a  href="giới_thiệu.php">giới thiệu <span></span></a></li>
                                <li class="nav-menu-list">
                                    <a href="sản_phẩm.php" class="sanpham">sản phẩm  <i style="font-size: 12px" class="ti-angle-down"></i> <span></span> <span></span></a>
                                    <ul class="dropdown-menu">
                                        <?php 
                                            	require "config.php";
                                                $sql = "SELECT * FROM category order by cate_id asc";
                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result)) {
                                                // output data of each row
                                                    while($row = mysqli_fetch_assoc($result)) 
                                                    {
                                                        echo "<li class='dropdown-menu-list'><a href='./sản_phẩm.php?cate_id=".$row['cate_id']."'>".$row['cate_name']."</a></li>";
                                                    }
                                                }
                                        ?>
                                    </ul>
                                </li>
                                <li class="nav-menu-list"><a href="tin_tức.php">tin tức<span></span></a></li>
                                <li class="nav-menu-list"><a href="liên_hệ.php">liên hệ <span></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-2 hotlines">
                            <ul class="hotline">
                                <li>
                                <span>
                                    <i class="	fa fa-headphones" aria-hidden="true"></i>
                                    Hotline:
                                </span>
                                <a href="#">19006750</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    </div>
                <div class="clear"></div>
            </div>
        </div>
    
    <!-- img content -->
    
    <div class="fui-container img-content">
        <img src="./images/img-content.webp" height="215px" width="100%" alt="">
        <div class="content">
            <h1>Thanh toán</h1>
            <a href="trang_chủ.php">Trang chủ</a>
            <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
            <span>Thanh toán</span>
        </div>
    </div>
    <!-- Main content -->
    <form class="form-bill" action="bill.php" method="post">
        <div style="margin-top:100px" class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-1"></div>
                    <div style="display:flex" class="col-10">
                        <div class="col-4">
                            <h5>Thông tin nhận hàng</h5>
                            <?php
                                    require "config.php";
                                    if($_SESSION)
                                    {
                                        echo 'Email <br><input type="text" name="email" placeholder="Email" value="'.$_SESSION["username"].'" ?>';
                                    }
                                    else{
                                        echo 'Email <br><input type="text" name="email" placeholder="Email" ?>';
                                    }  
                                ?>
                                <br><br>Họ và tên
                                <br><input type="text" name="name" placeholder="Họ và tên"><br>
                                <br>Số điện thoại
                                <input type="text" name="phone_number" placeholder="Số điện thoại"><br>
                                <br>Địa chỉ
                                <br><input type="text" name="address" placeholder="Địa chỉ"><br><br>
                                <input type="hidden" placeholder="" name="date" value="<?php echo date("Y-m-d")?>">
                        </div>
                        <div class="col-4">
                            <h5>Vận chuyển</h5>
                            <div class="vanchuyen">
                                <span>Giao hàng tận nơi:</span>
                                <span style="margin-left: 10px;">40.000₫</span>
                            </div>
                            <h5  style="margin-top: 30px">Thanh toán</h5>
                            <div class="thanhtoan">
                                <span>Thanh toán khi giao hàng (COD)</span>
                                <img  style="margin-left: 5px" src="./images/icons8-dollar-24.png" alt="">
                            </div>
                                
                        </div>
                        <div style="border: 1px solid #ccc;padding: 0 10px" class="col-4">
                            <h5 style="padding: 15px; border-bottom: 1px solid #ccc">Đơn hàng</h5>
                            <?php  
                                require "config.php";
                                $total = 0;
                                if(!$_SESSION){
                                    echo '<h5 style="padding: 10px">Không có đơn hàng nào</h5>';
                                }
                                else{
                                    if(isset($_POST["submit"])){
                                        echo "abc";
                                    }
                                    else{
                                        $sql = "select * FROM tbl_order inner join user on tbl_order.user_id = user.user_id where email ='".$_SESSION["username"]."'";
                                        $result = mysqli_query($conn,$sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $bill = mysqli_num_rows($result);

                                        if($bill == 0){
                                            echo "<h5 style = 'color: #f7941d; text-align: center'>Đặt hàng thành công</h5>";
                                        }else{
                                        $user_id=$row['user_id'];
                                        $sql1 = "select * from tbl_order inner join product on tbl_order.product_id = product.product_id where tbl_order.user_id ='".$user_id."'";
                                        $result1 = mysqli_query($conn,$sql1);
                                        if(mysqli_num_rows($result1)>0){
                                            while($row1 = mysqli_fetch_assoc($result1)){
                                                echo '<div style="position: relative;" class="bill_product">
                                                        <img style="width: 50px; height: 50px" src="'.$row1["thumbnail"].'" alt="">
                                                        <span class="num">'.$row1["num"].'</span>
                                                        <span style="margin-left: 10px;">'.$row1["title"].'</span>
                                                        <span style="position: absolute; right:0;top: 20px">'.number_format($row1["total_price"],"0",",",".").'đ</span>
                                                    </div>';
                                                    $total = $total + $row1["total_price"];
                                            }
                                        }
                                    }
                                    }
                                   
                                }
                                    
                            ?>
                                <div style="display: flex; margin-top: 10px;">
                                    <input style="padding: 9px;border-radius:5px;width: 65%;border: 1px solid #ccc" type="text" name="txt-discount-code" placeholder="Nhập mã giảm giá">
                                    <input style="width: 30%;background-color: #2A6395;color: #fff;border-radius:5px;border: none; text-align: center; margin-left: 10px;" type="submit" name="submit-discount-code" value="ÁP DỤNG">
                                </div>
                            <div class="total_price">
                                <div style="padding: 15px 0; border-bottom: 1px solid #ccc">
                                    <div style="margin-bottom: 10px">
                                        <span>Tạm tính</span>
                                        <span style="float: right"><?php echo number_format($total,"0",",","."); ?>đ</span>
                                    </div>
                                    <div>
                                        <span>Phí vận chuyển</span>
                                        <span style="float: right"><?php $a=40000; echo number_format($a,"0",",","."); ?>đ</span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div style="margin: 10px 0">
                                    <span>Tổng cộng</span>
                                    <span style="float: right"><?php echo number_format($total + $a,"0",",","."); ?>đ</span>
                            </div>
                            <button style="background-color: #2A6395;color: #fff;padding: 10px 30px;border-radius:5px;border: none; margin: 20px 0;float: right" type="submit" class="btn-bill" name="submit">ĐẶT HÀNG</button>

                        </div>                        
                    </div>
                    <div class="col-1"></div>
                    
                </div>
            </div>
        </div>
        </form>    
        
        <div style="margin-top: 150px;"class="fui-container footer">
            <div class="container">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 footer-content">
                        <div class="col-3 info-footer">
                            <img src="./images/policy1.png" alt="">
                            <div>
                                <h1>giao hàng miễn phí</h1>
                                <span>Với đơn trên 300.000 đ</span>
                            </div>
                        </div>
                        <div class="col-3 info-footer">
                            <img src="./images/policy2.png" alt="">
                            <div>
                                <h1>hỗ trợ 24/7</h1>
                                <span>Nhanh chóng thuận tiện</span>
                            </div>
                        </div>
                        <div class="col-3 info-footer">
                            <img src="./images/policy3.png" alt="">
                            <div>
                                <h1>đổi trả 3 ngày</h1>
                                <span>Hấp dẫn chưa từng có</span>
                            </div>
                        </div>
                        <div class="col-3 info-footer">
                            <img src="./images/policy4.png" alt="">
                            <div>
                                <h1>giá tiêu chuẩn </h1>
                                <span>Tiết kiệm 10% giá cả</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
                
            </div>
        </div>
        <div class="fui-container">
            <div class="container">
                <div style="margin-top: 50px; padding-bottom: 50px;" class="row">
                    <div class="col-1"></div>
                    <div style="display: flex;" class="col-10">    
                        <div class="col-4 footer-left">
                            <img src="./images/logo.png" alt="">
                            <h2>Siêu thị nội thất DNMC</h2>
                            <span>
                                Trụ sở chính: Quận Bắc Từ Liêm, Hà Nội <br>
                                Hotline: 1900 6750 <br>
                                Email: support@sapo.vn
                            </span>
                        </div>
                        <div style="display: flex;" class="col-8">
                            <div class="col-4 footer-center">
                                <h2>Về chúng tôi</h2>
                                <ul class="menu-footer">
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="trang_chủ.php"> Trang chủ</a>
                                    </li>
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="giới_thiệu.php">Giới thiệu</a>
                                    </li>
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="sản_phẩm.php">Sản phẩm</a>
                                    </li>
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="tin_tức.php">Tin tức</a>
                                    </li>
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="liên_hệ.php">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-4 footer-center">
                                <h2>tin khuyến mãi</h2>
                                <ul class="menu-footer">
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="trang_chủ.php"> Trang chủ</a>
                                    </li>
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="giới_thiệu.php">Giới thiệu</a>
                                    </li>
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="sản_phẩm.php">Sản phẩm</a>
                                    </li>
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="tin_tức.php">Tin tức</a>
                                    </li>
                                    <li class="click-menu-footer">
                                        <span></span>
                                        <a href="liên_hệ.php">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-4 footer-center footer-right">
                                <h2>Tổng đài hỗ trợ</h2>
                                <div class="footer-right-contact">
                                    <img src="./images/24-hours.svg" alt="">
                                </div>
                                <h2>Nhận tin khuyến mại</h2>
                                <form class="submit-email" action="">
                                    <input class="email" type="email" placeholder="Nhập email...">
                                    <input class="submit" type="submit" value="Đăng kí">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
        </div>
    </body>
</html>