
<?php 
    session_start();
	if(isset($_GET["task"]) && $_GET["task"]=="logout")
	{
		session_destroy();
		header("Location:index.php");
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
    <link rel="stylesheet" href="./https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./style.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <title>DNMC</title>
</head>
<body>
    <div class="fui-container all">
        <div class="container all-list">
                <!-- search and login -->
                <div class="row nav">
                    <div class="col-1"></div>
                    <div class="col-2 nav-left">
                        <a href="index.php"><img src="./images/logo.png" alt=""></a>
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
                                            <form  style="float: left;"  action="index.php" >
                                                <a href="index.php?task=logout">Đăng xuất</a>
                                            </form>
                                            ';   
                                    }
                                    
                                ?>
                            <a class='dolly' href='cart.php'>
                                <i style='float: right;' class='fa fa-shopping-cart'></i>
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
                                <li class="nav-menu-list"><a href="index.php">trang chủ <span></span></a></li>
                                <li class="nav-menu-list"><a href="giới_thiệu.php">giới thiệu </a></li>
                                <li class="nav-menu-list">
                                    <a href="sản_phẩm.php" class="sanpham">sản phẩm  <i style="font-size: 12px" class="ti-angle-down"></i> <span></span></a>
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
                                        <i class="	fa fa-headphones"></i>
                                        Hotline:
                                    </span>
                                    <a href="#">19006750</a>
                                </li>
                            </ul>
                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row owl-stage-outer">
                    <div class="col-1"></div>
                    <div class="col-10" style="display: flex;">
                    <?php 
                        require "config.php";
                        $sql = "SELECT * FROM category where cate_id='1'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result)) {
                        // output data of each row
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                echo'<div class="col-2 item">
                                        <a href="./sản_phẩm.php?cate_id='.$row['cate_id'].'">
                                            <div class="item-list sofa">
                                                <img src="./images/036-sofa-1.png" alt="">
                                                <span>'.$row["cate_name"].'</span>
                                            </div>   
                                        </a>
                                    </div>';
                            }
                        }
                        
                        
                    ?>
                        
    
                    <?php 
                        require "config.php";
                        $sql = "SELECT * FROM category where cate_id='2'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result)) {
                        // output data of each row
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                echo'<div class="col-2 item">
                                        <a href="./sản_phẩm.php?cate_id='.$row['cate_id'].'">
                                            <div class="item-list sofa">
                                                <img src="./images/043-chair-2.png" alt="">
                                                <span>'.$row["cate_name"].'</span>
                                            </div>   
                                        </a>
                                    </div>';
                            }
                        }
                    ?>
                    <?php 
                        require "config.php";
                        $sql = "SELECT * FROM category where cate_id='3'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result)) {
                        // output data of each row
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                echo'<div class="col-2 item">
                                        <a href="./sản_phẩm.php?cate_id='.$row['cate_id'].'">
                                            <div class="item-list sofa">
                                                <img src="./images/022-lamp.png" alt="">
                                                <span>'.$row["cate_name"].'</span>
                                            </div>   
                                        </a>
                                    </div>';
                            }
                        }
                    ?>
                    <?php 
                        require "config.php";
                        $sql = "SELECT * FROM category where cate_id='4'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result)) {
                        // output data of each row
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                echo'<div class="col-2 item">
                                        <a href="./sản_phẩm.php?cate_id='.$row['cate_id'].'">
                                            <div class="item-list sofa">
                                                <img src="./images/012-shelf.png" alt="">
                                                <span>'.$row["cate_name"].'</span>
                                            </div>   
                                        </a>
                                    </div>';
                            }
                        }
                    ?>
                    <?php 
                        require "config.php";
                        $sql = "SELECT * FROM category where cate_id='5'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result)) {
                        // output data of each row
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                echo'<div class="col-2 item">
                                        <a href="./sản_phẩm.php?cate_id='.$row['cate_id'].'">
                                            <div class="item-list sofa">
                                                <img src="./images/006-table-1.png" alt="">
                                                <span>'.$row["cate_name"].'</span>
                                            </div>   
                                        </a>
                                    </div>';
                            }
                        }
                    ?>
                    <?php 
                        require "config.php";
                        $sql = "SELECT * FROM category where cate_id='6'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result)) {
                        // output data of each row
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                echo'<div class="col-2 item">
                                        <a href="./sản_phẩm.php?cate_id='.$row['cate_id'].'">
                                            <div class="item-list sofa">
                                                <img src="./images//050-closet.png" alt="">
                                                <span>'.$row["cate_name"].'</span>
                                            </div>   
                                        </a>
                                    </div>';
                            }
                        }
                    ?>
                    </div>
                    <div class="col-1"></div>
                    
                </div>
                <div class="clear"></div>
                <div class="row content-sec">
                    <div class="col-1"></div>
                    <div style="display: flex;" class="col-10 ">
                        <div style="margin-left: -14px;" class="col-4 item-product-sidebar">
                                <a href="detail_product.php?p_id=g1">
                                    <img src="./images/gheluxury.jpg" alt="">
                                </a>
                                <div class="product-info">
                                    <a href="detail_product.php?p_id=g1">
                                        Ghế Luxury <br>
                                        <span>Luxury</span>
                                    </a><br>
                                    <span>570.000 đ</span>
                                </div>
                            
                        </div>
                        <div style="margin-left: 10px;" class="col-8">
                            <div style="margin-left: 10px;flex-wrap: nowrap;" class="row title-top-menu">
                                <div class="col-4 product">
                                    <h3>Sản phẩm nổi bật</h3>
                                </div>
                                <ul class=" col-8 link-tab-check-click">
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=1">Sofa</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=2">Ghế</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=3">Trang trí</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=4">Kệ sách</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=5">Bàn</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=6">Tủ quần áo</a></li>
                                </ul>
                            </div>
                            <div style="margin-top: 15px;" class="row">
                                <div class="container-show Noi-bat">
                                    <?php
                                    $sql = "SELECT * FROM `product` WHERE `status` LIKE '%1%'";
                                    $result=mysqli_query($conn,$sql);
                                    if(mysqli_num_rows($result)>0){
                                    
                                       while($row = mysqli_fetch_assoc($result)){
                                    echo"
                                        <div class='card-all'>
                                            <div class='card'>
                                                <a href='detail_product.php?p_id=".$row['product_id']."'>
                                                <img class='img-card' src='".$row["thumbnail"]."' alt=''>
                                                <span>".$row["title"]."</span>
                                                </a>
                                                <p>".number_format($row["price"],"0",",",".")." đ</p> 
                                            </div>
                                        </div>";
                                    }
                                    }
                                
                                    ?>
                                </div>
                        </div>



                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row">
                    <div class="col-1"></div>
                    <div style="margin-top: 100px; display:flex" class="col-10">
                        <div class="col-6 banner-1">
                            <a href="#">                               
                                <span>Phòng Bếp</span>
                            </a>
                            
                        </div>
                        
                        
                        <div class="col-6 banner-2">
                            <a href="#">
                                <span>Phòng Khách</span>
                            </a>
                            
                        </div>

                    </div>

                    <div class="col-1">
                    </div>
                </div>

                <!-- akdjsjkhsjf -->

                <div style="margin-top:60px" class="row content-sec">
                    <div class="col-1"></div>
                    <div style="display: flex; flex-direction: " class="col-10 ">
                        <div style="margin-left: -14px;" class="col-8">
                            <div style="margin-left: 10px;flex-wrap: nowrap;" class="row title-top-menu">
                                <div class="col-4 product">
                                    <h3>Sản phẩm hot</h3>
                                </div>
                                <ul class=" col-8 link-tab-check-click">
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=1">Sofa</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=2">Ghế</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=3">Trang trí</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=4">Kệ sách</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=5">Bàn</a></li>
                                        <li class="link-click"><a href="./sản_phẩm.php?cate_id=6">Tủ quần áo</a></li>
                                </ul>
                            </div>
                            <div style="margin-top: 15px;" class="row">
                                
                                <div class="container-show Hot">


                                    <?php
                                        $sql = "SELECT * FROM `product` WHERE `status` LIKE '%2%'";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0){
                                        
                                        while($row = mysqli_fetch_assoc($result)){
                                        echo"
                                            <div class='card-all'>
                                                <div class='card'>
                                                    <a href='detail_product.php?p_id=".$row['product_id']."'>
                                                    <img class='img-card' src='".$row["thumbnail"]."' alt=''>
                                                    <span>".$row["title"]."</span>
                                                    </a>
                                                    <p>".number_format($row["price"],"0",",",".")." đ</p> 
                                                </div>
                                            </div>";
                                        }
                                        }

                                        ?>       
                                    </div>
                            </div>
                        </div>
                        <div style="margin-left: 30px;" class="col-4 item-product-sidebar">
                            <a href="detail_product.php?p_id=b6">
                                <img src="./images/table.jpg" alt="">
                            </a>
                            <div class="product-info">
                                <a href="detail_product.php?p_id=b6">
                                    Bàn Aillen <br>
                                    <span>AILLEN</span>
                                </a><br>
                                <span>1.300.000 đ</span>
                            </div>
                        
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 banner-img">
                        <img src="./images/khaitruong.jpg" alt="">
                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 ">
                        <div class="row header-new-product"> 
                                <div class="col-3 product">
                                    <h3>Sản phẩm mới về </h3>
                                </div>
                        </div>
                        <div class="row new-product">
                            <div class="list_new_product">
                                <div class="container-s New">                                
                                    <?php
                                        $sql = "SELECT * FROM `product` WHERE `status` LIKE'%3%'";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0){                                   
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo"
                                                    <div class='card-all-product'>
                                                        <div class='card-list_new_product'>
                                                            <a href='detail_product.php?p_id=".$row['product_id']."'>
                                                                <img class='img-card' src='".$row["thumbnail"]."' alt=''>
                                                                <span style='margin: 20px 0'>".$row["title"]."</span>
                                                            </a>
                                                            <p>".number_format($row["price"],"0",",",".")." đ</p> 
                                                        </div>
                                                    </div>";
                                            }
                                        }
                                    ?>
                                </div> 
                            </div>
                            
                        </div>

                    </div>
                    <div class="col-1"></div>
                </div>

        </div>
    </div>
    <div class="fui-container footer">
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
                                    <a href="#"> Trang chủ</a>
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
                                    <a href="#">Trang chủ</a>
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






    <script  type = "module"  src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> 
    <script  nomodule  src = "https: // unkg .com / ionicons @ 5.5.2 / dist / ionicons / ionicons.js " > </script>    
</body>
</html>