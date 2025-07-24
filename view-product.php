<?php
session_start();
$id_user = "no user";
if(isset($_SESSION['id'])){
    $id_user = $_SESSION['id'];
}
if(!isset($_GET['id'])){
    header("Location: product.php?content=product&category=all");
    exit;
}
$id = $_GET['id'];
include 'backend/model/dbh.class.php';
include 'backend/model/product.class.php';
class View_product extends Product{
    public function getProductInFo($customer_id, $product_id){
        return $this->getProduct($customer_id, $product_id);
    }
    public function getRating($stars){
        if($stars<5){
            return $stars;
        }
        if(($stars%5)==0){
            return 5;
        }
        if(($stars%5)!=5){
            return $stars%5;
        }
    }
}

$productData = new View_product();
$product = $productData->getProductInFo($id_user, $id);
$rating = $productData->getRating($product['rating']);

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
    <link rel="stylesheet" href="css/view-product.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <title><?php echo $product['product_name'] ?></title>
</head>
<body>
    <?php include 'subpages/header.php' ?>
    <div class="content d-flex flex-column w-100">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex flex-row justify-content-center py-5 px-3 gap-3 w-100">
                <div class="product-image d-flex justify-content-end  animate__animated animate__fadeInLeft">
                    <img src="uploads/<?php echo $product['image_url'] ?>" alt="">
                </div>
                <div class="d-flex flex-column w-100 animate__animated animate__fadeInRight">
                    <h1 class="text-capitalize"><?php echo $product['product_name'] ?></h1>
                    <div class="d-flex flex-row gap-2">
                        <?php for($i = 1; $i<=5; $i++){ ?>
                        <div class="<?php echo $rating>=$i? "text-warning":"" ?>">
                            <i class="fas fa-star"></i>
                        </div>
                        <?php } ?>
                        <p>(<?php echo $product['rating']; ?> Star) | (Stocks: <?php echo $product['quantity_lift'] ?>)</p>
                    </div>
                    <h3><i class="fa-solid fa-peso-sign"></i><?php echo $product['price'] ?></h3>
                    <p><?php echo $product['product_description'] ?></p>
                    <div class="w-100 d-flex flex-row gap-2">
                        <div class="w-25">
                            <div>
                                Supplier:
                            </div>
                            <div class="d-flex flex-row px-3 align-items-center gap-2">
                                <div class="image-supplier">
                                    <img class="w-100" src="uploads/profile-images/<?php echo $product['image_profile'] ?>" alt="<?php echo $product['owner_name'] ?>">
                                </div>
                                <div class="text-capitalize">
                                    <?php echo $product['owner_name'] ?>
                                </div>
                            </div>
                            <div class="w-100 mt-4 d-flex flex-row gap-1">
                                <?php if($product['isAddCart']===1){?>
                                    <div class="bg-danger p-2 text-white w-25 text-center btn" style="border-radius: 5px/5px;" onclick="cancelCart(`<?php echo $product['cart_id']; ?>`)" id="btnAddtoCart">
                                        <i class="fas fa-cancel"></i>
                                    </div>
                                <?php }else{ ?>
                                    <div class="bg-success p-2 text-white w-25 text-center btn" style="border-radius: 5px/5px;" onclick="addtoCart(`<?php echo $id_user; ?>`, `<?php echo $_GET['id'] ?>`)" id="btnAddtoCart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                <?php }?>   
                                <button class="btn btn-success w-100 w-75">Buy now</button>
                            </div>
                        </div>
                        <div class="w-75 d-flex flex-row gap-2">
                            <!-- <div class="w-50">
                                <div class="card text-white bg-success d-flex flex-row align-items-center promo-content">
                                    <div class="py-1 px-2">
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
                            </div>
                            <div class="w-50">
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
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script src="js/view-product.js"></script>
</html>