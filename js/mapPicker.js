// ================= MAP PICKER =================

let mapPicker;
let markerPicker;

function openMapModal()
{
    $("#mapModal").modal("show");
    setTimeout(initMapPicker, 500);
}

function initMapPicker()
{
    if (mapPicker)
        mapPicker.remove();

    mapPicker = L.map('mapPicker')
        .setView([11.6087,125.4319], 13);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    ).addTo(mapPicker);

    let lat = parseFloat($("#lat_business").val());
    let lng = parseFloat($("#lng_business").val());

    if (lat && lng)
    {
        markerPicker = L.marker([lat,lng]).addTo(mapPicker);
        mapPicker.setView([lat,lng], 15);
    }

    mapPicker.off("click");

    mapPicker.on("click", function(e){

        let lat = e.latlng.lat;
        let lng = e.latlng.lng;

        $("#lat_business").val(lat);
        $("#lng_business").val(lng);

        if(markerPicker)
            mapPicker.removeLayer(markerPicker);

        markerPicker = L.marker([lat,lng]).addTo(mapPicker);

        $("#mapModal").modal("hide");

    });
}