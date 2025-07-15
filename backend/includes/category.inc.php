<?php
//start session for user account data
session_start();
 //connect classes
include '../model/dbh.class.php';
include '../model/category.class.php';
include '../controller/categoryContr.class.php';
$user_id = $_SESSION['id'];
if(isset($_POST['name'])&&isset($_POST['description'])&&isset($_POST['action'])&&$_POST['action']==="add"){
    //get user input from frontend
    $name = strtolower($_POST['name']);
    $description = strtolower($_POST['description']);
    //instantiate class for add category
    $category = new CategoryContr($user_id, $name, $description);
    //call add category
    echo $category->addCategory();
}
//delete category data
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    //instantiate class for Delete category
    $category = new CategoryContr('','','', $category_id);
    //delete category function
    echo $category->deleteCategory();
}
//edit category
if(isset($_POST['name'])&&isset($_POST['description'])&&isset($_POST['action'])&&$_POST['action']==="edit"){
    $name = strtolower($_POST['name']);
    $description = strtolower($_POST['description']);
    $category_id = $_POST['category_id'];
    //instantiate class for edit category
    $category = new CategoryContr($user_id ,$name ,$description, $category_id);
    //edit function
    echo $category->editCategory();
}