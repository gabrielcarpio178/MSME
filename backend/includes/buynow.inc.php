<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = json_decode(file_get_contents('php://input'), true);
    $items = $data['items'];
    $isSuccess = false;

    include '../model/dbh.class.php';
    include '../model/buy.class.php';
    include '../controller/buyContr.class.php';

    foreach($items as $item){
        $quantity = $item['quantity'];
        $price = $item['price'];
        $product_id = $item['product_id'];
        $cart_id = $item['cart_id'];

        $buyContr = new BuyContr($product_id, $price, $quantity,  $cart_id);
        if($buyContr->addtoBuy()){
            $isSuccess = $buyContr->deletetoCart();
        }
    }

    if($isSuccess){
        echo "success";
    }
    

}