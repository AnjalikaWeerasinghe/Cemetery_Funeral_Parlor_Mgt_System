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

h6 {
    font-weight: 600;
    color: var(--gold-main);
    border-left: 4px solid var(--gold-main);
    padding-left: 12px;
    letter-spacing: 0.4px;
}

.card {
    background: #ffffff;
    border-radius: 16px;
    border: none;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    padding: 10px;
}

.form-control, .form-select {
    border-radius: 10px;
    padding: 10px 12px;
    border: 1px solid #e0e6ed;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13,110,253,0.1);
}

.form-label {
    font-weight: 500;
    color: #444;
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

.option-card {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 14px;
    padding: 20px;
    cursor: pointer;
    transition: 0.3s;
    text-align: center;
    height: 150px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.option-card:hover {
    border-color: var(--gold-main);
    box-shadow: 0 10px 25px rgba(201,164,76,.25);
    transform: translateY(-3px);
}

.option-card.active {
    background: linear-gradient(135deg,var(--gold-main),var(--gold-soft));
    color: #2b2b2b;
    border: none;
}

.option-card.active i {
    color: #fff;
}

.option-card i {
    font-size: 34px;
    color: var(--gold-main);
    margin-bottom: 12px;
}

.option-card h5 {
    font-weight: 600;
    margin-bottom: 5px;
}

.option-card small {
    color: #666;
}

.price-card {
    background: linear-gradient(145deg, #ffffff, #f9fafc);
    border-radius: 16px;
    padding: 22px;
    border: 1px solid rgba(201,164,76,0.2);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    position: sticky;
    top: 20px;
}

.price-card:hover {
    transform: translateY(-3px);
    transition: 0.3s;
}

.price-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 15px;
    color: #555;
}

.price-total {
    display: flex;
    justify-content: space-between;
    font-weight: 700;
    font-size: 20px;
    color: var(--gold-main);
    padding-top: 10px;
}

.price-card hr {
    border: none;
    height: 1px;
    background: linear-gradient(to right, transparent, #ddd, transparent);
}
</style>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form id="burial_info" autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-4 p-3 bg-light rounded-3">
                            <h6 class="mb-3">Burial Information</h6>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Burial Date</label>
                                <input type="date" class="form-control" id="burial_date" name="burial_date">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Area Type</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="option-card area-card" data-value="municipal_limit">
                                        <i class="fas fa-city"></i>
                                        <div>
                                            <h5>Municipal Limit</h5>
                                            <small>Within council area</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="option-card area-card" data-value="outside_municipal_limit">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <h5>Outside Municipal Limit</h5>
                                            <small>Outside council area</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="area_type" name="area_type">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Select Grave Type</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="option-card grave-card" data-value="Single">
                                        <i class="fas fa-user"></i>
                                        <h5> Grave</h5>
                                        <small>One person</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="option-card grave-card" data-value="Double">
                                        <i class="fas fa-users"></i>
                                        <h5>Double Grave</h5>
                                        <small>Two persons</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="option-card grave-card" data-value="Family">
                                        <i class="fas fa-home"></i>
                                        <h5>Family Grave</h5>
                                        <small>Family plot</small>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="grave_type" name="grave_type">
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Cemetery Section Preference</label>
                                <select class="form-select" id="section_id" name="section_id">
                                    <option value="">
                                        Loading Sections...
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Additional Notes</label>
                            <textarea class="form-control" rows="4" id="request_note" name="request_note" placeholder="Enter any additional information"></textarea>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="price-card">
                            <div class="mb-4 p-3 bg-light rounded-3">
                                <h6 class="mb-3">Payment Summary</h6>
                            </div>
                            <div class="price-row">
                                <span>Burial Fee</span>
                                <span id="price_burial">LKR 0</span>
                            </div>

                            <div class="price-row">
                                <span>Grave Type</span>
                                <span id="summary_grave">-</span>
                            </div>

                            <div class="price-row">
                                <span>Plot Allocation</span>
                                <span class="text-warning" id="request_status">Pending</span>
                            </div>

                            <hr>

                            <div class="price-total">
                                <span>Total</span>
                                <span id="price_total">LKR 0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <div>
                        <button type="button" class="back-btn" id="load_step2">Back</button>
                    </div>
                    <div class="text-end">
                        <button type="submit" id="load_step4">Proceed to Next Page</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        const mode = window.mode;
        const bookingCode = window.bookingCode;

        if (mode === "view" && bookingCode) {
            loadBurialView(bookingCode);
        }

        let today = new Date().toISOString().split("T")[0];
        $("#burial_date").attr("min", today);

        const pricing = {
            municipal_limit: 5000,
            outside_municipal_limit: 8000
        };

        loadBurialSections();

        restoreStep3Data();
        updatePrice();

        function restoreStep3Data() {
            $("#burial_date").val(sessionStorage.getItem("burial_date"));
            $("#area_type").val(sessionStorage.getItem("area_type"));
            $("#request_note").val(sessionStorage.getItem("request_note"));

            let graveType = sessionStorage.getItem("grave_type");

            if (graveType) {
                $("#grave_type").val(graveType);
                $(".grave-card").removeClass("active");
                $('.grave-card[data-value="' + graveType + '"]').addClass("active");
            }

            let areaType = sessionStorage.getItem("area_type");

            if(areaType){
                $("#area_type").val(areaType);
                $(".area-card").removeClass("active");
                $('.area-card[data-value="'+areaType+'"]').addClass("active");
            }

            let savedSection = sessionStorage.getItem("section_id");

            loadBurialSections(savedSection);

            updatePrice();
        }

        $(".area-card").click(function () {

            $(".area-card").removeClass("active");
            $(this).addClass("active");
            $("#area_type").val($(this).data("value"));

            updatePrice();

        });

        $(".grave-card").click(function () {

            $(".grave-card").removeClass("active");
            $(this).addClass("active");

            let type = $(this).data("value");

            $("#grave_type").val(type);
            $("#summary_grave").text(type);

        });

        function updatePrice() {
            let area = $("#area_type").val();
            let burialPrice = pricing[area] || 0;

            $("#burial_fee").text("LKR " + burialPrice.toLocaleString());
            $("#price_burial").text("LKR " + burialPrice.toLocaleString());
            $("#price_total").text("LKR " + burialPrice.toLocaleString());

            sessionStorage.setItem("burial_price", burialPrice);
            sessionStorage.setItem("total_amount", burialPrice);
            sessionStorage.setItem("burial_total", burialPrice);
        }

        $("#area_type").change(function () {
            updatePrice();
        });

        $("#burial_info").submit(function (e) {
            e.preventDefault();

            if ($("#grave_type").val() == "") {
                showModal("Please select grave type.");
                return;
            }

            if($("#burial_date").val()==""){
                showModal("Please select burial date.");
                return;
            }

            if($("#area_type").val()==""){
                showModal("Please select area type.");
                return;
            }

            if($("#section_id").val()==""){
                showModal("Please select cemetery section.");
                return;
            }

            let formData = new FormData(this);

            $.ajax({
                url: "../routes/funeral_booking/add_burial_info_route.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    response = response.trim();

                    if (response == "success") {
                        sessionStorage.setItem("burial_date", $("#burial_date").val());
                        sessionStorage.setItem("area_type", $("#area_type").val());
                        sessionStorage.setItem("grave_type", $("#grave_type").val());
                        sessionStorage.setItem("section_id", $("#section_id").val());
                        sessionStorage.setItem("request_note", $("#request_note").val());

                        unlockStep(4);
                        loadStep(4);
                    }
                    else {
                        showModal(response);
                    }
                }
            });
        });

        $(document).on("click", "#load_step2", function () {
            loadStep(2);
        });
        
        function setAreaTypeAutomatically() {
            const council = sessionStorage.getItem("municipal_council");

            if (!council) return;

            if (council.trim().toLowerCase() == "gampola") {
                $("#area_type").val("municipal_limit");

                $(".area-card").removeClass("active");
                $('.area-card[data-value="municipal_limit"]').addClass("active");
            } else {
                $("#area_type").val("outside_municipal_limit");

                $(".area-card").removeClass("active");
                $('.area-card[data-value="outside_municipal_limit"]').addClass("active");
            }
            updatePrice();
        }

        setAreaTypeAutomatically();

        function loadBurialView(bookingCode) {

            $.ajax({
                url: "../routes/funeral_booking/get_funeral_booking_info_route.php",
                type: "GET",
                data: {
                    booking_code: bookingCode
                },
                success: function (res) {
                    const data = typeof res === "string" ? JSON.parse(res): res;

                    $("#burial_date").val(data.burial_date);
                    $("#area_type").val(data.area_type);

                    $(".area-card").removeClass("active");
                    $('.area-card[data-value="'+data.area_type+'"]').addClass("active");

                    $("#grave_type").val(data.grave_type);
                    $("#section_id").val(data.section_id);
                    $("#request_note").val(data.request_note);

                    $('.grave-card[data-value="' + data.grave_type + '"]').addClass("active");

                    updatePrice();
                    disableBurialView();
                }
            });
        }

        function disableBurialView() {
            $("#burial_info :input").prop("disabled", true);
            $(".grave-card").css("pointer-events", "none");
            $(".area-card").css("pointer-events", "none");
            $("#load_step2").hide();
            $("#burial_info").off("submit");
        }

        function showModal(message) {
            $("#modalMessage").text(message);
            $("#messageModal").modal("show");
        }

        function loadBurialSections(selectedSection = ""){

            $.ajax({
                url: "../routes/funeral_booking/load_burial_sections_route.php",
                type: "GET",
                dataType: "json",
                success:function(data){
                    let html = '<option value="">Select Section</option>';

                    $.each(data,function(index,row){
                        let selected = "";

                        if(selectedSection == row.cem_section_id){
                            selected = "selected";
                        }

                        html +=
                            '<option value="'+row.cem_section_id+'" '+selected+'>'
                            +row.section_name+
                            '</option>'
                        ;
                    });
                    $("#section_id").html(html);
                }

            });

        }

    });
</script>