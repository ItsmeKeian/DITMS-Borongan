$(document).ready(function(){
    loadReports();
});

let lineChart, pieChart;

/* LOAD REPORTS */
function loadReports(){

    $.get("php/get/get_reports.php", {
        barangay: $("#filterBarangay").val(),
        status: $("#filterStatus").val(),
        from: $("#fromDate").val(),
        to: $("#toDate").val(),
        search: $("#searchReports").val()
    }, function(data){

        let d = JSON.parse(data);

        renderTable(d.rows);
        renderCharts(d);

    });

}

/* TABLE */
function renderTable(rows){

    let html = "";

    if(rows.length === 0){
        html = `<tr><td colspan="5" class="text-center">No data</td></tr>`;
    }

    rows.forEach(r => {

        html += `
        <tr>
            <td>${r.business_name}</td>
            <td>${r.owner_name}</td>
            <td>${r.barangay}</td>
            <td>${r.date_of_inspection ?? "-"}</td>
            <td>${getStatusBadge(r.status)}</td>
        </tr>
        `;
    });

    $("#reportTableBody").html(html);
}

/* STATUS BADGE */
function getStatusBadge(status){

    if(status === "Inspected"){
        return '<span class="badge bg-success">Inspected</span>';
    }
    if(status === "Pending"){
        return '<span class="badge bg-warning text-dark">Pending</span>';
    }
    if(status === "Violation"){
        return '<span class="badge bg-danger">Violation</span>';
    }
}

/* CHARTS */
function renderCharts(d){

    if(lineChart) lineChart.destroy();
    if(pieChart) pieChart.destroy();

    // LINE
    lineChart = new Chart(document.getElementById("reportLineChart"), {
        type: 'line',
        data: {
            labels: d.months,
            datasets: [{
                label: "Inspections",
                data: d.monthly,
                borderColor: "#D4AF37",
                backgroundColor: "rgba(212,175,55,0.1)",
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });

    // PIE
    pieChart = new Chart(document.getElementById("reportPieChart"), {
        type: 'pie',
        data: {
            labels: ['Inspected','Pending','Violation'],
            datasets: [{
                data: [d.inspected, d.pending, d.violations],
                backgroundColor: [
                    "#C9A227",
                    "#D4AF37",
                    "#E5C76B"
                ],
                borderColor: "#fff",
                borderWidth: 2
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



$("#filterBarangay, #filterStatus, #fromDate, #toDate").on("change", loadReports);
$("#searchReports").on("keyup", loadReports);


// export reports
function exportReports(){

    let params = new URLSearchParams({
        barangay: $("#filterBarangay").val(),
        status: $("#filterStatus").val(),
        from: $("#fromDate").val(),
        to: $("#toDate").val(),
        search: $("#searchReports").val()
    });

    window.open("php/export/export_reports.php?" + params.toString(), "_blank");
}