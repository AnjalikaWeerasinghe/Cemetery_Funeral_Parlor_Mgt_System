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
                    <th width="150">Actions</th>
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
        $.get('../routes/emp/view_emp_route.php', function(data){
            $("#emp_data").html(data);
        })
    });
</script>