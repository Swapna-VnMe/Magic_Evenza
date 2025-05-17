<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us - Magic Evenza</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: rgb(168, 151, 151) !important;
      margin: 0;
      padding: 0;
      text-align: left;
    }

    .about-section {
      padding: 50px 0;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2, h3 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      color: #2c3e50;
    }

    p {
      font-size: 1.1rem;
      line-height: 1.6;
      color: #34495e;
      font-weight: 400;
    }

    .about-img {
      width: 75%;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .quote-box {
      background-color: #f8f9fa;
      padding: 30px;
      border-left: 5px solid #e74c3c;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      color: #2c3e50;
    }

    .team-member img {
      max-width: 200px;
      border-radius: 50%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .team-member h4 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      color: #2c3e50;
      margin-top: 15px;
    }

    .team-member p {
      color: #7f8c8d;
      font-weight: 400;
    }

    .lead {
      font-weight: bold;
      color:rgb(92, 58, 230);
    }
  </style>
</head>
<body>

<?php include './includes/navbar.php'; ?>

<div class="about-section">
  <div class="container">

    <!-- Row with Image and Quote -->
    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <img src="images/MagicEvenza.png" alt="Magic Evenza Event Management" class="about-img ms-5">
      </div>
      <div class="col-md-6">
        <div class="quote-box">
          <h4>"Turning Moments into Memories"</h4>
          <p>We bring your dream events to life with passion and creativity. Whether it’s a wedding, birthday, or corporate celebration – we make it magical.</p>
          <a href="contact.php" class="btn btn-danger mt-3">Book Your Event Now</a>
        </div>
      </div>
    </div>

    <div style="padding: 0 15px;">
      <h1 class=" mb-4" style="color:red;">About Magic Evenza</h1>

      <section>
        <h2 style="color:#6610f2 ;">Our Story</h2>
        <p>Founded with a passion for creativity and perfection, Magic Evenza is a full-service event management company dedicated to transforming your visions into unforgettable experiences. From intimate birthday celebrations to grand weddings and corporate galas, we bring a touch of magic to every event.</p>
      </section>

      <section>
        <h2 style="color:#6610f2 ;">Our Mission</h2>
        <p>Our mission is to craft seamless, innovative, and stress-free events that reflect our clients' personalities and goals. We believe that every event should be unique and unforgettable.</p>
      </section>

      <section>
        <h2 style="color:#6610f2 ;">Why Choose Us</h2>
        <ul>
          <li>Creative and customized event planning</li>
          <li>Professional and experienced team</li>
          <li>Strong vendor relationships</li>
          <li>On-time execution and budget-friendly options</li>
          <li>100% client satisfaction rate</li>
        </ul>
      </section>

      <section>
        <h2 style="color:#6610f2 ;">Our Services</h2>
        <p>We offer a wide range of services including:</p>
        <ul>
          <li>Wedding Planning</li>
          <li>Corporate Events</li>
          <li>Birthday & Anniversary Celebrations</li>
          <li>Theme Parties</li>
          <li>Stage Design and Decor</li>
          <li>Photography & Videography</li>
        </ul>
      </section>

      <section>
        <h2 style="color:#6610f2 ;">Meet the Team</h2>
        <p><strong>Key Members:</strong></p>
        <ul>
          <li>Swapna HG – Founder & Creative Head</li>
          <li>Rohit Verma – Lead Event Coordinator</li>
          <li>Priya Joshi – Decor & Styling Manager</li>
        </ul>
      </section>

      <section>
        <h2 style="color:#6610f2 ;">Our Values</h2>
        <p>At Magic Evenza, we operate with a strong set of values that guide every project:</p>
        <ul>
          <li>Integrity</li>
          <li>Creativity</li>
          <li>Reliability</li>
          <li>Client-first approach</li>
        </ul>
      </section>

      <section>
        <h2 style="color:#6610f2 ;">Client Testimonials</h2>
        <blockquote>"Magic Evenza truly made our wedding day magical. Every detail was perfect!" – Aisha & Raj</blockquote>
        <blockquote>"Highly professional and creative. They handled our corporate event flawlessly." – Arvind, CEO, TechNova</blockquote>
      </section>

      <section>
        <h2 style="color:#6610f2 ;">Let’s Create Magic Together</h2>
        <p>Ready to plan your next unforgettable event? <a href="contact.php">Contact us</a> today to get started!</p>
        <p class="fw-bold">We will reach you within 24 hours</p>
      </section>
    </div>
  </div>
</div>
<?php include './includes/footer.php'; ?>

</body>
</html>
