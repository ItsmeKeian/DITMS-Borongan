
$(document).ready(function(){
    loadBusinesses();
});

function loadBusinesses(){

    $.get(
        "php/get/get_businesses.php",
        function(data){

            let rows = JSON.parse(data);
            let html = "";

            rows.forEach(r => {

                let status = '<span class="badge bg-warning">Pending</span>';

                html += `
                <tr>
                    <td>${r.business_name}</td>
                    <td>${r.owner_name}</td>
                    <td>${status}</td>
                    <td>${formatDate(r.created_at)}</td>
                    <td>${r.barangay}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
                `;
            });

            $("#businessTableBody").html(html);

        }
    );

}

// helper
function formatDate(dateStr){
    let d = new Date(dateStr);
    return d.toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "2-digit"
    });
}
