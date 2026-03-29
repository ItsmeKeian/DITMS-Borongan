

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

        // CARDS
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

/* ================= PIE ================= */
function renderPie(d){

    new Chart(document.getElementById("statusChart"), {
        type: 'pie',
        data: {
            labels: ['Inspected', 'Pending', 'Violations'],
            datasets: [{
                data: [d.inspected, d.pending, d.violations],
                backgroundColor: ["#4CAF50", "#FFC107", "#F44336"]
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

/* ================= LINE ================= */
function renderLine(d){

    new Chart(document.getElementById("lineChart"), {
        type: 'line',
        data: {
            labels: d.months,
            datasets: [{
                label: "Inspections",
                data: d.monthly,
                borderColor: "#3498db",
                fill: false,
                tension: 0.3
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });

}

/* ================= BAR ================= */
function renderBar(d){

    new Chart(document.getElementById("barChart"), {
        type: 'bar',
        data: {
            labels: d.barangays,
            datasets: [{
                label: "Businesses",
                data: d.counts,
                backgroundColor: "#3498db"
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });

}

/* ================= INSIGHTS ================= */
function renderInsights(d){

    let html = `
        <li>${d.pending} businesses pending inspection</li>
        <li>Top barangay: ${d.top_barangay}</li>
        <li>${d.violations} violations recorded</li>
    `;

    $("#insightsList").html(html);
}