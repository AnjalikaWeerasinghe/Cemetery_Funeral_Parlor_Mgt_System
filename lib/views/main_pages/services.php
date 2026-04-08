<style>

section {
    position: relative;
    z-index: 1;
}

.about-service-bar {
    height: 200px;
    background: linear-gradient(to right, #8b6f47, #d4af7a);
    margin-top: 95px;
    display: flex;
    align-items: center;
    color: white;
}

.btn-gold {
    background: #1a1a1a;
    color: #d4af7a;
    border: 1px solid #d4af7a;
    padding: 10px 25px;
    border-radius: 30px;
    transition: 0.3s;
    position: relative;
    overflow: hidden;
}

.btn-gold:hover {
    background: #d4af7a;
    color: black;
}

.btn-gold::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 100%;
    background: #d4af7a;
    left: 0;
    top: 0;
    transition: 0.3s;
    z-index: 0;
}

.btn-gold:hover::after {
    width: 100%;
}

.btn-gold span {
    position: relative;
    z-index: 1;
}

.about-service-text {
    background: rgba(30,30,30,0.8);
    padding: 25px;
    border-radius: 10px;
    color: #ccc;
    line-height: 1.7;
}

.service-box {
    background: rgba(30,30,30,0.8);
    padding: 20px;
    border-radius: 10px;
    transition: 0.3s;
    border: 1px solid rgba(212,175,122,0.2);
}

.service-box i {
    font-size: 25px;
    color: #d4af7a;
    margin-bottom: 10px;
    position: relative;
    overflow: hidden;
}

.service-box h6,
.service-box h4 {
    color: #fff;
}

.service-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(212,175,122,0.3);
}

.service-box::before {
    content: "";
    position: absolute;
    width: 0%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(212,175,122,0.2), transparent);
    top: 0;
    left: 0;
    transition: 0.5s;
}

.service-box:hover::before {
    width: 100%;
}

.text-gold {
    color: #d4af7a;
}

.text-gold::after {
    content: "";
    display: block;
    width: 60px;
    height: 3px;
    background: #d4af7a;
    margin: 10px auto 0;
    border-radius: 5px;
}

.fee-card {
    background: rgba(30,30,30,0.85);
    padding: 25px;
    border-radius: 15px;
    border: 1px solid rgba(212,175,122,0.2);
    transition: 0.3s;
    height: 100%;
}

.fee-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(212,175,122,0.3);
}

.icon {
    font-size: 30px;
    color: #d4af7a;
    margin-bottom: 10px;
}

.highlight {
    border: 1px solid #d4af7a;
    box-shadow: 0 0 20px rgba(212,175,122,0.3);
}

.note {
    font-size: 12px;
    color: #aaa;
}

.table td {
    border: none;
    padding: 6px;
    background: none;
    color: white;
}

.section-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, #d4af7a, transparent);
    margin: 10px 0;
}

.service-box,
.fee-card {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.8s ease forwards;
}

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>

<section class="about-service-bar">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-md-6">
                <div class="text-start fw-bold">
                    <h1>About Our Services</h1>
                    <p>Gampola General Cemetery & Funeral Parlor</p>
                </div>
            </div>

            <div class="col-md-6 text-end">
                <button class="btn btn-gold">
                    <span><i class="fa-solid fa-fire me-2"></i>Book Now</span>
                </button>
            </div>

        </div>  
    </div>
</section>


<section class="container my-5">

    <div class="row align-items-center">

        <div class="col-md-6 mb-4">
            <div class="about-service-text">
                <p>
                    Under the guidance of Gampola Urban Council, the General Cemetery and Funeral Parlor provides comprehensive funeral 
                    services. Our dedicated staff supports families during their time of bereavement with care, dignity, and 
                    professionalism.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row text-center">

                <div class="col-md-4 mb-3">
                    <div class="service-box">
                        <i class="fa-solid fa-cross"></i>
                        <h6>Burial</h6>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="service-box">
                        <i class="fa-solid fa-fire"></i>
                        <h6>Cremation</h6>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="service-box">
                        <i class="fa-solid fa-building-columns"></i>
                        <h6>Parlor</h6>
                    </div>
                </div>

            </div>
        </div>

    </div>

</section>

<div class="section-divider"></div>

<section class="container my-5">
    <div class="text-center p-3">
        <h2 class="fw-bold text-gold">Our Services in Detail</h2>
        <p class="text-muted">Comprehensive services to meet every family's needs</p>
    </div>

    <div class="row mb-3 text-center text-light">
        <div class="col-md-4">
            <div class="service-box">
                <i class="fa-solid fa-cross"></i>
                <h4>Burial Service</h4>
                <p>Cemetery burial services are available at the Gampola General Cemetery. Book your plot in advance and receive 
                    confirmation with all necessary details.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-box">
                <i class="fa-solid fa-fire"></i>
                <h4>Crematorium Service</h4>
                <p>The Gampola General Cemetery Crematorium offers multiple daily time slots for cremation services. 
                    Normal slots are available throughout the day, with after-normal slots available for cases requiring 
                    authority approval.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-box">
                <i class="fa-solid fa-building-columns"></i>
                <h4>Nisala Arana - Parlor Service</h4>
                <p>The Gampola Urban Council has now implemented the Funeral Parlor within the site of cemetery to assisst families 
                    during their timer of breavement. Family members can reserve the parlor through the online booking in advance to the 
                    funeral day.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="section-divider"></div>

<section class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold text-gold">Service Fees</h2>
        <p class="text-muted">Current fee schedule for Urban Council services</p>
    </div>

    <div class="row text-light">

        <div class="col-md-4 mb-4">
            <div class="fee-card text-center">
                <i class="fa-solid fa-cross icon"></i>
                <h4>Burial Fees</h4>

                <table class="table table-borderless text-light mt-3">
                    <tr>
                        <td class="text-start">Within UC Limit</td>
                        <td class="text-end">Rs. 2,500</td>
                    </tr>
                    <tr>
                        <td class="text-start">Outside UC</td>
                        <td class="text-end">Rs. 5,000</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="fee-card text-center highlight">
                <i class="fa-solid fa-fire icon"></i>
                <h4>Crematorium</h4>

                <table class="table table-borderless text-light mt-3">
                    <tr>
                        <td class="text-start">Within UC</td>
                        <td class="text-end">Rs. 11,000</td>
                    </tr>
                    <tr>
                        <td class="text-start">Outside UC</td>
                        <td class="text-end">Rs. 13,000</td>
                    </tr>
                </table>

                <small class="note">+ Rs. 1,000 after 6.00 PM</small>

                <hr>

                <h6 class="mt-3">Ash Keeping</h6>

                <table class="table table-borderless text-light">
                    <tr>
                        <td class="text-start">Within UC</td>
                        <td class="text-end">Rs. 15,000</td>
                    </tr>
                    <tr>
                        <td class="text-start">Outside UC</td>
                        <td class="text-end">Rs. 25,000</td>
                    </tr>
                </table>

                <small class="note">Storage period: 4 years</small>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="fee-card text-center">
                <i class="fa-solid fa-building-columns icon"></i>
                <h4>Parlor Fees</h4>

                <table class="table table-borderless text-light mt-3">
                    <tr>
                        <td class="text-start">Per Day</td>
                        <td class="text-end">Rs. 25,000</td>
                    </tr>
                    <tr>
                        <td class="text-start">Deposit</td>
                        <td class="text-end">Rs. 5,000</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

</section>

<div class="section-divider"></div>

<section class="container my-5">

    <div class="text-center p-3">
        <h2 class="fw-bold text-gold">Help & Advice</h2>
    </div>

    <div class="vh-100 p-3" style="background: none;">
        <ul class="nav flex-column gap-2">
            <a class="nav-link" href="index.php?help_page=home">Registration of a Death Occured At Home</a>
            <a class="nav-link" href="index.php?help_page=history">Registration of a Death Occured At General Hospital</a>
            <a class="nav-link" href="index.php?help_page=about"></a>
        </ul>
    </div>

</section>