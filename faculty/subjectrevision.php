<?php require("header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subject Revision</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Subject Revision</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?php
        $subject = new Subject();
        $result = $subject->viewAssignedSubjectsFacultyWise($_SESSION["userId"]);
        foreach ($result as $row) {
            ?>
            <div class="card col-sm-6 mx-auto">
                <div class="card-body">
                    <table>
                        <tr>
                            <td><strong>Subject: </strong></td>
                            <td><?php echo " " . $row[1]  ?></td>
                        </tr><tr>
                            <td><strong>Status: </strong></td>
                            <td><?php
                                if ($row[5] == 0) {
                                    echo '<span class="badge bg-secondary">Pending</span>';
                                } else if ($row[5] == 1) {
                                    echo '<span class="badge bg-success">Accepted</span>';
                                } else if ($row[5] == 2) {
                                    echo '<span class="badge bg-danger">Rejected</span>';
                                }
                                ?></td>
                        </tr><tr>
                            <td><strong>File: </strong></td>
                            <td id="newfile"><?php
                                if ($row[6] == "") {
                                    echo 'Not Uploaded';
                                } else {
                                    echo "<a href='$row[6]'>View</a>";
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td><strong>Assign Date:</strong></td>
                            <td><?php echo $row[3] ?></td>
                        </tr>
                        <?php
                        if ($row[2] == 1 && $row[5] != 1) {
                            echo "<tr><form method='post' enctype='multipart/form-data'><td><strong>Upload File: <input type='hidden' name='sid' value='$row[1]' /></td>"
                            . "<td><input id='$row[1]' class='sfile' type='file' accept='.doc, .docx' class='form-controlcol-sm-2' name='sfile' required>"
                            . "<input type='submit'class='btn btn-sm btn-outline-primary' name='btnsubmit' value='Submit'></form></td></tr>";
                        } else {
                            if ($row[4] != "") {
                                echo "<tr><td><strong>Verified Date:</strong></td>"
                                . "<td>$row[4]</td></tr>";
                            } else {
                                echo "<tr><td><strong>Verified Date:</strong></td>"
                                . "<td>Not Verified</td></tr>";
                            }
                        }
                        if ($row[7] != "") {
                            echo "<tr><td><strong>Comments:</strong></td>"
                            . "<td>$row[7]</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        <?php } ?>

    </div>
    <!-- /.content -->
    <?php

    function savesfile($sfile, $now) {
        $extension = explode(".", $sfile);
        $extension = $extension[1];
        $sfile = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/";
        $target_file = $target_dir . basename($_FILES["sfile"]["name"]);
        move_uploaded_file($_FILES["sfile"]["tmp_name"], $target_file);
        rename("../syllabusfiles/" . $_FILES["sfile"]["name"], "../syllabusfiles/" . $sfile);
        $sfile = "../syllabusfiles/" . $sfile;
        return $sfile;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["sfile"]) && $_FILES["sfile"]["name"] != "") {
            $sfile = $_FILES["sfile"];
            $id = $_POST["sid"];
            $subject = new Subject();
            $now = new DateTime();
            $sfile = savesfile($sfile["name"], $now);
            $status = $subject->uploadSubjectRevision($id, $sfile);
            if ($status == 1) {
                displaymessage("success", "Uploaded Successfully!", "Revision file has been uploaded successfully!");
                echo "<script>setTimeout(function(){ location.reload(); }, 3000);</script>";
            } else {
                displaymessage("error", "Error!", "Something went wrong!");
                
            }
        } else {
            displaymessage("error", "Empty Form!", "Please select a file to upload!");
        }
    }
    ?>
    <script>
        let element = "";
        $(".sfile").change(function(){
            element = this.parentElement.parentElement.parentElement.children[2].children[1];
            console.log(element);
            
        });
    </script>
    <?php require("footer.php"); ?>