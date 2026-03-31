function saveSystem(){

    let data = {
        municipality: $("#municipality").val(),
        province: $("#province").val()
    };

    $.post("php/update/update_system.php", data, function(res){
        alert(res);
    });

}

function updatePassword(){

    let pass = $("#new_password").val();
    let confirm = $("#confirm_password").val();

    if(pass !== confirm){
        alert("Passwords do not match!");
        return;
    }

    $.post("php/update/update_password.php", { password: pass }, function(res){
        alert(res);
    });

}

function saveMap(){

    let data = {
        lat: $("#map_lat").val(),
        lng: $("#map_lng").val(),
        zoom: $("#map_zoom").val()
    };

    $.post("php/update/update_map.php", data, function(res){
        alert(res);
    });

}