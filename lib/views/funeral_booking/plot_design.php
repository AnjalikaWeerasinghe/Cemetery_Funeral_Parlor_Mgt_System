<style>
.plot-card {
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    border: 1px solid #ddd;
    transition: all 0.25s ease;
    font-weight: 500;
    cursor: pointer;
    user-select: none;
}

.plot-single {
    background: #f8f9fa;
    color: #333;
}
.plot-single:hover { background: #e9ecef; }

.plot-double {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}
.plot-double:hover { background: #ffe8a1; }

.plot-family {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
.plot-family:hover { background: #f1bfc5; }

.plot-selected {
    background: linear-gradient(145deg, #2c2c2c, #1a1a1a) !important;
    color: #fff !important;
    border: 1px solid #555;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

.plot-occupied {
    background: #d6d6d6 !important;
    color: #888 !important;
    cursor: not-allowed;
    opacity: 0.7;
}

.plot-reserved {
    border: 2px dashed #dc3545;
}
</style>

<div class="container mt-4">

    <h4 class="border-bottom pb-2 mb-3 text-primary">
        Manage Cemetery Burial Plots
    </h4>

    <div class="row mb-3">
        <div class="col-md-4">
            <select id="sectionSelect" class="form-control">
                <option value="">Select Section</option>
                <option value="1">Sinhala</option>
                <option value="2">Catholic</option>
                <option value="3">Tamil</option>
                <option value="4">Muslim</option>
            </select>
        </div>

        <div class="col-md-4">
            <button class="btn btn-success" id="refreshPlots">
                Refresh Plots
            </button>
        </div>
    </div>

    <div class="row" id="plotList">
        <p>Select a section to load plots.</p>
    </div>

    <input type="hidden" id="selected_plot">

</div>

<script>
$(document).ready(function(){

    $("#sectionSelect").change(function(){

        let section = $(this).val();

        if(!section){
            $("#plotList").html("<p>Select a section.</p>");
            return;
        }

        $.post("../routes/burial_plot/get_plots_route.php", {
            section: section
        }, function(res){
            $("#plotList").html(res);
        });

    });

    $("#refreshPlots").click(function(){
        $("#sectionSelect").trigger("change");
    });

});

$(document).on("click", ".plot-card", function(){

    if($(this).hasClass("plot-occupied")) return;

    $(".plot-card").removeClass("plot-selected");

    $(this).addClass("plot-selected");

    let id = $(this).data("id");

    $("#selected_plot").val(id);

});

<script>

function deletePlot(id){

    if(!confirm("Delete this plot?")) return;

    $.post("../routes/burial_plot/delete_plot_route.php", { id }, function(res){
        $("#sectionSelect").trigger("change");
    });
}

function toggleReserved(id){

    $.post("../routes/burial_plot/toggle_reserved_route.php", { id }, function(res){
        $("#sectionSelect").trigger("change");
    });
}

</script>
</script>