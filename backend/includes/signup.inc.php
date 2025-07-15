<?php

if(isset($_POST['btn_submit'])){
    $role = $_POST['role'];
    include('../model/dbh.class.php');
    include('../model/signup.class.php');
    include('../controller/signupContr.class.php');
    //add customer account
    if($role==="customer"){
        //get data from frontend
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['con-pwd'];
        //instantiate class for signupCustomer
        $customer = new SignUpCustomer($name, $address, $phone, $email, $pwd, $cpwd);
        //call signupCustomer function
        $customer->signupCustomer();
    }
    //add customer account
    if($role==="supplier"){
        // print_r($_POST);
        $bname = $_POST['bname'];
        $oname = $_POST['oname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['con-pwd'];
        //instantiate class for signupCustomer
        $supplier = new SignUpSupplier($bname, $oname, $address, $phone, $email, $pwd, $cpwd);
        //call signupSupplier function
        $supplier->signupSuplier();
    }
}