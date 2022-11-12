<?php
session_start();
require "connection.php";
$email = "";
$firstname = "";
$lastname = "";
$contactnumber;
$address = "";
$errors = array();
$city = "";
$baranggay = "";
$addressDetails = "";

//if user signup button
if (isset($_POST['signup'])) {
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contactnumber = mysqli_real_escape_string($con, $_POST['contactnumber']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $addressDetails = mysqli_real_escape_string($con, $_POST['addressDetails']);
    $postalCode = mysqli_real_escape_string($con, $_POST['postalCode']);
    $baranggay = mysqli_real_escape_string($con, $_POST['baranggay']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

   //contactnumber validation structure

   if(preg_match("/^[0-9]{11}$/", $contactnumber)) {
    // $phone is valid
  }

  else{
    $errors['contactwrong'] = 'Contact number is invalid';

  }

  //validate email
  // Include library file



  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo("$email is a valid email address");
  } else {
    $errors['emailinvalid'] = 'Email is invalid';;
  }


    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if (!$uppercase || !$lowercase || !$number  || strlen($cpassword) < 8) {
        $errors['passwordnotstrong'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number';
    }
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }

    
  




    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM table_customer WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered already exist!";
    }


   

    $number_check = "SELECT * FROM table_customer WHERE contactnumber = '$contactnumber'";
    $res1 = mysqli_query($con, $number_check);
    if (mysqli_num_rows($res1) > 0) {
        $errors['number'] = "Contact Number that you have entered already exist!";
    }
    if (count($errors) === 0) {


        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if (in_array($img_ext, $extensions) === true) {
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if (in_array($img_type, $types) === true) {
                $time = time();
                $new_img_name = $time . $img_name;
                date_default_timezone_set('Asia/Taipei');

                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $code = rand(999999, 111111);
                $status = "notverified";
                $dateJoined = date('Y-m-d');
                $insert_data = "INSERT INTO table_customer (firstname, lastname, email, contactnumber,city, addressDetails, baranggay, postalCode, password, code, status, img, dateJoined)
                values('$firstname','$lastname', '$email', '$contactnumber', '$city', '$addressDetails', '$baranggay', '$postalCode','$encpass', '$code', '$status', '{$new_img_name}', '$dateJoined')";



                $ran_id = rand(time(), 100000000);
                $status1 = "Active now";
                $hostname1 = "localhost";
                $username1 = "root";
                $password1 = "";
                $dbname1 = "db_spa2go";


                if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                    $ran_id = rand(time(), 100000000);
                    $status1 = "Active now";
                    $hostname1 = "localhost";
                    $username1 = "root";
                    $password1 = "";
                    $dbname1 = "db_spa2go";

                    echo $firstname;

                    $conn = mysqli_connect($hostname1, $username1, $password1, $dbname1);
                    $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                            VALUES ({$ran_id}, '{$firstname}','{$lastname}', '{$email}', '{$encpass}', '{$new_img_name}', '{$status1}')");
                    if ($insert_query) {
                        $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        if (mysqli_num_rows($select_sql2) > 0) {
                            $result = mysqli_fetch_assoc($select_sql2);
                            $_SESSION['unique_id'] = $result['unique_id'];
                            echo "success";
                        } else {
                            echo "This email address not Exist!";
                        }
                    } else {
                        echo "Something went wrong. Please try again!";
                    }
                }
            } else {
                echo "Please upload an image file - jpeg, png, jpg";
            }
        } else {
            echo "Please upload an image file - jpeg, png, jpg";
        }

        $data_check = mysqli_query($con, $insert_data);

        if ($data_check) {
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: spa2go.ph@gmail.com";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['emailArtist'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}
//if user click verification code submit button
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM table_customer WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE table_customer SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['firstname'] = $firstname;
            $_SESSION['email'] = $email;
            $_SESSION['emailClient'] = $email;
            header('location: ../Client/index.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

//if user click login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $check_email = "SELECT * FROM table_customer WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;
            $status = $fetch['status'];
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                $_SESSION['emailClient'] = $email;
                $_SESSION['password'] = $password;

                header('location: ../Client/index.php');
            } else {
                $info = "It's look like you haven't still verify your email - $email";
                $_SESSION['info'] = $info;

                header('location: user-otp.php');
            }
        } else {
            $errors['email'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
    }
}

//if user click continue button in forgot password form
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM table_customer WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE table_customer SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From: spa2go.ph@gmail.com";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a passwrod reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

//if user click check reset otp button
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM table_customer WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

//if user click change password button
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE table_customer SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

//if login now button click
if (isset($_POST['login-now'])) {
    header('Location: login-user.php');
}
