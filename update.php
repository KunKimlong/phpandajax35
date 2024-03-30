<?php 

    $connection = new mysqli('localhost','root','','db-php-3-5');

    $id = $_POST['update_id'];
    $name = $_POST['update_name'];
    $gender = $_POST['update_gender'];
    $salary = $_POST['update_salary'];
    $profile = $_POST['update_profile'];

    $sql = "UPDATE `tbl_ajax` SET `name`='$name',`gender`='$gender',`salary`='$salary',`profile`='$profile' WHERE `id` = $id";

    $rs = $connection->query($sql);
    if($rs){
        echo 'success';
    }