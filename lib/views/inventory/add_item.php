<div class="modal fade" id="addItemModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fa fa-box me-2"></i>Add New Item
                </h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="submit_form">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Item Code</label>
                            <input type="text" class="form-control" id="item_code" name="item_code" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Item Name</label>
                            <input type="text" class="form-control" name="item_name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Item Status</label>
                            <select class="form-select" name="item_status" required>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit</label>
                            <select class="form-select" name="unit" required>
                                <option value="">Select Unit</option>
                                <option value="Piece">Piece</option>
                                <option value="Box">Box</option>
                                <option value="Cylinder">Cylinder</option>
                                <option value="Kg">Kg</option>
                                <option value="Liter">Liter</option>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control"rows="3"name="description"></textarea>
                        </div>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="submit" form="submit_form" class="btn btn-warning" id="saveItem">
                    <i class="fa fa-save me-2"></i>Save Item
                </button>
            </div>
        </div>

    </div>

</div>

<script>
    $(document).on("show.bs.modal","#addItemModal",function(){
        loadItemCode();
    });

    function loadItemCode() {
        $("#item_code").val("Generating..");

        $.ajax({
            url: "../routes/inventory/generate_item_code.php",
            type: "GET",
            success: function (response) {
                $("#item_code").val(response);
            },
            error: function () {
                $("#item_code").val("Error");
            }
        });
    }

    $(document).on("submit", "#submit_form", function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "../routes/inventory/add_item_route.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $("#saveItem").prop("disabled", true)
                   .html('<i class="fa fa-spinner fa-spin me-2"></i>Saving...');
            },
            success: function(response){
                if(response.trim() === "success"){
                    Swal.fire({
                        icon: "success",
                        title: "Item Added Successfully",
                        showConfirmButton: false,
                        timer: 3500
                    }).then(() => {
                        $("#addItemModal").modal("hide");
                        $("#root").load("inventory/inventory.php");
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Failed to Add Item",
                        text: response
                    });
                }
            },
            error: function(xhr, status, error){
                $("button[type='submit']").prop("disabled", false).text("Save Item");
                Swal.fire({
                    icon: "error",
                    title: "Server Error",
                    text: "An error occurred while processing your request."
                });
            },
            complete: function(){
                $("#saveItem").prop("disabled", false)
                   .html('<i class="fa fa-save me-2"></i>Save Item');
            }
        })
    })
</script>