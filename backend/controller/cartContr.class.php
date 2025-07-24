<?php

class CartContr extends Cart{

    private $product_id;
    private $customer_id;

    private $cart_id;

    //constractor for the class cartcontr
    public function __construct($cart_id, $product_id, $customer_id){
        $this->cart_id = $cart_id;
        $this->product_id = $product_id;
        $this->customer_id = $customer_id;
    }
    //add to cart
    public function addCart(){
        if($this->checkIfEmpty()){
            return false;
        }
        return $this->addtoCart($this->customer_id, $this->product_id);
    }

    //remove to cart
    public function removeCart(){
        return $this->removetoCart($this->cart_id);
    }
    //check if the data is empty
    public function checkIfEmpty(){
        return empty($this->product_id)||empty($this->customer_id);
    }


}