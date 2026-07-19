<?php
require_once '../../functions/InvoiceController.php';

if(!isset($_GET['payment_id'])){
    die("Payment ID missing.");
}

$payment_id = $_GET['payment_id'];

$invoiceController = new InvoiceController();
$invoice = $invoiceController->getInvoiceDetails($payment_id);

if(!$invoice){
    die("Invoice not found.");
}
?>

<style>

body{
    background:#f3f4f7;
    font-family:'Segoe UI',sans-serif;
}

.invoice-container{
    width:500px;
    margin:25px auto;
    background:#fff;
    padding:25px;
    border-radius:10px;
    border-top:4px solid #c9a44c;
    box-shadow:0 5px 20px rgba(0,0,0,.1);
}

.invoice-header{
    text-align:center;
}

.logo{
    width:55px;
    height:55px;
    object-fit:cover;
}

.company-name{
    color:#b28b2c;
    font-size:18px;
    font-weight:700;
    margin:8px 0 2px;
}

.company-address{
    color:#777;
    font-size:13px;
    margin:0;
}

.invoice-title{
    font-size:17px;
    letter-spacing:2px;
    font-weight:700;
    margin:12px 0;
}

hr{
    margin:15px 0;
}

.invoice-info{
    background:#fafafa;
    border:1px solid #eee;
    border-radius:8px;
    padding:12px;
}

.invoice-info p{
    margin:5px 0;
    font-size:14px;
}

.info-label{
    color:#777;
}

.info-value{
    font-weight:600;
}

.section-title{
    text-align:center;
    font-size:15px;
    font-weight:600;
    margin:18px 0 8px;
}

.invoice-table{
    width:100%;
    border-collapse:collapse;
    margin:auto;
}

.invoice-table th{
    background:#f5f5f5;
    padding:8px;
    border:1px solid #ddd;
    text-align:center;
}

.invoice-table td{
    padding:8px;
    border:1px solid #ddd;
    font-size:14px;
}

.invoice-table td:first-child{
    text-align:left;
}

.invoice-table td:last-child{
    text-align:right;
}


.total-row td{
    font-weight:700;
    font-size:15px;
    background:#fff8df;
}

.status{
    text-align:center;
    margin-top:15px;
}

.payment-status{
    display:inline-block;
    background:#d4edda;
    color:#155724;
    padding:4px 15px;
    border-radius:15px;
    font-size:13px;
    font-weight:600;
}

.footer-note{
    text-align:center;
    color:#777;
    font-size:12px;
    margin-top:20px;
}

.signature{
    text-align:center;
    margin-top:35px;
    font-size:13px;
}

.signature-line{
    margin:auto;
    width:150px;
    border-top:1px solid #555;
    margin-bottom:5px;
}

.invoice-actions{
    width:500px;
    margin:20px auto;
    display:flex;
    justify-content:center;
    gap:15px;
}

.btn-print,
.btn-back{
    padding:8px 25px;
    border:none;
    border-radius:6px;
    font-size:14px;
    cursor:pointer;
    font-weight:600;
}

.btn-print{
    background:#c9a44c;
    color:white;
}

.btn-print:hover{
    background:#a8892f;
}

.btn-back{
    background:#6c757d;
    color:white;
}

.btn-back:hover{
    background:#565e64;
}

@media print{

    .invoice-actions{
        display:none;
    }

    body{
        background:white;
    }

    .invoice-container{
        box-shadow:none;
        margin:auto;
    }

}

@media print{

    body{
        background:white;
    }

    .invoice-container{
        box-shadow:none;
    }

}

</style>

<div class="invoice-container">

    <div class="invoice-header">
        <img src="../../uploads/cemetery_logo.png" class="logo rounded-circle">
        <h5 class="company-name">General Cemetery & Funeral Parlor</h5>
        <p class="company-address">Gampola Urban Council</p>
        <h4 class="invoice-title">PAYMENT INVOICE</h4>
    </div>

    <hr>

    <div class="invoice-info">
        <p>
        <span class="info-label">Invoice No:</span>
        <span class="info-value"><?= htmlspecialchars($invoice['payment_code']) ?></span>
        </p>

        <p>
        <span class="info-label">Booking Code:</span>
        <span class="info-value"><?= htmlspecialchars($invoice['booking_code']) ?></span>
        </p>

        <p>
        <span class="info-label">Payment Date:</span>
        <span class="info-value"><?= date('d M Y', strtotime($invoice['payment_date'])) ?></span>
        </p>
    </div>

    <h5 class="section-title">Payment Summary</h5>

    <table class="invoice-table">

        <tr>
            <th>Description</th>
            <th>Amount (LKR)</th>
        </tr>

        <tr>
            <td><?= htmlspecialchars($invoice['service_type']) ?> Service Fee</td>
            <td><?= number_format($invoice['service_cost'],2) ?></td>
        </tr>

        <?php if($invoice['memorial_cost'] > 0): ?>
            <tr>
                <td>Memorial Service Fee</td>
                <td><?= number_format($invoice['memorial_cost'],2) ?></td>
            </tr>
        <?php endif; ?>

        <tr class="total-row">
            <td>Total Paid</td>
            <td><?= number_format($invoice['total_payment'],2) ?></td>
        </tr>

    </table>

    <p class="footer-note">Thank you for using General Cemetery & Funeral Parlor services.</p>

    <div class="signature">
        .........................................<br>
        Cashier
    </div>

</div>

<div class="invoice-actions">

    <button onclick="window.print()" class="btn-print">
        🖨 Print Invoice
    </button>

    <button onclick="history.back()" class="btn-back">
        ← Back
    </button>

</div>