<?php 
    $name = ''; 
    $email = '';
    $gender = '';
    $status = '';
    if(isset($_POST['name'])) $name = $_POST['name'];
    if(isset($_POST['email'])) $email = $_POST['email'];
    if(isset($_POST['gender'])) $gender = $_POST['gender'];
    if(isset($_POST['status'])) $status = $_POST['status'];

    echo "Name: $name <br> Email: $email <br> Gender: $gender <br> Status: $status";
?>