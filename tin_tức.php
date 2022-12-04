
<?php 
    session_start();
	if(isset($_GET["task"]) && $_GET["task"]=="logout")
	{
		session_destroy();
		header("Location:trang_chủ.php");
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
        <a href="trang_chủ.">Trang chủ</a>
        <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
        <span>Tin tức</span>
    </div>
</div>

 
 <!-- main content -->
 
     <div class="fui-container main-content">
         <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div style="margin-left: 10px;flex-wrap: nowrap;" class="row title-top-menu">
                        <div class="col-2 product">
                            <h3>Tin tức</h3>
                        </div>
                    </div>
                    <div class="row grid-container1">
                        <div class="blog_index">
                            <a class="link_blog_index" href="">
                                <img src="./images/blog-grid-11.webp" alt="">
                                <span>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    <b>28/08/2019</b> Đăng bởi: <b>DNMC</b>
                                </span>
                                <div class="info_blog_index">
                                    <h3>Mẹo bảo quản & vệ sinh các đồ nội thất</h3>
                                    <p> Đối với nội thất bằng kim loại 
                                        - Khi xử lý các vết bẩn thông thường, bạn chỉ cầ...</p>
                                </div>
                            </a>
                        </div>
                        <div class="blog_index">
                            <a class="link_blog_index" href="">
                                <img src="./images/blog-grid-15.webp" alt="">
                                <span>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    <b>28/08/2019</b> Đăng bởi: <b>DNMC</b>
                                </span>
                                <div class="info_blog_index">
                                    <h3>Thư thái trong chính căn hộ của bạn</h3>
                                    <p>  Nét thư thái và thanh lịch là cảm nhận đầu tiên mà Nhà nghĩ tới khi kể cho khách ...</p>
                                </div>
                            </a>
                        </div>
                        <div class="blog_index">
                            <a class="link_blog_index" href="">
                                <img src="./images/dining-suite-for-sale.webp" alt="">
                                <span>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    <b>28/08/2019</b> Đăng bởi: <b>DNMC</b>
                                </span>
                                <div class="info_blog_index">
                                    <h3>Bảo quản đồ gỗ khi độ ẩm không khí cao</h3>
                                    <p>  Đồ nội thất bằng gỗ chất lượng cao là một sự đầu tư tuyệt vời để trang trí ngôi n...</p>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                    <div style="margin-top: 20px;" class="row grid-container1">
                        <div class="blog_index">
                            <a class="link_blog_index" href="">
                                <img src="./images/stefan-stefancik-unsplash.webp" alt="">
                                <span>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    <b>28/08/2019</b> Đăng bởi: <b>DNMC</b>
                                </span>
                                <div class="info_blog_index">
                                    <h3>Chọn kích thước bàn ăn như nào cho phù hợp?</h3>
                                    <p> Chiều cao tiêu chuẩn của bàn ăn phụ thuộc vào chiều cao trung bình của người sử d...</p>
                                </div>
                            </a>
                        </div>
                        <div class="blog_index">
                            <a class="link_blog_index" href="">
                                <img src="./images/tu-tu-unsplash-1.webp" alt="">
                                <span>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    <b>28/08/2019</b> Đăng bởi: <b>DNMC</b>
                                </span>
                                <div class="info_blog_index">
                                    <h3>Nhà đẹp không thể thiếu những món decor này</h3>
                                    <p> Đồ decor luôn là một nhân tố không thể thiếu trong không gian nội thất, bởi lẽ ch...</p>
                                </div>
                            </a>
                        </div>
                        <div class="blog_index">
                            <a class="link_blog_index" href="">
                                <img src="./images/bags-books-design-683929.jpg" alt="">
                                <span>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                    <b>28/08/2019</b> Đăng bởi: <b>DNMC</b>
                                </span>
                                <div class="info_blog_index">
                                    <h3>Có nên dùng gỗ công nghiệp cho đồ nội thất ?</h3>
                                    <p> Đối với không ít người, việc lựa chọn đồ gỗ nội thất là một việc cực kỳ đau đầu, ...</p>
                                </div>
                            </a>
                        </div>  
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
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