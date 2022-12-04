<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="./backend.css">
	</head>
	<body>
		<div class="container">
			<h1 style="text-align: center; margin-top: 50px; color: #FF6600">Đăng nhập</h1><br>
			<div class="row">
                <div class="col-3"></div>
				<form action="login_admin.php" class="col-6" method="post">
					<div class="text-field">
						<label for="username1">Username</label>
						<input autocomplete="off" name="email" type="email" id="username1" placeholder="Enter your username" />
					</div><br>
					<div class="text-field">
						<label for="username1">Password</label>
						<input autocomplete="off" name="password" type="password" id="username1" placeholder="Enter your username" />
					</div><br>
                    <button  type="submit" name="login" class="tiktok">Đăng nhập</button>
				</form>
                <div class="col-3"></div>
			</div>
			
		</div>
		
	</body>
</html>
<?php
	require "config.php";
	session_start();
	if(isset($_POST["login"]))
	{
		$email = $_POST["email"];
		$pa = $_POST["password"];
		$sql = "select * from admin where email='".$email."' and password = '".$pa."'";
								
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$_SESSION["email"] = $email;
				header("Location:list_login.php");
			}
		}    
		else {
			echo "<h4 style='color:red; text-align:center'>Sai tên đăng nhập hoặc mật khẩu</h4>";
		}
	}
?>