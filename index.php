<?php 



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Numerical Analysis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <style>
    .w-60 {
      width: 60%;
    }
    .accordion-body a {
      color: #222;
      text-decoration: none;
      position: relative;
      padding-left: 20px;
      transition: .2s all;
      display: block;
    }
    .accordion-body a:hover {
      color: #0d6efd;
    }

    .accordion-body a::before {
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      width: 10px;
      height: 10px; 
      border: 10px solid;
      border-color: transparent transparent transparent #0d6efd;
      margin-top: 3px
    }

    table, td, th {
      border: #CCCCCC;
      border-width: 0.2px;
      border-style: solid;
      border-collapse: collapse;

    }



  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Numerical Analysis</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item" >
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


    <div class="container " style="margin-top: 80px; padding: 30px 0;">
      <div class="row">
      <?php include('./accordion.php') ?>

        <!--  -->

        <div class="col-12 col-xl-9 px-3">
          <?php
            $chapter = "position_method";//"bisection" || "position_method"

//
//          if ($chapter=="bisection"){
//              include('./methods/Bisection.php');
//
//          }elseif ($chapter=="position_method")
//              include('./methods/position_method.php');
//          else
//              echo "Choose One Correct";
          switch ($chapter) {
              case "bisection":
                  include('./methods/Bisection.php');

                    break;
              case "position_method":
                include('./methods/position_method.php');
                break;

              default:
                echo "Choose One Correct";
            }
            ?>
        </div>

      </div>
    </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>