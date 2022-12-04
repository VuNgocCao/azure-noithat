<?php
    require "config.php";
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
                         <img src="./images/logo.png" alt="">
                     </div>
                   
                     <div class="col-6 nav-center">
                         <form action="index.php">
                            <input type="text" id="form-input" class="form-control search-box" placeholder="Nhập từ khóa tìm kiếm">
                            <a class="btn-search" href="index.php"><i class="fa fa-search" aria-hidden="true"></i></a>
                         </form>
                     </div>
           
                     <div class="col-2 nav-right">
                        <div class="login">
                            <a href="đăng_kí.php">Đăng kí</a>
                            |
                            <a href="đăng_nhập.php">Đăng nhập</a>
                            <a class="dolly" href="#">
                                <i class="fa fa-shopping-cart"></i>
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
                                 <li class="nav-menu-list"><a href="giới_thiệu.php">giới thiệu <span></span></a></li>
                                 <li class="nav-menu-list">
                                     <a href="sản_phẩm.php" class="sanpham">sản phẩm   <i style="font-size: 12px" class="ti-angle-down"></i> <span></span></a>
                                     <ul class="dropdown-menu">
                                         <li class="dropdown-menu-list">
                                             <a href="sofa.php">Sofa </a>
                                         </li>
                                         <li class="dropdown-menu-list"><a href="ghế.php">Ghế</a></li>
                                         <li class="dropdown-menu-list"><a href="#">Trang trí</a></li>
                                         <li class="dropdown-menu-list"><a href="kệ_sách.php">Kệ sách</a></li>
                                         <li class="dropdown-menu-list"><a href="bàn.php">Bàn </a></li>
                                         <li class="dropdown-menu-list"><a href="tủ_quần_áo.php">Tủ quần áo</a></li>
                                     </ul>
                                 </li>
                                 <li class="nav-menu-list"><a href="tin_tức.php" style="color: #f7941d">tin tức<span></span></a></li>
                                 <li class="nav-menu-list"><a href="liên_hệ.php">liên hệ <span></span></a></li>
                             </ul>
                      </div>
                     </div>
                     <!-- Hotline -->
                     <div class="col-2 hotlines">
                             <ul class="hotline">
                                 <li>
                                     <span>
                                         <i class="	fa fa-headphones" aria-hidden="true"></i>
                                         Hotline:
                                     </span>
                                     <a href="#"> 19006750</a>
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
        <h1>Tin tức</h1>
        <a href="trang_chủ.php">Trang chủ</a>
        <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
        <span>Tin tức</span>
    </div>
</div>

<div style="margin-top: 100px;"class="fui-container footer">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
            <?php
                    $sql="";
					if(isset($_POST["btn_search"])){
                        $txt_search=$_POST["txt_search"];
                        $sql = "select * from product where title like '%".$txt_search."%'";
                    }
                    else{
                        $sql = "select * from product";		
                    }
                    $result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
						// output data of each row
							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
                                    echo "<td>".$row["product_id"]."</td>";
                                    echo "<td>".$row["cate_id"]."</td>";
                                    echo "<td>".$row["title"]."</td>";
                                    echo "<td>".$row["price"]."</td>";
                                    echo "<td>".$row["description"]."<td>";
                                    echo "<td><img style='width:100px;height:100px;' src='".$row["thumbnail"]."'/></td>";
                                    echo "<td><a href='product.php?task=delete&product_id=".$row["product_id"]." class='btn btn-primary'>Xóa</a> </td>";
								echo "</tr>";
							}
						} else {
							echo "0 results";
						}
				?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</div>

<div style="margin-top: 100px;"class="fui-container footer">
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
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
 
 </body>
</html>

