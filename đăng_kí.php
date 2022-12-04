<?php
    include "config.php";
    
    if(isset($_POST["insert"])){
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = md5($_POST["password"]);
   
        
        if ($fullname == "" || $email == "" || $phone =="" || $address == "" || $password == "" ) {
            echo "Vui lòng nhập đầy đủ thông tin";
        }else{
            $sql = "select * from user where email='$email'";
            $check = mysqli_query($conn, $sql);
            if(mysqli_num_rows($check) > 0){
                echo "<h2 style='color: red'>Tài khoản email đã tồn tại</h2>";
            }else{
                $sql_1 = "insert into user(full_name,email,adress,phone_number,password) values (N'".$fullname."', '".$email."', N'".$address."', '".$phone."', '".$password."');";   
                if(mysqli_query($conn,$sql_1)){
                    echo "Đăng kí thành công";
                    header("Location: đăng_nhập.php");
                }
            }
        }
    }
?> 


<!-- 
<!DOCTYPE html> -->
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
    <link rel="stylesheet" href="style_link.css">
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
                        <form action="index.php" >
                            <input  type="text" id="form-input" class="form-control" placeholder="Nhập từ khóa tìm kiếm">
                            <a class="btn-search" href="#"><i class="fa fa-search"></i></a>
                        </form>
                    </div>
            
                    <div class="col-2 nav-right">
                        <div class="login">
                            <a href="đăng_kí.php">Đăng kí</a>
                            |
                            <a href="đăng_nhập.php">Đăng nhập</a>
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
                                <li class="nav-menu-list"><a href="#">giới thiệu <span></span></a></li>
                                <li class="nav-menu-list">
                                    <a href="sản_phẩm.php" class="sanpham">sản phẩm  <i style="font-size: 12px" class="ti-angle-down"></i> <span></span></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-menu-list">
                                            <a href="sofa.php">Sofa </a>
                                        </li>
                                        <li class="dropdown-menu-list"><a href="ghế.php">Ghế</a></li>
                                        <li class="dropdown-menu-list"><a href="trang_trí.php">Trang trí</a></li>
                                        <li class="dropdown-menu-list"><a href="kệ_sách.php">Kệ sách</a></li>
                                        <li class="dropdown-menu-list"><a href="bàn.php">Bàn </a></li>
                                        <li class="dropdown-menu-list"><a href="tủ_quần_áo.php">Tủ quần áo</a></li>
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
        <img src="./images/img-content.webp" height="215px" width="100%" alt="">
        <div class="content">
            <h1>Đăng kí tài khoản</h1>
            <a href="trang_chủ.php">Trang chủ</a>
            <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
            <span>Đăng kí tài khoản</span>
        </div>
    </div>

    <!-- --------------------------------------------------------- -->

    <div class="fui-container">
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 login-form">
                    <h3>Đăng kí tài khoản</h3>
                    <a href="#">
                        <img src="./images/fb-btn.svg" alt="">
                    </a>
                    <a href="#">
                        <img src="./images/gp-btn.svg" alt="">
                    </a>
                    <form class="form-signup" action="đăng_kí.php" method="post" id="form">
                        <input type="text" placeholder="Họ và tên" class="form-control login-form-control" id="name" name="fullname">
                        <input type="email" placeholder="Email" class="form-control login-form-control" id="email" name="email"> 
                        <input type="text" placeholder="Địa chỉ" class="form-control login-form-control" id="address" name="address"> 
                        <input type="text" placeholder="Số điện thoại" class="form-control login-form-control" id="call" name="phone">
                        <input type="password" placeholder="Mật khẩu" class="form-control login-form-control" id="password" name="password">
                        <div class="sign-in">
                            <button type="submit" class="signin" name="insert">Đăng Ký </button> 
                        </div>
                    </form>
                    <h3 id="error" style="color: red; text-align: center;font-size:15px;margin-top: 20px;"></h3>
                    <h3 id="result" style="color: green; text-align: center;font-size:20px;"></h3>
                </div>
                
                <div class="col-4"></div>
            </div>
        </div>
    </div>
   
    <div style="margin-top:60px" class="fui-container footer">
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
                                    <a href="trang_chủ.php">Trang chủ</a>
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



    <!-- <script type="text/javascript">
        //lay ra đôi tượng form
        var obj_form = document.getElementById('form');
        obj_form.addEventListener('submit', function() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var address = document.getElementById('address').value;
            var password = document.getElementById('password').value;
            var call = document.getElementById('call').value;
            var error = '';
            var result = '';
            if(name ==""){
                error="Không được bỏ trống name"
                document.getElementById('name').focus();
            }else if (email == '') {
                error = 'Không được để trống email';
                document.getElementById('email').focus();
            } else if (address == '') {
                error = 'Không được để trống địa chỉ';
                document.getElementById('address').focus();
            } else if (call == '') {
                error = 'Không đc để trống số điện thoại';
                document.getElementById('call').focus();
            }else if (password == '') {
                error = 'Không đc để trống mật khẩu';
                document.getElementById('password').focus();
            }

            
            if (error == '') {
                result ="Đăng ký thành công !"
            }
            //hiển thị lỗi và kết quả ra 2 thẻ h3
            document.getElementById('error').innerHTML = error;
            document.getElementById('result').innerHTML = result;
            //ngăn ngừa hành vi submit form sẽ tải lại trang
            event.preventDefault();
        });  -->
    </script>  
</body>
</html>