<?php require("header.php"); ?>
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
                            <input type="text" maxlength="15"  class="form-control" id="enro">
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email">
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
//                echo $_FILES["data"]["type"];
                if ('application/vnd.ms-excel' == $_FILES["data"]['type'] ) {
                    $admin = new Student();
                    $status = $admin->addStudents($_FILES["data"]);
                    if ($status == 1) {
                        displaymessage("success", "Students Added", "All students have been registered successfully");
                    } else {
                        displaymessage("error", "Error!", "Somthing went wrong!");
                    }
                } else {
                    displaymessage("error", "Invalid file type!", "Only CSV(Excel) file is allowed!");
                }
            }
        } else if (isset($_POST["submit"])) {
            
        }
    }
    ?>
    <!-- /.content -->