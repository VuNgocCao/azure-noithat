<?php

session_start();
if(isset($_GET["task"]) && $_GET["task"]=="logout")
{
    session_destroy();
    header("Location:trang_chủ.php");
}

include "config.php";
if(isset($_GET['tukhoa'])){
    $tukhoa=$_GET['tukhoa'];
}else{
    $tukhoa="";
}
$search_price="";
$search_trademark="";
if(isset($_GET['submit-search'])){
    $tukhoa=$_GET['tukhoa'];
    $search_price=$_GET['search-price'];
    $search_trademark=$_GET['trademark'];
}
$sql = "Select * From product where title like '%".$tukhoa."%' ".$search_price." ".$search_trademark." ";
$result = mysqli_query($conn,$sql);
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
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <title>DNMC</title>
</head>
<body >
<form action="TimKiem.php" method="GET">
    <div class="fui-container all">
        <div class="container">
                <!-- search and login -->
            <div class="all-list">
                <div class="row nav">
                    <div class="col-1"></div>
                    <div class="col-2 nav-left">
                        <img src="./images/logo.png" alt="">
                    </div>
                    <div class="col-6 nav-center">
                            <input  type="text" id="form-input" class="form-control" placeholder="Nhập từ khóa tìm kiếm" name="tukhoa" value="<?php echo $tukhoa; ?>">
                            <button type="submit" class="btn-search" name="submit-search"><i class="fa fa-search"></i></button>    
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
                                               <a href="trang_chủ.php?task=logout">Đăng xuất</a>
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
                                <li class="nav-menu-list"><a href="trang_chủ.php">trang chủ <span></span></a></li>
                                <li class="nav-menu-list"><a  href="giới_thiệu.php">giới thiệu <span></span></a></li>
                                <li class="nav-menu-list">
                                    <a style="color: #f7941d" href="sản_phẩm.php" class="sanpham">sản phẩm<i style="font-size: 12px;margin-left: 3px;" class="ti-angle-down"></i> <span></span></a>
                                    <ul class="dropdown-menu">
                                        <?php 
                                            	require "config.php";
                                                $sql1 = "SELECT * FROM category order by cate_id asc";
                                                $result1 = mysqli_query($conn, $sql1);

                                                if (mysqli_num_rows($result1)) {
                                                // output data of each row
                                                    while($row1 = mysqli_fetch_assoc($result1)) 
                                                    {
                                                        echo "<li class='dropdown-menu-list'><a href='./sản_phẩm.php?cate_id=".$row1['cate_id']."'>".$row1['cate_name']."</a></li>";
                                                    }
                                                }
                                        ?>
                                    </ul>
                                </li>
                                
                                <li class="nav-menu-list"><a href="tin_tức.php">tin tức<span></span></a></li>
                                <li class="nav-menu-list"><a href="giới_thiệu.php">liên hệ <span></span></a></li>
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
        <img src="./images/img-content.webp" height="215px" width="100%" alt="">
        <div class="content">
            <h1><?php if($tukhoa!=""){ echo $tukhoa; }else{ echo 'Tất cả sản phẩm';} ?></h1>
            <a href="TrangChu.php">Trang chủ</a>
            <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
            <span>Tim Kiếm</span>
        </div>
    </div>
    <div class="fui-container">
        <div class="container">
            <div style="margin-top: 20px" class="row">
                <!-- <div class="col-1"></div> -->
                <div style="display: flex;"class="col-10">
                    <div class="col-3">
                        <div class="row list-category">
                            <div class="row title-category-content">
                                <div class="col-8 title-head">
                                    <h1>Thương hiệu</h1>
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <div class="category trademark">
                                <ul class="list-category">
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark1" value=""
                                                <?php if($search_trademark=="") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark1">Tất cả</label>
                                    
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark1" value="and trademark = 'Ailen'"
                                                <?php if($search_trademark=="and trademark = 'Ailen'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark1">Ailen</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark2" value="and trademark = 'ALICE'"
                                            <?php if($search_trademark=="and trademark = 'ALICE'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark2">ALICE</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark3" value="and trademark = 'ARABICA'"
                                            <?php if($search_trademark=="and trademark = 'ARABICA'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark3">ARABICA</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark4" value="and trademark = 'AURORA'"
                                            <?php if($search_trademark=="and trademark = 'AURORA'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark4">AURORA</label>

                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark5" value="and trademark = 'BELLA'"
                                            <?php if($search_trademark=="and trademark = 'BELLA'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark5">BELLA</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark6" value="and trademark = 'Binas'"
                                            <?php if($search_trademark=="and trademark = 'Binas'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark6">Binas</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark7" value="and trademark = 'Euro'"
                                            <?php if($search_trademark=="and trademark = 'Euro'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark7">Euro</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark8" value="and trademark = 'Hobu'"
                                            <?php if($search_trademark=="and trademark = 'Hobu'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark8">Hobu</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark9" value="and trademark = 'Luxury'"
                                            <?php if($search_trademark=="and trademark = 'Luxury'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark9">Luxury</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark10" value="and trademark = 'Miso'"
                                            <?php if($search_trademark=="and trademark = 'Miso'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark10">Miso</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark11" value="and trademark = 'Poplar'"
                                            <?php if($search_trademark=="and trademark = 'Poplar'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark11">Poplar</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark12" value="and trademark = 'Tabu'"
                                            <?php if($search_trademark=="and trademark = 'Tabu'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark12">Tabu</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="trademark" id="trademark13" value="and trademark = 'Woody'"
                                            <?php if($search_trademark=="and trademark = 'Woody'") echo 'checked="checked"';?>
                                            >
                                            <label for="trademark13">Woody</label>
                                        
                                    </li>
                                </ul>
                            </div>
                            <div class="row title-category-content">
                                <div class=" col-8 title-head">
                                    <h1>Khoảng giá</h1>
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <div style="height: 230px;overflow: auto;" class="category trademark">
                            
                                <ul class="list-category">
                                    <li class="link-list-category">                                   
                                            <input type="radio" name="search-price" id="price1" value=""
                                                <?php if($search_price=="") echo 'checked="checked"';?> 
                                            >
                                            <label for="price1">Tất cả</label>                                       
                                    </li>
                                    
                                    <li class="link-list-category">                                   
                                            <input type="radio" name="search-price" id="price1" value="and price BETWEEN '0' AND '100000'"
                                                <?php if($search_price=="and price BETWEEN '0' AND '100000'") echo 'checked="checked"';?> 
                                            >
                                            <label for="price1">Giá dưới 100.000đ</label>                                       
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="search-price" id="price2" value="and price BETWEEN '100000' AND '200000'"
                                                <?php if($search_price=="and price BETWEEN '100000' AND '200000'") echo 'checked="checked"';?>
                                            >
                                            <label for="price2">100.000đ-200.000đ</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="search-price" id="price3" value="and price BETWEEN '200000' AND '300000'"
                                                <?php if($search_price=="and price BETWEEN '200000' AND '300000'") echo 'checked="checked"';?>
                                            >
                                            <label for="price3">200.000đ-300.000đ</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="search-price" id="price4" value="and price BETWEEN '300000' AND '500000'"
                                                <?php if($search_price=="and price BETWEEN '300000' AND '500000'") echo 'checked="checked"';?>
                                            >
                                            <label for="price4">300.000đ-500.000đ</label>

                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="search-price" id="price5" value="and price BETWEEN '500000' AND '1000000'"
                                                <?php if($search_price=="and price BETWEEN '500000' AND '1000000'") echo 'checked="checked"';?>
                                            >
                                            <label for="price5">500.000đ-1.000.000đ</label>
                                        
                                    </li>
                                    <li class="link-list-category">
                                        
                                            <input type="radio" name="search-price" id="price6" value="and price >= '1000000'"
                                                <?php if($search_price=="and price >= '1000000'") echo 'checked="checked"';?>
                                            >
                                            <label for="price6">Giá trên 1.000.000đ</label>
                                        
                                    </li>
                                    
                                </ul>
                                
                            </div>
                            
                                <input class="search_product" type="submit" name="submit-search" value="search">

                            
                        </div>
                    </div>
                    <div class="col-9 all-product">
                        <div class="row header-all-product">
                            <h2><?php if($tukhoa!=""){ echo $tukhoa; }else{ echo 'Tất cả sản phẩm';} ?></h2>
                        </div >
                        <div class="container-search" >
                        <?php
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "
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
                <div class="col-1"></div>
            </div>
        </div>
    </div>





    <div style="margin-top: 100px;"class="fui-container footer">
        <!-- <div class="container"> -->
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
                                    <a href="liên_hệ">Liên hệ</a>
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
                                    <a href="liên_hệ">Liên hệ</a>
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
</form>
</body>
</html>
