<?php

class Signup extends Dbh{
    protected function getEmailCustomer($email){
        $stmt = $this->connect()->prepare("SELECT `email` FROM `customer` WHERE `email` = ?");
        $stmt->execute([$email]);
        $resemail = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resemail !== false;  
    }

    protected function getPhoneCustomer($phone){
        $stmt = $this->connect()->prepare("SELECT `phone` FROM `customer` WHERE `phone` = ?");
        $stmt->execute([$phone]);
        $resphone = $stmt->fetch(PDO::FETCH_ASSOC);
       return $resphone !== false;
    }

    protected function addCustomer($name, $address, $phone, $email, $pwd){
        $stmt = $this->connect()->prepare("INSERT INTO `customer`(`name`, `email`, `password_hash`, `address`, `phone`) VALUES (?,?,?,?,?)");
        $stmt->execute([$name, $email, password_hash($pwd, PASSWORD_DEFAULT), $address, $phone]);
    }

    protected function getEmailSupplier($email){
        $stmt = $this->connect()->prepare("SELECT `email` FROM `supplier` WHERE `email` = ?");
        $stmt->execute([$email]);
        $resemail = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resemail !== false;  
    }

    protected function getPhoneSupplier($phone){
        $stmt = $this->connect()->prepare("SELECT `phone` FROM `supplier` WHERE `phone` = ?");
        $stmt->execute([$phone]);
        $resphone = $stmt->fetch(PDO::FETCH_ASSOC);
       return $resphone !== false;
    }


     protected function addSupplier($bname, $oname, $address, $phone, $email, $pwd){
        $stmt = $this->connect()->prepare("INSERT INTO `supplier`(`bussiness_name`, `owner_name`, `email`, `password_hash`, `address`, `phone`) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$bname, $oname, $email, password_hash($pwd, PASSWORD_DEFAULT), $address, $phone]);
    }
    
    
}