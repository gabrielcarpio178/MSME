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
     $('#image_file').on('change', function (event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        if (file) {
            //check insert file if is image
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                $('#message_img').text('File extension not allowed.');
                $(this).val('');
                $('#preview').html(``);
            }else{
                //review image file.
                $('#message_img').text('');
                reader.onload = function (e) {
                    $('#preview').html(`<img src="${e.target.result}" width="200" />`);
                };
            }
            reader.readAsDataURL(file);
        } else {
            $('#preview').html('');
        }

    });

    //submit product data field with image of produc
    $('#submit_addproduct').on('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        await $.ajax({
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



})

function showEdit(category_id, name, description){
    $("#editCategory").modal('show')
    $("#btnCategory").modal('hide')
    $("#ename").val(name)
    $("#edescription").val(description)
    $("#ecategory_id").val(category_id)
}

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


function deleteProduct(product_id){
     Swal.fire({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            
        }
    });
}