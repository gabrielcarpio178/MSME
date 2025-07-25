<?php

if(isset($_POST['btn_submit'])){
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    include '../model/dbh.class.php';
    include '../model/login.class.php';
    include '../controller/loginContr.class.php';

    $login = new LoginContr($email, $pwd);
    session_start();
    $user = $login->loginUser();
    
    $_SESSION['role'] = $user['role'];
    $_SESSION['email'] = $user['userData']['email'];
    $_SESSION['password'] = $user['userData']['password'];
    if($user['role']==="admin"){
        $_SESSION['id'] = $user['userData']['admin_id'];
        $_SESSION['name'] = $user['userData']['name'];
        header("Location: ../../pages/admin/dashboard.php");
    }
    if($user['role']==="supplier"){
        $_SESSION['id'] = $user['userData']['supplier_id'];
        $_SESSION['name'] = $user['userData'];
        header("Location: ../../pages/supplier/dashboard.php?content=dashboard");
    }
    if($user['role']==="rider"){
        $_SESSION['id'] = $user['userData']['rider_id'];
        $_SESSION['bussiness_name'] = $user['userData']['bussiness_name'];
        $_SESSION['owner_name'] = $user['userData']['owner_name'];
        header("Location: ../../pages/rider/dashboard.php");
    }
    if($user['role']==="customer"){
        $_SESSION['id'] = $user['userData']['customer_id'];
        $_SESSION['name'] = $user['userData']['name'];
        $_SESSION['image_profile'] = $user['userData']['image_profile'];
        header("Location: ../../index.php");
    }
    
}