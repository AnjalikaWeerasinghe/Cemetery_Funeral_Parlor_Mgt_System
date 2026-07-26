<style>
.search-box{
    background:#1e1e1e;
    padding:30px;
    border-radius:15px;
    border:1px solid #d4af7a;
}

.search-box h3{
    color:#d4af7a;
}

.result-card{
    background:#fff;
    padding:25px;
    border-radius:15px;
    margin-top:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.result-card h5{
    color:#8b6f47;
}

.btn-search{
    background:#d4af7a;
    border:none;
    padding:10px 25px;
    border-radius:25px;
}
</style>

<div class="container my-5 pt-4">

    <div class="search-box">
        <h3 class="text-center mb-4">
            <i class="fa-solid fa-location-dot"></i>Search Grave Location
        </h3>

        <div class="input-group">
            <input type="text" id="graveSearch" class="form-control" placeholder="Enter Plot Number / Booking Code / Deceased Name">

            <button class="btn btn-search" onclick="searchGrave()">
                Search
            </button>
        </div>
    </div>

    <div id="graveResult"></div>

</div>

<script>
    function searchGrave(){
        let keyword=$("#graveSearch").val();

        $.ajax({
            url:"lib/routes/main_pages/search_grave_route.php",
            method:"POST",
            data:{
                keyword:keyword
            },
            success:function(response){
                $("#graveResult").html(response);
            }
        });

    }
</script>