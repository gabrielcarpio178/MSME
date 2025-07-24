<?php

include "../model/dbh.class.php";
include "../model/cart.class.php";
include "../controller/cartContr.class.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];

    $cart = new CartContr('',$product_id, $customer_id);
    if($cart->addCart()){
        echo "add success";
    }else{
        echo "something want wrong";
    }
}

//delete remove to cart
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    //convert the php input to $_DELETE
    parse_str(file_get_contents('php://input'), $_DELETE);
    $cart_id = $_DELETE['cart_id'];
    $cart = new CartContr($cart_id, '', '');
    if($cart->removeCart()){
         echo "remove success";
    }else{
        echo "something want wrong";
    }
}