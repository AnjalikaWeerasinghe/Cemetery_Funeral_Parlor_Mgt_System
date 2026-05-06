<style>
.payment-card {
    background: #fff;
    border-radius: 14px;
    border-top: 3px solid #c9a44c;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    padding: 25px;
}

.section-title {
    font-weight: 600;
    color: #c9a44c;
    border-left: 4px solid #c9a44c;
    padding-left: 10px;
    margin-bottom: 15px;
}

.summary-box {
    background: #f9fbfd;
    border: 1px solid #e0e6ed;
    border-radius: 10px;
    padding: 12px;
    margin-bottom: 12px;
}

.label {
    font-size: 13px;
    color: #666;
}

.value {
    font-weight: 600;
    color: #222;
}

.payment-method {
    border: 1px solid #e0e6ed;
    border-radius: 10px;
    padding: 12px;
    cursor: pointer;
    transition: 0.2s;
    margin-bottom: 10px;
}

.payment-method:hover {
    border-color: #c9a44c;
    background: #fffdf6;
}

.payment-method.active {
    border: 2px solid #c9a44c;
    background: #fff9e6;
}

.pay-btn {
    background: linear-gradient(135deg, #c9a44c, #f4d03f);
    border: none;
    padding: 12px 25px;
    border-radius: 10px;
    font-weight: 600;
    width: 100%;
    transition: 0.3s;
}

.pay-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(201,164,76,0.4);
}

.price-box {
    position: sticky;
    top: 20px;
    background: #fff;
    border-radius: 14px;
    border-top: 3px solid #c9a44c;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    padding: 20px;
}
</style>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-8">

            <div class="payment-card">

                <h4 class="text-center mb-4">Payment Details</h4>

                <div class="section-title">Booking Summary</div>

                <div class="summary-box">
                    <div><span class="label">Name:</span> <span class="value" id="p_name"></span></div>
                    <div><span class="label">Date:</span> <span class="value" id="p_date"></span></div>
                    <div><span class="label">Slot:</span> <span class="value" id="p_slot"></span></div>
                    <div><span class="label">Area:</span> <span class="value" id="p_area"></span></div>
                </div>

                <div class="section-title">Select Payment Method</div>

                <div class="payment-method" data-method="card">
                    💳 Credit / Debit Card
                </div>

                <div class="payment-method" data-method="bank">
                    🏦 Bank Transfer
                </div>

                <div class="payment-method" data-method="cash">
                    💵 Cash Payment (On Arrival)
                </div>

                <div id="cardForm" style="display:none;">
                    <input class="form-control mb-2" placeholder="Card Number">
                    <input class="form-control mb-2" placeholder="Card Holder Name">
                    <div class="row">
                        <div class="col">
                            <input class="form-control" placeholder="MM/YY">
                        </div>
                        <div class="col">
                            <input class="form-control" placeholder="CVV">
                        </div>
                    </div>
                </div>

                <button class="pay-btn mt-3" id="payNow">
                    Pay & Confirm Booking
                </button>

            </div>
        </div>

        <div class="col-md-4">

            <div class="price-box">

                <div class="section-title">Payment Summary</div>

                <div class="d-flex justify-content-between">
                    <span>Cremation Fee</span>
                    <span id="fee1">LKR 0</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Memorial Fee</span>
                    <span id="fee2">LKR 0</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span id="total">LKR 0</span>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $("#p_name").text(sessionStorage.getItem("full_name"));
    $("#p_date").text(sessionStorage.getItem("cremation_date"));
    $("#p_slot").text(sessionStorage.getItem("slot_text"));
    $("#p_area").text(sessionStorage.getItem("area_type"));

    $("#fee1").text("LKR " + (sessionStorage.getItem("cremation_fee") || 0));
    $("#fee2").text("LKR " + (sessionStorage.getItem("memorial_fee") || 0));
    $("#total").text("LKR " + (sessionStorage.getItem("total_amount") || 0));

    $(".payment-method").click(function(){
        $(".payment-method").removeClass("active");
        $(this).addClass("active");

        let method = $(this).data("method");

        if(method === "card"){
            $("#cardForm").slideDown();
        } else {
            $("#cardForm").slideUp();
        }
    });

    $("#payNow").click(function(){
        alert("Payment Processing... (Integrate gateway here)");
    });

});
</script>