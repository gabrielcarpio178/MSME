<?php

class Login extends Dbh{
    protected function getAdmin($email, $pwd){
        $stmt = $this->connect()->prepare('SELECT * FROM `admin` WHERE `email` = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user || !password_verify($pwd, $user['password_hash'])) {
            return ["isLogin"=>0];
        } else {
            return ["role"=>"admin", "isLogin"=>1, "userData"=>$user];
        }
    }
    protected function getCustomer($email, $pwd){
        $stmt = $this->connect()->prepare('SELECT * FROM `customer` WHERE `email` = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user || !password_verify($pwd, $user['password_hash'])) {
            return ["isLogin"=>0];
        } else {
            return ["role"=>"customer", "isLogin"=>1, "userData"=>$user];
        }
    }
    protected function getRider($email, $pwd){
        $stmt = $this->connect()->prepare('SELECT * FROM `rider` WHERE `email` = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user || !password_verify($pwd, $user['password_hash'])) {
            return ["isLogin"=>0];
        } else {
            return ["role"=>"rider", "isLogin"=>1, "userData"=>$user];
        }
    }
    protected function getSupplier($email, $pwd){
        $stmt = $this->connect()->prepare('SELECT * FROM `supplier` WHERE `email` = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user || !password_verify($pwd, $user['password_hash'])) {
            return ["isLogin"=>0];
        } else {
            return ["role"=>"supplier", "isLogin"=>1, "userData"=>$user];
        }
    }
}