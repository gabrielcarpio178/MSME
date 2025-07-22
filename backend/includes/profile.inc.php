<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();
    include('../model/dbh.class.php');
    include('../model/profile.class.php');
    include('../controller/profileContr.class.php');

    //get data from frontend
    $user_id = $_SESSION['id'];
    $role = $_SESSION['role'];
    $bussiness_name = $_POST['bussiness_name'];
    $owner_name = $_POST['owner_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $opwd = $_POST['opassword'];
    $pwd = $_POST['password'];
    $cpwd = $_POST['cpassword'];
    $image = $_FILES['profile_img'];
    
    //instantiate class for profileContr
    $profile = new ProfileContr($user_id, $role, $bussiness_name, $owner_name, 
    $phone, $address, $image, $email, $opwd ,$pwd, $cpwd);
    $result = $profile->editProfile();
    if($result['result']==="update success"){
        $_SESSION['name']['owner_name'] = $owner_name;
        $_SESSION['name']['bussiness_name'] = $bussiness_name;
        $_SESSION['name']['phone'] = $phone;
        $_SESSION['name']['email'] = $email;
        $_SESSION['name']['address'] = $address;
        $_SESSION['name']['image_profile'] = $result['profile_name'];
        echo $result['result'];
    }else{
        echo $result['result'];
    }
}