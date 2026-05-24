<?php
session_start();

$bookingCode = $_SESSION['last_booking']['booking_code'] ?? '';
$paymentCode = $_SESSION['last_booking']['payment_code'] ?? '';
$paymentMethod = $_SESSION['last_booking']['payment_method'] ?? '';
?>

<style>
.success-card{
    background:#fff;
    border-radius:16px;
    padding:40px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    text-align:center;
}

.success-icon{
    font-size:70px;
    color:green;
}

.info-box{
    background:#f8f9fa;
    padding:15px;
    border-radius:10px;
    margin-top:20px;
}
</style>

<div class="container py-5">

    <div class="success-card">

        <div class="success-icon">
            ✅
        </div>

        <h2 class="mt-3">
            Booking Confirmed Successfully
        </h2>

        <p class="text-muted">
            Your cremation booking has been successfully submitted.
        </p>

        <div class="info-box">

            <p>
                <strong>Booking Code:</strong>
                <?= $bookingCode ?>
            </p>

            <p>
                <strong>Payment Code:</strong>
                <?= $paymentCode ?>
            </p>

            <p>
                <strong>Payment Method:</strong>
                <?= ucfirst($paymentMethod) ?>
            </p>

        </div>

    </div>

</div>

<div class="invoice-box">

    <h2>Cremation Booking Invoice</h2>

    <hr>

    <p><strong>Booking Code:</strong> <?= $bookingCode ?></p>

    <p><strong>Payment Code:</strong> <?= $paymentCode ?></p>

    <p><strong>Transaction Ref:</strong> <?= $transactionReference ?></p>

    <p><strong>Payment Date:</strong> <?= $paymentDate ?></p>

    <hr>

    <p><strong>Deceased Name:</strong> <?= $fullName ?></p>

    <p><strong>Applicant:</strong> <?= $applicantName ?></p>

    <p><strong>Service Type:</strong> Cremation</p>

    <hr>

    <table class="table">

        <tr>
            <td>Cremation Fee</td>
            <td>LKR <?= number_format($serviceCost,2) ?></td>
        </tr>

        <tr>
            <td>Memorial Fee</td>
            <td>LKR <?= number_format($memorialCost,2) ?></td>
        </tr>

        <tr>
            <th>Total Paid</th>
            <th>LKR <?= number_format($totalPayment,2) ?></th>
        </tr>

    </table>

    <button onclick="window.print()" class="btn btn-dark">
        Print Invoice
    </button>

</div>