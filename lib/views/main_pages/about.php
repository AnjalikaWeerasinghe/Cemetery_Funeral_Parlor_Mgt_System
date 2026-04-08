<style>

.about-hero {
  height: 400px;
  background: url('lib/uploads/homepage_1.jpg') center/cover no-repeat;
  position: relative;
  margin-top: 95px;
}

.about-hero .overlay {
  background: rgba(0,0,0,0.6);
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  color: white;
}

.text-gold {
  color: #d4af7a;
}

.about-card {
  background: rgba(30,30,30,0.8);
  padding: 30px;
  border-radius: 15px;
  border: 1px solid rgba(212,175,122,0.2);
  transition: 0.3s;
}

.about-card i {
  font-size: 30px;
  color: #d4af7a;
  margin-bottom: 10px;
}

.about-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(212,175,122,0.3);
}

.value-box {
  padding: 20px;
  border-radius: 10px;
  background: rgba(30,30,30,0.8);
  margin: 10px;
  transition: 0.3s;
}

.value-box i {
  font-size: 25px;
  color: #d4af7a;
  margin-bottom: 10px;
}

.value-box:hover {
  transform: scale(1.05);
}

.about-system {
  background: rgba(30,30,30,0.8);
  padding: 40px;
  border-radius: 15px;
  border: 1px solid rgba(212,175,122,0.2);
}

</style>

<section class="about-hero">
  <div class="overlay text-center">
    <h1>General Cemetery Gampola</h1>
    <p>A place of remembrance, dignity, and peace</p>
  </div>
</section>

<section class="container my-5">

  <div class="row text-center">
    <div class="text-center mb-3">
      <h2 class="text-gold">Who We Are</h2>
      <p class="text-dark" style="color: black;">
        The Gampola General Cemetery and Funeral Parlor operates under the Gampola Urban Council to provide a peaceful resting 
        place for the community, maintained with respect, dignity, and care for generations. We are committed to making these essential 
        services accessible to all families during their most difficult times, regardless of religious background, area of residence, or 
        financial circumstances.
      </p>
    </div>
  </div>

  <div class="row text-center mb-4 text-light">
    <div class="col-md-6 mb-4">
      <div class="about-card">
        <i class="fa-solid fa-bullseye"></i>
        <h5>Our Mission</h5>
        <p>To provide respectful, organized, and transparent cemetery services.</p>
      </div>
    </div>

    <div class="col-md-6 mb-4">
      <div class="about-card">
        <i class="fa-solid fa-eye"></i>
        <h5>Our Vision</h5>
        <p>To create a well-managed, digitally enabled cemetery system.</p>
      </div>
    </div>
  </div>

  <div class="text-center mb-4">
    <h2 class="text-gold">Our Values</h2>
  </div>

  <div class="row text-center mb-5 text-light">
    <div class="col-md-3">
      <div class="value-box">
        <i class="fa-solid fa-hand-holding-heart"></i>
        <p>Respect</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="value-box">
        <i class="fa-solid fa-people-group"></i>
        <p>Community</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="value-box">
        <i class="fa-solid fa-scale-balanced"></i>
        <p>Fairness</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="value-box">
        <i class="fa-solid fa-leaf"></i>
        <p>Care</p>
      </div>
    </div>
  </div>

  <div class="about-system text-center text-light">
    <h2 class="text-gold">About the System</h2>
    <p>
      This Cemetery Management System was developed to digitize burial records,improve service efficiency, and provide easy access to 
      cemetery information for both administrators and the public.
    </p>
  </div>

</section>