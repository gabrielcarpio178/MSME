<?php
session_start();
if(!isset($_SESSION['role'])||$_SESSION['role']!=="supplier"){
    header("Location: ../../index.php");
}else{
    $user_id = $_SESSION['id'];
    include '../../backend/model/dbh.class.php';
    include '../../backend/model/category.class.php';
    include '../../backend/model/product.class.php';
    //get category list
    class CategoriesData extends Category{
        public function getCategoriesList($user_id){
            return $this->getCategory($user_id);
        }
    }
    $categories = new CategoriesData();
    $categoriesList = $categories->getCategoriesList($user_id);
    //get products list
    class ProductsData extends Product{
        public function getProduct($supplier_id){
            return $this->getProductList($supplier_id);
        }
        public function searchProduct($supplier_id, $productSearch, $category_id){
            return $this->searchProductList($supplier_id, $productSearch, $category_id);
        }
    }
    //instantiate class for ProductsData
    $productClass = new ProductsData();
    $products = $productClass->getProduct($user_id);
    if(isset($_GET['search'])||isset($_GET['scategory'])){
        $_GET['content'] = 'products';
        $products = $productClass->searchProduct($user_id, $_GET['search'], $_GET['scategory']);
    }
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#btnProducts">Add product</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#btnCategory">
                     Category
                </button>
            </div>
        </div>
        <section class="container">
            <div class="d-flex flex-column">
                <form action="products.php?content=products&&" method="GET" class="d-flex flex-row align-items-end gap-2">
                    <div class="form-group pt-2">
                        <label for="search">Search</label>
                        <input type="text" name="search" class="form-control" id="search" value="<?php echo isset($_GET['search'])?$_GET['search']:"" ?>">
                    </div>
                    <div class="form-group pt-2">
                        <select name="scategory" class="form-control text-capitalize" id="scategory" required>
                            <option value="all">All</option>
                            <?php
                            foreach($categoriesList as $category){
                            ?>
                                <option <?php echo isset($_GET['scategory'])&&$_GET['scategory']==$category['category_id']?"selected":"" ?> value="<?php echo $category['category_id'] ?>" class="text-capitalize"><?php echo $category['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </form>
            </div>
            <?php
                if(count($products)===0){
                echo "<p>No Product</p>";
            }
            ?>
            <div class="row row-cols-3 mt-2 g-3" >
                
                <?php
                foreach($products as $product){
                ?>
                <div class="col">
                    <div class="card product-container" style="width: 18rem;">
                        <img class="card-img-top" src="../../uploads/<?php echo $product['image_url'] ?>" alt="Card image cap">
                        <div class="card-body d-flex flex-column gap-1">
                            <h5 class="card-title text-capitalize"><?php echo $product['name'] ?></h5>
                            <div class="card-text"><?php echo $product['description'] ?></div>
                            <div class="d-flex flex-row gap-1 justify-content-between">
                                <div>Price: <i class="fa-solid fa-peso-sign"></i><span><?php echo $product['price']; ?></span></div>
                                <div>Stock: <span><?php echo $product['stock_quantity']; ?></span></div>
                            </div>
                            <div>Category: <span  class="text-capitalize"><?php echo $product['category']; ?></span></div>
                            <div class="d-flex flex-row gap-1 w-100">
                                <button class="btn btn-primary w-50" onclick="editProducts(`<?php echo $product['product_id'] ?>`,`<?php echo $product['category_id'] ?>`,`<?php echo $product['name'] ?>`,`<?php echo $product['description'] ?>`,`<?php echo $product['price']; ?>`,`<?php echo $product['stock_quantity']; ?>`,`<?php echo $product['image_url'] ?>`)"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-danger w-50" onclick="deleteProduct(`<?php echo $product['product_id'] ?>`,`<?php echo $product['image_url'] ?>`)"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>
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

    <!-- add product modal -->
    <div class="modal fade" id="btnProducts" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form id="submit_addproduct">
                    <div id="add_image" class="image-container">
                        <div id="preview" class="position-absolute w-100 h-100 top-0">
                            
                        </div>
                        <button class="btn btn-primary"  style="z-index: 999" type="button" id="btnchoose_file" onclick="$(`#image_file`).click()">Choose Image</button>
                        <p class="text-danger" id="message_img"></p>
                    </div>
                    <input type="file" id="image_file" class="image-file" name="image_file">
                    <div class="d-flex flex-row gap-2 w-100">
                        <div class="form-group pt-2 w-50">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-control text-capitalize" id="category_id" required>
                                <?php
                                foreach($categoriesList as $category){
                                ?>
                                    <option value="<?php echo $category['category_id'] ?>" class="text-capitalize"><?php echo $category['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group pt-2 w-50">
                            <label for="pname">Name</label>
                            <input type="text" name="pname" class="form-control" id="pname" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group pt-2">
                        <label for="pdescription">Description</label>
                        <textarea type="text" name="pdescription" class="form-control" id="pdescription" placeholder="Description" required></textarea>
                    </div>
                    <div class="d-flex flex-row gap-2 w-100">
                        <div class="form-group pt-2 w-50">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" id="price" placeholder="Price" required>
                        </div>

                        <div class="form-group pt-2 w-50">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control" id="stock" placeholder="Stock" required>
                        </div>
                    </div>
                    <p class="text-danger text-capitalize" id="addProduct_message_invalid"></p>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary w-100">Add</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
    </div>

    <!-- Edit product modal -->
    <div class="modal fade" id="editBtnProducts" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form id="submit_editproduct">
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="hidden" name="image_name" id="image_name">
                    <input type="hidden" name="old_image_name" id="old_image_name">
                    <div id="add_image" class="image-container">
                        <div id="epreview" class="position-absolute w-100 h-100 top-0">
                            
                        </div>
                        <button class="btn btn-primary"  style="z-index: 999" type="button" id="btnchoose_file" onclick="$(`#eimage_file`).click()">Choose Image</button>
                        <p class="text-danger" id="emessage_img"></p>
                    </div>
                    <input type="file" id="eimage_file" class="image-file" name="eimage_file">
                    <div class="d-flex flex-row gap-2 w-100">
                        <div class="form-group pt-2 w-50">
                            <label for="ecategory_id">Category</label>
                            <select name="ecategory_id" class="form-control text-capitalize" id="ecategory_id" required>
                                <?php
                                foreach($categoriesList as $category){
                                ?>
                                    <option value="<?php echo $category['category_id'] ?>" class="text-capitalize"><?php echo $category['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group pt-2 w-50">
                            <label for="epname">Name</label>
                            <input type="text" name="epname" class="form-control" id="epname" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group pt-2">
                        <label for="epdescription">Description</label>
                        <textarea type="text" name="epdescription" class="form-control" id="epdescription" placeholder="Description" required></textarea>
                    </div>
                    <div class="d-flex flex-row gap-2 w-100">
                        <div class="form-group pt-2 w-50">
                            <label for="eprice">Price</label>
                            <input type="number" name="eprice" class="form-control" id="eprice" placeholder="Price" required>
                        </div>

                        <div class="form-group pt-2 w-50">
                            <label for="estock">Stock</label>
                            <input type="number" name="estock" class="form-control" id="estock" placeholder="Stock" required>
                        </div>
                    </div>
                    <p class="text-danger text-capitalize" id="editProduct_message_invalid"></p>
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