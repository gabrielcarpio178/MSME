<?php

class LoginContr extends Login{
    private $email;
    private $pwd;

    public function __construct($email, $pwd){
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function loginUser(){
        if ($this->checkIfEmpty()) {
            header("Location: ../../index.php?message=email and password is required");
            return;
        }
        if($this->getAdmin($this->email, $this->pwd)['isLogin']===1){
            $admin = $this->getAdmin($this->email, $this->pwd);
            return $admin;
        }
        if($this->getCustomer($this->email, $this->pwd)['isLogin']===1){
            $customer = $this->getCustomer($this->email, $this->pwd);
            return $customer;
        }
        if($this->getRider($this->email, $this->pwd)['isLogin']===1){
            $rider = $this->getRider($this->email, $this->pwd);
            return $rider;
        }
        if($this->getSupplier($this->email, $this->pwd)['isLogin']===1){
            $supplier = $this->getSupplier($this->email, $this->pwd);
            return $supplier;
        }
        header("Location: ../../index.php?message=wrong password or email&&email=".$this->email."&&password=".$this->pwd);
        return;
    }

    public function checkIfEmpty(){
        return empty($this->email) || empty($this->pwd);
    }



}