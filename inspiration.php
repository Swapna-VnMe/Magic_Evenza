<?php
include 'db_connection.php';

?>









<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inspiration - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
      .carousel-container {
        max-width: 800px;
        margin: 30px auto;
      }
      .carousel-inner img {
        border-radius: 10px;
      }
    </style>
  </head>
  <body>
<?php include './includes/navbar.php'; ?>

    <div class="text-center mt-4">
    <div class="fw-bold">
        <p class="text-danger fs-1">Inspiration | Magic Evenza </p>
<span>At Magic Evenza, we believe that every great event begins with a spark of inspiration. This page is dedicated to the stories, ideas, and moments that ignite creativity and passion. From breathtaking decor concepts to heartwarming success stories, let these inspirations guide you in creating events that are not just memorable—but magical.</span>
    </div>
      <h1 class="text-primary fw-bold mt-4">Know Our Events</h1>
    </div>

    <div class="carousel-container">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
     
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./assets/img/m1.avif" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>AJITH and ADITI</h5>
              <p>"Two hearts, one soul, endless love."</p>
            </div>
          </div>

   <div class="carousel-item active">
            <img src="./assets/img/b1.avif" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Mr & Mrs JHON</h5>
              <p>"A day to celebrate life, laughter, and another year of wonderful memories!"</p>
            </div>
          </div>

          
   <div class="carousel-item active">
            <img src="./assets/img/c1.avif" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Futura Company</h5>
              <p>"Where business meets brilliance—making every corporate event impactful."</p>
            </div>
          </div>


          <div class="carousel-item">
            <img src="./assets/img/m2.avif" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>ADI and AMULYA</h5>
              <p>"Two hearts, one soul, endless love."</p>
            </div>
          </div>




          <div class="carousel-item">
            <img src="./assets/img/m3.avif" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>NITHIN and NITHYA</h5>
              <p>"Two hearts, one soul, endless love."</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="./assets/img/m4.avif" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>ANIL and AVANI</h5>
              <p>"Two hearts, one soul, endless love."</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="./assets/img/m5.avif" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>SATHYA and PALLAVI</h5>
              <p>"Two hearts, one soul, endless love."</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="./assets/img/m6.avif" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>ANIRUDDH and ACCHUTA</h5>
              <p>"Two hearts, one soul, endless love."</p>
            </div>
          </div>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>


 <div class="d-flex align-items-center justify-content-center mb-">
  <a href="index.php" class="btn btn-primary">Join US to your event</a>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <?php include './includes/footer.php'; ?>

  </body>
</html>
