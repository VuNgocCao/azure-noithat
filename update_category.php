<?php
	require "config.php";
	
	//update
	if(isset($_POST["update"]))
	{	
		$cate_id=$_POST["cate_id"];
		$cate_name = $_POST["Cate_Name"];
		$cate_status=$_POST["cate_status"];
		$sql = "update category set cate_name=N'".$cate_name."', cate_status='".$cate_status."'  where cate_id='".$cate_id."'";
		if ($conn->query($sql) === TRUE) {
		  header("Location: category.php");
		} else {
		  echo "Error update record: " . $conn->error;
		}
	}
?>

<html>
	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<h1 style="text-align: center; margin-top: 50px; color: #FF6600">Cập Nhật Danh Mục Sản Phẩm</h1>
			<div class="row">
				<div class="col-3"></div>
				<form action="update_category.php" class="col-6" method="post">
					<?php
					
						if(isset($_GET["id"]))
						{
							$id = $_GET["id"];
							//echo $id;
							$sql = "SELECT * FROM category where cate_id=".$id;
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) 
							{
								// output data of each row
								while($row = mysqli_fetch_assoc($result)) 
								{	
									echo "<input type='hidden' name='cate_id' value='".$row["cate_id"]."'>";
									echo '<br><h3 style="text-align: center; display: block;">Cập nhật tên danh mục</h3><br>';
									echo "<input type='text' class='form-control' name='Cate_Name' value='".$row["cate_name"]."'><br>";
									echo '<h3 style="text-align: center; display: block;">Cập nhật trạng thái</h3><br>';
									echo "<input  type='text' class='form-control' name='cate_status' value='".$row["cate_status"]."'>";
								}
							}
						}
					?>
					
					<br><input style="width: 200px; display: block; margin: auto" type="submit" name="update" value="Cập nhật" class="btn btn-primary">
				</form>
				<div class="col-3"></div>
			</div>
			
		</div>
		
	</body>
</html>