<?php

if(isset($_POST['apply'])){

    $_SERVER['PHP_SELF'];
}
?>


<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    include("db_conn.php");



?>


    <!DOCTYPE html>
    <html>

    <head>
        <title>Home</title>

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
        <br><br><br>

        <div class="main">
            <div class="container-fluid">
                <div class="row">

<?php

if(isset($_POST['apply'])){

    
}


$sql = "SELECT * FROM table_pricing where id = 1";

           
//use for MySQLi-OOP
$query = $conn->query($sql);
while($row = $query->fetch_assoc()){

    $haircut = $row['haircut'];

    echo '




                    <div class="col-12">
  <div class="form-group col-xs-2">
                    
                        <h1>Modify Services Pricing (in Philippine Peso)</h1><br><br><br>

                        <form action="#" method="POST">
    <label for="">Haircut:</label>
    <input type="number" name ="haircut" class="form-control" placeholder="" id="email" value='.$haircut.'>

    <label for="">Massage:</label>
    <input type="number" name="massage" class="form-control" placeholder="" id="email" value='.$row['massage'].'>
 
    <label for="">Nail Care:</label>
    <input type="number" name="nailcare" class="form-control" placeholder="" id="email" value='.$row['nailcare'].'>
 
    <label for="">Makeup:</label>
    <input type="number" name="makeup" class="form-control" placeholder="" id="email" value='.$row['makeup'].'>

   <br<br><br><hr><br><br>


   <label for="">Commision Percentage:</label>
    <input type="number" name="commission" class="form-control" placeholder="" id="email" value='.$row['commission'].'>
 
<br>

  <button type="submit" class="btn btn-primary" name="apply">Apply Changes</button>
</form>
';
}
?>


                    </div>
                    </div>
                </div>
            </div>






        </div>







<?php
if(isset($_POST['apply'])){


    $haircut = $_POST['haircut'];
    $massage = $_POST['massage'];
    $nailcare = $_POST['nailcare'];
    $makeup = $_POST['makeup'];
    $commission = $_POST['commission'];

    $_SESSION['done'] = 'Pricing changed successfully';



    $sql1 = "UPDATE table_pricing SET  haircut = '$haircut', massage = '$massage', makeup = '$makeup', nailcare = '$nailcare', commission = '$commission' where id = '1'";

    $conn->query($sql1);
    $_SERVER['PHP_SELF'];




}

?>

<?php if (isset($_SESSION['done'])) {
                  echo
                  "
            <div class='alert alert-success text-center'>
                <button class='close'>&times;</button>
                " . $_SESSION['done'] . " </div>";
                  unset($_SESSION['done']);

                  
                }
                
                if (isset($_SESSION['apply'])) {
                  echo
                  "
            <div class='alert alert-success text-center'>
                <button class='close'>&times;</button>
                " . $_SESSION['photo'] . " </div>";
                  unset($_SESSION['photo']);

                  echo '<h6><a href="profile.php" class="link-primary">Return to Profile</a></h6>';
                }?>










    </body>

    </html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>