<!-- Google Font for logo -->
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .footer-logo {
    font-family: 'Pacifico', cursive;
    font-weight: bold;
    font-size: 2.2rem;
    color: #ffffff;
    letter-spacing: 1px;
  }

  .footer-logo span {
    color: rgb(92, 58, 230);
  }
</style>

<footer class="bg-dark text-light pt-4 mt-1">
  <div class="container text-center">
    <!-- Centered Stylish Text Logo -->
    <h1 class="footer-logo mb-4">Magic <span>Evenza</span></h1>
  </div>

  <div class="container">
    <div class="row text-center text-md-start">

      <!-- About Section -->
      <div class="col-md-4 mb-4 text-center">
        <h5>About Us</h5>
        <p>
          We organize the best events to bring people together. Join us and book your spot today!
        </p>
        <p class="fst-italic">“Creating unforgettable moments through events.”</p>
        <a href="about.php" class="btn btn-outline-light">Learn More</a>
        <div class="d-flex justify-content-center gap-3 mt-3">
          <i class="bi bi-calendar-event fs-5" title="Event Planning"></i>
          <i class="bi bi-people-fill fs-5" title="Guest Management"></i>
          <i class="bi bi-lightning fs-5" title="Lighting & Effects"></i>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-4 d-flex flex-column align-items-center">
        <h5>Quick Links</h5>
        <ul class="list-unstyled text-center">
          <li><a href="index.php" class="text-light text-decoration-none">Home</a></li>
          <li><a href="events.php" class="text-light text-decoration-none">Events</a></li>
          <li><a href="about.php" class="text-light text-decoration-none">About</a></li>
          <li><a href="contact.php" class="text-light text-decoration-none">Contact</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-md-4 mb-4">
        <h5>Contact Us</h5>
        <p>
          Email: <a href="mailto:Magic_Evenza@gmail.com" class="text-light text-decoration-none">Magic_Evenza@gmail.com</a><br>
          Phone: <a href="tel:+1234567890" class="text-light text-decoration-none">+917353514374</a><br>
          Address: Martha's Hospital Road, Uttarahalli, Bangalore-560061
        </p>
        <div>
          <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

    </div>

    <hr class="border-light" />

    <div class="text-center small pb-3">
      &copy; <?= date('Y') ?> Magic Evenza. All rights reserved.
    </div>
  </div>
</footer>
