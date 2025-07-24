$(document).ready(function(){
    
});

function addtoCart(user_id, product_id){
    if(user_id==="no user"){
        loginAccount();
        return;
    }
    $.ajax({
        url: 'backend/includes/cart.inc.php',
        type: 'POST',
        data: {
            customer_id: user_id,
            product_id: product_id
        },
        cache: false,
        success: function(res){
             Swal.fire({
                position: "center",
                icon: "success",
                title: "Add to cart success",
                showConfirmButton: false,
                timer: 1000
            }).then(()=>{
                location.reload();
            });
        }
    })    
}
//cancel to cart
function cancelCart(cart_id){
    Swal.fire({
        title: "Are you Sure",
        text: "Do want to remove to cart",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes! remove it."
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'backend/includes/cart.inc.php',
                type: 'DELETE',
                data: {
                    cart_id
                },
                cache: false,
                success: function(res){
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Remove to cart success",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(()=>{
                        location.reload();
                    });
                }
            })    
        }
    });
}

//no account login pop up
function loginAccount(){
    Swal.fire({
        title: "No Account",
        text: "Please login your account",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Login"
    }).then((result) => {
        if (result.isConfirmed) {
           window.location = "signin.php?content=signin";
        }
    });
}