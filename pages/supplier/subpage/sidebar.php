<?php
$contents = [
    ["name"=>"dashboard", "link"=>"dashboard.php?content=dashboard"],
    ["name"=>"products", "link"=>"products.php?content=products"],
    ["name"=>"orders", "link"=>"#"],
    ["name"=>"payments", "link"=>"#"],
    ["name"=>"chats", "link"=>"#"],
    ["name"=>"review", "link"=>"#"],
    ["name"=>"logout", "link"=>"../../backend/includes/logout.inc.php"],
]
?>
<style>
    a{
        color: black;
        text-decoration: none; 
    }
    ul>li{
        list-style: none;
        cursor: pointer;
        padding: 0;
        margin: 0;
    }
    
    .supplier-title{
        width: 100%;
    }
    .nav-bar{
        color: white;
        width: 280px;
        position: fixed;
        top: 75px;
    }
    .list-content>li>a{
        color: white
    }
    .btn-nav{
        border-radius: 15px 0 0 15px;
    }
    ul>.btn-nav:hover{
        background-color: white;
        color: black;
    }
    .selected-content{
        background-color: white;
        color: black;
    }
</style>
<nav class="nav-bar d-flex flex-column h-100 shadow bg-dark">
    <h2 class="supplier-title px-5 py-4">Supplier</h2>
    <ul class="d-flex flex-column gap-3 mt-3 list-content w-100">
        <?php foreach($contents as $content){ ?>
            <li class="text-capitalize border border-white w-100 py-2 px-3 btn-nav <?php echo isset($_GET['content'])&&$_GET['content']==$content["name"]?"selected-content":"" ?>" onclick="window.location = '<?php echo $content['link'] ?>'"><?php echo $content["name"] ?></li>
        <?php } ?>
    </ul> 
</nav>