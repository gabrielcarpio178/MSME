<?php
session_start();
if(!isset($_SESSION['role'])||$_SESSION['role']!=="supplier"){
    header("Location: ../../index.php");
}else{
    $user_id = $_SESSION['id'];
    include '../../backend/model/dbh.class.php';
    include '../../backend/model/category.class.php';
    //get category list
    class CategoriesData extends Category{
        public function getCategoriesList($user_id){
            return $this->getCategory($user_id);
        }
    }
    $categories = new CategoriesData();
    $categoriesList = $categories->getCategoriesList($user_id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
     <link href="../../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="../../js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/fontawesome.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
</head>
<body>
    <?php include("subpage/header.php"); ?>
    <?php include("subpage/sidebar.php"); ?>
    <div class="contents-container">
        <div class="d-flex flex-row justify-content-between p-3">
            <div class="h3">
                Products
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#btnCategory">
                 Category
             </button>
        </div>

        <?php include("subpage/toastmessage/successmessage.php") ?>
        
    </div>
    

    <!-- list of category modal -->
    <div class="modal fade" id="btnCategory" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($categoriesList as $category){
                        ?>
                            <tr>
                                <td class="text-capitalize"><?php echo $category['name'] ?></td>
                                <td class="text-capitalize"><?php echo $category['description'] ?></td>
                                <td><button class="btn btn-primary" onclick="showEdit(`<?php echo $category['category_id'] ?>`,`<?php echo $category['name'] ?>`,`<?php echo $category['description'] ?>`)"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                <td><button class="btn btn-danger" onclick="deleteCategory('<?php echo $category['category_id'] ?>')"><i class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">Add Category</button>
            </div>
            </div>
        </div>
    </div>

    <!-- add category modal -->

    <div class="modal fade" id="addCategory" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form id="submit_category">
                    <div class="form-group pt-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group pt-2">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" class="form-control" id="description" placeholder="Enter Description" required></textarea>
                    </div>
                    <p class="text-danger" id="message_invalid"></p>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary w-100">Add</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
    </div>

    <!-- edit category modal -->
     <div class="modal fade" id="editCategory" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form id="submit_edit_category">
                    <input type="hidden" name="ecategory_id" id="ecategory_id">
                    <div class="form-group pt-2">
                        <label for="ename">Name</label>
                        <input type="text" name="name" class="form-control" id="ename" aria-describedby="emailHelp" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group pt-2">
                        <label for="edescription">Description</label>
                        <textarea type="text" name="description" class="form-control" id="edescription" placeholder="Enter Description" required></textarea>
                    </div>
                    <p class="text-danger" id="message_invalid"></p>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
    </div>
    
</body>
<script src="../../js/jquery-3.7.1.min.js"></script>
<script src="../../js/sweetalert2.min.js"></script>
<script src="../../js/product.js"></script>
</html>