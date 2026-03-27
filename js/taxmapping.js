// ================= SIDEBAR =================

const sidebar = document.querySelector('.sidebar');
const toggleBtn = document.querySelector('.sidebar-toggle');

if (toggleBtn) {

    toggleBtn.addEventListener('click', function () {

        sidebar.style.transform =
            sidebar.style.transform === 'translateX(-100%)'
            ? 'translateX(0)'
            : 'translateX(-100%)';

    });

}


document.addEventListener('click', function (event) {

    if (!sidebar || !toggleBtn) return;

    if (
        window.innerWidth <= 992 &&
        !sidebar.contains(event.target) &&
        !toggleBtn.contains(event.target)
    ) {
        sidebar.style.transform = 'translateX(-100%)';
    }

});



// ================= MAP =================

let map;
let markerLayer;



$(document).ready(function () {

    map = L.map('map').setView(
        [11.6087, 125.4319],
        13
    );


    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    ).addTo(map);


    markerLayer = L.layerGroup().addTo(map);


    loadMarkers();


    // FILTER EVENTS

    $("#filterBarangay").on("change", loadMarkers);
    $("#filterStatus").on("change", loadMarkers);
    $("#filterSearch").on("keyup", loadMarkers);

});


// ================= LOAD MARKERS =================

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

            if (!r.latitude || !r.longitude)
                return;


            // ===== COLOR CLASS =====

            let className = "custom-label label-blue";

            if (r.operation_status === "Existing")
                className = "custom-label label-green";

            if (r.operation_status === "Unregistered")
                className = "custom-label label-red";

            if (r.operation_status === "Closed")
                className = "custom-label label-gray";

            if (r.operation_status === "Transferred")
                className = "custom-label label-orange";

            if (r.operation_status === "New")
                className = "custom-label label-blue";


            // ===== ICON =====

            let icon = L.divIcon({
                className: "",
                html: "<div class='business-icon'>🏢</div>",
                iconSize: [26,26]
            });


            let marker = L.marker(
                [r.latitude, r.longitude],
                { icon: icon }
            ).addTo(markerLayer);


            // ===== TOOLTIP =====

            marker.bindTooltip(
                r.business_name,
                {
                    permanent: true,
                    direction: "top",
                    offset: [0, -15],
                    className: className
                }
            );


            // ===== POPUP =====

            marker.bindPopup(

                "<b>" + r.business_name + "</b><br>" +
                r.owner_name + "<br>" +
                r.barangay + "<br>" +
                r.operation_status

            );

        });

    }
);

}