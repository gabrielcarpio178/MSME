<form action="backend/includes/signup.inc.php" method="POST" class="d-flex flex-column gap-2">
    <input type="hidden" name="role" value="rider">
    <div class="form-group">
        <label for="name">Full name</label>
        <input type="text" value="<?php echo isset($_GET['name'])?$_GET['name']:"" ?>" name="name" class="form-control " placeholder="Full name">
    </div>
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <div class="input-group mb-3">
            <span class="input-group-text">+63</span>
            <input type="number" value="<?php echo isset($_GET['phone'])?$_GET['phone']:"" ?>" name="phone" class="form-control " id="phone" placeholder="Phone number">
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" value="<?php echo isset($_GET['email'])?$_GET['email']:"" ?>" name="email" class="form-control " id="email" placeholder="Email">
    </div>
    <div class="d-flex flex-row gap-2">
        <div class="form-group w-50">
            <label for="pwd">Password</label>
            <input type="password" value="<?php echo isset($_GET['pwd'])?$_GET['pwd']:"" ?>" name="pwd" class="form-control  " id="pwd" placeholder="Password">
        </div>
        <div class="form-group w-50">
            <label for="con-pwd">Confirm Password</label>
            <input type="password" value="<?php echo isset($_GET['cpwd'])?$_GET['cpwd']:"" ?>" name="con-pwd" class="form-control" id="con-pwd" placeholder="Confirm Password">
        </div>
    </div>

    <?php if(isset($_GET['message'])){ ?>
    <p class="text-danger text-capitalize">
        <?php echo $_GET['message'] ?>    
    </p>
    <?php } ?>   
    <?php if(isset($_GET['success_message'])){ ?>
    <p class="text-capitalize">
        <?php echo $_GET['success_message'] ?> 
    </p>
    <?php } ?>
    <div class="d-flex align-items-center flex-column">
        <button type="submit" name="btn_submit" class="btn btn-primary mt-2 w-100">Signup</button>
        <a class="btn btn-danger mt-2 w-100" href="signup.php">Back</a>
    </div>

</form>    