

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Signup</title>
</head>
<body>
    
    <?php include 'subpages/header.php' ?>

    <div class="content d-flex flex-row w-100">
        <div class="suport-local py-5 w-50">
            <div class="super-local-img">
                <img src="images/Frame 762.png" alt="suport local">
            </div>
        </div>
        <div class="w-50  d-flex align-content-center justify-content-center">
            <div class="d-flex flex-column w-100 p-md-5" >
                <div class="d-flex flex-column ">
                    <h1>
                        Signup as
                    </h1>
                     <p>Enter your details below</p>
                </div>
                <div class="d-flex flex-column gap-2 px-5">
                    <?php if(!isset($_GET['role'])) include("subpages/signup/choose-role.php") ?>
                    <?php if(isset($_GET['role']) && $_GET['role']==='customer') include("subpages/signup/customer-form.php") ?>
                    <?php if(isset($_GET['role']) && $_GET['role']==='supplier') include("subpages/signup/supplier-form.php") ?>
                </div>
            </div>
        
        </div>
    </div>
</body>
</html>