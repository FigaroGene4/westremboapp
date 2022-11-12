<?php
session_start();



?>
<!DOCTYPE html>
<html>

<head>
  <title>Client</title>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="icon" type="image/x-icon" href="logo.png">
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    .height10 {
      height: 10px;
    }

    .mtop10 {
      margin-top: 10px;
    }

    .modal-label {
      position: relative;
      top: 7px
    }
  </style>

</head>

<body>



  <nav class="navbar navbar-light bg-light fixed-top ">
    <style>
      a {
        color: black;
      }

      a:hover {
        color: violet;
      }

      .dropdown-menu {
        padding: 15px;

      }
    </style>

    <a class="navbar-brand" href="home.php" style="padding-left: 10px;"> <img src="logo.png" width="20px"> </a>
    <a class="navbar-brand">Hello, <?php echo $_SESSION['name']; ?></a>
    <a class="navbar-brand navbar-right .active   " href="createadmin.php"></a>
    <a class="navbar-brand navbar-right  " href="changepassword.php"> </a>
    <a class="navbar-brand navbar-right  " href="logout.php" style="margin-left: auto"></a>
    <div class="dropdown droptxt">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Admin Settings
        <span class="caret"></span></button>
      <ul class="dropdown-menu droptxt">
        <li><a href="createadmin.php">Create Admin Account</a></li>
        <li><a href="changepassword.php">Reset Password</a></li>
        <div class="dropdown-divider"></div>
        <li><a href="logout.php">Logout</a></li>
    </div>
    </ul>
    </div>
  </nav>

  <div class="sidebar">
<br><br><br><br>

<a href="client.php ">Client</a>
<a href="artist.php">Artist</a>
<a href="booking.php">Booking</a>
<a href="payment.php">Payment</a>
<a href="pricing.php">Service Pricing</a>
<a href="report.php">Report</a>
<a href="refund.php">Refund</a>
<a href="payartist.php">Pay Artist</a>
<a href="Blog.php">Blog</a>
</div>

  </div><br><br>



  <br><br><br>
  <div class="main">

    <div class="container-fluid ">
      <div class="row">
        <div class="col-md-6">
          <h2>Today's Reports </h2>

          <?php
          include_once('db_conn.php');
          date_default_timezone_set('Asia/Taipei');
          $dateNow = date('m/d/Y');
          $date = date('F d, Y | g:iA');
          $sql = "SELECT *  FROM table_book where datebooking = '$date' AND status = 'Service Complete'";

          echo $date;
          echo '<br>';

          echo '<br><img src="philippine-peso.png" alt="Avatar" width="20px">';


          $sql = "SELECT sum(profit) as profit FROM table_book WHERE status ='Service Complete' AND datebooking = '$dateNow'";

          $result = $conn->query($sql);

          while ($row = mysqli_fetch_assoc($result)) {





            echo "Today's system earnings:<strong> ₱" . $row['profit'] . "</strong>";
          }
          ?>
          <table style="width:50%">
            <tr>
              <th>New Clients:</th>
              <td><?php
                  $dateNow = date('Y-m-d');
                  $q = "SELECT * FROM table_customer WHERE dateJoined='$dateNow' ";
                  $res = mysqli_query($conn, $q);
                  echo mysqli_num_rows($res);
                  echo " New Clients";

                  ?> </td>
            </tr>
            <tr>
              <th>Pamper Artist:</th>
              <td><?php
                  $dateNow = date('Y-m-d');
                  $q = "SELECT * FROM table_artist WHERE datejoined='$dateNow' ";
                  $res = mysqli_query($conn, $q);
                  echo mysqli_num_rows($res);
                  echo " New Pamper Artists";

                  ?> </td>
            </tr>
            <tr>
              <th>Transactions:</th>
              <td><?php
                  $dateNow = date('Y-m-d');
                  $q = "SELECT * from table_book where status='Service Complete' AND datebooking ='$dateNow'";
                  $res = mysqli_query($conn, $q);
                  echo mysqli_num_rows($res);
                  echo ' New transactions';

                  ?></td>
            </tr>
          </table>














        </div>

        <div class="col-md-6">
          <h2>Monthly Reports</h2>

          <?php
          include_once('db_conn.php');
          date_default_timezone_set('Asia/Taipei');
          $dateNow = date('m/d/Y');
          $date = date('M');
          $sql = "SELECT *  FROM table_book where datebooking = '$date' AND status = 'Service Complete'";

          echo 'Month of ' . $date;
          echo '<br>';

          echo '<br><img src="philippine-peso.png" alt="Avatar" width="20px">';


          $sql = "SELECT sum(profit) as profit FROM table_book WHERE status ='Service Complete' AND datebooking = '$dateNow'";

          $result = $conn->query($sql);

          while ($row = mysqli_fetch_assoc($result)) {





            echo "Month's system earnings:<strong> ₱" . $row['profit'] . "</strong>";
          }
          ?>
          <table style="width:50%">
            <tr>
              <th>New Clients:</th>
              <td><?php
                  $dateNow = date('Y-m-d');
                  $month = date('m');
                  $q = "SELECT * FROM table_customer WHERE dateJoined='$dateNow' ";
                  $res = mysqli_query($conn, $q);
                  echo mysqli_num_rows($res);
                  echo " New Clients";


                  ?> </td>
            </tr>
            <tr>
              <th>Pamper Artist:</th>
              <td><?php
                  $dateNow = date('Y-m-d');
                  $q = "SELECT * FROM table_artist WHERE datejoined='$dateNow' ";
                  $res = mysqli_query($conn, $q);
                  echo mysqli_num_rows($res);
                  echo " New Pamper Artists";

                  ?> </td>
            </tr>
            <tr>
              <th>Transactions:</th>
              <td><?php
                  $dateNow = date('Y-m-d');
                  $q = "SELECT * from table_book where status='Service Complete' AND datebooking ='$dateNow'";
                  $res = mysqli_query($conn, $q);
                  echo mysqli_num_rows($res);
                  echo ' New transactions';

                  ?></td>
            </tr>
          </table>

          <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
          <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

          <br><br>
        </div>
      </div>
      <h2>Search for Specific Date:</h2>

      <form action="#" method="POST">
        <input id="datepicker" width="250" name="datepicker" required placeholder="Select your preffered date" />
        <script>
          $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd',



          });
        </script>
        <br><br>
        <input class="btn btn-primary" type="submit" name="report" value="Search Report">



      </form>
    </div>

  </div>


  <?php

  if (isset($_POST['report'])) {

    $date = $_POST['datepicker'];
    echo '<div class="container-fluid main">
    <div class="row">';
    echo '<div class="col-md-12">';
    include_once('db_conn.php');
    date_default_timezone_set('Asia/Taipei');
    $newDate = date("F d, Y", strtotime($date));

    $sql = "SELECT *  FROM table_book where datebooking = '$date' AND status = 'Service Complete'";
    echo '<br><br>Date: ' . $newDate;
    echo '<br>';

    echo '<br><img src="philippine-peso.png" alt="Avatar" width="20px">';


    $sql = "SELECT sum(profit) as profit FROM table_book WHERE status ='Service Complete' AND datebooking = '$date'";

    $result = $conn->query($sql);

    while ($row = mysqli_fetch_assoc($result)) {



      if ($row['profit'] > 0) {
        echo "System  earnings:<strong> ₱" . $row['profit'] . "</strong>";
      } else {
        echo 'No System Earnings!';
      }



      echo ' <table style="width:20%">
      <tr>
        <th>New Clients:</th>
        <td>';

      $newDatez = date("Y-m-d", strtotime($date));
      $q = "SELECT * FROM table_customer WHERE dateJoined='$newDatez' ";

      $res = mysqli_query($conn, $q);
      echo mysqli_num_rows($res);
      echo " New Clients";

      echo '</td>
        </tr>
        <tr>
          <th>Pamper Artist:</th>
          <td>';

      $newDatez = date("Y-m-d", strtotime($date));
      $q = "SELECT * FROM table_artist WHERE datejoined='$newDatez' ";
      $res = mysqli_query($conn, $q);
      echo mysqli_num_rows($res);
      echo " New Pamper Artists";

      echo '</td>
      </tr>
      <tr>
        <th>Transactions:</th>
        <td>';


        $newDatez = date("m/d/Y", strtotime($date));
      $q = "SELECT * from table_book where status='Service Complete' AND datebooking ='$newDatez'";
      $res = mysqli_query($conn, $q);
      echo mysqli_num_rows($res);
      echo ' New transactions';
    }

    echo '</table></div></div></div>';
  }



  ?>
  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="datatable/jquery.dataTables.min.js"></script>
  <script src="datatable/dataTable.bootstrap.min.js"></script>
  <!-- generate datatable on our table -->
  <script>
    $(document).ready(function() {
      //inialize datatable
      $('#myTable').DataTable();

      //hide alert
      $(document).on('click', '.close', function() {
        $('.alert').hide();
      })
    });
  </script>













</body>

</html>