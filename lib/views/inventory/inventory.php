<style>
    :root{
        --gold: #c9a227;
        --gold-light: #e8c760;
        --dark: #111;
        --bg: #f4f6f9;
    }

    body{
        background: var(--bg);
        font-family: 'Segoe UI',sans-serif;
    }

    .inventory-wrapper{
        padding: 5px;
    }

    .inventory-header{
        background: white;
        color: linear-gradient(135deg, #111, #2d2d2d);
        padding: 25px 30px;
        border-radius: 20px;
        border-bottom: 4px solid var(--gold);
    }

    .inventory-header h3{
        font-weight: 700;
    }

    .summary-card{
        background:#fff;
        border-radius:15px;
        padding:12px 15px;
        box-shadow:0 4px 12px rgba(0,0,0,.06);
        border-top:3px solid var(--gold);
        transition:.3s;
        min-height:110px;
    }

    .summary-card:hover{
        transform:translateY(-3px);
    }

    .summary-card i{
        font-size:24px;
        color:var(--gold);
        margin-bottom:8px;
    }

    .summary-card h2{
        font-size:26px;
        font-weight:700;
        margin:0;
        color:#111;
    }

    .summary-card p{
        margin:4px 0 0;
        font-size:13px;
        color:#666;
    }

    .main-card{
        background: white;
        border-radius: 20px;
        padding: 25px;
        margin-top: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,.06);
    }

    .nav-tabs .nav-link{
        color: #555;
        font-weight: 600;
    }

    .nav-tabs .nav-link.active{
        background: #111;
        color: white;
        border-color: #111;
    }

    .btn-gold{
        background: var(--gold);
        color: white;
        border: none;
        border-radius: 10px;
    }

    .btn-gold:hover{
        background: #a88718;
        color: white;
    }

    .table thead{
        background: #111;
        color: white;
    }

    .badge-stock{
        background: #e8fff0;
        color: #138a3d;
    }

    .badge-low{
        background: #ffe7e7;
        color: #c00000;
    }
</style>

<div class="container-fluid inventory-wrapper">
    <div class="inventory-header d-flex justify-content-between align-items-center">
        <div>
            <h3>
                <i class="fa-solid fa-boxes-stacked me-2"></i>Inventory Management
            </h3>
            <p class="mb-0 opacity-75">Manage stock items and purchase orders</p>
        </div>
    </div>

    <div class="row mt-4">

        <div class="col-md-3">
            <div class="summary-card text-center">
                <i class="fa fa-box"></i>
                <h2>150</h2>
                <p>Total Items</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="summary-card text-center">
                <i class="fa fa-truck"></i>
                <h2>25</h2>
                <p>Suppliers</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="summary-card text-center">
                <i class="fa fa-file-invoice"></i>
                <h2>42</h2>
                <p>Purchase Orders</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="summary-card text-center">
                <i class="fa fa-triangle-exclamation"></i>
                <h2>8</h2>
                <p>Low Stock</p>
            </div>
        </div>

    </div>

    <div class="main-card">

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <button class="nav-link active inventory-tab" data-page="inventory/funeral_item.php">
                    <i class="fa fa-box me-2"></i>Funeral Items
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link inventory-tab" data-page="inventory/supplier_item.php">
                    <i class="fa fa-cart-shopping me-2"></i>Supplier Items
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link inventory-tab" data-page="inventory/item_purchase.php">
                    <i class="fa fa-cart-shopping me-2"></i>Purchases
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link inventory-tab" data-page="inventory/inventory_item.php">
                    <i class="fa fa-box me-2"></i>Inventory
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link inventory-tab" data-page="inventory/stock_history.php">
                    <i class="fa fa-clock-rotate-left me-2"></i>Stock History
                </button>
            </li>
        </ul>

        <div class="mt-4">

            <div id="inventory-content"></div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function () {

        $("#inventory-content").load("inventory/funeral_item.php");

        $(".inventory-tab").click(function () {

            $(".inventory-tab").removeClass("active");
            $(this).addClass("active");

            let page = $(this).data("page");

            $("#inventory-content").load(page);

        });

    });
</script>

