<?php require './header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Announcement</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Create Announcement</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card col-sm-6 mx-auto">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" maxlength="100" placeholder="Enter title here" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" maxlength="1000" rows="3" required></textarea>
                    </div>
                    <div class="mb-3 form-row">
                        <label for="attachment" class="form-label col-sm-3">Attachment</label>
                        <input type="file" id="attachment" name="attachment" accept=".doc, .docx, .pdf, .zip, .rar, xlsx" class="form-control col-sm-6" />
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-primary" id="btnsubmit" name="btnsubmit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <script>
        $('#attachment').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "docx" || ext == "doc" || ext == "DOCX" || ext == "DOC" || ext == "pdf" || ext == "PDF" || ext == "zip" || ext == "rar" || ext == "xlsx") {
                //no comments
            } else {
                alert("Please upload a doc, excel, pdf or zip file only");
                $('#attachment').val("");
            }
        });
    </script>

    <?php

    function savefile($filename, $now) {
        $extension = explode(".", $filename);
        $extension = $extension[1];
        $filename = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/announcements/";
        $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
        move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);
        rename("../syllabusfiles/announcements/" . $_FILES["attachment"]["name"], "../syllabusfiles/announcements/" . $filename);
        $filename = "../syllabusfiles/announcements/" . $filename;
        return $filename;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["btnsubmit"])) {
            if (isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["message"]) && !empty($_POST["message"])) {
                $title = trim($_POST["title"]);
                $message = trim($_POST["message"]);
                $admin = new User();
                $now = new DateTime();
                if ($_FILES["attachment"]["name"] != "") {
                    $attachment = savefile($_FILES["attachment"]["name"], $now);
                } else {
                    $attachment = "";
                }
                $status = $admin->createAnnouncement($_SESSION["userId"], $title, $message, $attachment);
                if($status == 1){
                    displaymessage("success", "Announcement Created!", "The announcement has been created successfully!");
                }
                else{
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            } else {
                displaymessage("error", "Empty Form!", "PLease fill the required details!");
            }
        } else {
            displaymessage("error", "Invalid Request!", "");
        }
    }
    ?>
    <?php require './footer.php'; ?>