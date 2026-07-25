<style>
    .modal-content{
        border:0;
        border-radius:18px;
        overflow:hidden;
    }

    .modal-header{
        background:#1f2937;
        color:#fff;
        padding:18px 25px;
        border:none;
    }

    .modal-header .modal-title{
        font-size:20px;
        font-weight:600;
    }

    .modal-body{
        padding:30px;
        background:#f8fafc;
    }

    .modal-footer{
        border:none;
        background:#fff;
        padding:18px 30px;
    }

    .form-label{
        font-weight:600;
        color:#374151;
        margin-bottom:8px;
    }

    .form-control,
    .form-select{
        height:48px;
        border-radius:12px;
        border:1px solid #d1d5db;
        transition:.3s;
    }

    textarea.form-control{
        height:110px;
        resize:none;
    }

    .form-control:focus,
    .form-select:focus{
        border-color:#c9a44c;
        box-shadow:0 0 0 .2rem rgba(201,164,76,.2);
    }

    .input-group-text{
        background:#fff;
        border-right:0;
        border-radius:12px 0 0 12px;
        color:#6b7280;
    }

    .input-group .form-control,
    .input-group .form-select{
        border-left:0;
    }

    .card-preview{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:15px;
        padding:18px;
        margin-top:10px;
    }

    .badge-status{
        display:inline-block;
        padding:8px 16px;
        border-radius:20px;
        font-size:13px;
        font-weight:600;
        background:#dcfce7;
        color:#15803d;
    }

    .btn{
        border-radius:10px;
        font-weight:600;
        padding:10px 22px;
    }

    .btn-gold{
        background:#c9a44c;
        color:#fff;
        border:none;
    }

    .btn-gold:hover{
        background:#b68f2f;
        color:#fff;
    }

    .required{
        color:#dc2626;
    }
</style>

<div class="modal fade" id="addSupplierItemModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-boxes-stacked me-2"></i>Add Supplier Item
                </h5>
                <button class="btn-close btn-close-white"data-bs-dismiss="modal"></button>
            </div>

            <form id="supplierItemForm">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Supplier<span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-truck"></i></span>
                                <select class="form-select" name="supplier_id">
                                    <option value="">Select Supplier</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Item<span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-box"></i></span>
                                <select class="form-select" name="item_id">
                                    <option value="">Select Item</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Unit</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-ruler"></i></span>
                                <input type="text" class="form-control" name="unit" readonly>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Unit Price (Rs.)<span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span>
                                <input type="number" name="unit_price" class="form-control" placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <div class="card-preview">
                        <h6 class="mb-3">
                            <i class="fa fa-circle-info me-2 text-primary"></i>Supplier Item Preview
                        </h6>

                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted">Supplier</small>
                                <div class="fw-semibold" id="previewSupplier"></div>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted">Item</small>
                                <div class="fw-semibold" id="previewItem"></div>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted">Unit Price</small>
                                <div>
                                    <span class="fw-semibold" id="previewPrice"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-gold">
                        <i class="fa fa-save me-2"></i>Save Supplier Item
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    $(document).ready(function(){
        loadSuppliers();
        loadItems();

        function loadSuppliers(){
            $.ajax({
                url:"../routes/inventory/load_supplier_route.php",
                type:"GET",
                success:function(data){
                    $("select[name='supplier_id']").html(data);
                }
            });
        }

        function loadItems(){
            $.ajax({
                url:"../routes/inventory/load_item_route.php",
                type:"GET",
                success:function(data){
                    $("select[name='item_id']").html(data);
                }
            });
        }

        $("select[name='item_id']").change(function(){
            let item_id=$(this).val();

            if(item_id==""){
                $("input[name='unit']").val("");
                return;
            }

            $.ajax({
                url:"../routes/inventory/get_item_unit_route.php",
                type:"GET",
                data:{item_id:item_id},
                dataType:"json",
                success:function(response){
                    $("input[name='unit']").val(response.unit);
                }
            });
        });

        $("#supplierItemForm").submit(function(e){
            e.preventDefault();

            $.ajax({
                url:"../routes/inventory/add_supplier_item_route.php",
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

                        $("#addSupplierItemModal").modal("hide");

                        loadSupplierItems();
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

        $("select[name='supplier_id']").change(function(){
            let supplierName = $(this).find(":selected").text();

            if($(this).val()=="") {
                $("#previewSupplier").text("-");
            } else {
                $("#previewSupplier").text(supplierName);
            }

        });

        $("select[name='item_id']").change(function(){
            let itemName = $(this).find(":selected").text();

            if($(this).val()=="") {
                $("#previewItem").text("-");
            } else {
                $("#previewItem").text(itemName);
            }

        });

        $("input[name='unit_price']").keyup(function(){
            let price = $(this).val();

            if(price=="") {
                $("#previewPrice").text("-");
            } else {
                $("#previewPrice").text("Rs. " + price);
            }

        });

    });
</script>