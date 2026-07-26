<style>
.search-container{
    background:rgba(30,30,30,0.85);
    padding:30px;
    border-radius:18px;
    border:1px solid rgba(212,175,122,0.3);
}

.search-title{
    color:#d4af7a;
    font-weight:bold;
}

.form-control{
    border-radius:30px;
    padding:12px 20px;
}

.search-result-card{
    background:#fff;
    border-radius:15px;
    padding:20px;
    margin-top:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.result-label{
    color:#8b6f47;
    font-weight:600;
}

.search-result-card{
    background:rgba(30,30,30,0.85);
    color:white;
    padding:25px;
    border-radius:18px;
    border:1px solid rgba(212,175,122,0.3);
    box-shadow:0 15px 35px rgba(0,0,0,0.25);
}

.search-result-card h5{
    color:#d4af7a;
    font-weight:700;
}

.search-result-card hr{
    border-color:#d4af7a;
    opacity:.5;
}

.info-row{
    display:flex;
    gap:10px;
    margin-bottom:12px;
    align-items:center;
}

.info-row i{
    width:22px;
    color:#d4af7a;
}

.info-row b{
    min-width:130px;
    color:#e8d9a3;
}

.info-row span{
    color:white;
}

.text-gold{
    color:#d4af7a;
}
</style>


<div class="container my-5 pt-4">

    <div class="search-container">
        <h2 class="text-center search-title mb-4">
            <i class="fa-solid fa-user me-2"></i>Search Deceased Information
        </h2>

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="input-group">
                    <input type="text" id="searchDeceased" class="form-control" placeholder="Enter deceased name or NIC">

                    <button class="btn btn-dark px-4" onclick="searchDeceased()">
                        <i class="fa-solid fa-search"></i>Search
                    </button>
                </div>

            </div>

        </div>

        <div id="deceasedResults"></div>

    </div>

</div>



<script>
function searchDeceased(){

    let keyword = $("#searchDeceased").val();

    if(keyword.trim()==""){
        alert("Please enter name or NIC");
        return;
    }

    $.ajax({
        url:"lib/routes/main_pages/search_deceased_route.php",
        method:"POST",
        data:{
            keyword:keyword
        },
        success:function(response){

            $("#deceasedResults").html(response);

        },
        error:function(xhr){

            console.log(xhr.responseText);

        }

    });

}
</script>