<?php

$signUpcontent = ['customer','supplier','rider'];
$viewContent = isset($_GET['content'])?$_GET['content']:"home";

?>
<style>
    .header-content{
        z-index: 999;
        background-color: white;
    }
    ul{
        padding: 0;
        margin: 0;
    }
    ul>li{
        list-style: none;
        cursor: pointer;
        padding: 0 3px;
    }
    ul > .underline::after{
        width: 100%;
    }
    .navigate-content{
        font-size: 1.2rem;
        width: 40%;
        padding: 0;
        font-weight: 400;
    }
    a{
        color: black;
        text-decoration: none; 
    }
    .btnnavigate-content {
        position: relative;
        transition: all 0.3s ease;
    }

    .btnnavigate-content::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0;
        height: 3px;
        background-color: black;
        transition: width 0.3s ease;
    }

    .btnnavigate-content:hover::after {
        width: 100%;
    }

    .profile-name{

        font-weight: 600;
    }

    .profile-image{
        border-radius: 50%;
        width: 15%;
        height: 7vh;
    }
    .profile-image > img{
        max-width: 100%;
        width: 100%;
        max-height: 100vh;
        height: 7vh;
    }
    .action-content{
        font-size: 2rem;
        width: 10%;
        height: 5vh;
        cursor: pointer;
    }
    .user-account{
        position: relative;
    }
    .btnuser-account{
        position: absolute;
        bottom: -570%;
        display: none;
    }
    .btnuser-account > ul{
        background-color: white;
        border-radius: 5px/5px;
    }
    .account-content > li > a{
        width: 100%;
        display: block;
    }
    .account-content > li:hover a {
        color: white;
    }
    .system_logo{
        width: 35%;
    }
    .system_logo > img{
        max-width: 100%;
        width: 5rem;
        border-radius: 50%;
    }
    .account-content > li{
        padding: 5px;
        border-radius: 5px/5px;
    }
    .account-content > li:hover{
        background: #000;
        opacity: 0.8;
        color: white;
    }
    </style>
    
    <header class="d-flex flex-row px-1 shadow-sm py-3 align-items-center position-fixed w-100 header-content">
        <div class="system_logo d-flex flex-row align-items-center justify-content-center gap-2 px-3">
            <img src="images/city_of_bago_logo.png" alt="bago city logo">
            <div class="title-content h2 text-center">
                Bago Merkado
            </div>
        </div>
        <ul class="navigate-content d-flex flex-row gap-lg-5 align-items-center w-50 justify-content-center">
            <li class="btnnavigate-content <?php echo $viewContent=="home"?"underline":"" ?>"><a href="index.php">Home</a></li>
            <li class="btnnavigate-content <?php echo $viewContent=="product"?"underline":"" ?>"><a href="product.php?content=product&category=all">Products</a></li>
            <li class="btnnavigate-content <?php echo $viewContent=="contact"?"underline":"" ?>"><a href="contact.php?content=contact">Contact</a></li>
            <li class="btnnavigate-content <?php echo $viewContent=="About"?"underline":"" ?>"><a href="about.php?content=about">About</a></li>
        </ul>
        <?php if(!isset($_SESSION['role'])){?>
        <ul class="d-flex flex-row w-25 justify-content-center gap-2">
            <li><a class="border border-black w-100 px-4 py-2 rounded shadow-md" href="signin.php?content=signin">Login</a></li>
            <li><a class="w-100 px-4 py-2 rounded shadow-md bg-dark text-white" href="signup.php?content=signup">Register</a></li>
        </ul>

        <?php }else{ ?>
            <div class="d-flex flex-column w-25 user-account">
                <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                    <div class="profile-name text-capitalize">
                        <?php echo $_SESSION['name']; ?>
                    </div>
                    <div class="profile-image">
                        <img src="uploads/profile-images/<?php echo $_SESSION['image_profile']; ?>" alt="customer-profile">
                    </div>
                    <div class="action-content d-flex align-items-center" id="action_content">
                        &#11166;
                    </div>
                </div>
                <div class="position-absolute w-100 px-5 btnuser-account shadow-md">
                    <ul class="p-2 d-flex flex-column gap-3 account-content">
                        <li>Profile</li>
                        <!-- when i hover this the text is not change. how to fixed? -->
                        <li><a href="cart.php?content=cart">Cart</a></li>
                        <li>Chat</li>
                        <li>Order</li>
                        <li onclick="window.location = 'backend/includes/logout.inc.php'">Logout</li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </header>
    <script>
        const btnAction = document.querySelector("#action_content");
        const content = document.querySelector(".btnuser-account");
        let i = "none";
        btnAction.addEventListener("click",function(){
            if(i=="none"){
                content.style.display = 'block';
                btnAction.innerHTML = "&#11167;"
                i = 'block';
            }else{
                content.style.display = 'none';
                btnAction.innerHTML = "&#11166;"
                i = 'none';
            }
        })
    </script>