<?php
include "config.php";
//Thêm mới nhân viên
if(isset($_POST["hoten"])){
    $hoten = $_POST["hoten"];
    $content = $_POST["content"];
    $email = $_POST["email"];
    $sql1 = "insert into contact(hoten, email,content) values(N'".$hoten."', '".$email."', '".$content."')" ;
    $result = mysqli_query($conn, $sql1); 
    if($result){
        echo "Success";
    }else{
        echo "Failed";
    }

}

?>