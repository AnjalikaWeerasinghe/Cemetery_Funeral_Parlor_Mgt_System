<div class="container mt-4">

    <h4 class="border-bottom pb-2 mb-3 text-primary">Manage Weekly Cremation Time Slots</h4>

    <div class="row mb-3">
        <div class="col-md-4">
            <select id="daySelect" class="form-control mb-3">
                <option value="">Select Day</option>
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <input type="time" id="start_time" class="form-control">
        </div>
        <div class="col">
            <input type="time" id="end_time" class="form-control">
        </div>
        <div class="col">
            <button class="btn btn-success" id="addSlot">Add Slot</button>
        </div>
    </div>

    <div id="slotList">
        <p>Select a day to view available time slots.</p>
    </div>

</div>

<script>
    $(document).ready(function(){
        $("#daySelect").change(function(){

            $.post("../routes/funeral_booking/cremation_slot/get_slots_route.php", { 
                day: $(this).val() 
            }, function(res){
                $("#slotList").html(res);
            });

        });

        $("#addSlot").click(function(){

            $.post("../routes/funeral_booking/cremation_slot/add_slot_route.php", {
                day: $("#daySelect").val(),
                start_time: $("#start_time").val(),
                end_time: $("#end_time").val()
            }, function(res){

                alert(res);
                $("#daySelect").trigger("change");

            });

        });

    });

    function deleteSlot(id){

        $.post("../routes/funeral_booking/cremation_slot/delete_slot_route.php", { 
            id 
        }, function(res){
            alert(res);
            $("#daySelect").trigger("change");
        });

    }

    function toggleSlot(id){

        $.post("../routes/funeral_booking/cremation_slot/toggle_slot_route.php", { 
            id 
        }, function(res){
            alert(res);
            $("#daySelect").trigger("change");
        });

    }
    
</script>