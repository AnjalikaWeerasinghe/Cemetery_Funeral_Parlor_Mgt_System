<style>

.text-gold {
color: #d4af7a;
}

.timeline {
  position: relative;
  padding: 10px 0;
}

.timeline::after {
  content: '';
  position: absolute;
  width: 4px;
  background: linear-gradient(#8b6f47, #d4af7a);
  top: 0;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  box-shadow: 0 0 10px rgba(212,175,122,0.5);
}

.timeline-item {
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 80px 0;
}

.timeline-item.left .timeline-img {
  width: 40%;
}

.timeline-item.left .timeline-content {
  width: 40%;
}

.timeline-item.right {
  flex-direction: row-reverse;
}

.timeline-item.right .timeline-img {
  width: 40%;
}

.timeline-item.right .timeline-content {
  width: 40%;
}

.timeline-img img {
  width: 100%;
  border-radius: 15px;
  transition: 0.4s;
}

.timeline-img img:hover {
  transform: scale(1.05);
}

.timeline-content {
  padding: 20px;
  border-radius: 15px;
  backdrop-filter: blur(10px);
  background: rgba(255,255,255,0.7);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
  transition: 0.3s;
}

.timeline-content:hover {
  transform: translateY(-5px);
}

.timeline-dot {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  
  width: 55px;
  height: 55px;
  
  background: linear-gradient(135deg, #8b6f47, #d4af7a);
  border-radius: 50%;
  
  display: flex;
  align-items: center;
  justify-content: center;
  
  color: white;
  font-size: 18px;
  
  z-index: 10;
  
  border: 4px solid white;
  box-shadow: 0 0 15px rgba(0,0,0,0.25);

  animation: pulse 2s infinite;
}

.timeline-item.left .timeline-content::before {
  content: '';
  position: absolute;
  top: 50%;
  right: -40px;
  width: 40px;
  height: 3px;
  background: linear-gradient(to right, #8b6f47, #d4af7a);
}

.timeline-item.right .timeline-content::before {
  content: '';
  position: absolute;
  top: 50%;
  left: -40px;
  width: 40px;
  height: 3px;
  background: linear-gradient(to left, #8b6f47, #d4af7a);
}

.timeline-content {
  position: relative;
}

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(212,175,122,0.7);
  }
  70% {
    box-shadow: 0 0 0 15px rgba(212,175,122,0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(212,175,122,0);
  }
}

@media (max-width: 768px) {

  .timeline::after {
    left: 20px;
  }

  .timeline-item {
    flex-direction: column;
    align-items: flex-start;
    margin-left: 40px;
  }

  .timeline-item .timeline-img,
  .timeline-item .timeline-content {
    width: 100%;
  }

  .timeline-dot {
    left: 20px;
  }
}

</style>

<section class="container my-5" >

  <div class="text-center mb-5" style="margin-top: 100px;">
    <h2 class="fw-bold text-gold">History of General Cemetery - Gampola</h2>
    <p class="text-muted">A journey through time</p>
  </div>

  <div class="timeline">

    <div class="timeline-item left">
      <div class="timeline-dot">
        <i class="fa-solid fa-landmark"></i>
      </div>

      <div class="timeline-img">
        <img src="lib/uploads/history_1.jpg" class="img-fluid rounded shadow">
      </div>

      <div class="timeline-content shadow">
        <h5><i class="fa-solid fa-landmark text-warning me-2"></i>Historical Background - Gampola</h5>
        <p>A royal capital of Sri Lanka (14th century) under kings like Buwanekabahu IV</p>
        <ul>
          <li>It was a major administrative and cultural center</li>
          <li>Surrounded by temples like Lankatilaka and Gadaladeniya</li>
          <li>Continued to develop during Kandyan and British periods</li>
        </ul>
      </div>
    </div>

    <div class="timeline-item right">
      <div class="timeline-dot">
        <i class="fa-solid fa-cross"></i>
      </div>

      <div class="timeline-img">
        <img src="lib/uploads/cem_4.jpg" class="img-fluid rounded shadow">
      </div>
      
      <div class="timeline-content shadow">
        <h5><i class="fa-solid fa-cross text-secondary me-2"></i>Origin</h5>
        <p>Colonial-era burial activity (1800s)</p>
        <ul>
          <li>Burial records from St. Andrew's Church, Gampola (1864-1971) exist</li>
          <li>These records include:
            <ul>
              <li>Europeans</li>
              <li>Local Residents</li>
              <li>Hospital Deaths</li>
            </ul>
          </li>
        </ul>
      </div>
    </div>

    <div class="timeline-item left">
      <div class="timeline-dot">
        <i class="fa-solid fa-city"></i>
      </div>

      <div class="timeline-img">
        <img src="lib/uploads/cem_2.jpg" class="img-fluid rounded shadow">
      </div>

      <div class="timeline-content shadow">
        <h5><i class="fa-solid fa-city text-success me-2"></i>Urban Development</h5>
        <p>Known as General Cemetery - Gampola</p>
        <ul>
          <li>Managed by Local Government (Urban Council)</li>
          <li>Multi-community Burial Ground - serves individuals from different cultural and religious backgrounds</li>
        </ul>
      </div>
    </div>

    <div class="timeline-item right">
      <div class="timeline-dot">
        <i class="fa-solid fa-users"></i>
      </div>

      <div class="timeline-img">
        <img src="lib/uploads/cem_4.jpg" class="img-fluid rounded shadow">
      </div>

      <div class="timeline-content shadow">
        <h5><i class="fa-solid fa-users text-primary me-2"></i>Community Heritage</h5>
        <p>Holds deep emotional and cultural significance for the community</p>
        <ul>
          <li>Reflects the diversity of the region, representing different traditions, beliefs, and customs associated with burial and 
              remembrance
          </li>
          <li></li>
        </ul>
      </div>
    </div>

    <div class="timeline-item left">
      <div class="timeline-dot">
        <i class="fa-solid fa-leaf"></i>
      </div>
      
      <div class="timeline-img">
        <img src="lib/uploads/cem_5.webp" class="img-fluid rounded shadow">
      </div>

      <div class="timeline-content shadow">
        <h5><i class="fa-solid fa-leaf text-success me-2"></i>Present Day</h5>
        <p>Provides burial services, record management, and maintenance, ensuring that the dignity of the resting place is preserved</p>
      </div>
    </div>

  </div>

</section>