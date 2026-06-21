<style>
.plot-card{
    cursor:pointer;
    transition:all .3s ease;
    background:#fff;
}

.plot-card:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.plot-selected{
    border:2px solid #198754 !important;
    background:#f0fff7;
}

.plot-disabled{
    opacity:.6;
    pointer-events:none;
    background:#f8f9fa;
}
</style>

<div class="container-fluid">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form id="burial_info" autocomplete="off">

                <div class="section-box mb-4">
                    <h5 class="fw-bold mb-2">
                        Burial Reservation Information
                    </h5>

                    <p class="text-muted mb-0">
                        Select burial details and an available cemetery plot.
                    </p>
                </div>

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-light">
                        <strong>Burial Details</strong>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Burial Date <span class="text-danger">*</span>
                                </label>

                                <input type="date"
                                    class="form-control"
                                    id="burial_date"
                                    name="burial_date"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Grave Type <span class="text-danger">*</span>
                                </label>

                                <select class="form-select"
                                    id="grave_type"
                                    name="grave_type"
                                    required>

                                    <option value="">
                                        Select Grave Type
                                    </option>

                                    <option value="single">
                                        Single Grave
                                    </option>

                                    <option value="double">
                                        Double Grave
                                    </option>

                                    <option value="family">
                                        Family Grave
                                    </option>

                                </select>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-light">
                        <strong>Cemetery Section</strong>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Cemetery Section
                                </label>

                                <select class="form-select"
                                    id="cem_section_id"
                                    name="cem_section_id">

                                    <option value="">
                                        Select Section
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Plot Type
                                </label>

                                <select class="form-select"
                                    id="plot_type"
                                    name="plot_type">

                                    <option value="">
                                        All Plot Types
                                    </option>

                                    <option value="standard">
                                        Standard
                                    </option>

                                    <option value="premium">
                                        Premium
                                    </option>

                                    <option value="family">
                                        Family
                                    </option>

                                </select>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-light">
                        <strong>Select Burial Plot</strong>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-info">
                            Select an available plot for burial.
                        </div>

                        <div class="row" id="plotContainer">

                            <div class="col-md-3 mb-3">

                                <div class="plot-card border rounded p-3 text-center">

                                    <span class="badge bg-success mb-2">
                                        Available
                                    </span>

                                    <h6 class="fw-bold">
                                        Plot A-01
                                    </h6>

                                    <small class="text-muted">
                                        Section A
                                    </small>

                                </div>

                            </div>

                        </div>

                        <input type="hidden"
                            id="selected_plot_id"
                            name="selected_plot_id">

                    </div>

                </div>

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-light">
                        <strong>Selected Plot Information</strong>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <label class="fw-bold">
                                    Section
                                </label>

                                <div id="selected_section">
                                    -
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="fw-bold">
                                    Plot Number
                                </label>

                                <div id="selected_plot">
                                    -
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="fw-bold">
                                    Grave Type
                                </label>

                                <div id="selected_grave_type">
                                    -
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-light">
                        <strong>Additional Notes</strong>
                    </div>

                    <div class="card-body">

                        <textarea class="form-control"
                            id="notes"
                            name="notes"
                            rows="4"
                            placeholder="Enter additional information if required"></textarea>

                    </div>

                </div>

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-light">
                        <strong>Price Summary</strong>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-2">
                            <span>Burial Fee</span>
                            <span id="price_burial">
                                LKR 0
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Plot Fee</span>
                            <span id="price_plot">
                                LKR 0
                            </span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total Amount</span>

                            <span id="price_total"
                                class="text-success">
                                LKR 0
                            </span>
                        </div>

                    </div>

                </div>

                <div class="d-flex justify-content-between">

                    <button type="button"
                        id="load_step2"
                        class="btn btn-outline-secondary px-4">

                        Previous

                    </button>

                    <button type="submit"
                        class="btn btn-success px-4">

                        Save & Continue

                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
    $(document).ready(function(){

        loadCemeterySections();

        $('#cem_section_id, #plot_type').change(function(){
            loadAvailablePlots();
        });

        $('#plotContainer').on('click', '.plot-card', function(){
            $('.plot-card').removeClass('plot-selected');
            $(this).addClass('plot-selected');

            $('#selected_plot_id').val($(this).data('plot-id'));
            $('#selected_section').text($(this).data('section-name'));
            $('#selected_plot').text($(this).data('plot-number'));
            $('#selected_grave_type').text($(this).data('grave-type'));

            updatePriceSummary();
        });

        $('#burial_info').submit(function(e){
            e.preventDefault();
            saveBurialInformation();
        });

    });
</script>