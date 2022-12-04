<?php 
    session_start();
	if(isset($_GET["task"]) && $_GET["task"]=="logout")
	{
		session_destroy();
		header("Location:trang_chủ.php");
	}
?>
<?php
    include "config.php";              
    if(isset($_GET["p_id"])){
        $id = $_GET["p_id"];    
        $sql = "SELECT * FROM product where product_id='".$id."'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result); 
    }
    else{    
        header('Location: trang_chủ.php');
    }
    if(isset($_GET["submit_cart"])){
        if(!$_SESSION)
        {
            header("Location:đăng_nhập.php");
        }
        else
        {
            $sqlab="select * from user where email = '".$_SESSION["username"]."'";
            $resultab = mysqli_query($conn,$sqlab);
            $rowab=mysqli_fetch_assoc($resultab);
            $user_id = $rowab["user_id"];
            $product_id=$id;
            $soLuong=$_GET["soLuong"];
            $sql_checkOrder="SELECT * FROM `tbl_order` WHERE `user_id` = '".$user_id."' AND `product_id` = '".$product_id."'";
            $result_checkOrder=mysqli_query($conn, $sql_checkOrder);
            if(mysqli_num_rows($result_checkOrder)!=0){
                $row_checkOrder = mysqli_fetch_assoc($result_checkOrder);
                $num=$row_checkOrder["num"]+$soLuong;
                $sql_upDateNum="UPDATE `tbl_order` SET `num`='".$num."' WHERE `order_id`='".$row_checkOrder['order_id']."'";
                mysqli_query($conn, $sql_upDateNum);
                header('Location:detail_product.php?p_id='.$product_id.'');
            }
            else{
                $price=$row["price"];
                $tong=$soLuong * $price;
                $sql_upOrder="insert into tbl_order (user_id, product_id, price, num, total_price) values ('".$user_id."', '".$product_id."', '".$price."', '".$soLuong."', '".$tong."');";
                if(mysqli_query($conn, $sql_upOrder)){
                    echo '<h6 class="container" style="margin: 0 auto;padding: 10px 0;text-align: center;background-color: #FFCC99;width 100%;">Thêm vào giỏ hàng thành công</h6>';
                }
                header('Location:detail_product.php?p_id='.$product_id.'');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="./fontawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./icon-web/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./style_link.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <title>DNMC</title>
</head>
<body>

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
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
                <!-- manu -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-2"></div>
                    <div class="col-6 menu">
                        <div>
                            <ul class="nav-menu">
                                <li class="nav-menu-list"><a href="trang_chủ.php">trang chủ <span></span></a></li>
                                <li class="nav-menu-list"><a  href="giới_thiệu.php">giới thiệu <span></span></a></li>
                                <li class="nav-menu-list">
                                    <a href="sản_phẩm.php" class="sanpham">sản phẩm<i style="font-size: 12px;margin-left: 3px;" class="ti-angle-down"></i> <span></span></a>
                                    <ul class="dropdown-menu">
                                        <?php 
                                            	require "config.php";
                                                $sql_cate = "SELECT * FROM category order by cate_id asc";
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
                                        <i class="	fa fa-headphones"></i>
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
    <div class="fui-container img-content">
        <img style="z-index: 0" src="./images/img-content.webp" height="215px" width="100%" alt="">
        <div class="content">
            <?php               
                echo "<h1>".$row["title"]."</h1>";
            ?>
            <a href="trang_chủ.php">Trang chủ</a>
            <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
            <?php 
                    $sql_product_cate = "select * FROM product INNER JOIN category ON product.cate_id = category.cate_id where product_id = '".$id."'";
                    $result_product_cate = mysqli_query($conn, $sql_product_cate);
                    if (mysqli_num_rows($result_product_cate) > 0) {
                        // output data of each row
                        while($row_product_cate = mysqli_fetch_assoc($result_product_cate)) 
                        {
                            echo "<span>".$row_product_cate["cate_name"]."</span>";
                            echo "<i style='font-size: 12px;padding: 0 5px;' class='ti-angle-right'></i>";
                            echo "<span>".$row_product_cate["title"]."</span>";
                        }
                    }  
            ?>
        </div>
    </div>
    <div class="fui-container">
        <div class="container">
            <div class="row product-details">
                <div class="col-1"></div>
                <div class="col-10" style="display: flex; ">
                    <div class="col-6 img-product">
                    <?php                                
                        echo '<img class="img-product-detail" src="'.$row["thumbnail"].'" alt="">';                               
                    ?>                       
                    </div>
                    <div class="col-6 info-detail">
                        <div class="info_detail-top">
                            <?php 
                                echo "<h1>".$row["title"]."</h1>";
                                echo "<span>".$row["trademark"]."<p class='border-box'></p></span>";
                                echo "
                                    <div class='price-box'>
                                        <h3>".number_format($row["price"],"0",",",".")." đ</h3>
                                    </div>";
                                echo "<p>Thông tin sản phẩm đang được cập nhật.</p>";
                            ?>
                        </div>
                        <div class="info_detail-bottom">
                            <div class="soluong">
                                <label for="">Số lượng</label>
                                <form action="detail_product.php" method="get">
                                        <div class="btn-num">
                                            <button class="btn-num1" onclick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro ) && qtypro > 1 ) result.value--;return false;" type="button">-</button>
                                            <input type="text" id="qtym" name="soLuong" value="1" maxlength="2" class="input-num" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" onchange="if(this.value == 0)this.value=1;" name="num">
                                            <button class="btn-num2" onclick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;return false;" type="button">+</button>
                                        </div>
                                        <input type="hidden" name="p_id" value="<?php echo $id?>">
                                        <button type="submit" name="submit_cart" class="add-product">Thêm vào giỏ hàng</button>
                                </form>
                               
                                <p>Gọi đặt mua: <span>19006750</span> (Miễn phí, 8-21h cả T7,CN)</p>
                                <span style="dislay: none" class="abc"></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row" style="margin-top: 100px">
                <div class="col-1"></div>
                <div class="col-10 product_details_title">
                    <h3><a class="product_details_title-left" href="#">MÔ TẢ</a></h3>
                    <h3><a class="product_details_title-right" href="#">THÔNG TIN</a></h3>
                </div>
                <div class="col-1"></div>
                
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="info-product-details">
                        <p>
                        <?php 
                            echo "<span>".$row["description"]."</span>";
                        ?>                     
                        </p>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10" style="margin: 0;
                padding: 0; border-bottom: 2px solid #ddd;  ">
                    <div class="title-sanphamlienquan">
                        <h3>SẢN PHẨM LIÊN QUAN</h3>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10" style="margin-top: 30px;display: flex;">
                    <?php 
                            $cate_id=$row['cate_id'];
                            $sql1 = "SELECT * FROM product where cate_id='".$cate_id."'";
                            $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                                while($row1=mysqli_fetch_assoc($result1)) 
                                {
                                    if($row1['product_id'] != $row['product_id'])
                                        echo '<div class="sanphamlienquan">
                                                <a href="detail_product.php?p_id='.$row1["product_id"].'">
                                                    <img src="'.$row1['thumbnail'].'" alt="">
                                                    <h3>'.$row1["title"].'</h3>
                                                    <span>'.number_format($row1["price"],"0",",",".").'đ</span>
                                                </a>
                                            </div>';
                                    }   
                            }
                    ?>    
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>

    <div style="margin-top: 50px;"class="fui-container footer">
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
