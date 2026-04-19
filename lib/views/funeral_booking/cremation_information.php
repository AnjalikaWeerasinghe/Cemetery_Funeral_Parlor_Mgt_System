
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

                        </div>

                        <label for="time_slot" class="form-label">Available Time Slots *</label>

                        <div id="timeSlotsContainer" class="d-flex flex-wrap gap-2"></div>

                        <input type="hidden" id="selected_slot_id">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    console.log("JS Loaded");
    
    $(document).ready(function() {
        $.ajax({
            url: "../routes/funeral_booking/generate_booking_code.php",
            type: "POST",
            data: {service_type: service_type},
            success:function(response){
                $("#booking_code").val(response);
            }
        });

        $("#cremation_date").change(function(){

            let selectedDate = $(this).val();
            console.log("Selected Date:", selectedDate);

            let dayOfWeek = new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'long' });
            console.log("Day:", dayOfWeek);

            $.post("../routes/funeral_booking/get_time_slots_route.php", {
                date: dayOfWeek
            }, function(res) {
                console.log("Response:", res);
                $("#timeSlotsContainer").html(res);
            });

        });

        $(document).on("click", ".slot-card", function(){

            if($(this).hasClass("bg-secondary")) return;

            $(".slot-card").removeClass("border-primary");

            $(this).addClass("border-primary");

            let slotId = $(this).data("id");

            $("#selected_slot_id").val(slotId);

            console.log("Selected Slot ID:", slotId);

        });
    });
</script>