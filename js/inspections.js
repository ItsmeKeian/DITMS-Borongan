//retrieve and search
$(document).ready(function(){

    loadInspections();
    loadBusinessOptions();

    $("#searchInspection").on("keyup", function(){

        let s = $(this).val();

        loadInspections(s);

    });

});



// load table


function loadInspections(search = "") {

    $.get(
        "php/get/get_inspections.php",
        { search: search },
        function (data) {

            let rows = JSON.parse(data);

            let html = "";

            rows.forEach(r => {

                // STATUS

                let statusBadge = "<span class='badge bg-success'>Active</span>";

                if (r.operation_status == "Closed")
                    statusBadge = "<span class='badge bg-danger'>Closed</span>";

                if (r.operation_status == "New")
                    statusBadge = "<span class='badge bg-primary'>New</span>";

                if (r.operation_status == "Unregistered")
                    statusBadge = "<span class='badge bg-warning'>Unregistered</span>";



                // FINDINGS

                let findingsBadge = "<span class='badge bg-success'>OK</span>";

                if (r.no_mayor_permit == 1)
                    findingsBadge = "<span class='badge bg-danger'>No Permit</span>";

                else if (r.expired_permit == 1)
                    findingsBadge = "<span class='badge bg-warning'>Expired</span>";



                html += `

                <tr>

                <td>${r.business_name}</td>

                <td>${r.owner_name}</td>

                <td>${r.barangay}</td>

                <td>${r.date_of_inspection}</td>

                <td>${r.type_of_business ?? ""}</td>

                <td>${statusBadge}</td>

                <td>${findingsBadge}</td>

                <td>

                <button class="btn btn-sm btn-outline-primary"
                onclick="viewInspection(${r.id})">

                <i class="fas fa-eye"></i>

                </button>

                <button class="btn btn-sm btn-outline-warning"
                onclick="editInspection(${r.id})">

                <i class="fas fa-edit"></i>

                </button>

                <button class="btn btn-sm btn-outline-danger"
                onclick="deleteInspection(${r.id})">

                <i class="fas fa-trash"></i>

                </button>

                </td>

                </tr>

                `;
            });

            $("#inspectionTable").html(html);

        });

}



//edit
function editInspection(id){

    $.get(
        "php/get/get_single_inspection.php?id=" + id,
        function(data){

            let r = JSON.parse(data);

         
            $("#inspection_id").val(r.id);

   
            $("input[name=date_of_inspection]").val(r.date_of_inspection);
            $("input[name=time_of_inspection]").val(r.time_of_inspection);
            $("#barangay").val(r.barangay);

  
            $("#inspection_business_id").val(r.business_id);
            $("#business_name").val(r.business_name);

      
            $("#selectBusiness").val(r.business_id).trigger("change");

            $("input[name=trade_name]").val(r.trade_name);
            $("#owner_name").val(r.owner_name);
            $("input[name=contact_number]").val(r.contact_number);

          
            $("select[name=mayor_permit]").val(r.mayor_permit);
            $("select[name=barangay_clearance]").val(r.barangay_clearance);
            $("select[name=dti_sec_cda]").val(r.dti_sec_cda);
            $("select[name=bir_registration]").val(r.bir_registration);

            $("input[name=permit_number]").val(r.permit_number);
            $("input[name=year_last_registered]").val(r.year_last_registered);

        
            $("textarea[name=declared_nature]").val(r.declared_nature);
            $("textarea[name=actual_nature]").val(r.actual_nature);

            $("input[name=activity_matches]")
                .prop("checked", r.activity_matches == 1);

            $("input[name=activity_not_match]")
                .prop("checked", r.activity_not_match == 1);

            $("input[name=psic_code]").val(r.psic_code);

            $("select[name=type_of_business]").val(r.type_of_business);
            $("select[name=operation_status]").val(r.operation_status);

            $("input[name=floor_area]").val(r.floor_area);
            $("input[name=male_employees]").val(r.male_employees);
            $("input[name=female_employees]").val(r.female_employees);

            $("select[name=additional_support]").val(r.additional_support);
            $("textarea[name=remarks]").val(r.remarks);

            
            $("input[name=no_mayor_permit]").prop("checked", r.no_mayor_permit == 1);
            $("input[name=expired_permit]").prop("checked", r.expired_permit == 1);
            $("input[name=change_nature]").prop("checked", r.change_nature == 1);
            $("input[name=change_address]").prop("checked", r.change_address == 1);
            $("input[name=additional_line]").prop("checked", r.additional_line == 1);

            $("input[name=others]").val(r.others);

          
            $("input[name=notice_register]").prop("checked", r.notice_register == 1);
            $("input[name=notice_violation]").prop("checked", r.notice_violation == 1);
            $("input[name=reassessment]").prop("checked", r.reassessment == 1);

            $("input[name=compliance_days]").val(r.compliance_days);
            $("input[name=referred_to]").val(r.referred_to);

            $("textarea[name=action_remarks]").val(r.action_remarks);

         
            $("select[name=sanitary_permit]").val(r.sanitary_permit);
            $("select[name=fire_cert]").val(r.fire_cert);
            $("select[name=permit_displayed]").val(r.permit_displayed);

       
            $("#latitude").val(r.latitude);
            $("#longitude").val(r.longitude);

         
            $("input[name=inspector_name]").val(r.inspector_name);
            $("input[name=date_signed]").val(r.date_signed);

          
            $("#inspectionForm").attr(
                "action",
                "php/update/update_inspection.php"
            );

           
            $("#addInspectionModal").modal("show");

        }
    );

}



//delete 

function deleteInspection(id){

    if(!confirm("Delete this inspection?"))
        return;

    $.post(
        "php/delete/delete_inspection.php",
        { id:id },
        function(){

            loadInspections();

        }
    );

}


//view

function viewInspection(id){

    window.location =
    "php/view/view_inspection.php?id=" + id;

}




// ================= ADD MODAL =================

function openAddModal(){

    $("#inspectionForm")[0].reset();

    $("#inspection_id").val("");

    $("#inspectionForm").attr(
        "action",
        "php/create/create_inspection.php"
    );

    $("#addInspectionModal").modal("show");

}


function loadBusinessOptions(){

    $.get("php/get/get_businesses.php", function(data){

        let rows = JSON.parse(data);
        let html = '<option value="">Select Business</option>';

        rows.forEach(r => {

            html += `
            <option value="${r.id}"
                data-name="${r.business_name}"
                data-owner="${r.owner_name}"
                data-barangay="${r.barangay}">
                ${r.business_name}
            </option>
            `;

        });

        $("#selectBusiness").html(html);

    });

}





$(document).on("change", "#selectBusiness", function(){

    let selected = $(this).find(":selected");

    let id = $(this).val();

    console.log("SELECTED ID:", id); // DEBUG

    $("#inspection_business_id").val(id);
    $("#business_name").val(selected.data("name"));
    $("#owner_name").val(selected.data("owner"));
    $("#barangay").val(selected.data("barangay"));

});


// ================= EXPORT=================

function exportExcel(){

    window.location =
    "/ditms-borongan/php/export/export_excel.php";

}