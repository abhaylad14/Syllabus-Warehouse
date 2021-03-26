<?php require("header.php");
 require '../database/openops.php';
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
                    <h1 class="m-0">Add Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Student</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card col-sm-8 mx-auto">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row col-sm-10 mx-auto">
                        <label for="data" class="col-sm-3">Upload via CSV: </label>
                        <input class="form-control col-sm-6" type="file" name="data" id="data" required />
                        <input type="submit" value="Submit"  name="submitcsv" class="btn btn-primary ml-2 col-sm-2" >
                        <i id="info" class="fas fa-info-circle mt-2 ml-4 text-info"></i>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-sm-8 mx-auto">
            <div class="card-body">
                <h4 class="text-center">Student Details</h4>
                <hr/>
                <form method="post">
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="enro" class="form-label">Enrollment Number:</label>
                            <input type="text" maxlength="15"  class="form-control" name="enro" id="enro">
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="col text-center">
                            <br>
                            <input type="submit" value="Submit"  name="submit" class="btn btn-primary" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submitcsv"])) {
            if (isset($_FILES["data"])) {
                $filename = $_FILES["data"]["name"];
                if ('application/vnd.ms-excel' == $_FILES["data"]['type']) {
                    $admin = new Student();
                    $status = $admin->addStudents($_FILES["data"]);
                    if ($status == 1) {
                        displaymessage("success", "Students Added", "All students have been registered successfully");
                    } else if ($status == 2) {
                        displaymessage("error", "Duplicate Entry!", "Students already exists!");
                    } else {
                        displaymessage("error", "Error!", "Somthing went wrong!");
                    }
                } else {
                    displaymessage("error", "Invalid file type!", "Only CSV(Excel) file is allowed!");
                }
            }
        } else if (isset($_POST["submit"])) {
            if (!empty($_POST["enro"]) && isset($_POST["enro"]) && !empty($_POST["name"]) && isset($_POST["name"]) && !empty($_POST["email"]) && isset($_POST["email"])) {
                $enro = trim($_POST["enro"]);
                $name = trim($_POST["name"]);
                $email = trim($_POST["email"]);
                $admin = new Student();
                $status = $admin->addSingleStudent($enro, $name, $email);
                if ($status == 1) {
                    displaymessage("success", "Student Added!", "Student has been added successfully!");
                }else if ($status == 2) {
                    displaymessage("error", "Duplicate Entry!", "Student has been already added!");
                }  
                else if ($status == 3) {
                    displaymessage("error", "Cannot send Email!", "Password is not sent via Email!");
                }  
                else {
                    displaymessage("error", "Error!", "Somthing went wrong!");
                }
            } else {
                displaymessage("error", "Empty Form!", "Please fill the required details!");
            }
        }
    }
    ?>
    <!-- /.content -->
    <div class="modal fade" id="infomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CSV Format</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img <script src="../images/democsv.PNG" class="img-responsive" width="450" />
                </div>
            </div>
        </div>
    </div>
    <script>
    $("#info").click(function (){
       $('#infomodal').modal('toggle');
    });
    </script>
    <?php require 'footer.php'; ?>