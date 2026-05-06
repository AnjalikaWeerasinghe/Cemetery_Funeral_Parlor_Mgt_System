<style>

.slot-card {
    background: #f8f8f8;
    border: 1px solid #ccc;
    transition: 0.2s;
}

.slot-card {
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    border: 1px solid #ddd;
    transition: all 0.25s ease;
    font-weight: 500;
}

.slot-normal {
    background: #f8f9fa;
    color: #333;
}

.slot-normal:hover {
    background: #e9ecef;
}

.slot-after {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}

.slot-after:hover {
    background: #ffe8a1;
}

.slot-disabled {
    background: #d6d6d6 !important;
    color: #888 !important;
    cursor: not-allowed;
    opacity: 0.7;
}

.slot-selected {
    background: linear-gradient(145deg, #2c2c2c, #1a1a1a) !important;
    color: #fff !important;
    border: 1px solid #555;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

.slot-card:hover {
    background: #eeeeee;
}

.slot-selected {
    background: linear-gradient(145deg, #3a3a3a, #1f1f1f);
    color: #fff;
    border: 1px solid #666;
}

.slot-disabled {
    background: #ccc;
    color: #777;
    cursor: not-allowed;
}
</style>

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

        <div class="col-md-4">
            <select name="slottype" id="slottype" class="form-control mb-3">
                <option value="">Select slot type</option>
                <option value="normal" class="slot-normal">Normal</option>
                <option value="afterNormal" class="slot-after">After Normal</option>
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
            <button type="button" class="btn btn-success" id="addSlot">Add Slot</button>
        </div>

        <input type="hidden" name="cremation_time_slot" id="selected_slot">
    </div>

    <div id="slotList">
        <p>Select a day to view available time slots.</p>
    </div>

</div>

<script>
    $(document).ready(function(){
        $("#daySelect").change(function(){

            let day = $(this).val();

            if(!day) {
                $("#slotList").html("<p>Select a day to view available time slots.</p>");
                return;
            }

            $.post("../routes/funeral_booking/cremation_slot/get_slots_route.php", { 
                day: day 
            }, function(res){
                $("#slotList").html(res);
            });

        });

        $("#addSlot").click(function(){
            console.log("Button clicked");

            let day = $("#daySelect").val();
            let start = $("#start_time").val();
            let end = $("#end_time").val();
            let slottype = $("#slottype").val();

            console.log("Day:", day, "Slot Type:", slottype, "Start:", start, "End:", end);

            if(!day){
                alert("Please select a day.");
                return; 
            }

            if(!start ||  !end){
                alert("Please select start and end times.");
                return; 
            }

            $.post("../routes/funeral_booking/cremation_slot/add_slot_route.php", {
                day: day,
                slottype: slottype,
                start_time: start,
                end_time: end
            }, function(res){
                console.log(res);
                $("#daySelect").trigger("change");

            });

        });

    });

    $(document).on("click", ".slot-card", function(){

        if($(this).hasClass("bg-secondary")) return;

        if($(this).hasClass("slot-disabled")) return;

        $(".slot-card").removeClass("slot-selected");

        $(this).addClass("slot-selected");

        let slotId = $(this).data("id");

        $("#selected_slot").val(slotId);

    });

    function deleteSlot(id){

        if(!confirm("Are you sure you want to delete this slot?")) return;

        $.post("../routes/funeral_booking/cremation_slot/delete_slot_route.php", { 
            id 
        }, function(res){
            $("#daySelect").trigger("change");
        });

    }

    function toggleSlot(id){

        $.post("../routes/funeral_booking/cremation_slot/toggle_slot_route.php", { 
            id 
        }, function(res){
            $("#daySelect").trigger("change");
        });

    }
    
</script>