
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
<!DOCTYPE html>
    <?php
          
          require_once("config.php");
          // Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
          if (isset($_POST["btn_submit"])) {
              // lấy thông tin người dùng
              $username = $_POST["username"];
              $password = md5($_POST["password"]);
              //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
              //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
              $username = strip_tags($username);
              $username = addslashes($username);
              $password = strip_tags($password);
              $password = addslashes($password);
              if ($username == "" || $password =="") {
                  echo "Tên đăng nhập hoặc mật khẩu của bạn không được để trống!";
              }else{
                  $sql = "select * from user where email ='$username' and password = '$password'";
                  $query = mysqli_query($conn,$sql);
                  $num_rows = mysqli_num_rows($query);
              if ($num_rows==0) {
                  echo "<h6 style='color:red; margin-top: 20px;text-align: center'>Tên đăng nhập hoặc mật khẩu của bạn không đúng!</h6>";
              }else{
                  //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
                  $_SESSION['username'] = $username;
                      // echo $_SESSION;
                          // Thực thi hành động sau khi lưu thông tin vào session
                          // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là trang_chủ.php
                  header('Location:trang_chủ.php');

              }
              }
          }
      ?>
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
                                        echo "<h6 style='width: 100px; overflow: hidden;text-overflow: ellipsis'>".$_SESSION['username']."</h6>";
                                        echo '
                                            <form action="trang_chủ.php" >
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
                                <li class="nav-menu-list"><a  href="#">giới thiệu <span></span></a></li>
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
                                                        echo "<li class='dropdown-menu-list'><a href='category_list.php?cate_id=".$row['cate_id']."'>".$row['cate_name']."</a></li>";
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
        <img src="./images/img-content.webp" height="215px" width="100%" alt="">
        <div class="content">
            <h1>Đăng nhập tài khoản</h1>
            <a href="trang_chủ.php">Trang chủ</a>
            <i style="font-size: 12px;padding: 0 5px;" class="ti-angle-right"></i>
            <span>Đăng nhập tài khoản</span>
        </div>
    </div>

    <!-- --------------------------------------------------------- -->

    <div  class="fui-container">
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 login-form">
                    <h3>Đăng nhập tài khoản</h3>
                    <a href="#">
                        <img src="./images/fb-btn.svg" alt="">
                    </a>
                    <a href="#">
                        <img src="./images/gp-btn.svg" alt="">
                    </a>
                    <form action="đăng_nhập.php" method="post" >
                        
                        <input class="form-control login-form-control" type="email" name="username" placeholder="Email" required>
                        <input class="form-control login-form-control" type="password" name="password" placeholder="Mật khẩu" required>
                        <div class="sign-in">
                            <button type="submit" class="signin" name="btn_submit">Đăng nhập</button> 
                        </div>

                    </form>
                    <span>
                        Bạn chưa có tài khoản, vui lòng đăng ký <a href="đăng_kí.php">tại đây</a>
                    </span>
  
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
</body>
</html>
 
