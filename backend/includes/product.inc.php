<?php
session_start();
include("../model/dbh.class.php");
include("../model/product.class.php");
include("../controller/productContr.class.php");

//delete image function
function deleteImage($image_name){
    return unlink('../../uploads/'.$image_name);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['action'])){
        //get data from frontend.
        $category_id = $_POST['category_id'];
        $name = $_POST['pname'];
        $description = $_POST['pdescription'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $supplier_id = $_SESSION['id'];
    
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
            $file = $_FILES['image_file'];
            $product = new ProductContr('',$supplier_id, $category_id ,$name, $description, $price, $stock, $file);
            // Insert the data in database.
            echo $product->addProduct();
        }  
        else {
            echo "Image file is missing or has an error.";
        }  
    }
    
}


//delete product by id
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    //convert the php input to $_DELETE
    parse_str(file_get_contents('php://input'), $_DELETE);
    $product_id = $_DELETE['product_id'];
    $image_name = $_DELETE['image_name'];
    //instantiate class for ProductContr
    $product = new ProductContr($product_id,'', '' ,'', '', '', '', '');
    //if delete succes the image is deleted
    if($product->deleteProduct()){
        if(deleteImage($image_name)){
            echo "delete success";
        }
    }
}

//edit products
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['action'])){
        $product_id = $_POST['product_id'];
        $image_name = $_POST['image_name'];
        $oldImage_name = $_POST['old_image_name'];
        $category_id = $_POST['ecategory_id'];
        $name = $_POST['epname'];
        $description = $_POST['epdescription'];
        $price = $_POST['eprice'];
        $stock = $_POST['estock'];
        $supplier_id = $_SESSION['id'];
        if (isset($_FILES['eimage_file']) && $_FILES['eimage_file']['error'] === 0) {
            $file = $_FILES['eimage_file'];
            $product = new ProductContr($product_id,$supplier_id, $category_id ,$name, $description, $price, $stock, $file);
            if(deleteImage($oldImage_name)){
                // Insert updated data in database.
                echo $product->editProduct($image_name);
            }
        }  
        else {
            $product = new ProductContr($product_id,$supplier_id, $category_id ,$name, $description, $price, $stock, '');
            echo $product->editProduct($image_name);
        }  
    }
}
