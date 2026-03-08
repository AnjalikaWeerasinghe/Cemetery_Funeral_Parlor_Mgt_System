<style>
#preview {
    width: 150px;
    height: 150px;
    border: 2px dashed #ced4da;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 10px;
    background-color: #f8f9fa;
    color: #6c757d;
    font-size: 14px;
}

#preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add New Funeral Reservation</h5>

            <a href="admin.php?page=funeralBookings" class="btn btn-light btn-sm bg-warning">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="card-body">
            <form id="submit_form" autocomplete="off">
                <h6 class="border-bottom pb-2 mb-3 text-primary">Deceased Information</h6>

                <div class="row">
                    <div class="col-md-9 mb-3">
                        <label for="full_name" class="form-label">Full Name *</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="date_of_death" class="form-label">Date of Death *</label>
                        <input type="date" name="date_of_death" id="date_of_death" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="cause_of_death" class="form-label">Cause of death *</label>
                        <input type="text" name="cause_of_death" id="cause_of_death" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="applicant_name" class="form-label">Applicant Name *</label>
                        <input type="text" name="applicant_name" id="applicant_name" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="contact_number" class="form-label">Contact Number *</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" required>
                    </div>
                </div>

                <h6 class="border-bottom pb-2 mb-3 text-primary">Booking Information</h6>

                <div class="row">
                    <div class="form-check form-check-inline col-md-3 mb-3">
                        <input class="form-check-input service_type" type="radio" name="service_type" id="cremation" value="Cremation">
                        <label class="form-check-label" for="cremation">Cremation</label>
                    </div>
                    <div class="form-check form-check-inline col-md-3 mb-3">
                        <input class="form-check-input service_type" type="radio" name="service_type" id="burial" value="Burial">
                        <label class="form-check-label" for="burial">Burial</label>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="booking_code" class="form-label">Booking Code</label>
                    <input type="text" name="booking_code" id="booking_code" class="form-control" readonly>
                </div>

                <div>
                    <div id="cremationContent" class="row mt-2" style="display:none;">
                        <div class="col-md-4 ">
                            <div class="mb-3">
                                <label for="cremation_date" class="form-label">Date of Cremation *</label>
                                <input type="date" name="cremation_date" id="cremation_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="time_slot" class="form-label">Time Slot *</label>
                                <input type="time" name="time_slot" id="time_slot" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <h5>Daily Schedule</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Time Slot</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="schedule_table">
                                    <tr>
                                        <td colspan="2">Select a date to view schedule</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <div id="burialContent" class="mt-2" style="display:none;">
                        <div class="col-md-3 mb-3">
                            <label for="burial_date" class="form-label">Date of Burial *</label>
                            <input type="date" name="burial_date" id="burial_date" class="form-control" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="burial_time" class="form-label">Burial Time *</label>
                            <input type="time" name="burial_time" id="burial_time" class="form-control" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".service_type").change(function(){
            let service_type = $(this).val();

            $.ajax({
                url: "../routes/funeral_booking/generate_booking_code.php",
                type: "POST",
                data: {service_type: service_type},
                success:function(response){
                    $("#booking_code").val(response);
                }
            });
        });

        $('input[name="service_type"]').on('change', function() {

            $('#cremationContent, #burialContent').slideUp();

            if ($(this).val() === 'Cremation') {
            $('#cremationContent').slideDown();
            } else if ($(this).val() === 'Burial') {
            $('#burialContent').slideDown();
            }
        });

        $("#schedule_date").change(function(){

            let selectedDate = $(this).val();

            $.ajax({
                url: "get_schedule.php",
                method: "POST",
                data: {date:selectedDate},
                success:function(data){
                    $("#schedule_table").html(data);
                }

            });

        });
        
    });
</script>