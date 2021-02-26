<?php
require("header.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Faculty</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Faculty</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card col-sm-7 mx-auto">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mt-2">
                        <div class="col-sm-6 mx-auto text-center">
                            <div class="text-center">
                                <img class="img-fluid" height="100" width="100" id="pp" src="../images/userdefault.png" >
                            </div>
                            <label for="profile" class="form-label mt-2">Profile Picture</label>
                            <input type="file" class="form-control" id="profile" value="" name="profile" >
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Full name</label>
                            <input type="text" class="form-control" maxlength="30" pattern="^[ A-Za-z]+$" id="name" name="name" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col-sm-6">
                            <label for="cnum" class="form-label">Contact No</label>
                            <input type="text" class="form-control" id="cnum" name="cnum" pattern="^[6789][0-9]{9}$" maxlength="10">
                        </div>
                        <div class="col-sm-6 mt-2">
                            <br>
                            <label>Gender: </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div>
                        <div class="col mt-4 text-center">
                            <button class="col-sm-2 btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php require("footer.php"); ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["name"]) && !empty($_POST["name"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["gender"]) && !empty($_POST["gender"])) {
            $name = trim($_POST["name"]);
            $profile = $_FILES["profile"]["name"];
            $email = trim($_POST["email"]);
            $cnum = trim($_POST["cnum"]);
            $gender = $_POST["gender"];
//            echo "<script>Lobibox.notify('success',{title: 'Success',msg: 'User added successfully!', sound: false, delay: '2000',icon: true, iconSource: 'fontAwesome'});</script>";
            //validation flags
            $flagname = 0;
            $flagprofile = 0;
            $flagemail = 0;
            $flagcnum = 0;
            $flagpass = 0;
            $errstmt = "";

            // Full name validations
            $patname = "/^[a-zA-Z\s]+$/";
            if (preg_match($patname, $name)) {
                $flagname = 1;
            } else {
                $errstmt = $errstmt . "Full name is not valid";
            }

            //email validations
            $patemail = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
            if (preg_match($patemail, $email)) {
                $flagemail = 1;
            } else {
                $errstmt = $errstmt . "Email ID is not valid";
            }

            //Contact number validations
            if (!empty($cnum)) {
                $patcnum = "/^[6-9][0-9]{9}$/";
                if (preg_match($patcnum, $cnum)) {
                    $flagcnum = 1;
                } else {
                    $errstmt = $errstmt . "Contact number is not valid";
                }
            } else {
                $flagcnum = 1;
            }

            $profile = "";
            // profile picture validations
            if ($_FILES["profile"]["name"] != "") {
                $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
                $filename = $_FILES["profile"]["name"];
                $now = new DateTime();
                $extension = explode(".", $filename);
                $extension = $extension[1];
                if ((($_FILES["profile"]["type"] == "image/jpeg") || ($_FILES["profile"]["type"] == "image/jpg") || ($_FILES["profile"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
                    if ($_FILES["profile"]["size"] < 200000) {
                        $profile = $now->getTimestamp() . "." . $extension;
                        $flagprofile = 1;
                    } else {
                        $errstmt = $errstmt . "Image size should be less than 2 MB";
                    }
                } else {
                    $errstmt = $errstmt . "Only jpg,jpeg and png image files are allowed";
                }
            } else {
                $profile = "../images/userdefault.png";
                $flagprofile = 2;
            }

            // password generator

            $pass = rand(10000000, 99999999);
            $to = $email;
            $subject = "Login credentials";
            $message = "Respected Sir/Ma'am, <br>"
                    . "<b>Username: </b> $email <br>"
                    . "<b>Password: </b> $pass <br>";
            $genderval = "";
            if ($gender == "male") {
                $genderval = "m";
            } else {
                $genderval = "f";
            }

            //database insertion
            if ($flagname == 1 && $flagemail == 1 && $flagcnum == 1 && $flagprofile != 0) {
                if ($flagprofile == 1) {
                    $target_dir = "../images/profile/";
                    $target_file = $target_dir . basename($_FILES["profile"]["name"]);
                    move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file);
                    rename("../images/profile/" . $_FILES["profile"]["name"], "../images/profile/" . $profile);
                    $profile = "../images/profile/" . $profile;
                }
                $adminops = new User();
                require("../database/openops.php");
                try {
                    $status = $adminops->addUser($email, $pass, $name, $cnum, $gender, $profile);
                    if ($status == 1) {
//                        $x = $mail->send();
                        $x = sendEmail($email, $subject, $message);
                        if ($x) {
                            displaymessage("success", "Email Sent!", "The password has been sent via email");
                        } else {
                            echo "<script>alert('The password for the $email is $pass');<script>";
                        }
                        displaymessage("success", "Success", "User added successfully!");
                    } else {
//                        echo "<script>Lobibox.notify('error',{title: 'Error',msg: 'Something went wrong!',sound: false,delay: '2000',icon: true, iconSource: 'fontAwesome'});</script>";
                    }
                } catch (Exception $ex) {
                    displaymessage("error", "Something went wrong!", "Please try again later!");
                }
            } else {
                displaymessage("error", "Error", $errstmt);
            }
        } else {
            // if form is empty
            displaymessage("error", "Empty Form!", "Please fill the required details!");
        }
    }
    ?>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pp').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#profile").change(function () {
            readURL(this);
        });
    </script>