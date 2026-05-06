<!DOCTYPE html>
<html>
<head>
<style>
    body { font-family: Arial; }
    .header { text-align:center; color:#c9a44c; }
    .box { border:1px solid #ddd; padding:10px; margin-bottom:10px; }
    .total { font-size:18px; font-weight:bold; color:#c9a44c; }
</style>
</head>

<body>

    <h2 class="header">Cremation Invoice</h2>

    <div class="box">
        <p><b>Name:</b> <?= $name ?></p>
        <p><b>Date:</b> <?= $date ?></p>
        <p><b>Slot:</b> <?= $slot ?></p>
    </div>

    <div class="box">
        <p><b>Cremation Fee:</b> LKR <?= $cremation ?></p>
        <p><b>Memorial Fee:</b> LKR <?= $memorial ?></p>
    </div>

    <p class="total">Total: LKR <?= $total ?></p>

</body>
</html>