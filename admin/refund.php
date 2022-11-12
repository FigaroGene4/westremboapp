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

                .content_td p {
                    max-width: 100%;
                    max-height: 100px;
                    overflow-y: scroll;
                    text-overflow: ellipsis;
                }

                .nav-tabs {
                    width: 80%;
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

        <br><br><br><br><br>
        <div class="main">


            <div class="container-fluid ">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="refund.php">Refund Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="refunded.php">Accepted Refunds</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="declinedBookingRefund.php">Declined Booking Refund</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="refunddeclinebookings.php">Refund Declined Bookings</a>
                    </li>

                </ul>
                <div class="row">
                    <div class="col-12">




                    </div>


                    <div class="col-10">
                        <div class="height10">


                            <table id="myTable" class="table text-center table-striped">
                                <thead class="thead-dark">

                                    <th>Customer Name</th>
                                    <th>Artist Name</th>
                                    <th>GCASH Reference Number</th>
                                    <th>Contact Number</th>
                                    <th>Tracking Number </th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Complaint</th>
                                    <th>Reason</th>
                                    <th>Proof</th>

                                    <th>Action</th>


                                </thead>
                                <tbody>



                                    <?php


                                    include_once('db_conn.php');


                                    $sql = "SELECT * FROM table_book WHERE newStatus = 'Refund Request' ";



                                    //use for MySQLi-OOP
                                    $query = $conn->query($sql);
                                    while ($row = $query->fetch_assoc()) {
                                        $status = $row['status'];




                                        $ddate = $row['datebooking'];
                                        $newDate = date("F d, Y", strtotime($ddate));
                                        echo
                                        "<tr>
                        
                            <td>" . $row['clientFirstName'] . ' ' . $row['clientLastName'] . "</td>
                            <td>" . $row['artistFirstName'] . ' ' . $row['artistLastName'] . "</td>
                            <td>" . $row['referenceNumber'] . "  </td>
                            <td>" . $row['clientContactNumber'] . "  </td>
                            <td>" . $row['transactionNumber'] . "</td>
                            <td>₱" . $row['price'] . "</td>
                            <td>" . $newDate . "</td>
                            <td>" . $row['categoryRefund'] . "</td>
                            <td>" . $row['refundComplaint'] . "</td>
                            <td> <img src='../Client/images/".$row['imageRefund']."'width='600px' >"."</td>";


                                        $_SESSION_['id'] = $row['id'];
                                        $_SESSION['transactionNumber'] = $row['transactionNumber'];
                                        if ($status == 'Refunded') {
                                            echo "   <td>
                                <a href='#edit_" . $row['id'] . "' class='btn btn-info btn-sm disabled' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Accept</a>
                                <a href='#delete_" . $row['id'] . "' class='btn btn-danger btn-sm disabled' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Decline</a>
                            </td>
    </tr>";
                                        } else {
                                            echo "   <td>
                        <a href='#edit_" . $row['id'] . "' class='btn btn-info btn-sm  ' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Accept</a>
                        <a href='#delete_" . $row['id'] . "' class='btn btn-danger btn-sm buttonz' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Decline</a>
                    </td>
</tr>";
                                        }
                                        include('refundModal.php');
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
                            <?php
                            if (isset($_SESSION['error'])) {
                                echo
                                "
                  <div class='alert alert-danger text-center'>
                      
                      " . $_SESSION['error'] . "
                  </div>
                  ";
                                unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo
                                "
                  <div class='alert alert-success text-center'>
                      
                      " . $_SESSION['success'] . "
                  </div>
                  ";
                                unset($_SESSION['success']);
                            }
                            ?>
                        </div>

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