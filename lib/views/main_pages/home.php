<style>

.service-card {
  padding: 30px;
  border-radius: 15px;
  background: rgba(30,30,30,0.8);
  border: 1px solid rgba(212,175,122,0.2);
  color: #ddd;

  transition: all 0.4s ease;
  height: 100%;
  min-height: 260px;
}

.service-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 30px rgba(212,175,122,0.3);
}

.icon-box {
  width: 70px;
  height: 70px;
  margin: auto;

  border-radius: 50%;
  background: radial-gradient(circle, #d4af7a, #8b6f47);

  display: flex;
  align-items: center;
  justify-content: center;

  font-size: 28px;
  color: white;

  box-shadow: 0 0 15px rgba(212,175,122,0.6);
  transition: 0.3s;
}

.service-card:hover .icon-box {
  transform: scale(1.1) rotate(5deg);
}

.service-card h5 {
  color: #d4af7a;
  margin-bottom: 10px;
}

.service-card p {
  font-size: 14px;
  color: #bbb;
}

</style>

<section style="background: url('lib/uploads/homepage_1.jpg') center/cover; height: 500px; margin-top: 95px;">
    <img src="lib/uploads/homepage_1.png" alt="">
</section>

<section class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-dark text-white p-5 rounded text-center shadow">
            
                <h2 class="fw-bold mb-3">Welcome to General Cemetery Gampola</h2>
                
                <h5 class="mb-4 text-light">
                    A place of remembrance, dignity, and eternal peace - serving the community with care and respect.
                </h5>
                
                <p class="lead mb-0">
                    The General Cemetery Gampola stands as a peaceful and respectful resting place for generations of loved ones.
                    Managed with dedication and responsibility, our cemetery provides a serene environment where families can honor,
                    remember, and celebrate the lives of those who have passed on.
                </p>

            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="row">

        <div class="col-md-12">
            <div class="row d-flex justify-content-center">
                <h2 class="text-center pb-3 fw-bold">Our Services</h2>

                <div class="col-md-6 mb-4">
                    <div class="service-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fa-solid fa-monument"></i>
                        </div>

                        <h5 class="fw-bold">Burial Plot Allocation</h5>
                        <p>We provide an organized and transparent system for allocating burial plots,
                        ensuring proper space management while respecting cultural and religious requirements.
                        </p>

                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="service-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fa-solid fa-leaf"></i>
                        </div>

                        <h5 class="fw-bold">Grave Maintenance and Care</h5>
                        <p>Our team ensures that all graves and surrounding areas are regularly maintained, keeping the environment clean, 
                            respectful, and well-preserved for visitors.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="service-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <h5>Assistance with Funeral Arrangements</h5>
                        <p>We offer guidance and support to families during funeral arrangements, helping them manage procedures with care, 
                            dignity, and understanding.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="service-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fa-solid fa-dove"></i>
                        </div>
                        <h5>Visitor Arrangements</h5>
                        <p>Visitors are provided with clear directions and assistance to locate graves and navigate the cemetery comfortably 
                            and respectfully.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="service-card text-center">
                        <div class="icon-box mb-3">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                    <h5>Record Management and Documentation</h5>
                    <p>We maintain accurate and secure records of all burials, allowing easy access to essential information while 
                        ensuring long-term data reliability.
                    </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<section class="container my-5">

    <div class="text-center mb-4">
        <h2 class="fw-bold">Our Location</h2>
        <p class="text-muted">General Cemetery - Gampola</p>
    </div>

    <div class="card shadow border-0">
        <img src="lib/uploads/Cemetery_Map.png" class="img-fluid rounded" alt="Cemetery Map">
    </div>

    <div class="mt-3 text-center">
        <p><strong>Landmark:</strong> Near Gampola Town / Main Road</p>
    </div>

    <div class="text-center">
        <a href="https://www.google.com/maps?q=General+Cemetery+Gampola" class="btn btn-dark" target="_blank">
            Open in Google Maps
        </a>
    </div>

</section>