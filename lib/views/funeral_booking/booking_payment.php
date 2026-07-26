<?php
session_start();
?>

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
                    <div><span class="label">Name of Deceased:</span> <span class="value" id="deceased_name"></span></div>
                    <div><span class="label">Date of Cremation:</span> <span class="value" id="cremation_date"></span></div>
                    <div><span class="label">Cremation Time Slot:</span> <span class="value" id="cremation_slot"></span></div>
                    <div><span class="label">Area:</span> <span class="value" id="area_type"></span></div>
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
                    <input type="text" id="card_number" class="form-control mb-2" placeholder="Card Number">
                    <input type="text" id="card_holder" class="form-control mb-2" placeholder="Card Holder Name">
                    <div class="row">
                        <div class="col">
                            <input type="text" id="expiry_date" class="form-control" placeholder="MM/YY">
                        </div>
                        <div class="col">
                            <input type="text" id="cvv" class="form-control" placeholder="CVV">
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
                    <span id="funeral_service_fee">LKR 0</span>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Memorial Fee</span>
                    <span id="memorial_fee">LKR 0</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span id="total_fee">LKR 0</span>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $("#deceased_name").text(sessionStorage.getItem("full_name"));
    $("#cremation_date").text(sessionStorage.getItem("selectedDate"));
    $("#cremation_slot").text(sessionStorage.getItem("slot_text"));

    let areaType = sessionStorage.getItem("area_type");

    if(areaType === "municipal_limit"){
        $("#area_type").text("Municipal Limit Area");
    }
    else if(areaType === "outside_municipal_limit"){
        $("#area_type").text("Outside Municipal Limit Area");
    } 
    else{
        $("#area_type").text("Not Selected");
    }

    $("#funeral_service_fee").text("LKR " + (sessionStorage.getItem("cremation_price") || 0));
    $("#memorial_fee").text("LKR " + (sessionStorage.getItem("memorial_price") || 0));
    $("#total_fee").text("LKR " + (sessionStorage.getItem("total_amount") || 0));

    $(".payment-method").click(function(){
        $(".payment-method").removeClass("active");
        $(this).addClass("active");

        let method = $(this).data("method");

        if(method === "card"){
            $("#cardForm").stop(true, true).slideDown();
        }
        else{
            $("#cardForm").stop(true, true).slideUp();
        }
    });

    $("#payNow").click(function(){
        let pay_method = $(".payment-method.active").data("method");
        if(!pay_method){
            alert("Please select a payment method.");
            return;
        }

        if(pay_method === "card"){
            let cardNo = $("#card_number").val();

            if(!cardNo || cardNo.replace(/\s/g, "").length < 16){
                alert("Invalid card number.");
                return;
            }
        }

        let route = "<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin')
                ? '../routes/funeral_booking/add_booking_payment_route.php'
                : 'lib/routes/funeral_booking/add_booking_payment_route.php'; ?>";

        $.ajax({
            url: route,
            method: "POST",
            data: {
                payment_method: pay_method,
                service_cost: sessionStorage.getItem("cremation_price"),
                memorial_cost: sessionStorage.getItem("memorial_price"),
                total_payment: sessionStorage.getItem("total_amount"),
                paid_amount: sessionStorage.getItem("total_amount")
            },
            success: function(res){
                let paymentResponse = JSON.parse(res);

                console.log(res);

                if(paymentResponse.status === "success"){
                    let route = "<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin')
                        ? '../routes/funeral_booking/confirm_cremation_booking_route.php'
                        : 'lib/routes/funeral_booking/confirm_cremation_booking_route.php'; ?>";


                    $.ajax({
                        url: route,
                        method: "POST",
                        success: function(confirmRes){
                            console.log(confirmRes);

                            let response = JSON.parse(confirmRes);

                            if(response.status === "success"){
                                
                                Swal.fire({
                                    title: "Payment Successful!",
                                    text: "Your booking has been confirmed.",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonText: "Generate Invoice",
                                    cancelButtonText: "View Booking"
                                }).then((result)=>{

                                    sessionStorage.clear();
                                    localStorage.removeItem("selectedBookingService");

                                    window.bookingCode = "";
                                    completedStep = 1;

                                    if(result.isConfirmed){
                                        let invoiceRoute = "<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin')
                                            ? '../views/funeral_booking/invoice.php'
                                            : 'lib/views/funeral_booking/invoice.php'; ?>";


                                        window.location.href =
                                        "funeral_booking/invoice.php?payment_id=" + response.payment_id;

                                    }
                                    else{
                                        let confirmPage = "<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin')
                                            ? '../views/funeral_booking/booking_confirmation.php'
                                            : 'lib/views/funeral_booking/booking_confirmation.php'; ?>";

                                        $("#bookingContent")
                                        .load(confirmPage);

                                    }

                                });

                            }
                        },
                        error: function(err){
                            console.log(err.responseText);

                            alert("Booking confirmation failed.");
                        }
                    });
                       
                } else {
                    alert(res);
                }
            },
            error: function(xhr){
                console.log(xhr.responseText);
                alert("An error occurred while processing your payment.");
            }
        });
    });

});
</script>