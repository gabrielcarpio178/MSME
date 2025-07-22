<?php
session_start();
if(!isset($_SESSION['role'])||$_SESSION['role']!=="supplier"){
    header("Location: ../../index.php");
    exit;
}

$userData = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
     <link href="../../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="../../js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/fontawesome.css">
    <link rel="stylesheet" href="../../css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php include("subpage/header.php"); ?>
    <?php include("subpage/sidebar.php"); ?>
    <div class="contents-container">
        <div class="d-flex flex-row justify-content-between p-3">
            <div class="h3">
                Profile
            </div>
        </div>

        <div class="d-flex flex-row gap-2">
            <div class="d-flex flex-column gap-2 profile-content">
                <div class="card w-100" style="width: 12rem;">
                    <div class="product-container d-flex flex-column align-items-center">
                        <img class="card-img-top" src="../../uploads/profile-images/<?php echo $userData['image_profile'] ?>" alt="<?php echo $userData['owner_name'] ?>">
                    </div>
                    <div class="card-body d-flex flex-row align-items-center justify-content-between gap-1">
                        <div class="text-center w-100">
                            <div class="h5 text-capitalize">
                                <?php echo $userData['owner_name'] ?>
                            </div>
                            <div class="text-capitalize">
                                <?php echo $userData['bussiness_name'] ?>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="card w-100" style="width: 12rem;">
                    <div class="px-2 d-flex flex-column">
                        <div class="h4">
                            Contact Information
                        </div>
                        <div class="p-1 d-flex flex-row justify-content-between">
                            <div class="card p-1">
                                <label for="phone">Phone</label>
                                <div id="phone">+63<?php echo $userData['phone'] ?></div>
                            </div>
                            <div class="card p-1"> 
                                <label for="email">Email</label>
                                <div id="email"><?php echo $userData['email'] ?></div>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="card w-100" style="width: 12rem;">
                    <div class="p-2 d-flex flex-column">
                        <div class="h4">
                            Address
                        </div>
                        <div class="card p-1">
                            <?php echo $userData['address'] ?>
                        </div>
                    </div>
               </div>
            </div>
            <div class="d-flex flex-column px-2 profile-setting">
                <div class="card w-100 p-3">
                    <h4>Edit Profile</h4>
                    <form class="row row-cols-2 g-3 px-2" id="submit_edit">
                        <div class="col">
                             <div class="form-group">
                                <label for="bussiness_name">Bussines Name</label>
                                <input value="<?php echo $userData['bussiness_name'] ?>" type="text" name="bussiness_name" class="form-control" id="bussiness_name" placeholder="Bussines Name">
                            </div>
                        </div>
                        <div class="col">
                             <div class="form-group">
                                <label for="owner_name">Owner Name</label>
                                <input value="<?php echo $userData['owner_name'] ?>" type="text" name="owner_name" class="form-control" id="owner_name" placeholder="Owner Name">
                            </div>
                        </div>
                        <div class="col">
                             <div class="form-group">
                                <label for="phone">Phone number</label>
                                 <div class="input-group mb-3">
                                    <span class="input-group-text">+63</span>
                                    <input type="number" value="<?php echo $userData['phone'] ?>" name="phone" class="form-control " id="phone" placeholder="Phone number">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                             <div class="form-group">
                                <label for="address">Address</label>
                                <input value="<?php echo $userData['address'] ?>" type="text" name="address" class="form-control" id="address" placeholder="Address">
                            </div>
                        </div>

                        <div class="col-span-2 w-100">
                             <div class="form-group">
                                <label for="profile_img">Profile Image</label>
                                <input value="" type="file" name="profile_img" class="form-control" id="profile_img" placeholder="Profile Image">
                            </div>
                        </div>
                        
                        <div class="col">
                             <div class="form-group">
                                <label for="email">Email</label>
                                <input value="<?php echo $userData['email'] ?>" type="email" name="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        
                        <div class="col">
                             <div class="form-group">
                                <label for="opassword">Old Password</label>
                                <input value="" type="password" name="opassword" class="form-control" id="opassword" placeholder="Old Password">
                            </div>
                        </div>

                        <div class="col">
                             <div class="form-group">
                                <label for="password">Password</label>
                                <input value="" type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="col">
                             <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input value="" type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="col-span-2 w-100">
                            <button class="btn btn-success w-100" type="submit" name="btn_submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="../../js/jquery-3.7.1.min.js"></script>
<script src="../../js/sweetalert2.min.js"></script>
<script src="../../js/profile.js"></script>
</html>