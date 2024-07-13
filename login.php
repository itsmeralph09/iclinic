<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>iClinic - Login</title>
      
      <!-- CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

      <link href="./css/login.css" rel="stylesheet">
      <!-- FONT -->

      <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

      <!-- SweetAlert2 CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

      <!-- SweetAlert2 JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

      <!-- Jquery -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

   </head>
   <body class="">
      <!-- CONTAINER -->
      <div class="container d-flex align-items-center min-vh-100">
         <div class="row g-0 justify-content-center">
            <!-- TITLE -->
            <div class="col-lg-5 offset-lg-1 mx-0 px-0">
               <div id="title-container">
                  <img class="covid-image" src="./img/prmsu_cande.png">
                  <h2>iClinic</h2>
                  <h3>PRMSU Candelaria Clinic Management System</h3>
                  <p>"Welcome to the iClinic: PRMSU Candelaria Clinic Management System, your gateway to efficient healthcare management. Embrace a seamless experience where precision meets care, designed to elevate patient services and streamline clinic operations. Step into a realm of medical excellence and compassionate care, where each interaction fosters wellness and trust."</p>
               </div>
            </div>
            <!-- FORMS -->
            <div class="col-lg-7 mx-0 px-0">
               <div id="qbox-container" class="">
                  <form class="needs-validation" id="form-wrapper" method="post" name="form-wrapper" novalidate="" method="POST">
                     <div id="steps-container">
                        <div class="step col-12">
                           <h4>Provide us with your account information:</h4>
                           <div class="">
                              <div class="form-floating mt-5">
                                <input type="text" class="form-control form-control-user" id="no" name="no" placeholder="" required>
                                <label for="no">Student / Employee No.</label>
                              </div>
                              <div class="form-floating mt-3">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="" required>
                                <label for="first_name">Password</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="q-box__buttons">
                        <button id="login-btn" type="submit">Login</button>
                     </div>
                  </form>
                  <hr>
                  <p class="text-center">No account yet? <span><a href="register.php">Register!</a></span></p>
               </div>
            </div>
         </div>
      </div>

      <div id="preloader-wrapper">
         <div id="preloader"></div>
         <div class="preloader-section section-left"></div>
         <div class="preloader-section section-right"></div>
      </div>

      <script src="./js/login.js"></script>
   </body>
</html>