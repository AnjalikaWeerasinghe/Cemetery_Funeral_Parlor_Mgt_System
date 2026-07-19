<div class="container-fluid">

    <div class="align-items-center justify-content-center text-center mb-4">
        <img src="../uploads/cemetery_logo.png" class="rounded-circle me-2" height="45" width="45" alt="Logo">
        <h6>General Cemetery & Funeral Parlor</h6>
        <h6>Gampola</h6>
    </div>

    <div class="text-center py-2">
        <h5>Monthly Income Report</h5>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Income (LKR)</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach($reportData as $row){ ?>
                        <tr>
                            <td><?= htmlspecialchars($row['service']) ?></td>
                            <td><?= $fromDate ?></td>
                            <td><?= $toDate ?></td>
                            <td class="text-end">
                                <?= number_format($row['total_income'],2) ?>
                            </td>
                        </tr>
                    <?php } ?>

                    <tr class="table-secondary fw-bold">
                        <td>Total</td>
                        <td><?= $fromDate ?></td>
                        <td><?= $toDate ?></td>
                        <td class="text-end">
                            <?= number_format($grandTotal,2) ?>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>
    </div>

    <div class="row mt-5">

        <div class="col-md-4 text-center">
            <br><br>
            ...................................................
            <br>
            Signature
        </div>

        <div class="col-md-4 text-center">
            <br><br>
            ...................................................
            <br>
            Date
        </div>

        <div class="col-md-4 text-center">
            <br><br>
            ...................................................
            <br>
            General Manager
        </div>

    </div>

</div>


