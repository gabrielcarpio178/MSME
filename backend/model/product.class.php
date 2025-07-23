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
        $stmt = $this->connect()->prepare("SELECT pt.product_id, pt.name AS product_name, ct.name AS category_name, pt.description, pt.price, pt.image_url, st.bussiness_name, st.image_profile, st.owner_name FROM product pt INNER JOIN category ct ON pt.category_id = ct.category_id INNER JOIN supplier st ON st.supplier_id = pt.supplier_id ORDER BY pt.product_id DESC;");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    protected function getProductsFeatured(){
        $stmt = $this->connect()->prepare("SELECT pt.product_id, pt.name, st.bussiness_name, st.owner_name, st.image_profile, pt.image_url, pt.price FROM featured_product ft INNER JOIN product pt ON pt.product_id = ft.product_id INNER JOIN supplier st ON pt.supplier_id = st.supplier_id ORDER BY ft.featured_id DESC");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    protected function getProductData($category_id){
        $stmt = $this->connect()->prepare("SELECT pt.product_id, pt.name AS product_name, ct.name AS category_name, pt.description, pt.price, pt.image_url, st.bussiness_name, st.image_profile, st.owner_name FROM product pt INNER JOIN category ct ON pt.category_id = ct.category_id INNER JOIN supplier st ON st.supplier_id = pt.supplier_id WHERE ct.category_id = ? ORDER BY pt.product_id DESC;");
        $stmt->execute([$category_id]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    protected function getProduct($product_id){
        $stmt = $this->connect()->prepare("SELECT pt.product_id ,pt.name AS product_name, pt.description AS product_description, ct.name AS product_category_name, pt.price, st.image_profile, st.owner_name, IF(SUM(rt.rating) IS NULL, 0, SUM(rt.rating)) AS rating, pt.image_url, IF((pt.stock_quantity - SUM(ot.quantity)) IS NULL, pt.stock_quantity, (pt.stock_quantity - SUM(ot.quantity))) AS quantity_lift FROM product pt INNER JOIN supplier st ON pt.supplier_id = st.supplier_id INNER JOIN category ct ON pt.category_id = ct.category_id LEFT JOIN orders ot ON pt.product_id = ot.product_id LEFT JOIN rating rt ON rt.orders_id = ot.orders_id WHERE pt.product_id = ? GROUP BY pt.product_id;");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
    }
}