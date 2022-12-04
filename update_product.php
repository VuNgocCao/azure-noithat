<?php
	require "config.php";
	//update
		
		if (isset($_POST['update1'])) {
			$id=$_POST['product_id'];
			$title = $_POST["title"];
			$price = $_POST["price"];
			$description = $_POST["description"];
			$status="0";
			if(isset($_POST["status1"])){
				$status=$status."1";
			}
			if(isset($_POST["status2"])){
				$status=$status."2";
			}
			if(isset($_POST["status3"])){
				$status=$status."3";
			}
			$trademark= $_POST["trademark"];
			$target_dir = "images/";
			$target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
			if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file))
			{
				$sql = "update product set title=N'".$title."', price='".$price."',description=N'".$description."',status='".$status."',trademark='".$trademark."',thumbnail='".$target_file."'  where product_id='".$id."'";
				if ($conn->query($sql) === TRUE) {
					header("Location: product.php");
				  } else {
					echo "Error update record: " . $conn->error;
				  }
			} 
			else {
				echo "Sorry, there was an error uploading your file.";
			}
		}

?>
		




<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
		<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
	</head>
	<body>
		<div class="container">
			<h1 style="text-align: center; margin-top: 50px; color: #FF6600">Cập nhật sản phẩm</h1><br>
			<div class="row">
				<div class="col-3"></div>
				<form action="update_product.php" class="col-6" method="post" enctype="multipart/form-data">
					<?php
					
						if(isset($_GET["id"]))
						{
							$id = $_GET["id"];
							$sql = 'SELECT * FROM product where product_id="'.$id.'"';
							$result = mysqli_query($conn,$sql);
							if (mysqli_query($conn, $sql))
							{
								// output data of each row
								while($row = mysqli_fetch_assoc($result)) 
								{	
									echo "<input type='hidden' name='product_id' value='".$row["product_id"]."'>";
									echo "Cập nhật tên sản phẩm";
									echo "<input type='text' class='form-control' name='title' value='".$row["title"]."'><br>";
									echo "Cập nhật giá";
									echo "<input type='text' class='form-control' name='price' value='".$row["price"]."'><br>";
									echo "Cập nhật ảnh";
									echo "<input type='file' name='thumbnail' value'".$row["thumbnail"]."'><br>";
									echo "Cập nhật mô tả<br>";
									echo "<textarea name='description'>".$row["description"]."</textarea>
									<script>
											CKEDITOR.replace( 'description' );
									</script>";
									echo'
									<label >Nhập trạng thái :</label>
									<input type="checkbox" name="status1" value="1" >
									<label >Nổi Bật</label>
									<input type="checkbox" name="status2" value="2" >
									<label >Hot</label>
									<input type="checkbox" name="status3" value="3" >
									<label >New</label>
									</br>
									</br>';
									echo "<br>Cập nhật thương hiệu <br>";
									echo "<input type='text' class='form-control' name='trademark' value='".$row["trademark"]."'><br>";

								}
							}
						}
					?>
					
					<br><input style="width:200px;display: block; margin: auto" type="submit" name="update1" value="Cập nhật" class="btn btn-primary">
				</form>
				<div class="col-3"></div>
			</div>
			
		</div>
		
	</body>
</html>