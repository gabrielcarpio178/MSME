$(document).ready(function(){
    $("#submit_edit").on("submit", function(e){
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: '../../backend/includes/profile.inc.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                if(res=="update success"){
                    Swal.fire({
                        position: "center",
                        title: `Success Update`,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1000,
                    }).then(()=>{
                        location.reload();
                    })
                }else{
                    console.log(res)
                    // Swal.fire({
                    //     position: "center",
                    //     title: res,
                    //     icon: "error",
                    //     showConfirmButton: false,
                    //     timer: 1000,
                    // })
                }
            }
        })
    })
});