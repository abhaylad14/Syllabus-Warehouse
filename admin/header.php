<?php
session_start();
if(!$_SESSION["userId"] || $_SESSION["userType"] != 1){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin</title>
        <link rel="icon" href="../images/favicon.ico" sizes="16x16">
        <?php require_once("../notify.php");
        require_once("../database/adminops.php");   
        ?> 
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
        
        <link rel="stylesheet" href="../lobibox-master/dist/css/lobibox.min.css"/>
        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 5 -->
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <script src="../lobibox-master/dist/js/lobibox.min.js"></script>
        <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    </head>
    <body class="hold-transition sidebar-mini sidebar-collapse">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-info navbar-dark border-0">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="dashboard.php" class="nav-link">Home</a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"> Logout</i></a></li>
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"> Profile </i></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="" class="brand-link">
                    <img src="../images/bmiitlogo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                    <span class="brand-text font-weight-light">Syllabus Warehouse</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                          <!--<img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
                            <i class="fas fa-user-circle fa-2x img-circle elevation-2 text-light"></i>
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"> Admin</a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
<!--                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Starter Pages
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Active Page</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Inactive Page</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
                            <li class="nav-item">
                                <a href="addfaculty.php" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Add Faculty
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="managefaculty.php" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Manage Faculty
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="deletedfaculty.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-shield"></i>
                                    <p>
                                        Deleted Faculty
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="addstudent.php" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Add Student
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="addsubject.php" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Add Subject
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="managesubject.php" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Manage Subject
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="configuresyllabus.php" class="nav-link">
                                    <i class="nav-icon fas fa-book-reader"></i>
                                    <p>
                                        Configure Syllabus
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../underconstruction.php" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Syllabus Revision
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../underconstruction.php" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Generate Reports
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../underconstruction.php" class="nav-link">
                                    <i class="nav-icon fas fa-file-excel"></i>
                                    <p>
                                        Generate TES
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

