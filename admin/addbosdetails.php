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
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="mname" class="form-label">Meeting Name</label>
                            <input type="text" class="form-control" id="mname" name="mname" maxlength="100" required>
                        </div>
                        <div class="col-md-6">
                            <label for="mvenue" class="form-label">Meeting Venue</label>
                            <input type="text" class="form-control" id="mvenue" name="mvenue" maxlength="100" required>
                        </div>
                    </div>
                    <div class="row mt-2 justify-content-center">
                        <div class="col-md-4">
                            <label for="mdate" class="form-label">Meeting Date</label>
                            <input type="date" class="form-control" id="mdate" name="mdate" required>
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
                    <div class="row mt-3 justify-content-center">
                        <button type="submit" name="btnsubmit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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

    <?php

    function savesfile($sfile, $now) {
        $extension = explode(".", $sfile);
        $extension = $extension[1];
        $sfile = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/bos/agenda/";
        $target_file = $target_dir . basename($_FILES["magenda"]["name"]);
        move_uploaded_file($_FILES["magenda"]["tmp_name"], $target_file);
        rename("../syllabusfiles/bos/agenda/" . $_FILES["magenda"]["name"], "../syllabusfiles/bos/agenda/" . $sfile);
        $sfile = "../syllabusfiles/bos/agenda/" . $sfile;
        return $sfile;
    }

    function saveszip($zipfile, $now) {
        $extension = explode(".", $zipfile);
        $extension = $extension[1];
        $zipfile = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/bos/syllabus/";
        $target_file = $target_dir . basename($_FILES["szip"]["name"]);
        move_uploaded_file($_FILES["szip"]["tmp_name"], $target_file);
        rename("../syllabusfiles/bos/syllabus/" . $_FILES["szip"]["name"], "../syllabusfiles/bos/syllabus/" . $zipfile);
        $zipfile = "../syllabusfiles/bos/syllabus/" . $zipfile;
        return $zipfile;
    }

    function saveteszip($zipfile, $now) {
        $extension = explode(".", $zipfile);
        $extension = $extension[1];
        $zipfile = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/bos/tes/";
        $target_file = $target_dir . basename($_FILES["teszip"]["name"]);
        move_uploaded_file($_FILES["teszip"]["tmp_name"], $target_file);
        rename("../syllabusfiles/bos/tes/" . $_FILES["teszip"]["name"], "../syllabusfiles/bos/tes/" . $zipfile);
        $zipfile = "../syllabusfiles/bos/tes/" . $zipfile;
        return $zipfile;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["btnsubmit"])) {
            if (isset($_POST["mname"]) && !empty($_POST["mname"]) && isset($_POST["mvenue"]) && !empty($_POST["mvenue"]) && isset($_POST["mdate"]) && !empty($_POST["mdate"])) {
                $mname = trim($_POST["mname"]);
                $mvenue = trim($_POST["mvenue"]);
                $mdate = trim($_POST["mdate"]);

                $magenda = $_FILES["magenda"];
                $szip = $_FILES["szip"];
                $teszip = $_FILES["teszip"];

                $admin = new Subject();
                $now = new DateTime();

                if ($magenda["name"] != "") {
                    $magenda = savesfile($magenda["name"], $now);
                } else {
                    $magenda = "";
                }
                if ($szip["name"] != "") {
                    $szip = saveszip($szip["name"], $now);
                } else {
                    $szip = "";
                }
                if ($teszip["name"] != "") {
                    $teszip = saveszip($teszip["name"], $now);
                } else {
                    $teszip = "";
                }
                $status = $admin->addBOS($mname, $mvenue, $mdate, $magenda, $szip, $teszip);
                if($status == 1){
                    displaymessage("success", "BOS details Added!", "BOS details has been added successfully!");
                }else{
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            } else {
                displaymessage("error", "Empty Form!", "Please fill the required details!");
            }
        } else {
            displaymessage("error", "Invalid Request!", "");
        }
    }
    ?>
    <?php require './footer.php'; ?>