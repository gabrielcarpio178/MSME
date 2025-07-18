<?php

class ProductContr extends Product{
    private $category_id;
    private $supplier_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $image_file;
    private $product_id;

    public function __construct($product_id='', $supplier_id='' ,$category_id='',$name='',$description='',$price='',$stock='',$image_file=''){
        $this->category_id = $category_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->image_file = $image_file;
        $this->product_id = $product_id;
        $this->supplier_id = $supplier_id;
    }

    public function uploadImage(){
        $file = $this->image_file;
        if($file!==''){
            $fileName = basename($file['name']);
            $fileTmp = $file['tmp_name'];
            $uploadDir = '../../uploads/';
    
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
                echo "Invalid image type.";
                exit;
            }
            //Move file if success return false,
            if(move_uploaded_file($fileTmp, $uploadPath)){
                //return the name of the files
                return $image_file;
            }
        }
    }
    //add data product in database
    public function addProduct(){
        if($this->isEmpty()){
            return 'input is empty';
        }
        return $this->addProductData($this->category_id, $this->supplier_id,$this->name,$this->description, $this->price, $this->stock, $this->uploadImage());
    }

    //edit data product in database
    public function editProduct($image_name){
        $updatedImage_name = $this->checkIfUpdate($image_name)?$image_name:$this->uploadImage();
        if($this->isEmpty()){
            return 'input is empty';
        }
        return $this->editProductData($this->product_id, $this->category_id, $this->name,$this->description, $this->price, $this->stock, $updatedImage_name);
    }

    public function checkIfUpdate($image_name){
        return $this->isUpdateImage($this->product_id)===$image_name;
    }

    //check if input is empty
    public function isEmpty(){
        return empty($this->category_id)|| empty($this->name)|| empty($this->description)||empty($this->price)||empty($this->stock)||empty($this->supplier_id);
    }

    //delete product.
    public function deleteProduct(){
        return $this->deleteProductData($this->product_id);
    }

    


}