<?php require './header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add BOS Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add BOS Details</li>
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
                <div class="row">
                    <div class="col-md-6">
                        <label for="mname" class="form-label">Meeting Name</label>
                        <input type="text" class="form-control" id="mname" name="mname" maxlength="100">
                    </div>
                    <div class="col-md-6">
                        <label for="mvenue" class="form-label">Meeting Venue</label>
                        <input type="text" class="form-control" id="mvenue" name="mvenue" maxlength="100">
                    </div>
                </div>
                <div class="row mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label for="mdate" class="form-label">Meeting Date</label>
                        <input type="date" class="form-control" id="mdate" name="mdate">
                    </div>
                    <div class="col-md-4">
                        <label for="magenda" class="form-label">Meeting Agenda</label>
                        <input type="file" class="form-control" id="magenda" name="magenda" accept=".doc, .docx">
                    </div>
                </div>
                <div class="row mt-2 justify-content-center">
                    <div class="col-md-4">
                        <label for="szip" class="form-label">Syllabus Zip</label>
                        <input type="file" class="form-control" id="szip" name="szip" accept=".zip, .rar">
                    </div>
                    <div class="col-md-4">
                        <label for="teszip" class="form-label">TES Zip</label>
                        <input type="file" class="form-control" id="teszip" name="teszip" accept=".zip, .rar" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $('#magenda').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "docx" || ext == "doc" || ext == "DOCX" || ext == "DOC") {
                //no comments
            } else {
                alert("Please upload a document file only");
                $('#magenda').val("");
            }
        });
        $('#szip').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "zip" || ext == "rar") {
                //no comments
            } else {
                alert("Please upload a ZIP file only");
                $('#szip').val("");
            }
        });
        $('#teszip').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "zip" || ext == "rar") {
                //no comments
            } else {
                alert("Please upload a ZIP file only");
                $('#teszip').val("");
            }
        });
        
    </script>
    <!-- /.content -->
