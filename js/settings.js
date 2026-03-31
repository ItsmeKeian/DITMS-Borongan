//updating and saving system info
function saveSystem(){

    let formData = new FormData();

    formData.append("municipality", $("#municipality").val());
    formData.append("province", $("#province").val());

    let file = $("#logoInput")[0].files[0];
    if(file){
        formData.append("logo", file);
    }

    $.ajax({
        url: "php/update/update_system.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res){
            alert(res);
            location.reload(); // refresh para makita logo
        }
    });
}

//getting system info
$(document).ready(function(){

    loadSettings();

});

function loadSettings(){

    $.get("php/get/get_settings.php", function(res){

        let data = JSON.parse(res);

        $("#municipality").val(data.municipality);
        $("#province").val(data.province);

        if(data.logo){
            $(".top-header img").attr("src", "uploads/" + data.logo + "?t=" + new Date().getTime());
        }

    });

}


// saving logo
$("#logoInput").change(function(){

    let file = this.files[0];

    if(file){

        // validation (optional)
        if(!file.type.startsWith("image/")){
            alert("Please select an image file");
            return;
        }

        let reader = new FileReader();

        reader.onload = function(e){
            $("#logoPreview")
                .attr("src", e.target.result)
                .show();

            $("#uploadPlaceholder").hide();
        }

        reader.readAsDataURL(file);
    }

});