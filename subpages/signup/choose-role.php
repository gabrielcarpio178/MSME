<?php
    $roles = [
        ["name"=>"Customer", "link"=>"signup.php?role=customer"],
        ["name"=>"Supplier", "link"=>"signup.php?role=supplier"],
        ["name"=>"Rider", "link"=>"signup.php?role=rider"],
        ["name"=>"Back", "link"=>"index.php"],
    ];
    foreach($roles as $role){
        
?>
    <a class="btn <?php echo $role["name"]!=="Back"?"btn-primary":"btn-danger"?>" href="<?php echo $role['link'] ?>"><?php echo $role["name"]!=="Back"?$role['name']:"I Have already account"?></a>
    
<?php } ?>