<?php require_once "controllerUserData.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Welcome to SPA2GO!</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>




  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart - v1.9.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="../index.php" class="logo d-flex align-items-center">
        <img src="assets/img/jorj.png" alt="">
        <span>SPA2GO</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="../index.php">Home</a></li>
          
          <li><a class="getstarted scrollto" href="../index.php/#">Get Started</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <br><br><br><br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form">
        <form action="signup-user.php" method="POST" autocomplete="" enctype="multipart/form-data">
          <h2 class="text-center">Create an Account</h2>
          <p class="text-center">Enter your credentials</p>
          <?php
          if (count($errors) == 1) {
          ?>
            <div class="alert alert-danger text-center">
              <?php
              foreach ($errors as $showerror) {
                echo $showerror;
              }
              ?>
            </div>
          <?php
          } elseif (count($errors) > 1) {
          ?>
            <div class="alert alert-danger">
              <?php
              foreach ($errors as $showerror) {
              ?>
                <li><?php echo $showerror; ?></li>
              <?php
              }
              ?>
            </div>
          <?php
          }
          ?>
          <div class="form-group">
            <input class="form-control" type="text" name="firstname" placeholder="First Name" required value="<?php echo $firstname ?>">
          </div>
          <div class="form-group">
            <input class="form-control" type="text" name="lastname" placeholder="Last Name" required value="<?php echo $lastname ?>">
          </div>
          <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
          </div>

          <div class="form-group">
            <input class="form-control" type="number" name="contactnumber"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" placeholder="Contact Number" required value="<?php echo $contactnumber?> ">
          </div><br>
          
          <label for="custom-select">Select your City:</label><br>
          <select class="custom-select" name='city' required>
            
            <option  selected><?php 
            if(isset($city)){
              echo $city;
             } 
              if($city ==''){
                echo 'Your Current City';
               } 
              

            
            
            ?></option>
            <option value="Taguig City">Taguig City</option>
            <option value="Makati City">Makati City</option>
            <option value="Pasig City">Pasig City</option>
          </select>
          <div class="form-group">
            <input class="form-control" type="text" name="addressDetails" placeholder="Street Name, Building, House N  " required value="<?php echo $addressDetails ?>">
          </div>
          <div class="form-group">
            <input class="form-control" type="text" name="baranggay" placeholder="Baranggay" required value="<?php echo $baranggay ?>">
          </div>

          <div class="form-group">
            <input class="form-control" type="number" name="postalCode" placeholder="Postal Code" required value="<?php echo $postalCode ?>">
          </div>
          <div class="form-group"><br>
            <input class="form-control" type="password" name="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
          </div>
          <label for="" style="font-size:13px" >&nbspPassword must be 8 characters minimum with an uppercase and a number</label>
          <br><br>

          <div class="field image">
            <label>Upload Profile Picture</label>
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
          </div>
          <br>
          <br>

          <div class="tacbox">
            <input id="checkbox" type="checkbox" required />
            <label for="checkbox"> I agree to these <a href="#" data-toggle="modal" data-target="#exampleModalLong">Terms and Conditions</a>.</label>
          </div>
          <br>
          <div class="form-group">
            <input class="form-control button" type="submit" name="signup" value="Signup">
          </div>
          <div class="link login-link text-center">Already a member? <a href="login-user.php">Login here</a></div>
        </form>
      </div>
    </div>
  </div>

  <br>
  <?php include '../includes/footer.php'; ?>


  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Terms and Conditions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h2> SPA2GO and its proponents </h2>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>



  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>