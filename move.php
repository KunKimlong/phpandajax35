<?php 

    $profile = $_FILES['profile']['name'];
    $profile = rand(1,99999).'-'.$profile;
    $path = 'Image/'.$profile;

    move_uploaded_file($_FILES['profile']['tmp_name'],$path);
    echo $profile;
