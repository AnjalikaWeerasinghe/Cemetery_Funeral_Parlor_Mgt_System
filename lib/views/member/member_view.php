<div class="container-fluid mt-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Member Detail Management</h4>

        <div>
            <input type="text" id="searchMember" class="form-control d-inline-block w-auto" placeholder="Search Members...">
            <a href="admin.php?page=addMember" class="btn btn-primary ms-2 mb-1" id="member_add">
                <i class="fa-solid fa-user"></i>
                Add New Members
            </a>
        </div>
    </div>

    <div id="memberTable">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Member Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="50"></th>
                    <th width="50"></th>
                </tr>
            </thead>
            <tbody id="member_data">
                <!-- Load from database -->
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).on("click", ".addMemberBtn", function(){
    $("#content").load("member_add.php");
    });

    $(document).ready(function(){
        $.get('../routes/member/view_member_route.php', function(data){
            $("#member_data").html(data);

            $(".delete").click(function(){
                $btnId = $(this).attr('id');
                
                $.get("../routes/member/delete_member_route.php", {id: $btnId}, function(data){
                alert(data);
                })
            })
        })

    });

    $(document).on("click", ".edit", function(){

        let id = $(this).attr('id');
        console.log("Clicked ID:", id);

        $("#content").load("member_add.php", function(){

            console.log("FORM LOADED ✅");

            $.ajax({
                url: "../routes/member/get_member_route.php",
                type: "GET",
                data: { member_id: id },
                dataType: "json",

                success: function(response){
                    console.log("DATA:", response);

                    $("#member_id").val(response.member_id);
                    $("#first_name").val(response.first_name);
                    $("#middle_name").val(response.middle_name);
                    $("#last_name").val(response.last_name);
                    $("#nic").val(response.nic);

                    // $("input[name='gender'][value='" + response.gender + "']").prop("checked", true);
                    $("#gender").val(data.gender);
                    $("#date_of_birth").val(response.date_of_birth);
                    $("#contact_number").val(response.contact_number);
                    $("#address").val(response.address);
                    $("#email").val(response.email);
                    $("#member_status").val(response.member_status);
                    $("#member_code").val(response.member_code);

                    if(response.image){
                        $("#preview").html(`<img src="/Cemetery_Funeral_Parlor_Mgt_System/uploads/images/${response.image}" width="100">`);
                    }

                    $("button[type='submit']").text("Update Member");
                },

                error: function(xhr){
                    console.log("AJAX ERROR:", xhr.responseText);
                }
            });

        });

    });

</script>