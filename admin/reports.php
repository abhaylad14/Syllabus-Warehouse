<?php require "header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container col-sm-8 overflow-hidden">
            <div class="row gy-5">
                <div class="col-sm-6 mt-4">
                    <a href="report1.php" class="p-3 border border-primary bg-light btn-block text-center">All configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                    <a href="report2.php" class="p-3 border border-primary bg-light btn-block text-center">Academic year wise configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                    <a href="report3.php" class="p-3 border border-primary bg-light btn-block text-center">Semester wise configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                    <a href="report4.php" class="p-3 border border-primary bg-light btn-block text-center">Term wise configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                    <a href="report5.php" class="p-3 border border-primary bg-light btn-block text-center">Academic year + Semester wise configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                    <a href="report6.php" class="p-3 border border-primary bg-light btn-block text-center">Academic year + Term wise configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                    <a href="report7.php" class="p-3 border border-primary bg-light btn-block text-center">Batch wise configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                     <a href="report8.php" class="p-3 border border-primary bg-light btn-block text-center">Common Subjects for different Programs</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php require("footer.php"); ?>
