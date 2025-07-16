<?php

class Product extends Dbh{
    
    protected function addProductData($category_id, $supplier_id ,$name, $description, $price, $stock, $image_file){
        $stmt = $this->connect()->prepare("INSERT INTO `product`(`supplier_id`, `category_id`, `name`, `description`, `price`, `stock_quantity`, `image_url`) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$supplier_id, $category_id, $name, $description, $price, $stock, $image_file]);
        return "add success";
    }

    protected function getProductList($supplier_id){
        $stmt = $this->connect()->prepare("SELECT pt.product_id, ct.name AS category, pt.name, pt.description, pt.image_url, pt.price, pt.stock_quantity FROM product pt INNER JOIN category ct ON pt.category_id = ct.category_id INNER JOIN supplier st ON pt.supplier_id = st.supplier_id WHERE pt.supplier_id = ? ORDER BY pt.product_id DESC");
        $stmt->execute([$supplier_id]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
}