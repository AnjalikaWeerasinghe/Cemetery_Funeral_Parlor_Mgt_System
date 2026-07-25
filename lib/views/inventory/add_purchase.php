<style>
    .card-header{
        border-radius:15px 15px 0 0 !important;
        padding:15px 20px;
    }

    .form-label{
        font-weight:600;
        color:#374151;
    }

    .input-group-text{
        background:#fff;
        border-right:0;
    }

    .input-group .form-control,
    .input-group .form-select{
        border-left:0;
    }

    textarea.form-control{
        resize:none;
        min-height:100px;
    }

    .required,
    .text-danger{
        color:#dc2626;
    }
</style>

<div class="modal fade" id="addPurchaseModal" tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fa fa-cart-shopping me-2"></i>Create Purchase Order
                </h5>

                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="purchaseForm">

                <div class="modal-body">

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">
                                <i class="fa fa-file-invoice me-2"></i>
                                Purchase Information
                            </h6>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Purchase Code <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-hashtag"></i>
                                        </span>
                                        <input type="text" class="form-control" name="purchase_code" id="purchase_code" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Purchase Date <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" class="form-control" name="purchase_date" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Supplier <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-truck"></i>
                                        </span>
                                        <select class="form-select" name="supplier_id">
                                            <option value="">Select Supplier</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Payment Status
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-credit-card"></i>
                                        </span>
                                        <select class="form-select" name="payment_status">
                                            <option value="Pending" selected>Pending</option>
                                            <option value="Partially Paid">Partially Paid</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">
                                        Remarks
                                    </label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="remarks" rows="2" placeholder="Enter purchase remarks (optional)..."></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Purchase Items</h6>

                        <button type="button" class="btn btn-success" id="addRow">
                            <i class="fa fa-plus me-2"></i>Add Item
                        </button>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle" id="purchaseTable">
                            <thead class="table-dark">
                                <tr>
                                    <th width="30%">Item</th>
                                    <th width="15%">Unit</th>
                                    <th width="15%">Quantity</th>
                                    <th width="15%">Unit Price</th>
                                    <th width="15%">Total</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>

                            <tbody id="purchaseItems"></tbody>
                        </table>

                    </div>

                    <div class="row mt-4">

                        <div class="col-md-8"></div>

                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Order Summary</h5>

                                    <div class="d-flex justify-content-between">
                                        <span>Total Amount</span>
                                        <strong>Rs. <span id="grandTotal">0.00</span></strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-gold">
                        <i class="fa fa-save me-2"></i>Save Purchase Order
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<script>
    $(document).ready(function(){
        loadSuppliers();
        loadPurchaseCode();

        let supplierItems = [];

        function loadPurchaseCode() {
            $("#purchase_code").val("Generating..");

            $.ajax({
                url: "../routes/inventory/generate_purchase_code.php",
                type: "GET",
                success: function (response) {
                    $("#purchase_code").val(response);
                },
                error: function () {
                    $("#purchase_code").val("Error");
                }
            });
        }

        function loadSuppliers(){
            $.ajax({
                url:"../routes/inventory/load_supplier_route.php",
                type:"GET",
                success:function(data){
                    $("select[name='supplier_id']").html(data);
                }
            });
        }

        $("select[name='supplier_id']").change(function(){
            let supplier_id = $(this).val();

            if(supplier_id==""){
                supplierItems = [];
                return;
            }

            $.ajax({
                url:"../routes/inventory/load_supplier_item_route.php",
                type:"GET",
                data:{
                    supplier_id:supplier_id
                },
                dataType:"json",
                success:function(response){
                    console.log(response);
                    supplierItems = response;

                    $("#purchaseItems").empty();

                    calculateGrandTotal();
                }
            });

        });

        $("#addRow").click(function(){

            if($("select[name='supplier_id']").val() == ""){
                Swal.fire({
                    icon: "warning",
                    title: "Supplier Required",
                    text: "Please select a supplier first."
                });
                return;
            }

            if(supplierItems.length==0){
                Swal.fire({
                    icon:"warning",
                    title:"No Items",
                    text:"This supplier has no items."
                });

                return;
            }

            let options = '<option value="">Select Item</option>';

            supplierItems.forEach(function(item){
                options += `
                    <option value="${item.supplier_item_id}">
                        ${item.item_name}
                    </option>
                `;
            });

            let row = `
                <tr>
                    <td>
                        <select class="form-select itemSelect" name="supplier_item_id[]">
                            ${options}
                        </select>
                    </td>

                    <td>
                        <input type="text" class="form-control unit" readonly>
                    </td>

                    <td>
                        <input type="number" class="form-control qty" name="quantity[]" min="1" value="1">
                    </td>

                    <td>
                        <input type="number" class="form-control price" name="unit_price[]" readonly>
                    </td>

                    <td>
                        <input type="text" class="form-control total" name="sub_total[]" readonly>
                    </td>

                    <td class="text-center">
                        <button type="button" class="btn btn-danger removeRow">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            $("#purchaseItems").append(row);
        });

        $(document).on("change", ".itemSelect", function(){
            let supplier_item_id = $(this).val();
            let row = $(this).closest("tr");
            let selected = supplierItems.find(function(item){
                return item.supplier_item_id == supplier_item_id;
            });

            console.log(selected);

            if(selected){
                row.find(".unit").val(selected.unit);
                row.find(".price").val(selected.unit_price);
                row.find(".qty").val(1);

                calculateRow(row);
            }
        });

        function calculateRow(row){
            let qty = parseFloat(row.find(".qty").val()) || 0;
            let price = parseFloat(row.find(".price").val()) || 0;
            let total = qty * price;

            row.find(".total").val(total.toFixed(2));

            calculateGrandTotal();
        }

        function calculateGrandTotal(){
            let grandTotal = 0;

            $("#purchaseItems tr").each(function(){
                grandTotal += parseFloat($(this).find(".total").val()) || 0;
            });

            $("#grandTotal").text(grandTotal.toFixed(2));
        }

        $(document).on("keyup change", ".qty", function(){
            let row = $(this).closest("tr");

            calculateRow(row);
        });

        $(document).on("click", ".removeRow", function(){
            $(this).closest("tr").remove();

            calculateGrandTotal();
        });

        $("#purchaseForm").submit(function(e){
            e.preventDefault();

            let valid = true;

            $(".itemSelect").each(function(){
                if($(this).val()==""){
                    valid = false;
                    return false;
                }
            });

            if(!valid){
                Swal.fire({
                    icon:"warning",
                    title:"Incomplete Purchase",
                    text:"Please select an item for every purchase row."
                });
                return;
            }

            if($("#purchaseItems tr").length == 0){
                Swal.fire({
                    icon:"warning",
                    title:"No Items",
                    text:"Please add at least one purchase item."
                });

                return;
            }

            $.ajax({
                url:"../routes/inventory/add_purchase_route.php",
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

                        $("#addPurchaseModal").modal("hide");

                        loadPurchases();
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
</script>