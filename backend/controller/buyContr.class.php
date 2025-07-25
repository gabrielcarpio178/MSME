<?php

class BuyContr extends Buy{

    private $product_id;
    private $price;
    private $quantity;

    private $cart_id;

    public function __construct($product_id, $price, $quantity, $cart_id){
        $this->product_id = $product_id;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->cart_id = $cart_id;
    }

    public function addtoBuy(): bool{
        return $this->addBuy($this->product_id, $this->price, $this->quantity);
    }
    public function deletetoCart(){
        return $this->deleteCart($this->cart_id);
    }
}