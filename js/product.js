$(document).ready(function(){
    //add category
    $("#submit_category").on('submit', async function(e){
        e.preventDefault()
        var name = $("#name").val();
        var description = $("#description").val();
        await $.ajax({
            url: '../../backend/includes/category.inc.php',
            type: 'POST',
            data: {
                name: name,
                description: description,
                action: "add"
            },
            cache: false,
            beforeSend: function(){

            },
            success: function(res){
                if(res==="add_success"){
                    //reset input
                    $("#name").val("")
                    $("#description").val("")
                    $("#message_text").text("Added Success")
                    $("#message").text("Please wait for reload the page")
                    successShowToastMessage().then(()=>{
                        $('#addCategory').modal('hide');
                        location.reload();
                    })
                }
                else{
                    $("#message_invalid").text(res)
                }
            },
            error: function(xhr){
                console.error("Error:", xhr.responseText);
            }
        })
    })
    //edit category
    $("#submit_edit_category").on("submit", async function(e){
        e.preventDefault();
        var name = $("#ename").val();
        var description = $("#edescription").val();
        var category_id = $("#ecategory_id").val();
        await $.ajax({
            url: '../../backend/includes/category.inc.php',
            type: 'POST',
            data: {
                category_id, name, description, action: "edit"
            },
            cache: false,
            success: function(res){
                if(res==="update success"){
                    //reset input
                    $("#message_text").text("Update Success")
                    $("#message").text("Please wait for reload the page")
                    $("#emessage_invalid").text("")
                    successShowToastMessage().then(()=>{
                        $("#editCategory").modal('hide')
                        location.reload();
                    });
                }else{
                    $("#emessage_invalid").text(res)
                }
            }
        })
    })
    
    //display selected image
    //display image add
    $('#image_file').on('change', function (event){
        const file = event.target.files[0];
        reviewImage(file, 'message_img', 'preview');
    })
    //display image edit
    $('#eimage_file').on('change', function (event){
        $("#image_name").val('');
        const file = event.target.files[0];
        reviewImage(file, 'emessage_img', 'epreview');
    })



    //submit product data field with image of produc
    $('#submit_addproduct').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: '../../backend/includes/product.inc.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res==="add success"){
                    $('#pname').html(``);
                    $('#pdescription').html(``);
                    $('#price').html(``);
                    $('#stock').html(``);
                    $("#addProduct_message_invalid").text('');
                    $("#message_text").text("Add Success")
                    $("#message").text("Please wait for reload the page")
                    successShowToastMessage().then(()=>{
                        $("#image_file").val('');
                        $('#preview').html(``);
                        $("#btnProducts").modal("hide");
                        location.reload();
                    })
                }else{
                    $("#addProduct_message_invalid").text(res);
                }

            },
        })
    })

    //submit edit product data
    $("#submit_editproduct").on('submit',function(e){
        e.preventDefault();
        const formData = new FormData(this);
        //add data for action
        formData.append('action', 'update');
        $.ajax({
            url: '../../backend/includes/product.inc.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res==="update success"){
                    $("#message_text").text("Edit Success")
                    $("#message").text("Please wait for reload the page")
                    successShowToastMessage().then(()=>{
                        $("#image_file").val('');
                        $('#preview').html(``);
                        $("#btnProducts").modal("hide");
                        location.reload();
                    })
                }else{
                    $("#editProduct_message_invalid").text(res);
                }

            },
        })
    })

    
    
})
//review image
function reviewImage(file, message_image, preview_image){
    const reader = new FileReader();
    if (file) {
        //check insert file if is image
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        const fileExtension = file.name.split('.').pop().toLowerCase();
        if (!allowedExtensions.includes(fileExtension)) {
            $(`#${message_image}`).text('File extension not allowed.');
            $(this).val('');
            $(`#${preview_image}`).html(``);
        }else{
            //review image file.
            $(`#${message_image}`).text('');
            reader.onload = function (e) {
                $(`#${preview_image}`).html(`<img src="${e.target.result}" width="200" />`);
            };
        }
        reader.readAsDataURL(file);
    } else {
        $(`#${preview_image}`).html('');
    }
}

//show edit category
function showEdit(category_id, name, description){
    $("#editCategory").modal('show')
    $("#btnCategory").modal('hide')
    $("#ename").val(name)
    $("#edescription").val(description)
    $("#ecategory_id").val(category_id)
}
//show success message
function successShowToastMessage(){
    return new Promise((resolve) => {
        const toastElement = $("#successliveToast");
        const toast = new bootstrap.Toast(toastElement[0]);

        toast.show();
        
        setTimeout(() => {
            toast.hide();
            resolve(); 
        }, 1000);
    });
}
//delete category
async function deleteCategory(category_id){
    Swal.fire({
        title: "Are you sure?",
        text: "All Products belongs to this category is also deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(async (result) => {
        if (result.isConfirmed) {
            await $.ajax({
                url: '../../backend/includes/category.inc.php',
                type: 'GET',
                data: {
                    category_id: category_id,
                },
                cache: false,
                success: function (res){
                    $("#message_text").text("Delete Success")
                    $("#message").text("Please wait to reload the page")
                    successShowToastMessage().then(()=>{
                        $('#btnCategory').modal('hide');
                        location.reload();
                    });
                }
            })
        }
    });
    
}

//delete product
function deleteProduct(product_id, image_name){
     Swal.fire({
        title: "Are you sure?",
        text: "Do want to delete this product!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../../backend/includes/product.inc.php',
                type: 'DELETE',
                data: {product_id, image_name},
                cache: false,
                success: function (res){
                    if(res==="delete success"){
                        $("#message_text").text("Delete Success")
                        $("#message").text("Please wait to reload the page")
                        successShowToastMessage().then(()=>{
                            $('#btnCategory').modal('hide');
                            location.reload();
                        });
                    }
                }
            })
        }
    });
}
//edit show products
function editProducts(product_id, category_id, name, description, price, stock_quantity, image_name){
    $("#editBtnProducts").modal('show')
    $("#epname").val(name);
    $("#epdescription").val(description);
    $("#eprice").val(price);
    $("#estock").val(stock_quantity);
    $("#product_id").val(product_id);
    $("#image_name").val(image_name);
    $("#old_image_name").val(image_name);
    $('#ecategory_id option').each(function() {
        if ($(this).val() == category_id) {
            $(this).prop('selected', true);
        }
    });
    // Set the current image name (if available)
    if (image_name) {
        // If the image name exists, show the current image
        const imagePath = '../../uploads/' + image_name; // Adjust path accordingly
        $('#epreview').html(`<img src="${imagePath}" width="200" />`);
    }
}
