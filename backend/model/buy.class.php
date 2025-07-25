<?php

class Buy extends Dbh {
    protected function addBuy($product_id, $price, $quantity){
        $stmt = $this->connect()->prepare("INSERT INTO `orders`(`product_id`, `quantity`, `price`) VALUES (?,?,?)");
        return $stmt->execute([$product_id, $quantity, $price]);
    }

    protected function deleteCart($cart_id){
        $stmt = $this->connect()->prepare("DELETE FROM `cart` WHERE `cart_id` = ? ");
        return $stmt->execute([$cart_id]);
    }
}