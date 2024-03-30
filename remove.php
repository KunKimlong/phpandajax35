<?php 

    $connection = new mysqli('localhost','root','','db-php-3-5');

    $remove_id =$_POST['remove_id'];

    $rs = $connection->query("DELETE FROM `tbl_ajax` WHERE `id` = '$remove_id'");
    if($rs){
        echo 'success';
    }

    