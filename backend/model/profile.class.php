<?php

class Profile extends Dbh{
    protected function getEmailSupplier($email, $user_id){
        $stmt = $this->connect()->prepare("SELECT `email` FROM `supplier` WHERE `supplier_id` != ?");
        $stmt->execute([$user_id]);
        $resemails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resemails as $emails) {
            if (strtolower($emails['email']) === strtolower($email)) {
                return true;  // Email already exists, update not allowed
            }
        }
        return false;  
    }

    protected function getPhoneSupplier($phone, $user_id){
        $stmt = $this->connect()->prepare("SELECT `phone` FROM `supplier` WHERE `supplier_id` != ?");
        $stmt->execute([$user_id]);
        $resphones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resphones as $phones) {
            if (strtolower($phones['phone']) === strtolower($phone)) {
                return true;  // phone already exists, update not allowed
            }
        }
        return false;  
    }

    protected function getProfileImage($role, $userId){
        $sql = "";
        if($role==='supplier'){
            $sql = "SELECT `image_profile` FROM `supplier` WHERE `supplier_id` = ?";
        } else if($role==='rider'){
            $sql = "SELECT `image_profile` FROM `rider` WHERE `rider_id` = ?";
        }else if($role==="customer"){
            $sql = "SELECT `image_profile` FROM `customer` WHERE customer_id = ?";
        }

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);
        $resImage = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resImage['image_profile'];
    }

    protected function checkOldPassword($old, $user_id, $role){
        $sql = "";
        if($role==='supplier'){
            $sql = "SELECT `password_hash` FROM `supplier` WHERE `supplier_id` = ?";
        } else if($role==='rider'){
            $sql = "SELECT `password_hash` FROM `rider` WHERE `rider_id` = ?";
        }else if($role==="customer"){
            $sql = "SELECT `password_hash` FROM `customer` WHERE customer_id = ?";
        }
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $oldpassword = $stmt->fetch(PDO::FETCH_ASSOC);
        return !password_verify($old, $oldpassword['password_hash']);
    }

    protected function editProfileSupplier($user_id, $bussiness_name, $owner_name, $phone, $address, $profile_img ,$email, $pwd){
        $stmt = $this->connect()->prepare("UPDATE `supplier` SET `bussiness_name`= ?,`owner_name`=?,`email`=?,`password_hash`=?,`address`=?,`phone`=?,`image_profile`=? WHERE `supplier_id` = ?");
        return $stmt->execute([$bussiness_name, $owner_name, $email, password_hash($pwd,PASSWORD_DEFAULT), $address, $phone, $profile_img, $user_id]);
    }
}