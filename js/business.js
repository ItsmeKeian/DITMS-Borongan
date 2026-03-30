$(document).ready(function(){

    loadBusinesses();

    // 🔍 LIVE SEARCH
    $("#searchBusiness").on("keyup", function(){
        let search = $(this).val();
        loadBusinesses(search);
    });

});

function loadBusinesses(search = ""){

    $.get(
        "php/get/get_businesses.php",
        { search: search }, // ✅ send to backend
        function(data){

            let rows = JSON.parse(data);
            let html = "";

            rows.forEach(r => {

                let status = r.inspection_count > 0
                    ? '<span class="badge bg-success">Inspected</span>'
                    : '<span class="badge bg-warning">Pending</span>';

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

                        <button class="btn btn-sm btn-outline-warning me-1" onclick="editBusiness(${r.id})">
                            <i class="fas fa-edit"></i>
                        </button>

                        <button class="btn btn-sm btn-outline-danger" onclick="deleteBusiness(${r.id})">
                            <i class="fas fa-trash"></i>
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


//delete
function deleteBusiness(id){

    if(confirm("Are you sure you want to delete this business?")){

        $.post(
            "php/delete/delete_business.php",
            { id: id },
            function(response){

                alert(response);
                loadBusinesses(); // reload table

            }
        );

    }

}

//edit
function editBusiness(id){

    $.get(
        "php/get/get_single_business.php",
        { id: id },
        function(data){

            let r = JSON.parse(data);

            // fill modal inputs
            $("#edit_id").val(r.id);
            $("#edit_business_name").val(r.business_name);
            $("#edit_owner_name").val(r.owner_name);
            $("#edit_barangay").val(r.barangay);
            $("#edit_contact").val(r.contact_number);

            $("#editModal").modal("show");

        }
    );

}

//update
function updateBusiness(){

    let formData = {
        id: $("#edit_id").val(),
        business_name: $("#edit_business_name").val(),
        owner_name: $("#edit_owner_name").val(),
        barangay: $("#edit_barangay").val(),
        contact_number: $("#edit_contact").val()
    };

    $.post(
        "php/update/update_business.php",
        formData,
        function(response){

            alert(response);
            $("#editModal").modal("hide");
            loadBusinesses();

        }
    );

}