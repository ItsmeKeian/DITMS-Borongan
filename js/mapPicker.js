// ================= MAP PICKER =================

let mapPicker;
let markerPicker;

let activeLat = null;
let activeLng = null;

function openMapModal(type)
{
    if(type === "inspection"){
        activeLat = "#latitude";
        activeLng = "#longitude";
    }

    if(type === "business"){
        activeLat = "#lat_business";
        activeLng = "#lng_business";
    }

    $("#mapModal").modal("show");

    setTimeout(initMapPicker, 500);
}

function initMapPicker()
{
    if(!activeLat || !activeLng) return;

    if (mapPicker)
        mapPicker.remove();

    mapPicker = L.map('mapPicker')
        .setView([11.6087,125.4319], 13);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    ).addTo(mapPicker);

    let lat = parseFloat($(activeLat).val());
    let lng = parseFloat($(activeLng).val());

    if (lat && lng)
    {
        markerPicker = L.marker([lat,lng]).addTo(mapPicker);
        mapPicker.setView([lat,lng], 15);
    }

    mapPicker.off("click");

    mapPicker.on("click", function(e){

        let lat = e.latlng.lat;
        let lng = e.latlng.lng;

        $(activeLat).val(lat);
        $(activeLng).val(lng);

        if(markerPicker)
            mapPicker.removeLayer(markerPicker);

        markerPicker = L.marker([lat,lng]).addTo(mapPicker);

        $("#mapModal").modal("hide");

    });
}