<?php
session_start();
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
    .btnnavigate-content:hover{
        border-bottom: 3px solid black;
    }
    ul > .underline{
        border-bottom: 3px solid black;
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
    .content{
        padding-top: 5rem;
    }
    </style>
    <header class="d-flex flex-row px-1 shadow-sm py-3 align-items-center position-fixed w-100 header-content">
        <div class="title-content h2 w-25 text-center">
            Bago Merkado
        </div>
        <ul class="navigate-content d-flex flex-row gap-lg-5 align-items-center w-50 justify-content-center">
            <li class="btnnavigate-content <?php echo $viewContent=="home"?"underline":"" ?>"><a href="index.php">Home</a></li>
            <li class="btnnavigate-content <?php echo $viewContent=="product"?"underline":"" ?>"><a href="product.php?content=product">Products</a></li>
            <li class="btnnavigate-content <?php echo $viewContent=="seller"?"underline":"" ?>"><a href="seller.php?content=seller">Sellers</a></li>
            <li class="btnnavigate-content <?php echo $viewContent=="contact"?"underline":"" ?>"><a href="contact.php?content=contact">Contact</a></li>
            <li class="btnnavigate-content <?php echo $viewContent=="About"?"underline":"" ?>"><a href="about.php?content=about">About</a></li>
        </ul>
        <?php if(!isset($_SESSION['role'])){?>
        <ul class="d-flex flex-row w-25 justify-content-center gap-2">
            <li><a class="border border-black w-100 px-4 py-2 rounded shadow-md <?php echo $viewContent=="signin"?"bg-dark text-white":"" ?>" href="signin.php?content=signin">Login</a></li>
            <li><a class="border border-black w-100 px-4 py-2 rounded shadow-md <?php echo $viewContent=="signup"?"bg-dark text-white":"" ?>" href="signup.php?content=signup">Register</a></li>
        </ul>

        <?php } ?>
    </header>