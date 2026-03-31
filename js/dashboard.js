

$(document).ready(function(){
    console.log("Dashboard JS Loaded");
    loadDashboard();
});



function formatNumber(num){
    return num.toLocaleString();
}



function loadDashboard(){

    $.get("php/get/get_dashboard.php", function(data){

        let d = JSON.parse(data);

        // cards
        $("#totalBusinesses").text(d.total);
        $("#inspectedCount").text(d.inspected);
        $("#pendingCount").text(d.pending);
        $("#violationsCount").text(d.violations);

        renderPie(d);
        renderLine(d);
        renderBar(d);
        renderInsights(d);

    });

}

// pie
function renderPie(d){

    new Chart(document.getElementById("statusChart"), {
        type: 'pie',
        data: {
            labels: ['Inspected', 'Pending', 'Violations'],
            datasets: [{
                data: [d.inspected, d.pending, d.violations],
                backgroundColor: [
                    "#C9A227",
                    "#D4AF37",
                    "#E5C76B"
                ],
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

}

// line
function renderLine(d){

    new Chart(document.getElementById("lineChart"), {
        type: 'line',
        data: {
            labels: d.months,
            datasets: [{
                label: "Inspections",
                data: d.monthly,
                borderColor: "#D4AF37",
                fill: false,
                tension: 0.3
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });

}

// bar
function renderBar(d){

    new Chart(document.getElementById("barChart"), {
        type: 'bar',
        data: {
            labels: d.barangays,
            datasets: [{
                label: "Businesses",
                data: d.counts,
                backgroundColor: "#D4AF37"
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });

}
