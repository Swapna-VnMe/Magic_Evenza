<?php
include 'db_connection.php';

?>







<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

  <title> Packages - Magic Evenza</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 40px;
    }

    .packages {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .package {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 5px;
      width: 250px;
      text-align: center;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .package img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }

    .package h2 {
      margin: 15px 0 10px;
      font-size: 20px;
      color: #111;
    }

    .package h3 {
      font-size: 14px;
      color: #000;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .package ul {
      list-style: none;
      padding: 0;
      margin: 0 15px 15px;
      text-align: left;
    }

    .package ul li {
      border-bottom: 1px solid #eee;
      padding: 8px 0;
    }

    .price {
      font-weight: bold;
      margin: 10px 0;
    }

    .details-button {
      background-color:rgb(92, 58, 230);
      color: white;
      padding: 10px;
      border: none;
      width: 100%;
      cursor: pointer;
      font-size: 14px;
    }

    .details-button:hover {
      background-color:red;
    }
  </style>
</head>
<body>
<?php include './includes/navbar.php'; ?>

<div class="mt-5" style="color:#6610f2 ;"><h1>OUR EVENT PACKAGES</h1></div>

<div class="packages">

  <!-- Birthday -->
  <div class="package mb-5 mt-4">
    <img src="./assets/img/birthday.avif" alt="Birthday">
    <h2 >Birthday</h2>
    <h3>THIS PACKAGE INCLUDES:</h3>
    <ul>
      <li>Birthday Cake</li>
      <li>Meal Service</li>
      <li>DJ & MC Services</li>
      <li>Bar Service</li>
      <li>Themes,Decorations</li>
    </ul>
    <div class="price">Price starts from 2k</div>
<a href="index.php" class="details-button btn btn-success">Book Event</a>

  </div>

  <!-- Wedding -->
  <div class="package mb-5 mt-4">
    <img src="./assets/img/marriage.avif" alt="Wedding">
    <h2>Wedding</h2>
    <h3>THIS PACKAGE INCLUDES:</h3>
    <ul>
      <li>Wedding Cake</li>
      <li>Meal Service</li>
      <li>DJ & MC Services</li>
      <li>Bar Service</li>
      <li>Themes,Decorations</li>
    </ul>
    <div class="price">Price starts from 50k</div>
<a href="index.php" class="details-button btn btn-success">Book Event</a>

  </div>
  <!-- Corporate -->
  <div class="package mb-5 mt-4">
    <img src="./assets/img/corporate.avif" alt="Corporate">
    <h2>Corporate Events</h2>
    <h3>THIS PACKAGE INCLUDES:</h3>
    <ul>
      <li>Right Venue & Branding</li>
      <li>Meal Service</li>
      <li>DJ & MC Services</li>
      <li>Bar Service</li>
      <li>Themes,Decorations</li>
    </ul>
    <div class="price">Price starts from 1lakh</div>
<a href="index.php" class="details-button btn btn-success">Book Event</a>

  </div>

  <!-- Get together -->
  <div class="package mb-5 mt-4">
    <img src="./assets/img/getogether.avif" alt="Gettogether">
    <h2>Get Together</h2>
    <h3>THIS PACKAGE INCLUDES:</h3>
    <ul>
      <li>Right Venue & Branding</li>
      <li>Meal Service</li>
      <li>DJ & MC Services</li>
      <li>Bar Service</li>
      <li>Themes,Decorations</li>
    </ul>
    <div class="price">Price starts from 20k</div>
<a href="index.php" class="details-button btn btn-success">Book Event</a>

  </div>

  <!-- baby shower -->
  <div class="package mb-5 mt-4">
    <img src="./assets/img/babyshower.avif" alt="Babyshower">
    <h2>Baby Shower</h2>
    <h3>THIS PACKAGE INCLUDES:</h3>
    <ul>
      <li>Right Venue & Branding</li>
      <li>Meal Service</li>
      <li>DJ & MC Services</li>
      <li>activities</li>
      <li>Themes,Decorations</li>
    </ul>
    <div class="price">Price starts from 50k</div>
<a href="index.php" class="details-button btn btn-success">Book Event</a>

  </div>

  <div class="package mb-5 mt-4">
    <img src="./assets/img/education.jpg" alt="Edu">
    <h2>Educational Events</h2>
    <h3>THIS PACKAGE INCLUDES:</h3>
    <ul>
      <li>Right Venue & Branding</li>
      <li>Meal Service</li>
      <li>DJ & MC Services</li>
      <li>Volunteers</li>
      <li>Themes,Decorations</li>
    </ul>
    <div class="price">Price starts from 5k</div>
<a href="index.php" class="details-button btn btn-success">Book Event</a>

  </div>

  <div class="package mb-5 mt-4">
    <img src="./assets/img/concerts.avif" alt="Concerts">
    <h2>Concerts</h2>
    <h3>THIS PACKAGE INCLUDES:</h3>
    <ul>
      <li>Right Venue & Branding</li>
      <li>Meal Service</li>
      <li>DJ & MC Services</li>
      <li>Bar Service</li>
      <li>Themes,Decorations</li>
    </ul>
    <div class="price">Price starts from 50k</div>
<a href="index.php" class="details-button btn btn-success">Book Event</a>

  </div>

    <div class="package mb-5 mt-4">
    <img src="./assets/img/view-futuristic-concert_23-2151072985.avif" alt="Concerts">
    <h2>Private Party</h2>
    <h3>THIS PACKAGE INCLUDES:</h3>
    <ul>
      <li>Right Venue & Branding</li>
      <li>Meal Service</li>
      <li>DJ & MC Services</li>
      <li>Bar Service</li>
      <li>Themes,Decorations</li>
    </ul>
    <div class="price">Price starts from 50k</div>
<a href="index.php" class="details-button btn btn-success">Book Event</a>

  </div>

</div>

<div>
  <span class="fw-bold d-flex justify-content-center mb-2" style="color: #6610f2;">Contact Us through call For More Details</span>
</div>
<?php include './includes/footer.php'; ?>

</body>
</html>
