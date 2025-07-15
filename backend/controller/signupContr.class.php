<?php
class SignUpCustomer extends Signup {
    private $name;
    private $address;
    private $phone;
    private $email;
    private $pwd;
    private $cpwd;

    public function __construct($name, $address, $phone, $email, $pwd, $cpwd){
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->cpwd = $cpwd;
    }

    public function signupCustomer(){
        if($this->isInputEmpty()){
            header("Location: ../../signup.php?role=customer&&name=".$this->name."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=input is empty");
            exit;
        }
        if($this->isPwdMatch()){
            header("Location: ../../signup.php?role=customer&&name=".$this->name."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=password or confirm password is not match");
            exit;
        }
        if($this->isValidPhone()){
            header("Location: ../../signup.php?role=customer&&name=".$this->name."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=Phone number must be exactly 10 digits");
            exit;
        }
        if($this->getEmailCustomer($this->email)){
            header("Location: ../../signup.php?role=customer&&name=".$this->name."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=email is already used");
            exit;
        }
        if($this->getPhoneCustomer($this->phone)){
            header("Location: ../../signup.php?role=customer&&name=".$this->name."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=phone number is already used");
            exit;
        }
        $this->addCustomer($this->name, $this->address, $this->phone, $this->email, $this->pwd);
        header("Location: ../../signup.php?role=customer&&success_message=Please Verify your account.");
        exit;
    }

    public function isInputEmpty(){
        return empty($this->name)|| empty($this->address)|| empty($this->phone)|| empty($this->pwd)|| empty($this->cpwd);
    }
    public function isPwdMatch(){
        return $this->pwd !== $this->cpwd;
    }

    public function isValidPhone(){
        return strlen($this->phone)!='10';
    }

}

class SignUpSupplier extends Signup {
    private $bname;
    private $oname;
    private $address;
    private $phone;
    private $email;
    private $pwd;
    private $cpwd;

    public function __construct($bname, $oname, $address, $phone, $email, $pwd, $cpwd){
        $this->bname = $bname;
        $this->oname = $oname;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->cpwd = $cpwd;
    }

    public function signupSuplier(){
        if($this->isInputEmpty()){
            header("Location: ../../signup.php?role=supplier&&bname=".$this->bname."&&oname=".$this->oname."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=input is empty");
            exit;
        }
        if($this->isPwdMatch()){
            header("Location: ../../signup.php?role=supplier&&bname=".$this->bname."&&oname=".$this->oname."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=password or confirm password is not match");
            exit;
        }
        if($this->isValidPhone()){
            header("Location: ../../signup.php?role=supplier&&bname=".$this->bname."&&oname=".$this->oname."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=Phone number must be exactly 10 digits");
            exit;
        }
        if($this->getEmailSupplier($this->email)){
            header("Location: ../../signup.php?role=supplier&&bname=".$this->bname."&&oname=".$this->oname."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=email is already used");
            exit;
        }
        if($this->getPhoneSupplier($this->email)){
            header("Location: ../../signup.php?role=supplier&&bname=".$this->bname."&&oname=".$this->oname."&&address=".$this->address."&&phone=".$this->phone."&&email=".$this->email."&&pwd=".$this->pwd."&&cpwd=".$this->cpwd."&&message=phone number is already used");
            exit;
        }
        $this->addSupplier($this->bname, $this->oname, $this->address, $this->phone, $this->email, $this->pwd);
        header("Location: ../../signup.php?role=supplier&&success_message=Please Verify your account.");
        exit;
    }

    public function isInputEmpty(){
        return empty($this->bname)|| empty($this->oname) || empty($this->address)|| empty($this->phone)|| empty($this->pwd)|| empty($this->cpwd);
    }

    public function isPwdMatch(){
        return $this->pwd !== $this->cpwd;
    }

    public function isValidPhone(){
        return strlen($this->phone)!='10';
    }

}