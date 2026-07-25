<div class="modal fade" id="addInventoryModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fa fa-box me-2"></i>Add Inventory Item
                </h5>

                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="addInventoryForm">

                <div class="modal-body">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Item Name</label>
                            <select class="form-select" name="item_id" id="item_id" required>
                                <option value="">Select Item</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Unit</label>
                            <input type="text" class="form-control" id="unit" name="unit" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Opening Quantity</label>
                            <input type="number" class="form-control" name="quantity" min="0" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Reorder Level
                            </label>
                            <input type="number" class="form-control" name="reorder_level" min="0" value="5">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                <option value="Available">Available</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-gold">
                        <i class="fa fa-save me-2"></i>Save Inventory
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<script>
    $(document).ready(function () {

        $.ajax({
            url: "../routes/inventory/load_item_route.php",
            type: "GET",
            success: function (data) {
                $("#item_id").html(data);
            }
        });

        $("#addInventoryForm").submit(function(e){
            e.preventDefault();

            $.ajax({
                url:"../routes/inventory/add_inventory_route.php",
                type:"POST",
                data:$(this).serialize(),
                dataType:"json",
                success:function(response){
                    if(response.status=="success"){
                        Swal.fire({
                            icon:"success",
                            title:"Success",
                            text:response.message,
                            timer:1800,
                            showConfirmButton:false
                        });

                        $("#addInventoryModal").modal("hide");

                        loadInventory();
                    } else{
                        Swal.fire({
                            icon:"error",
                            title:"Error",
                            text:response.message
                        });
                    }
                },
                error:function(){
                    Swal.fire({
                        icon:"error",
                        title:"Server Error",
                        text:"Something went wrong."
                    });
                }

            });

        });

    });

    $("select[name='item_id']").change(function(){
        let item_id=$(this).val();

        if(item_id==""){
            $("input[name='unit']").val("");
            $("input[name='unit_price']").val("");
            return;
        }

        $.ajax({
            url:"../routes/inventory/get_item_unit_route.php",
            type:"GET",
            data:{item_id:item_id},
            dataType:"json",
            success:function(response){
                $("input[name='unit']").val(response.unit);
                $("input[name='unit_price']").val(response.unit_price);
            }
        });
    });
</script>