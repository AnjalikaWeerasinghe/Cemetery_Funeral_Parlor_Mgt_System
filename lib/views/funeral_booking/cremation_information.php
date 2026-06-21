<?php
    header('Content-Type: text/html; charset=UTF-8');
?>

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

.slot-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.25s ease;
}

.slot-card:hover {
    border-color: #c9a44c;
    color: #c9a44c;
    background: #fffdf6;
}

.slot-selected {
    background: linear-gradient(135deg, var(--gold-main), var(--gold-soft));
    color: #2b2b2b;
    border: none;
    box-shadow: 0 6px 18px rgba(201,164,76,0.35);
    transform: scale(1.05);
}

.slot-card.bg-secondary {
    background: #eee !important;
    color: #999 !important;
    cursor: not-allowed;
    border: 1px solid #ddd;
}

.tablet-preview {
    width: 260px;
    height: 180px;
    border-radius: 12px;
    border: 1px solid #ddd;
    background: linear-gradient(145deg, #f8f8f8, #eaeaea);
    color: #333;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    font-family: "Georgia", serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.form-control,
.form-select,
.slot-card,
button {
    transition: all 0.25s ease;
}

input[type="file"] {
    border: 2px dashed #d0d7de;
    background: #f9fbfd;
    padding: 10px;
    cursor: pointer;
}

input[type="file"]:hover {
    border-color: #0d6efd;
}

#previewName {
    font-weight: bold;
    letter-spacing: 1px;
    text-shadow: 0 1px 1px rgba(255,255,255,0.2),
                 0 -1px 1px rgba(0,0,0,0.6);
}

#previewMessage {
    font-size: 14px;
    color: #000;
    text-shadow: 0 1px 1px rgba(255,255,255,0.1);
}

#previewIcon {
    margin-bottom: 5px;
}

#previewImage {
    border-radius: 4px;
    border: 1px solid #aaa;
    align-self: center;
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

@font-face {
    font-family: 'Yaldevi';
    src: url('/../../styles/webfonts/yaldevi/Yaldevi[wght].ttf') format('ttf'),
    font-weight: normal;
    font-style: normal;
}

</style>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form id="cremation_info" autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-4 p-3 bg-light rounded-3">
                            <h6 class="mb-3">Cremation Information</h6>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cremation_date" class="form-label">Date of Cremation *</label>
                                    <input type="date" name="cremation_date" id="cremation_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="area_type" class="form-label">Area Type *</label>
                                    <select name="area_type" id="area_type" class="form-select" required>
                                        <option value="">Select Area</option>
                                        <option value="municipal_limit">Municipal Limit Area</option>
                                        <option value="outside_municipal_limit">Outside Municipal Area</option>
                                    </select>
                                </div>
                            </div>

                            <label for="time_slot" class="form-label">Available Time Slots *</label>

                            <div id="timeSlotsContainer" class="d-flex flex-wrap gap-2">
                                
                            </div>

                            <input type="hidden" id="selected_slot_id" name="schedule_slots_table_slot_id">
                        </div>

                        <div>
                            <div class="mb-3 pe-3">
                                <label for="ash_collection" class="form-label pe-2">Are you collecting the Ash after cremation? *</label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="collect_ash" value="1" required>
                                    <label class="form-check-label">Yes</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="collect_ash" value="0">
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="ash_collection_method" class="form-label">Ash collection method</label>
                                <select name="ash_collection_method" id="ash_collection_method" class="form-select">
                                    <option value="">Select</option>
                                    <option value="scatter">Scatter</option>
                                    <option value="memorial">Memorial</option>
                                </select>
                            </div>

                            <!-- Display only if Memorial is selected -->
                            <div class="row mt-4">
                                <div class="col-md-7">
                                    <div id="memorialSection" style="display:none;" class="border rounded p-3 mt-3">

                                        <div class="mb-2 p-2 bg-light rounded-3">
                                            <h6 class="mb-3">Memorial Tablet Customization</h6>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">Name on Tablet</label>
                                            <input type="text" class="form-control" name="memorial_name">
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control" name="memorial_message" rows="3"></textarea>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">Add a Symbol</label>
                                            <select class="form-select" id="memorial_icon" name="memorial_icon">
                                                <option value="">None</option>
                                                <option value="cross">Cross</option>
                                                <option value="flower">Flower</option>
                                            </select>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">Upload Image (Optional)</label>
                                            <input type="file" id="memorial_image" name="memorial_image" class="form-control" accept="image/*">
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">Font Style</label>
                                            <select class="form-select" name="font_style">
                                                <option value="classic">Classic</option>
                                                <option value="modern">Modern</option>
                                                <option value="elegant">Elegant</option>
                                            </select>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">Theme</label>
                                            <select id="tablet_theme" name="tablet_theme" class="form-select">
                                                <option value="dark">Granite</option>
                                                <option value="light">Marble</option>
                                                <option value="gold">Gold</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <!-- Preview of Memorial  -->
                                <div class="col-md-4 text-center mt-4">
                                    <div id="previewWrapper" class="mt-4" style="display:none;">
                                        <div class="m-4 p-3 bg-light rounded-3">
                                            <h6 class="mb-3">Live Preview</h6>
                                        </div>

                                        <div id="memorialPreview" class="tablet-preview mx-auto text-center p-4">
                                            <div id="previewIcon" style="font-size:24px;" class="text-center"></div>
                                            <img id="previewImage" style="max-width:60px; display:none; margin-bottom:5px;" />
                                            <h5 id="previewName">Name</h5>
                                            <p id="previewMessage">Your message will appear here</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea name="notes" id="notes" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
    
                    </div>

                    <div class="col-md-4">
                        <div class="price-card">
                            <div class="mb-4 p-3 bg-light rounded-3">
                                <h6 class="mb-3">Payment Summary</h6>
                            </div>

                            <div class="price-row">
                                <span>Cremation Fee</span>
                                <span id="price_cremation">LKR 0</span>
                            </div>

                            <div class="price-row">
                                <span>Memorial Fee</span>
                                <span id="price_memorial">LKR 0</span>
                            </div>

                            <hr>

                            <div class="price-total">
                                <span>Total</span>
                                <span name="price_total" id="price_total">LKR 0</span>
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
    // console.log("JS Loaded");
    
    $(document).ready(function() {
        const mode = window.mode;
        const bookingCode = window.bookingCode;

        if (mode === "view" && bookingCode) {
            loadCremationView(bookingCode);
        }

        let today = new Date().toISOString().split("T")[0];
        $("#cremation_date").attr("min", today);

        // Create the table to get the real pricings for services
        const pricing = {
            municipal_limit: 5000,
            outside_municipal_limit: 8000,
            memorial: 2000
        };

        function loadTimeSlots(selectedDate, callback){

            $.post("../routes/funeral_booking/get_time_slots_route.php", {
                date: selectedDate
            }, function(res) {
                // console.log("Response:", res);
                $("#timeSlotsContainer").html(res);

                if(typeof callback === "function"){
                    callback();
                }

                let savedSlotId = sessionStorage.getItem("selected_slot_id");

                setTimeout(function(){

                    if(savedSlotId){
                        let selectedCard = $(`.slot-card[data-id="${savedSlotId}"]`);

                        if(selectedCard.length){
                            selectedCard.trigger("click");
                        }
                    }

                }, 100);
            });

        }

        restoreStep3Data();

        updatePrice();

        function restoreStep3Data(){
            $("#notes").val(sessionStorage.getItem("notes"));

            let selectedDate = sessionStorage.getItem("selectedDate");
            let areaType = sessionStorage.getItem("area_type");

            let collectAsh = sessionStorage.getItem("collect_ash");
            let ashCollectionMethod = sessionStorage.getItem("ash_collection_method");

            if(selectedDate && selectedDate !== "undefined"){
                $("#cremation_date").val(selectedDate);

                loadTimeSlots(selectedDate);
            }

            if(areaType){
                $("#area_type").val(areaType).trigger("change");
            }

            if(collectAsh){
                $(`input[name="collect_ash"][value="${collectAsh}"]`).prop("checked", true);
            }

            if(ashCollectionMethod){
                $("#ash_collection_method").val(ashCollectionMethod).trigger("change");
            }

             // Restore memorial design if available
            if(ashCollectionMethod === "memorial"){
                $("#memorialSection").show().find("input, textarea, select").prop("disabled", false);
                $("#previewWrapper").show();

                $("input[name='memorial_name']").val(sessionStorage.getItem("memorial_name") || "");
                $("textarea[name='memorial_message']").val(sessionStorage.getItem("memorial_message") || "");

                $("select[name='font_style']").val(sessionStorage.getItem("font_style")).trigger("change");
                $("#tablet_theme").val(sessionStorage.getItem("tablet_theme")).trigger("change");
                $("#memorial_icon").val(sessionStorage.getItem("memorial_icon")).trigger("change");

                let savedImage = sessionStorage.getItem("memorial_image");
                if (savedImage) {
                    $("#previewImage").attr("src", savedImage).show();
                    $("#previewWrapper").show();
                } else{
                    $("#previewImage").hide().attr("src", "");
                }

                updatePreviewText();

                // Note: cannot restore the uploaded image due to browser security restrictions
            }  
            
            updatePrice();
        }

        $("#cremation_date").change(function(){

            let selectedDate = $(this).val();
            // console.log("Selected Date:", selectedDate);

            // let dayOfWeek = new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'long' });
            // console.log("Day:", dayOfWeek);

            loadTimeSlots(selectedDate);

        });

        $(document).on("click", ".slot-card", function(){

            if($(this).hasClass("bg-secondary")) return;

            $(".slot-card").removeClass("slot-selected");

            $(this).addClass("slot-selected");

            let slotId = $(this).data("id");
            let slotText = $(this).data("text");

            // console.log("Slot:", slotId, slotText);

            $("#selected_slot_id").val(slotId);

            sessionStorage.setItem("selected_slot_id", slotId);
            sessionStorage.setItem("slot_text", slotText);

            // console.log("Selected Slot ID:", slotId);

        });

        $("#cremation_info").on("submit", function(e) {
            e.preventDefault();

            updatePrice();

            let designData = null;

            let formData = new FormData(this);

            if($("#ash_collection_method").val() === "memorial"){
                designData = {
                    name: $("input[name='memorial_name']").val(),
                    message: $("textarea[name='memorial_message']").val(),
                    font: $("select[name='font_style']").val(),
                    theme: $("#tablet_theme").val(),
                    icon: $("#memorial_icon").val(),
                    hasImage: $("#memorial_image")[0].files.length > 0
                };
            }

            if(designData){
                formData.append("memorial_design", JSON.stringify(designData));

                let memorialImage = $("#memorial_image")[0].files[0];

                if(memorialImage){
                    formData.append("memorial_image", memorialImage);
                }
            }

            if($("#selected_slot_id").val() === ""){
                showModal("Please select a time slot for cremation.");
                return;
            }

            if($("#ash_collection_method").val() === "memorial"){

                if($("input[name='memorial_name']").val().trim() === ""){
                    showModal("Please enter memorial name.");
                    return;
                }
            }

            $.ajax({
                url: "../routes/funeral_booking/add_cremation_info_route.php",
                method: "POST",
                data : formData,
                processData: false,
                contentType: false,

                success:function(response){
                    // console.log("Response:", response);

                    response = response.trim();

                    if(response === "success"){
                        let date = $("#cremation_date").val();

                        if(date){
                            sessionStorage.setItem("selectedDate", date);
                        }

                        sessionStorage.setItem("area_type", $("#area_type").val()); 
                        
                        sessionStorage.setItem("selected_slot_id", $("#selected_slot_id").val());

                        sessionStorage.setItem("collect_ash", $('input[name="collect_ash"]:checked').val());
                        sessionStorage.setItem("ash_collection_method", $("#ash_collection_method").val());

                        sessionStorage.setItem("memorial_name", $("input[name='memorial_name']").val());
                        sessionStorage.setItem("memorial_message", $("textarea[name='memorial_message']").val());
                        sessionStorage.setItem("memorial_icon", $("#memorial_icon").val());
                        
                        sessionStorage.setItem("font_style", $("select[name='font_style']").val());
                        sessionStorage.setItem("tablet_theme", $("#tablet_theme").val());
                        
                        sessionStorage.setItem("notes", $("#notes").val());

                        unlockStep(4);
                        loadStep(4);

                    } else {

                        showModal(response);
                    }
                }
            });
        });

        $("input[name='collect_ash']").change(function(){
            let collectAsh = $('input[name="collect_ash"]:checked').val();

            if(collectAsh === "0"){
                $("#ash_collection_method").val("").prop("disabled", false);
                $("#memorialSection").hide();
                $("#previewWrapper").hide();
            } else {
                $("#ash_collection_method").prop("disabled", true);
            }

            updatePrice();
        });

        $("#ash_collection_method").change(function(){

            let value = $(this).val();

            if(value === "memorial"){
                $("#memorialSection").slideDown().find("input, textarea, select").prop("disabled", false);
                $("#previewWrapper").fadeIn();
            } else {
                $("#memorialSection").slideUp().find("input, textarea, select").prop("disabled", true);
                $("#previewWrapper").fadeOut();

                // Clear memorial design data from sessionStorage when not selected
                sessionStorage.removeItem("memorial_name");
                sessionStorage.removeItem("memorial_message");
                sessionStorage.removeItem("memorial_icon");
                sessionStorage.removeItem("font_style");
                sessionStorage.removeItem("tablet_theme");
                sessionStorage.removeItem("memorial_image");

                // Reset preview to default
                $("#previewName").text("Name");
                $("#previewMessage").text("Your message will appear here");
                $("#previewIcon").text("");
                $("#previewImage").hide().attr("src", "");
            }

        });

        let selectedLang = "en";

        $(document).on("change", "#language_type", function(){

            selectedLang = $(this).val();

            if(selectedLang === "en"){
                $("#memorialPreview").css("font-family", "Georgia, serif");
            }
            else if(selectedLang === "si"){
                $("#memorialPreview").css("font-family", "'Yaldevi', serif");
            }
            else if(selectedLang === "ta"){
                $("#memorialPreview").css("font-family", "'Yaldevi', serif");
            }
        });

        function updatePreviewText(){

            let name = $("input[name='memorial_name']").val();
            let msg = $("textarea[name='memorial_message']").val();

            $("#previewName").text(name || "Name");
            $("#previewMessage").text(msg || "Your message will appear here");
        }

        $("#memorialSection").find("input, textarea, select").prop("disabled", true);

        $(document).on("input", "input[name='memorial_name']", function(){
            updatePreviewText();
        });

        $(document).on("input", "textarea[name='memorial_message']", function(){
            updatePreviewText();
        });

        $(document).on("change", "select[name='font_style']", function(){

            let font = $(this).val();

            if(font === "classic"){
                $("#memorialPreview").css("font-family", "Georgia, serif");
            }
            else if(font === "modern"){
                $("#memorialPreview").css("font-family", "Arial, sans-serif");
            }
            else if(font === "elegant"){
                $("#memorialPreview").css("font-family", "Times New Roman, serif");
            }

        });

        $("#tablet_theme").change(function(){

            let theme = $(this).val();

            if(theme === "dark"){
                $("#memorialPreview").css({
                    background: "linear-gradient(145deg, #2b2b2b, #1a1a1a)",
                    color: "#eaeaea"
                });
            }
            else if(theme === "light"){
                $("#memorialPreview").css({
                    background: "linear-gradient(145deg, #f8f8f8, #e5e5e5)",
                    color: "#222"
                });
            }
            else if(theme === "gold"){
                $("#memorialPreview").css({
                    background: "linear-gradient(145deg, #b8962e, #e6c65c)",
                    color: "#2b2b2b"
                });
            }

        });

        $("#memorial_icon").change(function(){

            let icon = $(this).val();

            if(icon === "cross"){
                $("#previewIcon").text("✝");
            }
            else if(icon === "flower"){
                $("#previewIcon").text("🌸");
            }
            else{
                $("#previewIcon").text("");
            }

        });

        $("#memorial_image").change(function(e){

            let file = e.target.files[0];

            if(file && file.size > 2 * 1024 * 1024){
                showModal("Memorial image must be below 2MB.");
                $(this).val("");
                return;
            }

            if(file){
                let reader = new FileReader();

                reader.onload = function(event){
                    $("#previewImage").attr("src", event.target.result).show();

                    sessionStorage.setItem("memorial_image", event.target.result);
                };

                reader.readAsDataURL(file);
            }

        });

        function updatePrice(){

            let areaType = $("#area_type").val();
            let memorialType = $("#ash_collection_method").val();

            let cremationPrice = 0;
            let memorialPrice = 0;

            if(areaType){
                cremationPrice = pricing[areaType] || 0;
            }

            if(memorialType === "memorial"){
                memorialPrice = pricing.memorial;
            }

            let total = cremationPrice + memorialPrice;

            $("#price_cremation").text("LKR " + cremationPrice);
            $("#price_memorial").text("LKR " + memorialPrice);
            $("#price_total").text("LKR " + total.toLocaleString());

            sessionStorage.setItem("cremation_price", cremationPrice);
            sessionStorage.setItem("memorial_price", memorialPrice);
            sessionStorage.setItem("total_amount", total);
        }

        $("#area_type, #ash_collection_method").on("change", function () {
            updatePrice();
        });

        $(document).on("click", "#load_step2", function () {
            loadStep(2);
        });

        function showModal(message) {
            $("#modalMessage").text(message);
            $("#messageModal").modal("show");
        }

        function loadCremationView(bookingCode){

            $.ajax({
                url: "../routes/funeral_booking/get_funeral_booking_info_route.php",
                type: "GET",
                data: { booking_code: bookingCode },

                success: function(res){
                    const data = typeof res === "string" ? JSON.parse(res) : res;

                    // Fill basic fields
                    $("#cremation_date").val(data.cremation_date);
                    $("#area_type").val(data.area_type);
                    $("#notes").val(data.notes);

                    // Ash collection
                    $(`input[name="collect_ash"][value="${data.collect_ash}"]`)
                        .prop("checked", true);

                    $("#ash_collection_method").val(data.ash_collection_method);

                    // Slot (display only)
                    $("#selected_slot_id").val(data.slot_id);

                    // Memorial (if exists)
                    if(data.ash_collection_method === "memorial"){
                        $("#memorialSection").show();

                        $("input[name='memorial_name']").val(data.memorial_name);
                        $("textarea[name='memorial_message']").val(data.memorial_message);
                        $("#tablet_theme").val(data.tablet_theme);
                        $("#memorial_icon").val(data.memorial_icon);

                        if(data.memorial_image){
                            $("#previewImage").attr("src", data.memorial_image).show();
                        }
                    }

                    disableCremationView();
                }
            });
        }

        function disableCremationView(){

            // disable all inputs
            $("#cremation_info :input").prop("disabled", true);

            $("#load_step2").hide();
            $(".slot-card").css("pointer-events", "none");
            $("input[type='file']").hide();

            $(document).off("click", ".slot-card");
            $("#cremation_info").off("submit");
        }

        function setAreaTypeAutomatically(){

            const localAuthority = sessionStorage.getItem("municipal_council");

            if(!localAuthority) return;

            if(localAuthority.trim().toLowerCase() === "gampola"){
                $("#area_type").val("municipal_limit");
            } else {
                $("#area_type").val("outside_municipal_limit");
            }
        }

        setAreaTypeAutomatically();

    });

</script>