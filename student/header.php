<?php
session_start();
if (!$_SESSION["userId"] || $_SESSION["userType"] != 4) {
    header("Location: ../index.php");
}
include_once("../database/openops.php");
$data = getStudentData($_SESSION["userId"]);
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- Bootstrap CSS -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="../bootstrap/js/bootstrap.bundle.min.js" ></script>
        <link rel="icon" href="../images/favicon.ico" sizes="16x16">

        <title>Student</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">

                    <a class="navbar-brand" href="#">
                        <img src="../images/bmiitlogo.png" class="img-fluid" height="30" width="30" />
                        Syllabus Warehouse</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ml-4">

                        </ul>
                        <span class="d-flex">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user text-light"> <?php echo $data[4]; ?></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"> Logout</i></a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"> Profile</i></a></li>
                                    </ul>
                                </li>

                        </span>
                    </div>
                </div>
            </nav>
        </header>
