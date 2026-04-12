<style>

.contact-header {
    margin-top: 100px;
}

.text-gold {
    color: #d4af7a;
}
    
.contact-card {
    background: rgba(30,30,30,0.85);
    padding: 10px;
    border-radius: 10px;
    border: 1px solid rgba(212,175,122,0.2);
    color: #ccc;
}

.contact-card h5 {
    color: #d4af7a;
    margin-bottom: 10px;
}

.contact-form {
    background: #ffffff;
    color: #333;
    border-radius: 15px;
    padding: 35px;
    border: 3px solid rgba(212,175,122,0.3);
}

.form-control {
    background: transparent;
    border: 1px solid #555;
    color: #333;
}

.form-control:focus {
    border-color: #d4af7a;
    box-shadow: none;
}

::placeholder {
    color: #aaa;
}

.btn-gold {
    background: #1a1a1a;
    color: #d4af7a;
    border: 1px solid #d4af7a;
    padding: 10px;
    border-radius: 30px;
    transition: 0.3s;
}

.btn-gold:hover {
    background: #d4af7a;
    color: black;
}

</style>

<section class="container my-5">

    <div class="contact-header text-center mb-5">
        <h2 class="fw-bold text-gold">Contact Us</h2>
        <p class="text-muted">We are here to assist you with care and respect</p>
    </div>

    <div class="row">

        <div class="col-md-5 mb-4">

            <div class="contact-card mb-2">
                <h5><i class="fa-solid fa-phone me-2"></i>Contact</h5>
                <p> +94 711 654 562 <br>
                    +94 771 562 456
                </p>
            </div>

            <div class="contact-card mb-2">
                <h5><i class="fa-solid fa-location-dot me-2"></i>Address</h5>
                <p>General Cemetery,<br>Urban Council Gampola</p>
            </div>

            <div class="contact-card mb-2">
                <h5><i class="fa-solid fa-envelope me-2"></i>Email</h5>
                <p>generalcemeterygampola@gmail.com</p>
            </div>

            <div class="contact-card mb-2">
                <h5><i class="fa-regular fa-clock me-2"></i>Office hours</h5>
                <p> Monday - Friday: 8:00 AM - 4:30 PM <br>
                    Saturday: 8:00 AM - 12:00 PM
                </p>
            </div>

        </div>

        <div class="col-md-7">

            <div class="contact-form">

                <form action="routes/contact.php" method="POST">

                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-7">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>

                        <div class="col-md-5">
                            <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Your Contact Number">
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                    </div>

                    <div class="mb-3">
                        <textarea name="message" rows="5" class="form-control" placeholder="Your Message" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-gold w-25">
                        Send Message
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>