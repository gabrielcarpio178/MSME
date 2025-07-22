<?php 

class ProfileContr extends Profile{

    private $bussiness_name;
    private $owner_name;
    private $phone;
    private $address;
    private $profile_img;
    private $email;
    private $opwd;
    private $pwd;
    private $cpwd;

    private $user_id;
    private $role;

    public function __construct($user_id, $role, $bussiness_name, $owner_name, $phone, $address, $profile_img ,$email, $opwd, $pwd, $cpwd){
        $this->user_id = $user_id;
        $this->role = $role;
        $this->bussiness_name = $bussiness_name;
        $this->owner_name = $owner_name;
        $this->phone = $phone;
        $this->address = $address;
        $this->profile_img = $profile_img;
        $this->email = $email;
        $this->opwd = $opwd;
        $this->pwd = $pwd;
        $this->cpwd = $cpwd;
    }

    public function editProfile(){
        $profile_name = $this->uploadImage();
        if($this->isEmpty()){
            return ["result"=>"Empty input."];
        }
        if($this->isPwdMatch()){
            return ["result"=>"Password and Confirm Password is not match."];
        }
        if($this->isValidPhone()){
            return ["result"=>"Phone most be 10 digit."];
        }
        if($this->getEmailSupplier($this->email, $this->user_id)){
            return ["result"=>"Email is already used."];
        }
        if($this->getPhoneSupplier($this->phone, $this->user_id)){
            return ["result"=>"Phone is already used."];
        }
        if($this->uploadImage()==="Invalid image type."){
            return ["result"=>"Invalid image type."];
        }
        if($this->checkOldPassword($this->opwd, $this->user_id, $this->role)){
            return "Invalid Old password";
        }
        if($this->editProfileSupplier($this->user_id, $this->bussiness_name, $this->owner_name, $this->phone, $this->address, $profile_name, $this->email, $this->pwd)){
            return ["result"=>"update success", "profile_name" =>$profile_name];
        }
        
    }

    public function isEmpty(){
        return empty($this->bussiness_name)||empty($this->owner_name)||empty($this->phone)||empty($this->address)||empty($this->email)||empty($this->pwd)||empty($this->cpwd);
    }

    public function isPwdMatch(){
        return $this->pwd !== $this->cpwd;
    }

    public function isValidPhone(){
        return strlen($this->phone)!='10';
    }

    public function uploadImage(){
        $file = $this->profile_img;
        $old_profile = $this->getProfileImage($this->role, $this->user_id);
        if(isset($file) && $file['error'] === 0 && $file!==''){
            $fileName = basename($file['name']);
            $fileTmp = $file['tmp_name'];
            $uploadDir = '../../uploads/profile-images/';
    
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $image_file = uniqid('file_', true) . '.' . $ext;
            $uploadPath = $uploadDir . $image_file;
    
             // Create folder if not exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
    
            // Validate image
            if (!in_array($ext, $allowed)) {
                return "Invalid image type.";
            }
            //Move file if success return false,
            if(move_uploaded_file($fileTmp, $uploadPath)){
                //return the name of the files
                unlink('../../uploads/profile-images/'.$old_profile);
                return $image_file;
            }
        }else{
            return $old_profile;
        }
    }
}