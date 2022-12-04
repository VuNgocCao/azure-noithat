<!DOCTYPE html>
<html>
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
    <title>Register</title>
	<!-- Latest compiled and minified CSS -->
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./backend.css">
</head>
<body>
	<div class="container register">
		<div style="margin-top: 50px" class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Đăng kí tài khoản</h2>
			</div>
			<div style="display: block; margin: auto;" class="panel-body">
				<div class="form-group">
				  <label for="usr">Họ & tên:</label>
				  <input required="true" type="text" class="form-control" id="usr">
				</div>
				<div class="form-group">
				  <label for="email">Email:</label>
				  <input required="true" type="email" class="form-control" id="email">
				</div>
                <div class="form-group">
				  <label for="address">Địa chỉ:</label>
				  <input type="text" class="form-control" id="address">
				</div>
                <div class="form-group">
				  <label for="phone">Số điện thoại:</label>
				  <input type="text" class="form-control" id="phone">
				</div>
				<div class="form-group">
				  <label for="pwd">Mật khẩu:</label>
				  <input required="true" type="password" class="form-control" id="pwd">
				</div>
				<div class="form-group">
				  <label for="confirmation_pwd">Nhập lại mật khẩu</label>
				  <input required="true" type="password" class="form-control" id="confirmation_pwd">
				</div>
				
				<button style="margin: auto; display: block" class="btn btn-success">Đăng kí</button>
			</div>
		</div>
	</div>
</body>
</html>