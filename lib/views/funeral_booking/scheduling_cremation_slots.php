<style>
    body{
        background:#f4f6fb;
        font-family:'Segoe UI',sans-serif;
    }

    .card{
        border:none;
        border-radius:18px;
        box-shadow:0 6px 20px rgba(0,0,0,0.05);
    }

    .page-title{
        font-weight:700;
        color:#1f2937;
    }

    .form-control,
    .form-select{
        border-radius:12px;
        padding:12px;
        border:1px solid #e5e7eb;
    }

    .form-control:focus,
    .form-select:focus{
        border-color:#d4af37;
        box-shadow:0 0 0 0.15rem rgba(212,175,55,.15);
    }

    .btn-success{
        background:linear-gradient(135deg,#b58b2a,#d4af37);
        border:none;
        border-radius:12px;
        font-weight:600;
        padding:12px 18px;
    }

    .btn-success:hover{
        opacity:.95;
        transform:translateY(-1px);
    }

    .stat-card{
        background:#fff;
        border-radius:16px;
        padding:16px;
        box-shadow:0 6px 18px rgba(0,0,0,0.05);
    }

    .stat-title{
        color:#6b7280;
        font-size:13px;
    }

    .stat-value{
        font-size:28px;
        font-weight:700;
    }

    .slot-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
        gap:16px;
    }

    .slot-card{
        border-radius:16px;
        padding:18px;
        text-align:center;
        transition:all .25s ease;
        cursor:pointer;
        border:1px solid #e5e7eb;
        font-weight:500;
        position:relative;
        overflow:hidden;
    }

    .slot-status{
        position:absolute;
        top:12px;
        right:12px;
    }

    .slot-card:hover{
        transform:translateY(-4px);
        box-shadow:0 8px 20px rgba(0,0,0,.08);
    }

    .slot-standard{
        background:#ffffff;
        border-left:5px solid #6c757d;
    }

    .slot-peak{
        background:#fff8e1;
        border-left:5px solid #f59e0b;
    }

    .slot-premium{
        background:#fff0f0;
        border-left:5px solid #dc3545;
    }

    .slot-selected{
        background:linear-gradient(135deg,#b58b2a,#d4af37)!important;
        color:#fff!important;
        border:none!important;
    }

    .slot-disabled{
        background:#e5e7eb!important;
        color:#9ca3af!important;
        opacity:.8;
        cursor:not-allowed;
    }

    .slot-time{
        font-size:18px;
        font-weight:700;
    }

    .slot-type{
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.5px;
        margin-top:5px;
    }

    .slot-actions{
        margin-top:12px;
    }

    .slot-actions button{
        border-radius:8px;
        font-size:12px;
        padding:4px 10px;
    }

    .nav-pills{
        flex-wrap:nowrap;
        overflow-x:auto;
        gap:10px;
        padding-bottom:8px;
    }

    .nav-pills .nav-link{
        border-radius:50px;
        padding:10px 18px;
        background:#fff;
        border:1px solid #eee;
        color:#444;
        font-weight:600;
        white-space:nowrap;
    }

    .nav-pills .nav-link.active{
        background:linear-gradient(135deg,#b58b2a,#d4af37);
        color:white;
        border:none;
    }
</style>

<div class="container mt-4">

    <div class="card mb-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">🔥 Cremation Time Slot Management</h3>
                    <p class="text-muted mb-0">
                        Configure weekly cremation schedules and manage slot availability.
                    </p>
                </div>

                <div>
                    <span class="badge bg-light text-dark p-2">
                        <i class="fa fa-calendar me-1"></i>
                        Weekly Schedule
                    </span>
                </div>
            </div>

            <div class="row g-3">

                <div class="col-md-3">
                    <select id="daySelect" class="form-control">
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

                <div class="col-md-3">
                    <select id="slottype" class="form-control">
                        <option value="">Select slot type</option>
                        <option value="standard" class="slot-standard">Standard</option>
                        <option value="peak" class="slot-peak">Peak</option>
                        <option value="premium" class="slot-premium">Premium</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="time" id="start_time" class="form-control">
                </div>

                <div class="col-md-2">
                    <input type="time" id="end_time" class="form-control">
                </div>

                <div class="col-md-2">
                    <button id="addSlot" class="btn btn-success w-100">➕ Add Time Slot</button>
                </div>

            </div>

        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">

            <ul class="nav nav-pills justify-content-center gap-2" id="weekDays">

                <li class="nav-item">
                    <button class="nav-link day-pill active" data-day="Monday">Monday</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link day-pill" data-day="Tuesday">Tuesday</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link day-pill" data-day="Wednesday">Wednesday</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link day-pill" data-day="Thursday">Thursday</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link day-pill" data-day="Friday">Friday</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link day-pill" data-day="Saturday">Saturday</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link day-pill" data-day="Sunday">Sunday</button>
                </li>

            </ul>

        </div>
    </div>

    <div class="row">

        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Weekly Time Slots</h5>

                    <!-- when a day from nav pills is selected time slot should load here -->
                    <div id="slotList" class="slot-grid"></div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card sticky-top">
                <div class="card-body">
                    <h5 class="fw-bold">Selected Slot</h5>

                    <div id="selectedSlotPanel">
                        <div class="text-center text-muted py-5">
                            <i class="fa fa-clock fa-3x mb-3"></i>
                            <p>Select a slot to view details</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                alert("Please select a day.")
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

        $("#searchSlot").on("keyup", function(){

            let value = $(this).val().toLowerCase();

            $(".slot-card").filter(function(){

                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

            });

        });

        $("#daySummary").removeClass("d-none");
        $("#daySummary").html(
            `<strong>${day}</strong> Schedule Loaded`
        );

    });

    $(document).on("click", ".slot-card", function(){

        $(".slot-card").removeClass("slot-selected");
        $(this).addClass("slot-selected");

        let slotId = $(this).data("id");

        $.post("../routes/funeral_booking/cremation_slot/get_slot_details_route.php", {
                slot_id: slotId
            },
            function(response){
                $("#selectedSlotPanel").html(response);
            }
        );

    });

    $(document).ready(function(){

        $(".day-pill:first").trigger("click");

    });

    $(document).on("click",".day-pill",function(){

        $(".day-pill").removeClass("active");

        $(this).addClass("active");

        let day = $(this).data("day");

        loadSlots(day);

    });

    function loadSlots(day){

        $.post("../routes/funeral_booking/cremation_slot/get_slots_route.php",{
                day : day
            },
            function(response){

                $("#slotList").html(response);

                $("#selectedDayLabel").html(day + " Schedule");

            }
        );

    }

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