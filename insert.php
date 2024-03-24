<?php 
    
    $connection = new mysqli('localhost','root','','db-php-3-5');

    $name = $_POST['insert_name'];
    $gender = $_POST['insert_gender'];
    $salary = $_POST['insert_salary'];
    $profile = $_POST['insert_profile'];
    // echo $name.$gender.$salary.$profile;
    $sql = "INSERT INTO `tbl_ajax` VALUES(null,'$name','$gender','$salary','$profile')";
    $rs  = $connection->query($sql);

    if($rs){
        $rs2 = $connection->query('SELECT * FROM `tbl_ajax` ORDER BY `id` DESC LIMIT 1');
        $row = mysqli_fetch_assoc($rs2);
        echo $row['id'];
    }

