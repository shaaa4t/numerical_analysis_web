<?php



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Numerical Analysis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">

  <link rel="stylesheet" href="./public/style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">


</head>

<body>
  <nav class="navbar navbar-expand-lg py-2">
    <div class="container ">
      <a class="navbar-brand text-light" href="index.php">
        <img src="./public/pngegg.png" width="40" alt="">
        <span>Numerical Analysis</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100 justify-content-end">
          <li class="nav-item mx-3 active">
            <a class="nav-link " aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item mx-3 ">
            <!-- ms-auto -->
            <a class="nav-link text-light" href="#">About</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container" style="margin-top: 80px; padding: 30px 0;">
    <div class="row">
      <?php include('./accordion.php') ?>

      <!--  -->

      <div class="col-12 col-xl-9 px-3">
        <!-- <div id="mohammed">

        </div> -->
        <?php

        if (isset($_GET['bisection'])) {
          include('./methods/Bisection.php');
        } else if (isset($_GET['position'])) {
          include('./methods/position_method.php');
        } else if (isset($_GET['lagrange'])) {
          include('./methods/lagrange.php');
        } else if (isset($_GET['curve_ax^b'])) {
          include('./methods/curve_ax_b.php');
        } else if (isset($_GET['curve_ab^x'])) {
          include('./methods/curve_ab_x.php');
        } else if (isset($_GET['trapezoidal'])) {
        include('./methods/trapezoidal.php');
      }else if (isset($_GET['simpson1_3'])) {
        include('./methods/simpson1_3.php');
      } else {
          include('./methods/Bisection.php');
        }
        
        ?>
      </div>

    </div>
  </div>

  <!-- <script>
    let mohammed = document.getElementById('mohammed');
    if (window.location.href === "http://localhost:1234/numerical_analysis/" || window.location.href === "http://localhost:1234/numerical_analysis/index.php") {
      mohammed.textContent = "Please Choose The Method From The List";
    } else {
      mohammed.remove()
    }
  </script> -->

  <script src="./public/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>

</html>