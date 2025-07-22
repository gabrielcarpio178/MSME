<?php 

class Category extends Dbh{
    
    //check data if already used.
    protected function checkCategory($user_id, $name){
        $stmt = $this->connect()->prepare("SELECT `name` FROM `category` WHERE `supplier_id` = ? AND `name` = ?");
        $stmt->execute([$user_id, $name]);
        $resCategoryName = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resCategoryName !== false; 
    }

    //add category in database
    protected function addDataCategory($user_id, $name, $description){
        $stmt = $this->connect()->prepare("INSERT INTO `category`(`supplier_id`, `name`, `description`) VALUES (?,?,?)");
        $stmt->execute([$user_id, $name, $description]);
        return "add_success";
    }

    //get category list function
    protected function getCategory($user_id){
        $stmt = $this->connect()->prepare("SELECT `category_id`, `name`, `description` FROM `category` WHERE `supplier_id` = ? ORDER BY `category_id` DESC");
        $stmt->execute([$user_id]);
        $resCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resCategories;
    }
    //delete category
    protected function deleteDataCategory($categories_id){
        $stmt = $this->connect()->prepare("DELETE FROM `category` WHERE `category_id` = ?");
        $stmt->execute([$categories_id]);
        return "delete success";
    }

    //remove the name of category for updating the data
    protected function checkDataUpdate($category_id, $name){
        $stmt = $this->connect()->prepare("SELECT `name` FROM `category` WHERE `category_id` != ?;");
        $stmt->execute([$category_id]);
        $resCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resCategories as $category) {
            if (strtolower($category['name']) === strtolower($name)) {
                return true;  // Name already exists, update not allowed
            }
        }
        return false;  // Name is unique, update allowed
    }
    //update category data
    protected function editDataCategory($category_id ,$name, $description){
        $stmt = $this->connect()->prepare("UPDATE `category` SET `name`= ?,`description`= ? WHERE `category_id`=?");
        $stmt->execute([$name, $description, $category_id]);
        return "update success";
    }

    protected function getAllCategory(){
        $stmt = $this->connect()->prepare("SELECT ct.name, ct.category_id, count(ct.category_id) AS count_product FROM category ct INNER JOIN product pt ON pt.category_id = ct.category_id GROUP BY pt.category_id;");
        $stmt->execute();
        $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $category;
    }
}