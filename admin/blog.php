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


        </div><br><br><br><br>

        <div class="main">
            <div class="container ">
                <div class="row">
                    <div class="col-12">
                        <h1>Health Tips</h1><br><br>

                        <a type="button" class="btn btn-primary" href="blogcreate.php">Create a post</a><br><br>

                    </div>

                    <style>
                        .buttonz {
                            width: 60px;
                            height: 30px;
                            vertical-align: top;
                        }
                    </style>

                    <?php
                                if (isset($_SESSION['error'])) {
                                    echo
                                    "
                                        <div class='alert alert-danger text-center'>
                                            <button class='close'>&times;</button>
                                            " . $_SESSION['error'] . "
                                        </div>
                                        ";
                                    unset($_SESSION['error']);
                                  }
                                  if (isset($_SESSION['success'])) {
                                    echo
                                    "
                                        <div class='alert alert-success text-center'>
                                            <button class='close'>&times;</button>
                                            " . $_SESSION['success'] . "
                                        </div>
                                        ";
                                    unset($_SESSION['success']);
                                  }
                                  ?>
                    <div class="col-10">
                        <div class="height10">


                            <table id="myTable" class="table text-center table-striped ">
                                <thead class="thead-dark">
                                    <th>ID</th>
                                    <th>TITLE</th>
                                    <th>DATE</th>
                                    <th>CONTENT</th>
                                    <th>IMG</th>
                                    <th>CATEGORY</th>
                                    <th>ACTION</th>



                                </thead>
                                <tbody>



                                    <?php


                                    include_once('db_conn.php');
                                    $sql = "SELECT * FROM table_blog";


                                    //use for MySQLi-OOP
                                    $query = $conn->query($sql);
                                    while ($row = $query->fetch_assoc()) {
                                        echo
                                        "<tr>
        <td>" . $row['id'] . "</td>
        <td>" . $row['title'] . "</td>
        <td>" . $row['date'] . "</td>
        <td class='ontent_td' ><p>" . $row['content'] . "</p>   </td>
        <td>" . $row['img'] . "</td>
        <td>" . $row['category'] . "</td>
        
        
        <td>
            
            <a href='#delete_" . $row['id'] . "' class='buttonz btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
        </td>
    </tr>";
                                        include('deleteBlogModal.php');
                                    }
                                    /////////////////

                                    //use for MySQLi Procedural
                                    // $query = mysqli_query($conn, $sql);
                                    // while($row = mysqli_fetch_assoc($query)){
                                    // 	echo
                                    // 	"<tr>
                                    // 		<td>".$row['id']."</td>
                                    // 		<td>".$row['firstname']."</td>
                                    // 		<td>".$row['lastname']."</td>
                                    // 		<td>".$row['address']."</td>
                                    // 		<td>
                                    // 			<a href='#edit_".$row['id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                                    // 			<a href='#delete_".$row['id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                                    // 		</td>
                                    // 	</tr>";
                                    // 	include('edit_delete_modal.php');
                                    // }
                                    /////////////////

                                    ?>


                                    </tr>


                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>




            </div>
        </div>
        </div>



        </div>






    </body>

    </html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>