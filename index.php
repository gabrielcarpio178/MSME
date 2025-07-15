
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    
    <?php include 'subpages/header.php' ?>

    <div class="content d-flex flex-row w-100">
        <div class="suport-local py-5 w-50">
            <div class="super-local-img">
                <img src="images/Frame 762.png" alt="suport local">
            </div>
        </div>
        <div class="w-50 py-lg-5 d-flex align-content-center justify-content-center">
            
            <form action="backend/includes/login.inc.php" method="POST" class="p-md-5">
                <div class="d-flex flex-column">
                    <h1>
                        Login in to Exclusive
                    </h1>
                    <p>Enter your details below</p>
                </div>
                <div class="form-group pt-2">
                    <label for="exampleInputEmail1">Email address</label>
                    <input value="<?php echo isset($_GET['email'])?$_GET['email']:"" ?>" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group pt-2">
                    <label for="exampleInputPassword1">Password</label>
                    <input value="<?php echo isset($_GET['password'])?$_GET['password']:"" ?>" type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <p class="text-danger">
                    <?php echo isset($_GET['message'])?$_GET['message']:"" ?>
                </p>
                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" name="btn_submit" class="btn btn-primary mt-2 w-25">Login</button>
                    <a href="#">Forgot password</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>