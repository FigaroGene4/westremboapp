

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
            <br><br><br>
            <a href="client.php ">Client</a>
            <a href="artist.php">Artist</a>
            <a href="booking.php">Booking</a>
            <a href="service.php">Services</a>
            <a href="report.php">Report</a>
            <a href="Blog.php">Blog</a>
        </div><br><br><br><br>

        <div class="main">
            <div class="container ">

            <div id="sample">
  <script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script> 
  <script type="text/javascript">
 
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  </script>
                    
                    

                <h1>Create a post</h1><br>

                <form action="#" method="post" enctype="multipart/form-data">


                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="Blog title here">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select category</label>
                            <select class="form-control" name="category" id="exampleFormControlSelect1">
                                <option>Hair</option>
                                <option>Skin</option>
                                <option>Body</option>
                                <option>Makeup</option>
                                <option>Nails</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Example textarea</label>
                            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="field-image">

                            <label for="exampleFormControlFile1">Upload header image</label>
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>



                        </div><br><br>

                        <button type="submit" name="submit" class="btn btn-primary">Post Blog</button>
                    </form>




                </form>
                <?php
include("db_conn.php");
if (isset($_POST['submit'])){
if (isset($_FILES['image'])){
    $title =mysqli_real_escape_string($conn, $_POST['title']);
    $content  =mysqli_real_escape_string($conn, $_POST['content']);
    $date = date("Y-m-d");
    $category =  mysqli_real_escape_string($conn, $_POST['category']);

    $img_name = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $img_explode = explode('.', $img_name);
    $img_ext = end($img_explode);

    $extensions = ["jpeg", "png", "jpg"];

    $types = ["image/jpeg", "image/jpg", "image/png"];

    $time = time();
    $new_img_name = $time . $img_name;
    move_uploaded_file($tmp_name, "../admin/blogimage/" . $new_img_name);

    $sql = "INSERT INTO table_blog (title, date, content, img, category)
    VALUES ('$title', '$date','$content', '{$new_img_name}', '$category')";
    $conn->query($sql);

   



    $_SESSION['success'] = 'Blog posted successfully';
}
}



?>

<br>
                <h1> <?php if (isset($_SESSION['success'])) {
            echo
            "
            <div class='alert alert-success text-center'>
               
                " . $_SESSION['success'] . "
                
            </div>
            ";
            unset($_SESSION['success']);
        } ?> </h1>
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




