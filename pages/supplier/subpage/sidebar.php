<?php
$contents = [
    ["name"=>"dashboard", "link"=>"dashboard.php?content=dashboard", "icon"=>'<i class="fas fa-chart-line"></i>'],
    ["name"=>"products", "link"=>"products.php?content=products", "icon"=>'<i class="fas fa-box"></i>'],
    ["name"=>"orders", "link"=>"#", "icon"=>'<i class="fas fa-receipt"></i>'],
    ["name"=>"payments", "link"=>"#", "icon"=>'<i class="fas fa-credit-card"></i>'],
    ["name"=>"chats", "link"=>"#", "icon"=>'<i class="fas fa-comments"></i>'],
    ["name"=>"review", "link"=>"#", "icon"=>'<i class="fas fa-star"></i>'],
    ["name"=>"logout", "link"=>"../../backend/includes/logout.inc.php", "icon"=>'<i class="fas fa-right-from-bracket"></i>'],
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
        text-align: center;
    }
    .nav-bar{
        color: white;
        width: 280px;
        position: fixed;
        top: 75px;
    }
    .btn-nav{
        border-radius: 10px 0 0 10px;
    }
    .list-content>li>a{
        color: white
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
<nav class="nav-bar d-flex flex-column h-100 bg-dark">
    <h2 class="supplier-title">Supplier</h2>
    <ul class="d-flex flex-column gap-1 mt-3 list-content">
        <?php foreach($contents as $content){ ?>
            <li class="text-capitalize border border-white py-2 px-3 btn-nav <?php echo isset($_GET['content'])&&$_GET['content']==$content["name"]?"selected-content":"" ?>" onclick="window.location = '<?php echo $content['link'] ?>'">
                <div class="d-flex flex-row gap-2">
                    <div>
                        <?php echo $content['icon'] ?>
                    </div>
                    <div>
                        <?php echo $content["name"] ?>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul> 
</nav>