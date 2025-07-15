<?php 

class CategoryContr extends Category{
    private $name;
    private $description;
    private $user_id;

    private $category_id;

    //contractor for category
    public function __construct($user_id='', $name='', $description='', $category_id=''){
        $this->user_id = $user_id;
        $this->name = $name;
        $this->description = $description;
        $this->category_id = $category_id;
    }

    //add category 
    public function addCategory(){
        if($this->isEmpty()){
            echo "empty input";
            exit;
        }
        if($this->checkCategory($this->user_id, $this->name)){
            echo "category name is already used";
            exit;
        }
        return $this->addDataCategory($this->user_id, $this->name, $this->description);
    }
    public function editCategory(){
        if($this->isEmpty()){
            echo "empty input";
            exit;
        }
        if($this->checkDataUpdate($this->category_id, $this->name)){
            echo "category name is already used";
            exit;
        }
        return $this->editDataCategory($this->category_id ,$this->name, $this->description);
    }

    //validate data if empty
    public function isEmpty(){
        return empty($this->name)||empty($this->description);
    }

    public function deleteCategory(){
        return $this->deleteDataCategory($this->category_id);
    }

}