<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form id="submit_form" autocomplete="off" enctype="multipart/form-data">
                <div>
                    <h6 class="border-bottom pb-2 mb-3 text-primary">Cremation Information</h6>

                    <div class="row">
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

                        <div class="col-md-7">
                            <h6>Daily Schedule</h5>
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

                    <div>
                        <div class="mb-3 pe-3">
                            <label for="ash_collection" class="form-label pe-2">Are you collecting the Ash after cremation? *</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cremation_permission" value="1" required>
                                <label class="form-check-label">Yes</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cremation_permission" value="0">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="ash_collection_method" class="form-label">Ash collection method</label>
                            <select name="ash_collection_method" id="ash_collection_method" class="form-select">
                                <option value="">Select</option>
                                <option value="">Collect</option>
                                <option value="">Memorial</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
 
                </div>
            </form>

            <div>
                <button type="submit" class="btn btn-success">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "../routes/funeral_booking/generate_booking_code.php",
            type: "POST",
            data: {service_type: service_type},
            success:function(response){
                $("#booking_code").val(response);
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