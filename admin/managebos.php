<?php require("header.php"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage BOS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Manage BOS</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->

    <div class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive-sm">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Meeting Name</th>
                            <th scope="col">Meeting Venue</th>
                            <th scope="col">Date</th>
                            <th scope="col">Agenda</th>
                            <th scope="col">Minutes</th>
                            <th scope="col">Syllabus Zip</th>
                            <th scope="col">TES Zip</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin = new Subject();
                        $result = $admin->viewBOSdetails();
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <th scope="row">#</th>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><?php
                                    if ($row[4] != "") {
                                        echo "<a href='$row[4]'>View </a>"
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-sfile'></button>";
                                    } else {
                                        echo "Not Uploaded "
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-sfile'></button>";
                                    }
                                    ?></td>
                                <td><?php
                                    if ($row[5] != "") {
                                        echo "<a href='$row[5]'>View </a>"
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-minutes'></button>";
                                    } else {
                                        echo "Not Uploaded "
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-minutes'></button>";
                                    }
                                    ?></td>
                                <td><?php
                                    if ($row[6] != "") {
                                        echo "<a href='$row[6]'>View </a>"
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-szip'></button>";
                                    } else {
                                        echo "Not Uploaded "
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-szip'></button>";
                                    }
                                    ?></td>
                                <td><?php
                                    if ($row[7] != "") {
                                        echo "<a href='$row[7]'>View </a>"
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-teszip'></button>";
                                    } else {
                                        echo "Not Uploaded "
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-teszip'></button>";
                                    }
                                    ?></td>
                                <td>
                                    <button id='<?php echo $row[0]; ?>' class='btn btn-outline-success btn-sm fas fa-eye border-0 btn-view'></button>
                                    <button id="<?php echo $row[0]; ?>" class='btn btn-outline-warning btn-sm fas fa-edit border-0 btn-edit'></button>
                                    <button id="<?php echo $row[0]; ?>" class='btn btn-outline-danger btn-sm fas fa-trash-alt border-0 btn-delete'></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this Meeting details?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="ajaxdelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit here</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="mname" class="form-label">Meeting Name</label>
                        <input type="text" class="form-control" id="mname" placeholder="Enter meeting name">
                    </div>
                    <div class="mb-3">
                        <label for="mvenue" class="form-label">Meeting Venue</label>
                        <input type="text" class="form-control" id="mvenue" placeholder="Enter meeting venue">
                    </div>
                    <div class="mb-3">
                        <label for="mdate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="mdate" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="ajaxupdate">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Minutes Modal -->
    <div class="modal fade" id="updateminutesfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id4" id="id4" value='' >
                        <input type="file" class="form-control" id="minutes" name="minutes" required accept=".docx, .doc, .pdf"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="btnupdateminutes" class="btn btn-success" >Update Minutes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <!-- Update Agenda Modal -->
    <div class="modal fade" id="updatesfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id1" id="id1" value='' >
                        <input type="file" class="form-control" id="magenda" name="magenda" required accept=".docx, .doc, .pdf"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="btnsavesfile" class="btn btn-success" >Update Agenda</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <!-- Update Syllabus Zip Modal -->
    <div class="modal fade" id="updateszip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id2" id="id2" value='' >
                        <input type="file" class="form-control" id="szip" name="szip" required accept=".zip, .rar"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="btnsaveszip" class="btn btn-success" >Update Zip</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <!-- Update Syllabus Zip Modal -->
    <div class="modal fade" id="updateteszip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id3" id="id3" value='' >
                        <input type="file" class="form-control" id="teszip" name="teszip" required accept=".zip, .rar"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="btnsaveteszip" class="btn btn-success" >Update Zip</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <!-- View Modal -->
    <div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="data">

                </div>
            </div>
        </div>
    </div>
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
    function saveminutes($mfile, $now) {
        $extension = explode(".", $mfile);
        $extension = $extension[1];
        $mfile = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/bos/minutes/";
        $target_file = $target_dir . basename($_FILES["minutes"]["name"]);
        move_uploaded_file($_FILES["minutes"]["tmp_name"], $target_file);
        rename("../syllabusfiles/bos/minutes/" . $_FILES["minutes"]["name"], "../syllabusfiles/bos/minutes/" . $mfile);
        $mfile = "../syllabusfiles/bos/minutes/" . $mfile;
        return $mfile;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["btnsavesfile"])) {
            if ($_FILES["magenda"]["name"] != "" && isset($_FILES["magenda"]) && !empty($_POST["id1"])) {
                $id = $_POST["id1"];
                $magenda = $_FILES["magenda"];
                $admin = new Subject();
                $now = new DateTime();
                $magenda = savesfile($magenda["name"], $now);
                $status = $admin->updateBOSagenda($id, $magenda);
                if ($status == 1) {
                    displaymessage("success", "Agenda Updated!", "New agenda file has been uploaded successfully!");
                    echo "<script>setTimeout(function(){ location.reload(); }, 3000);</script>";
                } else {
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            } else {
                displaymessage("error", "Empty Form!", "Please upload a file!");
            }
        } else if (isset($_POST["btnsaveszip"])) {
            if ($_FILES["szip"]["name"] != "" && isset($_FILES["szip"]) && !empty($_POST["id2"])) {
                $id = $_POST["id2"];
                $szip = $_FILES["szip"];
                $admin = new Subject();
                $now = new DateTime();
                $szip = saveszip($szip["name"], $now);
                $status = $admin->updateBOSszip($id, $szip);
                if ($status == 1) {
                    displaymessage("success", "Syllabus zip Uploaded!", "New Syllabus zip file has been uploaded successfully!");
                    echo "<script>setTimeout(function(){ location.reload(); }, 3000);</script>";
                } else {
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            } else {
                displaymessage("error", "Empty Form!", "Please upload a file!");
            }
        } else if (isset($_POST["btnsaveteszip"])) {
            if ($_FILES["teszip"]["name"] != "" && isset($_FILES["teszip"]) && !empty($_POST["id3"])) {
                $id = $_POST["id3"];
                $teszip = $_FILES["teszip"];
                $admin = new Subject();
                $now = new DateTime();
                $teszip = saveteszip($teszip["name"], $now);
                $status = $admin->updateBOSteszip($id, $teszip);
                if ($status == 1) {
                    displaymessage("success", "TES zip Uploaded!", "New TES zip file has been uploaded successfully!");
                    echo "<script>setTimeout(function(){ location.reload(); }, 3000);</script>";
                } else {
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            } else {
                displaymessage("error", "Empty Form!", "Please upload a file!");
            }
        }
        else if (isset($_POST["btnupdateminutes"])) {
            if ($_FILES["minutes"]["name"] != "" && isset($_FILES["minutes"]) && !empty($_POST["id4"])) {
                $id = $_POST["id4"];
                $minutes = $_FILES["minutes"];
                $admin = new Subject();
                $now = new DateTime();
                $minutes = saveminutes($minutes["name"], $now);
                $status = $admin->updateBOSminutes($id, $minutes);
                if ($status == 1) {
                    displaymessage("success", "Minutes updated!", "New minutes file has been uploaded successfully!");
                    echo "<script>setTimeout(function(){ location.reload(); }, 3000);</script>";
                } else {
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            } else {
                displaymessage("error", "Empty Form!", "Please upload a file!");
            }
        }
    }
    ?>
    <script>
        let id = "";
        let block = "";
        $(".btn-edit").click(function () {
            id = this.id;
            $('#editmodal').modal('toggle');
            block = this.parentElement.parentElement;
            $("#mname").val(block.children[1].innerText);
            $("#mvenue").val(block.children[2].innerText);
            $("#mdate").val(block.children[3].innerText);
        });
        $("#ajaxupdate").click(function () {
            let mname = $("#mname").val();
            let mvenue = $("#mvenue").val();
            let mdate = $("#mdate").val();
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "updateBOS",
                    name: mname,
                    venue: mvenue,
                    date: mdate
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "BOS updated successfully!");
                        block.children[1].innerText = mname;
                        block.children[2].innerText = mvenue;
                        block.children[3].innerText = mdate;
                    } else if (result == "empty") {
                        displaymessage("error", "Empty Form!", "Please fill the form!");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $(".btn-delete").click(function () {
            id = this.id;
            $('#deletemodal').modal('toggle');
            block = this.parentElement.parentElement;
        });
        $("#ajaxdelete").click(function () {
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "deleteBOS"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "BOS details deleted successfully!");
                        block.remove();
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $(".btn-sfile").click(function () {
            id = this.id;
            $("#id1").val(id);
            $('#updatesfile').modal('toggle');
        });
        $(".btn-minutes").click(function () {
            id = this.id;
            $("#id4").val(id);
            $('#updateminutesfile').modal('toggle');
        });
        $(".btn-szip").click(function () {
            id = this.id;
            $("#id2").val(id);
            $('#updateszip').modal('toggle');
        });
        $(".btn-teszip").click(function () {
            id = this.id;
            $("#id3").val(id);
            $('#updateteszip').modal('toggle');
        });
        $(document).ready(function () {
            $('.table').DataTable();
        });
        $('#minutes').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "docx" || ext == "doc" || ext == "DOCX" || ext == "DOC" || ext == "PDF" || ext == "pdf") {
                //no comments
            } else {
                alert("Please upload a document or pdf file only");
                $('#minutes').val("");
            }
        });
        $('#magenda').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "docx" || ext == "doc" || ext == "DOCX" || ext == "DOC" || ext == "PDF" || ext == "pdf") {
                //no comments
            } else {
                alert("Please upload a document or pdf file only");
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
        $(".btn-view").click(function () {
            let id = this.id;
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "viewremarks"
                },
                success: function (result) {
                    result = JSON.parse(result);
                    let html = "";
                    for (let i = 0; i < result.length; i++) {
                            html += `<i class="fas fa-arrow-right ml-4"></i> ${result[i]}<br>`;
                    }
                    $("#data").html(html);
                }
            });
            $('#viewmodal').modal('toggle');
        });
    </script>
    <?php require("footer.php") ?>