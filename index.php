<?php 
    $products = [
        ['image'=>'file_6877ab41a427c3.74189373.jpg',
        'name'=>'Traditional Handwoven Basket', 'price'=>620, 'seller_name'=>'Juan araneta', 'seller_profile'=>''],
        ['image'=>'file_6877ab41a427c3.74189373.jpg',
        'name'=>'Traditional Handwoven Basket', 'price'=>302, 'seller_name'=>'Juan araneta', 'seller_profile'=>''],
        ['image'=>'file_6877ab41a427c3.74189373.jpg',
        'name'=>'Traditional Handwoven Basket', 'price'=>620, 'seller_name'=>'Juan araneta', 'seller_profile'=>''],
    ];

    $communities = [
        ['image'=>'', 'link'=>'#' ,'btnLabel'=>'Become a Seller' ,'name'=>'Sellers','description'=>'List your products manage orders and grow your artisan business with our platform'],
        ['image'=>'', 'link'=>'#' ,'btnLabel'=>'Show now' ,'name'=>'Buyers','description'=>'Discover authentic local products, place orders and support Bago City artisan'],
        ['image'=>'', 'link'=>'#' ,'btnLabel'=>'Apply on Rider' ,'name'=>'Riders','description'=>'Join Our delivery network and earn money by delivering products locally'],
        ['image'=>'', 'link'=>'#' ,'btnLabel'=>'Admin Login' ,'name'=>'Admin','description'=>'Manage the marketplace verify sellers and ensure smooth operations'],
    ]





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/fontawesome.css">
</head>
<body>
    
    <?php include 'subpages/header.php' ?>
    <div class="content d-flex flex-column w-100 gap-5">
        <div class="cover-photo">
            <div class="cover-text animate__animated animate__fadeInDown">
                <h2>Discover Local Treasures in Bago City</h2>
                <p>Shop authentic handmade products directly from local artisans and <br> support the vibrant culture of our community</p>
            </div>
            <a href="#" type="button" class="px-4 py-3 mt-3 animate__animated animate__fadeInUp">Explore Products</a>
        </div>   

        <div class="animate-content animate__animated text-success featured-product text-center">
            <h2>About Bago Merkado</h2>
        </div>

        <div class="animate-content animate__animated d-flex justify-content-center w-100 text-center px-5">
            <p class="w-75">Bago Merkado is an online marketplace dedicated to showcasing and promoting the expeptional craftsmanship of Bago City's local artisans. We connect buyers with authentic, high-quality handmade products while providing our seller with a platform to grow their bussinesses</p>
        </div>
        
        <div class="featured-product text-center">
            <h2 class="text-success ">Featured Products</h2>
            <p>
                Discover Handpicked items from our talented local artisans
            </p>
        </div>
        <div class="animate-content d-flex flex-row justify-content-center gap-3 exclusives-products animate__animated">
            <?php foreach($products as $product){ ?>
             <div class="card product-container">
                <div class="product-rate">
                    <div class="product-rate-text">
                        Recommend
                    </div>
                </div>
                <img class="card-img-top" src="uploads/<?php echo $product['image'] ?>" alt="Card image cap">
                <div class="card-body d-flex flex-column gap-3 px-4">
                    <h5 class="card-title text-capitalize">
                        <?php echo $product['name'] ?>
                    </h5>
                    <div class="seller-profile d-flex flex-row gap-1 align-items-center">
                        <img src="<?php echo $product['seller_profile'] ?>" alt="<?php echo $product['seller_name'] ?>">
                        <div class="seller-name text-capitalize">
                            <?php echo $product['seller_name'] ?>
                        </div>

                    </div>
                    <h5 class="supplier-price">
                       <i class="fa-solid fa-peso-sign"></i><span><?php echo $product['price'] ?></span>     
                    </h5>
                    <div class="w-100 btn-addtocart">
                        <button class="btn btn-success w-100 text-center py-2">Add to Cart</button>
                    </div>
                </div>
                
            </div>
            <?php } ?>
        </div>    
        <div class="animate-content animate__animated featured-product text-center">
            <h2 class="text-success ">Join Our Community</h2>
            <p>Bago Merkado serves different users in our local marketplace ecosystem</p>
        </div>

        <div class="animate-content d-flex flex-row justify-content-center gap-3 exclusives-products animate__animated px-5">
                
                <?php foreach($communities as $community){  ?>
                    <div class="card">
                         <div class="card-body d-flex flex-column gap-3 px-4 d-flex align-items-center">
                            <div class="image-community">
                                <img src="<?php echo $community['image'] ?>" alt="<?php echo $community['name'] ?>">
                            </div>
                            <h5 class="card-title text-capitalize text-success text-center h3">
                                <?php echo $community['name'] ?>
                            </h5>

                            <p class="text-center"><?php echo $community['description'] ?></p>
                                                    
                            <div class="w-100 btn-community">
                                <a href="<?php echo $community['link'] ?>" class="btn btn-success w-100 text-center py-2"><?php echo $community['btnLabel'] ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

        </div>

        <div class="animate-content animate__animated featured-product text-center">
            <h2 class="text-success ">What Our Community Says</h2>
            <p>Hear from people who love Bago Merkado</p>
        </div>
      
        <div class="animate-content d-flex flex-column justify-content-center gap-3 exclusives-products animate__animated px-5 align-items-center">
            <div class="d-flex flex-column align-items-center community w-50">
                <div class="community-profile">
                    <img src="" alt="community-profile">
                </div>

                <p class="px-4 mt-5">"Bago Merkado has helped me turn weving passion into sustainable business. I've connected with customers whi truly appreciate traditional craftmanship"</p>
            </div>

            <div class="text-center">
                <h5 class="text-success">Ana Reyes</h5>
                <p>Artisan|Bago HandWoven</p>
            </div>
            
        </div>


    </div>
</body>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/home.js"></script>
</html>