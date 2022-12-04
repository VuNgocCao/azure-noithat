
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                <li class="nav-menu-list"><a style="color: #f7941d" href="liên_hệ.php">liên hệ <span></span></a></li>
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
            <h1>Liên hệ</h1>
            <a href="trang_chủ.php">Trang chủ</a>
            <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
            <span>Liên hệ</span>
        </div>
    </div>

      
    <!-- Main content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-3 contact">
                        <div class="contact-list">
                            <ul>
                                <li  class="contact-list-child contact-email">
                                    <span>
                                        <i style="border-radius: 50%" class="ti-map-alt"></i>
                                        <p>Số 18 Phố Viên - Phường Đức Thắng - Quận Bắc Từ Liêm - Hà Nội</+span>
                                    </span>   
                                </li>
                                
                                <li class="contact-list-child contact-email">
                                    <i class="ti-mobile"></i>
                                    <span>19006750</span>
                                </li>
                                
                                <li class="contact-list-child contact-email">
                                    <i class="ti-comment" aria-hidden="true"></i>
                                    <span>admin@gmail.com</span>
                                </li>
                            </ul>
                        </div>
    
                        <h5 style="margin-top: 50px;">Liên hệ</h5>
                        <div class="contact-form">
                            <form id="insert_data" method="post">
                                <input id="txthoten" type="text" placeholder="Họ và tên">
                                <?php 
                                    if(!$_SESSION){
                                        echo '<input id="txtemail" type="email" placeholder="Email">';
                                    }
                                    else{
                                        echo '<input id="txtemail" type="email" value ="'.$_SESSION['username'].'">';
                                    }
                                ?>
                                <input style="height: 100px" id="txtcontent" placeholder="Nội dung" name="" type="text" ></input> 
                                <!-- cols="30" rows="5" -->
                                <br>
                                <!-- <button id="button_submit" type="submit">Gửi liên hệ</button> -->
                                <input style="width:40%; color:white;background-color:#f7941d; " class="btn btn-warning" id="button_submit" type="button" name="insert_data" value="Gửi liên hệ">
                            </form>
                        </div>
                    </div>
                    <script type="text/javascript">
                            $(document).ready(function(){                              
                                // insert dữ liệu
                                $('#button_submit').on('click',function(){
                                    var hoten = $('#txthoten').val();
                                    var email = $('#txtemail').val();
                                    var content = $('#txtcontent').val();
                                    if(hoten == '' || email == '' || content == '' ){
                                        alert('Hãy điền đầy đủ thông tin.')
                                    }else{
                                        $.ajax({
                                            url: "xuly_lienhe.php",
                                            method: "POST",
                                            data: {hoten:hoten, email:email, content: content},
                                            success: function(data){
                                                alert("Cảm ơn bạn đã gửi lại phản hồi");
                                                $('#insert_data')[0].reset(); // làm mới lại các thẻ input

                                            }
                                        });
                                    }
                                })
                            });
                        </script>       
                    <div class="col-7 map-address">
                        <div class="gg-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.0174616877957!2d105.77172461493335!3d21.07196478597495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134552defbed8e9%3A0x1584f79c805eb017!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBN4buPIC0gxJDhu4thIGNo4bqldA!5e0!3m2!1svi!2s!4v1633485448715!5m2!1svi!2s" width="750" height="550" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
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
    </body>
</html>