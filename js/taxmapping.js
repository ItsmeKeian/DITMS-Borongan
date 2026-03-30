//  MAP 

let map;
let markerLayer;

$(document).ready(function () {

    initMap();
    bindFilters();
    loadMarkers();

});



function initMap() {

    map = L.map('map').setView([11.6087, 125.4319], 13);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    ).addTo(map);

    markerLayer = L.layerGroup().addTo(map);

}


// FILTER EVENTS

function bindFilters() {

    $("#filterBarangay").on("change", loadMarkers);
    $("#filterStatus").on("change", loadMarkers);

    // Debounce search (para hindi spam request)
    let debounceTimer;

    $("#filterSearch").on("keyup", function () {

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            loadMarkers();
        }, 300);

    });

}


// LOAD MARKERS 

function loadMarkers() {

    let barangay = $("#filterBarangay").val();
    let status = $("#filterStatus").val();
    let search = $("#filterSearch").val();

    markerLayer.clearLayers();

    $.get(
        "php/get/get_map_locations.php",
        {
            barangay: barangay,
            status: status,
            search: search
        },
        function (data) {

            let rows = JSON.parse(data);

            rows.forEach(r => {

                if (!r.latitude || !r.longitude) return;

                let lat = parseFloat(r.latitude);
                let lng = parseFloat(r.longitude);

                if (isNaN(lat) || isNaN(lng)) return;

                // ================= STATUS COLOR =================

                let className = "custom-label label-gray"; // default

                if (r.operation_status === "Existing")
                    className = "custom-label label-green";

                else if (r.operation_status === "Unregistered")
                    className = "custom-label label-red";

                else if (r.operation_status === "New")
                    className = "custom-label label-blue";

                else if (r.operation_status === "Closed")
                    className = "custom-label label-gray";

                else if (r.operation_status === "Transferred")
                    className = "custom-label label-orange";

                // ICON

                let icon = L.divIcon({
                    className: "",
                    html: "<div class='business-icon'>🏢</div>",
                    iconSize: [26, 26]
                });

                let marker = L.marker([lat, lng], { icon: icon })
                    .addTo(markerLayer);

                // TOOLTIP

                marker.bindTooltip(
                    r.business_name,
                    {
                        permanent: true,
                        direction: "top",
                        offset: [0, -15],
                        className: className
                    }
                );

                // POPUP 

                marker.bindPopup(`
                    <b>${r.business_name}</b><br>
                    ${r.owner_name}<br>
                    ${r.barangay}<br>
                    <b>Status:</b> ${r.operation_status ?? "No Inspection"}
                `);

            });

        }
    );

}