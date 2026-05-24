<style>
:root {
    --gold-main: #c9a44c;
    --gold-soft: #e8d9a3;
    --gold-dark: #a8892f;
}

body {
    background: #f4f6fb;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    background: #ffffff;
    border-radius: 16px;
    border: none;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    padding: 10px;
}

h6 {
    font-weight: 600;
    color: var(--gold-main);
    border-left: 4px solid var(--gold-main);
    padding-left: 12px;
    letter-spacing: 0.4px;
}

.form-control {
    border-radius: 10px;
    padding: 10px 12px;
    border: 1px solid #e0e6ed;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13,110,253,0.1);
}

.form-label {
    font-weight: 500;
    color: #444;
}

.section-box {
    background: #f8fafc;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
}

#load_step4 {
    background: linear-gradient(135deg, var(--gold-main), var(--gold-soft));
    color: #2b2b2b;
    border: none;
    border-radius: 12px;
    padding: 12px 28px;
    font-weight: 600;
    letter-spacing: 0.6px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

#load_step4::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: 0.5s;
}

#load_step4:hover::after {
    left: 100%;
}

#load_step4:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(201,164,76,0.4);
}

#load_step4:active {
    transform: scale(0.98);
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

#load_step4:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(201,164,76,0.3);
}

.back-btn {
    background: linear-gradient(135deg, #6c757d, #adb5bd);
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: 10px 22px;
    font-weight: 600;
    letter-spacing: 0.4px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.back-btn::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: 0.5s;
}

.back-btn:hover::after {
    left: 100%;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

.back-btn:active {
    transform: scale(0.97);
}

</style>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form id="parlor_info" autocomplete="off" enctype="multipart/form-data">
                <div class="section-box">
                    <h6 class="mb-3">Parlor Booking Information</h6>
                    <p class="text-muted">Please provide the following information regarding the Parlor Reservation.</p>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="district" class="form-label">District *</label>
                        <input type="text" name="district" id="district" class="form-control" value="Kandy" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="urban_council_division" class="form-label">Urban Council Division *</label>
                        <input type="text" name="urban_council_division" id="urban_council_division" class="form-control" value="Gampola Urban Council" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="parlor_name" class="form-label">Parlor Name *</label>
                        <input type="text" name="parlor_name" id="parlor_name" class="form-control" value="Nisala Arana Parlor" readonly>
                    </div>
                </div>

                <div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 mb-3">
                            <label for="start_date" class="form-label text-start">Start Date *</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="start_time" class="form-label text-start">Start Time *</label>
                            <input type="time" name="start_time" id="start_time" class="form-control">
                        </div>
                    </div>

                    <p class="text-center">From</p>

                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4 mb-3">
                            <label for="end_date" class="form-label text-start">End Date *</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">  
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="end_time" class="form-label text-start">End Time *</label>
                            <input type="time" name="end_time" id="end_time" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="price-row d-flex justify-content-center align-items-center">
                        <span class="text-muted">Parlor Reservation Cost:</span>
                    </div>
                </div>

                <div class="row">
                    <div class="price-row d-flex justify-content-center align-items-center">
                        <span class="fw-bold text-dark" id="parlor_cost">LKR 0</span>
                    </div>
                    <input type="hidden" name="parlor_total_cost" id="parlor_total_cost">
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <div>
                        <button type="button" class="back-btn" id="load_step2">Back</button>
                    </div>
                    <div class="text-end">
                        <button type="submit" id="load_step4">Proceed to Confirmation Page</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        const hourlyRate = 500;

        function calculateParlorCost() {

            let startDate = $("#start_date").val();
            let startTime = $("#start_time").val();

            let endDate = $("#end_date").val();
            let endTime = $("#end_time").val();

            if (
                startDate && startTime && endDate && endTime
            ) {

                let start = new Date(startDate + "T" + startTime);
                let end = new Date(endDate + "T" + endTime);

                let diffMs = end - start;
                let hours = diffMs / (1000 * 60 * 60);

                if (hours <= 0) {
                    $("#parlor_cost").text("Invalid Date/Time");
                    return;
                }

                let totalCost = hours * hourlyRate;

                $("#parlor_cost").text(
                    "LKR " + totalCost.toLocaleString()
                );

            }

            $("#parlor_total_cost").val(totalCost);

        }

        $("#parlor_info").on("submit", function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({

                url: "../routes/funeral_booking/add_parlor_info_route.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success:function(response) {
                    if (response.success) {
                        loadStep(4);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("Something went wrong.");
                }

            });

        });

        $("#start_date, #start_time, #end_date, #end_time").on("change", function () {
            calculateParlorCost();
        });

        $(document).on("click", "#load_step2", function () {
            loadStep(2);
        });

    });

</script>