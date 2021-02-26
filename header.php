<?php
session_start();
ob_start();
?>
<!doctype html>
<html lang="en">
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="lobibox-master/dist/css/lobibox.min.css"/>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

        <link rel="stylesheet" href="lobibox-master/dist/css/lobibox.min.css"/>
        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 5 -->
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="lobibox-master/dist/js/lobibox.min.js"></script>


        <title>Syllabus Warehouse</title>
        <link rel="icon" href="images/favicon.ico" sizes="16x16" />


    </head>
    <body id="body">
        <?php
        require("notify.php");
        require('database/openops.php');
        ?>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <img src="images/bmiitlogo.png" class="img-fluid" height="30" width="30" />
                        Syllabus Warehouse</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        </ul>
                        <div class="d-flex">
                            <a class="nav-link text-light" href="about.php">About</a>
                            <a class="nav-link text-light" href="contactus.php">Contact Us</a>
                            <a href="http://utu.ac.in/bmiit/" class="btn btn-outline-info border-0">BMIIT</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
