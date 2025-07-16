<?php
session_start();
include("../model/dbh.class.php");
include("../model/product.class.php");
include("../controller/productContr.class.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //get data from frontend.
    $category_id = $_POST['category_id'];
    $name = $_POST['pname'];
    $description = $_POST['pdescription'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $supplier_id = $_SESSION['id'];

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        $file = $_FILES['image_file'];
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

        // Move file and insert the data in database.
        if (move_uploaded_file($fileTmp, $uploadPath)) {
            //instantiate class for ProductContr
            $product = new ProductContr('',$supplier_id, $category_id ,$name, $description, $price, $stock, $image_file);
            echo $product->addProduct();
            exit;
        } else {
            echo "Failed to move the uploaded file.";
            exit;
        }

    }  
    else {
        echo "Image file is missing or has an error.";
    }  
}