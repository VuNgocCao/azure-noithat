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
		header("Location:login_cate_admin.php");
	}
    if(isset($_POST["insert"]))
    {
        $name=$_POST["Cate_Name"];
        $status=$_POST["cate_status"];
		$sql = "insert into category(cate_name,cate_status) values(N'".$name."',".$status.")";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            header("Location:category.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
    //delete
    if(isset($_GET["task"]) && $_GET["task"]=="delete"){
        $cate_id = $_GET["cate_id"];
        $sql = "DELETE FROM category WHERE cate_id=".$cate_id;
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; margin-top: 50px; color: #FF6600">Danh Mục Sản Phẩm</h1>
        <div class="row">
            <div class="col-3"></div>
            <form style="margin-top: 50px" action="category.php" class="col-6" method="post">

                <div class="row">
                    <h3 style="text-align: center; display: block;">Nhập tên danh mục</h3>
                    <input style="width: 70%; display: block; margin: auto" type="text" class="form-control" name="Cate_Name">
                    <h3 style="text-align: center; display: block;">Nhập trạng thái</h3>
                    <input style="width: 70%; display: block; margin: auto" type="text" class="form-control" name="cate_status">  
                </div><br>
                <input style="display: block; margin: auto" type="submit" name="insert" value="Thêm mới" class="btn btn-primary"><br><br>
            </form>
            <div class="col-3"></div>
        </div>
        <table style="margin-top: 50px;" class="table table-striped">
            <tr>
                <th>Mã Danh Mục</th>
                <th>Tên Danh Mục</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            <?php
                $sql = "SELECT * FROM category order by cate_id DESC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
            ?>

                        <tr>
                            <td><?php echo $row["cate_id"] ?></td>
                            <td><?php echo $row["cate_name"] ?></td>
                            <td><?php echo $row["cate_status"] ?></td>
                            <td>
                                <a class="btn btn-warning" href="update_category.php?id=<?php echo $row["cate_id"]?>">
                                    Sửa
                                </a>
                                <a onclick="return del('<?php echo $row['cate_name'] ?>')" href="category.php?task=delete&cate_id=<?php echo $row["cate_id"]?>" class="btn btn-danger">
                                    Xóa
                                </a> 
                            </td>
                        </tr>
            <?php
                    }
                } else {
                echo "0 results";
                }
            ?>
        </table>
        
    </div><br><br>
    <script>
			function del(name){
				return confirm("Bạn có chắc muốn xóa danh mục: "+name+" này ?");
			}
	</script>
</body>
</html>
