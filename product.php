<?php
    include 'backend/model/dbh.class.php';
    include 'backend/model/product.class.php';
    include 'backend/controller/productContr.class.php';

    include 'backend/model/category.class.php';
    
    class ProductsView extends ProductContr{
        public function getProducts(){
            return $this->getAllProducts();
        }
        public function productsFeatured(){
            return $this->getProductsFeatured();
        }
        public function getProductByCategory($id){
            return $this->getProductData($id);
        }
    }
    class CategoryView extends Category{
        public function getCategories(){
            return $this->getAllCategory();
        }
    }
    $getAllProduct = new ProductsView();
    $getAllCategory = new CategoryView();
    $categories = $getAllCategory->getCategories();
    $featured = $getAllProduct->productsFeatured();
    if($_GET['category']==='all'){
        $products = $getAllProduct->getProducts();
    }else{
        $category_id = $_GET['category'];
        $products = $getAllProduct->getProductByCategory($category_id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/product.css">
    <link rel="icon" type="image/svg+xml" href="images/city_of_bago_logo_icon.png" />
    <title>Products</title>
</head>
<body>
    <?php include 'subpages/header.php' ?>
    <div class="content d-flex flex-column w-100">
        <div class="cover-products w-100">
            <div class="d-flex flex-column w-100 h-100">
                <div class="cover-content d-flex flex-column align-items-center justify-content-center w-100 title-product gap-2 text-white">
                    <div class="cover-text w-75 text-center">
                        <div class="animate__animated animate__fadeInDown">
                            <h2>
                                Local Artisan Products from Bago City
                            </h2>
                            <p class="text-center">
                                Crafted with tradition and care, our handmade products reflect the culture and creativity of Bago City. Using natural materials and local techniques, each piece supports sustainable craftsmanship and empowers local artisans.
                            </p>
                        </div>
                        <div class="w-100 btn-cart d-flex justify-content-center animate__animated animate__fadeInUp">
                            <button class="btn btn-warning">
                                Shop now
                            </button>
                        </div>
                    </div>
                </div>
               
            </div>
            
        </div>
    </div>
    <div class="px-5">
        <div class="w-100 text-center py-4 animate__animated animate__fadeInDown">
            <h1 class="text-success">New Collection</h1>
        </div>

        <div class="products-content d-flex flex-row  py-4 mt-3 gap-5">
            <div class="category-content w-25 mt-3 d-flex flex-column gap-2">
                <div class="card p-3">
                    <h5>Category</h5>
                    <ul class="d-flex flex-column gap-2 mt-3">
                        <li onclick="category(`all`)" class="d-flex w-100 justify-content-between py-2 category-item <?php echo isset($_GET['category'])&&$_GET['category']==='all'?'highlightCategory':'' ?>">
                            <div class="text-capitalize d-flex gap-2 categories-name-icon align-items-center">
                                <i class="fa-solid fa-bag-shopping"></i>
                                <div class="categories-name">
                                    All
                                </div>
                            </div>
                        </li>
                        <?php foreach($categories as $category){ ?>
                            <li onclick="category(`<?php echo $category['category_id']; ?>`)" class="d-flex w-100 justify-content-between py-2 category-item <?php echo isset($_GET['category'])&&$_GET['category']==$category['category_id']?'highlightCategory':'' ?>">
                                <div class="text-capitalize d-flex gap-2 categories-name-icon align-items-center">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                    <div class="categories-name">
                                        <?php echo $category['name'] ?>
                                    </div>
                                </div>
                                <div><?php echo $category['count_product'] ?></div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="card text-white bg-success d-flex flex-row align-items-center promo-content">
                    <div class="py-3 px-2">
                        <div class="d-flex flex-row align-items-center">
                            <div class="text-white icon-promo">
                                <i class="fa-solid fa-tag"></i>
                            </div>
                            <h5 class="px-2">Seasonal Sale</h5>
                        </div>
                        <p>Up to 30% OFF for our Bago Fiesta Sale!
Celebrate local culture and craftsmanship
Limited time only – until July 31!</p>
                        
                    </div>
                </div>

                <div class="card text-white bg-success d-flex flex-row align-items-center promo-content">
                    
                    <div class="py-3 px-2">
                        <div class="d-flex flex-row align-items-center">
                            <div class="text-white icon-promo">
                                <i class="fa-solid fa-tag"></i>
                            </div>
                            <h5 class="px-2">Welcome Offer (First Purchase)</h5>
                        </div>
                        <p>Get 10% OFF your first order Code: FIRST10 Valid for new customers only</p>
                    </div>
                </div>

                <div class="card p-3">
                    <h5>Featured Products</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach($featured as $feature){ ?>
                        <div class="d-flex flex-row card p-1 gap-2">
                            <div class="featured-product w-25">
                                <img src="uploads/<?php echo $feature['image_url'] ?>" alt="<?php echo $feature['name']; ?>">
                            </div>
                            <div class="d-flex flex-column w-75">
                                <div class="d-flex flex-row owner-image align-items-center">
                                    <img src="uploads/profile-images/<?php echo $feature['image_profile'] ?>" alt="<?php echo $$feature['owner_name'] ?>">
                                    <div class="text-capitalize"><?php echo $feature['owner_name'] ?></div>
                                </div>
                                <div>
                                    <i class="fa-solid fa-peso-sign"></i><span><?php echo $feature['price'] ?></span> 
                                </div>
                                <a href="view-product.php?content=product&id=<?php echo $feature['product_id']; ?>" class="btn btn-success w-100 text-center p-0">Add to Cart</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            

            <div class="w-75">
                
                <?php if(isset($_GET['category'])&&$_GET['category']=='all'){ ?>
                <div class="w-100">
                    <h3 class="text-success">Best Sellers</h3>
                </div>
                <?php } ?>

                <?php if(isset($_GET['category'])&&$_GET['category']!='all'){ ?>
                <div class="w-100">
                    <h3 class="text-success">Category</h3>
                </div>
                <?php } ?>

                <div class="row row-cols-3 g-3">
                    <?php
                    foreach($products as $product){
                    ?>
                        <div class="col">
                            <div class="card">
                                <img class="card-img-top" src="uploads/<?php echo $product['image_url'] ?>" alt="Card image cap">
                                <div class="card-body d-flex flex-column gap-3 px-4">
                                    <h5 class="card-title text-capitalize">
                                        <?php echo $product['product_name'] ?>
                                    </h5>
                                    <div class="seller-profile d-flex flex-row gap-1 align-items-center">
                                        <img src="uploads/profile-images/<?php echo $product['image_profile'] ?>" alt="<?php echo $product['bussiness_name'] ?>">
                                        <div class="seller-name text-capitalize">
                                            <?php echo $product['owner_name'] ?>
                                        </div>
        
                                    </div>
                                    <h5 class="supplier-price">
                                    <i class="fa-solid fa-peso-sign"></i><span><?php echo $product['price'] ?></span>     
                                    </h5>
                                    <div class="w-100 btn-addtocart">
                                        <a href="view-product.php?content=product&id=<?php echo $product['product_id']; ?>" class="btn btn-success w-100 text-center py-2">Add to Cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php } ?>    
                </div>

                <?php if(isset($_GET['category'])&&$_GET['category']=='all'){ ?>
                <div class="w-100 py-4 mt-3">
                    <h3 class="text-success">Recommended for You</h3>
                </div>
                
                
                <div class="row row-cols-3 g-3">
                    <?php
                    foreach($products as $product){
                    ?>
                        <div class="col">
                            <div class="card">
                                <img class="card-img-top" src="uploads/<?php echo $product['image_url'] ?>" alt="Card image cap">
                                <div class="card-body d-flex flex-column gap-3 px-4">
                                    <h5 class="card-title text-capitalize">
                                        <?php echo $product['product_name'] ?>
                                    </h5>
                                    <div class="seller-profile d-flex flex-row gap-1 align-items-center">
                                        <img src="uploads/profile-images/<?php echo $product['image_profile'] ?>" alt="<?php echo $product['bussiness_name'] ?>">
                                        <div class="seller-name text-capitalize">
                                            <?php echo $product['owner_name'] ?>
                                        </div>
        
                                    </div>
                                    <h5 class="supplier-price">
                                    <i class="fa-solid fa-peso-sign"></i><span><?php echo $product['price'] ?></span>     
                                    </h5>
                                    <div class="w-100 btn-addtocart">
                                        <a href="<?php echo $product['product_id']; ?>" class="btn btn-success w-100 text-center py-2">Add to Cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    <?php } ?>    
                </div>
                <?php } ?>
            </div>    
        </div>

    </div>
    <?php include "subpages/footer.php" ?>
</body>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/product.js"></script>
</html>