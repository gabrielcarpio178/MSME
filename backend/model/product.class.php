<?php

class Product extends Dbh{
    //add product data.
    protected function addProductData($category_id, $supplier_id ,$name, $description, $price, $stock, $image_file){
        $stmt = $this->connect()->prepare("INSERT INTO `product`(`supplier_id`, `category_id`, `name`, `description`, `price`, `stock_quantity`, `image_url`) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$supplier_id, $category_id, $name, $description, $price, $stock, $image_file]);
        return "add success";
    }

    protected function isUpdateImage($product_id){
        $stmt = $this->connect()->prepare("SELECT `image_url` FROM `product` WHERE `product_id` = ?");
        $stmt->execute([$product_id]);
        $image_name = $stmt->fetch(PDO::FETCH_ASSOC);
        return $image_name['image_url'];
    }
    //get product list
    protected function getProductList($supplier_id){
        $stmt = $this->connect()->prepare("SELECT pt.category_id ,pt.product_id, ct.name AS category, pt.name, pt.description, pt.image_url, pt.price, pt.stock_quantity FROM product pt INNER JOIN category ct ON pt.category_id = ct.category_id INNER JOIN supplier st ON pt.supplier_id = st.supplier_id WHERE pt.supplier_id = ? ORDER BY pt.product_id DESC");
        $stmt->execute([$supplier_id]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    protected function searchProductList($supplier_id, $product, $category){
        if($category==='all'){
            $sql = "SELECT pt.category_id ,pt.product_id, ct.name AS category, pt.name, pt.description, pt.image_url, pt.price, pt.stock_quantity FROM product pt INNER JOIN category ct ON pt.category_id = ct.category_id INNER JOIN supplier st ON pt.supplier_id = st.supplier_id WHERE pt.supplier_id = ? AND pt.name LIKE ? ORDER BY pt.product_id DESC";
            $dataArray = [$supplier_id, $product.'%'];
        }else{
            $sql = "SELECT pt.category_id ,pt.product_id, ct.name AS category, pt.name, pt.description, pt.image_url, pt.price, pt.stock_quantity FROM product pt INNER JOIN category ct ON pt.category_id = ct.category_id INNER JOIN supplier st ON pt.supplier_id = st.supplier_id WHERE pt.supplier_id = ? AND (pt.name LIKE ? AND pt.category_id = ?) ORDER BY pt.product_id DESC;";
             $dataArray = [$supplier_id, $product.'%', $category];
        }

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($dataArray);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    //delete product data
    protected function deleteProductData($product_id){
        $stmt = $this->connect()->prepare("DELETE FROM `product` WHERE product_id = ?");
        return $stmt->execute([$product_id]);
    }

    protected function editProductData($product_id, $category_id, $name, $description, $price, $stock, $image_name){
        $stmt = $this->connect()->prepare("UPDATE `product` SET `category_id`= ?,`name`= ?,`description`=?,`price`= ?,`stock_quantity`=?,`image_url`=? WHERE `product_id` = ?");
        $stmt->execute([$category_id, $name, $description, $price, $stock, $image_name, $product_id]);
        return "update success";
    }

    protected function getAllProducts(){
        $stmt = $this->connect()->prepare("SELECT pt.product_id, pt.name AS product_name, ct.name AS category_name, pt.description, pt.price, pt.image_url, st.bussiness_name, st.image_profile FROM product pt INNER JOIN category ct ON pt.category_id = ct.category_id INNER JOIN supplier st ON st.supplier_id = pt.supplier_id ORDER BY pt.product_id DESC;");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
}