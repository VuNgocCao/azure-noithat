<?php 
    session_start();
	if(isset($_GET["task"]) && $_GET["task"]=="logout")
	{
		session_destroy();
		header("Location:trang_chủ.php");
	}
?>
<?php
     require "config.php";
                                    
     if(!$_SESSION)
     {
        header("Location:đăng_nhập.php");
     }                                                          
?>
<?php
    include "config.php";
    $sqla="select * from user where email = '".$_SESSION["username"]."'";
    $resulta = mysqli_query($conn,$sqla);
    $rowa=mysqli_fetch_array($resulta);
    $user_id = $rowa["user_id"];
    $sql="select * from tbl_order inner join product on tbl_order.product_id = product.product_id  where tbl_order.user_id='".$user_id."'";
    $result=mysqli_query($conn,$sql);
    
    $result_update=mysqli_query($conn,$sql);
    $result_check=mysqli_query($conn,$sql);
    if(mysqli_fetch_assoc($result_check)==NULL){
        $result='';
    }
    if(isset($_GET["deleteId"])){
        $deleteId=$_GET["deleteId"];
        $sql_delete="DELETE FROM tbl_order WHERE order_id='".$deleteId."';";
        mysqli_query($conn,$sql_delete);
        header("location:./cart.php");
    }
    if(isset($_GET["thanhToan"])){
         while($row_update = mysqli_fetch_assoc($result_update)){
            $order_id=$row_update["order_id"];
            $soLuong=$_GET["update-soluong-".$order_id.""];
            if($soLuong>0){
                $sql_update="UPDATE tbl_order SET `num`='".$soLuong."' WHERE order_id='".$order_id."';";
                mysqli_query($conn,$sql_update);
                header("location:bill.php");
            }  
         }
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
                                <button style="border: none" type="submit" class="btn-search"><i class="fa fa-search"></i></button>    
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
                                                $sql_cate= "SELECT * FROM category order by cate_id asc";
                                                $result_cate = mysqli_query($conn, $sql_cate);

                                                if (mysqli_num_rows($result_cate)) {
                                                // output data of each row
                                                    while($row_cate = mysqli_fetch_assoc($result_cate)) 
                                                    {
                                                        echo "<li class='dropdown-menu-list'><a href='./sản_phẩm.php?cate_id=".$row_cate['cate_id']."'>".$row_cate['cate_name']."</a></li>";
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
            <h1>Giỏ hàng</h1>
            <a href="trang_chủ.php">Trang chủ</a>
            <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
            <span>Giỏ hàng</span>
        </div>
    </div>

      
    <!-- Main content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-1"></div>
                    <div style=" position: relative;" class="col-10">
                    <h2>Giỏ hàng của bạn</h2>
                    
                    <?php
                    if($result==''){
                        echo '
                            <div class="container" style="background-color:#fff;border: 1px solid #f7941d;padding: 20px 10px 10px 10px">
                                <p>Không có sản phẩm nào trong giỏ hàng. Quay lại cửa hàng để tiếp tục mua sắm.</p>
                            </div>
                        ';
                    }
                    else{
                    echo'
                        <form action="" method="GET">
                            <table class="table-cart" >
                                <tr>
                                    <th id="th-thao-tac"></th>
                                    <th id="th-anh">Ảnh</th>
                                    <th id="th-san-phame">Sản phẩm</th>
                                    <th id="th-gia">Giá</th>
                                    <th id="th-so-luong">Số lượng</th>
                                    <th id="th-thanh-tien">Thành tiền</th>
                                </tr>
                    ';
                    $dem=0;
                    while($row = mysqli_fetch_assoc($result)){
                    $dem++;
                    $tr=$dem%2;
                    echo'           
                        <tr class="tr'.$tr.'" >
                            <td class="td-thao-tac" ><a style="text-decoration: none; " href="./cart.php?deleteId='.$row["order_id"].'"><i class="fa fa-close"></i></a></td>
                            <td class="td-img"><img style="width:150px; height:150px;padding:0px 0px" src="'.$row["thumbnail"].'" alt=""></td>
                            <td class="td-ten"><span>'.$row["title"].'</span><p>'.$row["trademark"].'</p></td>
                            <td class="td-gia" ><span>'.number_format($row["price"],"0",",",".").' đ </span></td>
                            <td class="td-so-luong" ><input type="text" name="update-soluong-'.$row["order_id"].'" value="'.$row["num"].'" maxlength="2"></td>
                            <td class="td-tong-gia" ><span>'.number_format(($row["price"]*$row["num"]),"0",",",".").' đ</span></td>
                        </tr>
                    ';}      
                    echo'
                        </table>
                        <div class="cart-form" style="float: right;margin-top:20px">       
                                <a href="trang_chủ.php">Tiếp tục mua hàng</a>
                                <input type="submit" name="thanhToan" value="Tiến hành thanh toán">  
                        </div>
                        </form>
                        ';
                    }
                    ?>
                    </div>
                    <div class="col-1"></div>
                    
                </div>
            </div>
        </div>
    



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