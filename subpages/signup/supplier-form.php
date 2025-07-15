<form action="backend/includes/signup.inc.php" method="POST" class="d-flex flex-column gap-2">
    <input type="hidden" name="role" value="supplier">
    <div class="d-flex flex-row gap-2">
        <div class="form-group w-50">
            <label for="bname">Bussiness name</label>
            <input type="text" value="<?php echo isset($_GET['bname'])?$_GET['bname']:"" ?>" name="bname" id="bname" class="form-control " placeholder="Bussiness name">
        </div>
        <div class="form-group w-50">
            <label for="oname">Owner name</label>
            <input type="text" value="<?php echo isset($_GET['oname'])?$_GET['oname']:"" ?>" name="oname" id="oname" class="form-control " placeholder="Owner name">
        </div>
    </div>
    <div class="d-flex flex-row gap-2">
        <div class="form-group w-50">
            <label for="address">Address</label>
            <input type="text" value="<?php echo isset($_GET['address'])?$_GET['address']:"" ?>" name="address" id="address" class="form-control " placeholder="Address">
        </div>
        <div class="form-group w-50">
            <label for="phone">Phone</label>
            <div class="input-group mb-3">
                <span class="input-group-text">+63</span>
                <input type="number" value="<?php echo isset($_GET['phone'])?$_GET['phone']:"" ?>" name="phone" class="form-control " id="phone" placeholder="Phone number">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" value="<?php echo isset($_GET['email'])?$_GET['email']:"" ?>" placeholder="Email">
    </div>

     <div class="d-flex flex-row gap-2">
        <div class="form-group w-50">
            <label for="pwd">Password</label>
            <input type="password" value="<?php echo isset($_GET['pwd'])?$_GET['pwd']:"" ?>" name="pwd" id="pwd" class="form-control " placeholder="Password">
        </div>
        <div class="form-group w-50">
            <label for="cpwd">Confirm Password</label>
            <input type="password" value="<?php echo isset($_GET['cpwd'])?$_GET['cpwd']:"" ?>" name="con-pwd" id="cpwd" class="form-control " placeholder="Confirm Password">
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