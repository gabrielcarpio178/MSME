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
                    successShowToastMessage();
                    $("#name").val("")
                    $("#description").val("")
                    $('#addCategory').modal('hide');
                    $("#message_text").text("Added Success")
                    $("#message").text("Please wait for reload the page")
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
                    successShowToastMessage();
                    $("#message_text").text("Update Success")
                    $("#message").text("Please wait for reload the page")
                    $("#emessage_invalid").text("")
                    $("#editCategory").modal('hide')
                }else{
                    $("#emessage_invalid").text(res)
                }
            }
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
    const toastElement = $("#successliveToast");
    const toast = new bootstrap.Toast(toastElement[0]);
    toast.show();
    setTimeout(() => {
        toast.hide();
        location.reload();
    }, 2000);
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
                    successShowToastMessage();
                    $("#message_text").text("Delete Success")
                    $("#message").text("Please wait to reload the page")
                    $('#btnCategory').modal('hide');
                }
            })
        }
    });
    
}
