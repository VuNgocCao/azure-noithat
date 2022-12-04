<?php
	require "config.php";
	session_start();
	if(!$_SESSION["email"])
	{
		header("Location:login_admin.php");
	}
	else
	{
		echo '<div style="right: 0;position: absolute;top: 10px;display: flex;flex-direction: column;align-items: center">
				<h4 style="color: #FF6600">Xin chào: '.$_SESSION["email"].'</h4>
				<a style="background-color: #f7941d; padding: 10px 20px;width: 200px; border-radius: 10px; text-decoration: none;text-align: center; font-size: 18px; color: #fff" href="login_admin.php?task=logout">Đăng xuất</a>
			</div>';
	}
	if(isset($_GET["task"]) && $_GET["task"]=="logout")
	{
		session_destroy();
		header("Location:login_product_admin.php");
	}
	//insert
	if(isset($_POST["insert"]))
	{
		$product_id = $_POST["product_id"];
		$cate_id = $_POST["cate_id"];
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
			$sql = "insert into product(product_id, cate_id,title,price,thumbnail,description,status,trademark) values('".$product_id."',".$cate_id.",N'".$title."',N'".$price."','".$target_file."',N'".$description."',".$status.",N'".$trademark."')";
			if (mysqli_query($conn, $sql)) {
			  echo "New record created successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		} 
		else {
			echo "Sorry, there was an error uploading your file.";
		}
	}  
    // delete
    if(isset($_GET["task"]) && $_GET["task"]=="delete"){
        $product_id = $_GET["product_id"];
        $sql = 'DELETE FROM product WHERE product_id="'.$product_id.'"';
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
		<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <title>DNMC</title>
		<style>
			input,select{
				margin: 10px 0;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h1 style="text-align: center; margin-top: 50px; color: #FF6600">Quản trị sản phẩm</h1>
			<div class="row">
				<div class="col-3"></div>
				<form style="text-align:center; margin-top: 50px" action="product.php" class="col-6" method="post" enctype="multipart/form-data">
					Nhập vào mã sản phẩm
					<input type="text" class="form-control" name="product_id">
					Chọn danh mục sản phẩm
					<select name="cate_id" class="form-control">
						<?php
							$sql = "SELECT * FROM category order by cate_id DESC";
						
							$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($result) > 0) {
							  // output data of each row
							  while($row = mysqli_fetch_assoc($result)) 
							  {
								  echo "<option value='".$row["cate_id"]."'>".$row["cate_name"]."</option>";
							  }
							}
						?>
						
					</select>
					<br>
					Nhập vào tên sản phẩm
					<input type="text" class="form-control" name="title">
					Nhập vào giá sản phẩm
					<input type="text" class="form-control" name="price">
					Mô tả sản phẩm
					<textarea name="description"></textarea>
					<script>
							CKEDITOR.replace( 'description' );
					</script><br>
					Chọn ảnh đại diện cho sản phẩm
					<input type="file" name="thumbnail"><br><br>		
					<label >Nhập trạng thái :</label>
					<input type="checkbox" name="status1" value="1" >
					<label >Nổi Bật</label>
					<input type="checkbox" name="status2" value="2" >
					<label >Hot</label>
					<input type="checkbox" name="status3" value="3" >
					<label >New</label>
						</br>
						</br>
					Nhập thương hiệu sản phẩm
					<input class="form-control" type="text" name="trademark" ><br>
					<div style="display: flex;">
                        <input style="width: 40%;heigh: 50px; margin: auto" type="submit" name="insert" value="Thêm mới" class="btn btn-primary"><br><br>
                    </div><br>
                    <div style="display: flex">
                        <input style="width: 70%" type="text" class="form-control" name="txt_search">
                        <input type="submit" style="width: 30%; margin-left: 5px" name="btn_search" class="btn btn-primary" value="Tìm kiếm">
                    </div>
                    
				</form>
				<div class="col-3"></div>

			</div>

			<table class="table table-striped" style="margin-bottom: 50px;">
				<tr>
					<th>Mã sản phẩm</th>
					<th>Mã danh mục</th>
					<th>Tên sản phẩm</th>
					<th>Giá</th>
					<th>Ảnh</th>
					<th>Mô tả</th>
					<th>Trạng thái</th>
					<th>Thương hiệu</th>
					<th>Hành động</th>
				</tr>
				<?php

					$sql = "";
										
					if(isset($_POST["btn_search"]))
					{
						$txt_search = $_POST["txt_search"];
						
						$sql = "select * from product where title like '%".$txt_search."%'";

					}
					else
					{
						$sql = "select * from product";
							
					}

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) { ?>
							<tr>
								<td><?php echo $row["product_id"]; ?></td>
								<td><?php echo $row["cate_id"]; ?></td>	
								<td><?php echo $row["title"]; ?></td>
								<td><?php echo $row["price"]; ?></td>
								<td><?php echo "<img style='width:200px;height:200px;' src='".$row["thumbnail"]."'/>"?></td>
								<td><?php echo $row["description"]; ?></td>
								<td><?php echo $row["status"]; ?></td>
								<td><?php echo $row["trademark"]; ?></td>
								<td>
									<a class="btn btn-warning" href="update_product.php?id=<?php echo $row["product_id"]; ?>">
									Sửa</a>
									<a onclick="return del('<?php echo $row['title']; ?>')" href="product.php?task=delete&product_id=<?php echo $row["product_id"] ?>" class='btn btn-danger'>Xóa</a>
								</td>

							</tr>
							
						
						<?php	}
						} else {
							echo "0 results";
						} 
						?>
                    
					
			</table>
		</div>
		<script>
			function del(name){
				return confirm("Bạn có chắc muốn xóa sản phẩm: "+name+" này ?");
			}
		</script>
	</body>
</html>
