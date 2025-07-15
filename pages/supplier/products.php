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
            <div>
                <button type="button" class="btn btn-primary">Add product</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#btnCategory">
                     Category
                </button>
            </div>
        </div>
        <section class="container">
            <div class="row row-cols-3 mt-2" >

                <div class="col">
                    <div class="card"  style="width: 18rem;">
                        <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1980ef92ec1%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1980ef92ec1%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1953125%22%20y%3D%2296.3%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </section>

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
                    <p class="text-danger" id="emessage_invalid"></p>
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