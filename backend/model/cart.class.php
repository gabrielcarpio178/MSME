<?php

class Cart extends Dbh{
    protected function addtoCart($customer_id, $product_id){
        $stmt = $this->connect()->prepare("INSERT INTO `cart`(`product_id`, `customer_id`) VALUES (?,?);");
        return $stmt->execute([$product_id, $customer_id]);
    }
    protected function removetoCart($cart_id){
        $stmt = $this->connect()->prepare("DELETE FROM `cart` WHERE `cart_id` = ?");
        return $stmt->execute([$cart_id]);
    }

    protected function getAddedCart($customer_id){
        $stmt = $this->connect()->prepare("SELECT crt.cart_id ,crt.customer_id, pt.name, pt.image_url, pt.price FROM cart crt INNER JOIN product pt ON crt.product_id = pt.product_id WHERE crt.customer_id = ?");
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}