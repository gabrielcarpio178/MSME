<?php

class ProductContr extends Product{
    private $category_id;
    private $supplier_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $image_file;
    private $product_id;

    public function __construct($product_id='', $supplier_id='' ,$category_id='',$name='',$description='',$price='',$stock='',$image_file=''){
        $this->category_id = $category_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->image_file = $image_file;
        $this->product_id = $product_id;
        $this->supplier_id = $supplier_id;
    }

    public function addProduct(){
        if($this->isEmpty()){
            return 'input is empty';
        }
        return $this->addProductData($this->category_id, $this->supplier_id,$this->name,$this->description, $this->price, $this->stock, $this->image_file);
    }
    public function isEmpty(){
        return empty($this->category_id)|| empty($this->name)|| empty($this->description)||empty($this->price)||empty($this->stock)||empty($this->image_file)||empty($this->supplier_id);
    }


}