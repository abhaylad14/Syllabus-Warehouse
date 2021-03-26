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
        <div class="container overflow-hidden">
            <div class="row gy-5">
                <div class="col-sm-6 mt-4">
                    <a href="report1.php" class="p-3 border border-primary bg-light btn-block text-center">All configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                    <a href="report2.php" class="p-3 border border-primary bg-light btn-block text-center">Academic year wise configured subjects</a>
                </div>
                <div class="col-sm-6 mt-4">
                    <button class="p-3 border border-primary bg-light btn-block">Semester wise configured subjects</button>
                </div>
                <div class="col-sm-6 mt-4">
                    <button class="p-3 border border-primary bg-light btn-block">Term wise configured subjects</button>
                </div>
                <div class="col-sm-6 mt-4">
                    <button class="p-3 border border-primary bg-light btn-block">Academic year + Semester wise configured subjects</button>
                </div>
                <div class="col-sm-6 mt-4">
                    <button class="p-3 border border-primary bg-light btn-block">Academic year + Term wise configured subjects</button>
                </div>
                <div class="col-sm-6 mt-4">
                    <button class="p-3 border border-primary bg-light btn-block">Batch wise configured subjects</button>
                </div>
                <div class="col-sm-6 mt-4">
                    <button class="p-3 border border-primary bg-light btn-block">Common Subjects for different Programs</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php require("footer.php"); ?>
