<?php
session_start();
if(!isset($_SESSION['role'])||$_SESSION['role']!=="customer"){
    header("Location: ../../index.php");
    exit;
}
include "backend/model/dbh.class.php";
include "backend/model/cart.class.php";
class GetCart extends Cart{
    public function getProduct($customer_id){
        return $this->getAddedCart($customer_id);
    }
}
$cart = new GetCart();
$customer_id = $_SESSION['id'];
$products = $cart->getProduct($customer_id);
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
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="icon" type="image/svg+xml" href="images/city_of_bago_logo_icon.png" />
    <title>Cart</title>
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <?php include 'subpages/header.php' ?>
    <div class="content d-flex flex-row w-100">
        <?php if(count($products)!=0){ ?>
        <form class="p-5 w-100" id="submitBuy">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $key => $product){ ?>
                        <tr>
                            <th scope="row"><?php echo $key+1 ?></th>
                            <td>
                                <div class="product-cell">
                                    <img src="uploads/<?php echo $product['image_url'] ?>" alt="<?php echo $product['name'] ?>">
                                    <span><?php echo $product['name'] ?></span>
                                </div>
                            </td>
                            <td class="align-middle" class="price-product">
                                <?php echo $product['price'] ?>
                            </td>
                            <td class="align-middle">
                                <input type="hidden" name="cart_id[]" class="cart_id" value="<?php echo $product['cart_id']; ?>">
                                <input type="hidden" name="product_id[]" class="product_id" value="<?php echo $product['product_id']; ?>">
                                <input type="number" name="quantity[]" class="form-control quantity-input" style="width: 60px;" data-price="<?php echo $product['price'] ?>">
                            </td>
                            <td class="align-middle">
                                <input type="number" class="form-control subtotal-input" value="0" disabled style="width: 80px;">
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Check out</button>
            </div>
        </form>
        <?php }else{ ?>
            <p>No product add to cart.</p>
        <?php } ?>
    </div>
</body>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script src="js/cart.js"></script>
</html>