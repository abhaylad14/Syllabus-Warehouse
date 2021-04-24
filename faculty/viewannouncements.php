<?php require './header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Announcements</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">View Announcements</li>
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
                            <th scope="col">Title</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date</th>
                            <th scope="col">Attachment</th>
                            <th scope="col">Announced by</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin = new User();
                        $result = $admin->displayAnnouncements($_SESSION["userId"]);
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <th scope="row">#</th>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>

                                <td><?php
                                    if ($row[4] != "") {
                                        echo "<a href='$row[4]' target='_blank'>View </a>"
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-file'></button>";
                                    } else {
                                        echo "No Attachment"
                                        . "<button id='$row[0]' class='btn btn-outline-success btn-sm fas fa-edit border-0 btn-file'></button>";
                                    }
                                    ?></td>
                                <td><?php echo $row[5]; ?></td>
                                <td>
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
                    Are you sure want to delete this announcement?
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
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <input type="text" class="form-control" id="message" placeholder="Enter Message">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="ajaxupdate">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Update attachment Modal -->
    <div class="modal fade" id="updateafile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                        <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id1" id="id1" value='' >
                        <input type="file" class="form-control" id="afile" name="afile" required accept=".doc, .docx, .pdf, .zip, .rar, xlsx"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="btnuploadafile" class="btn btn-success" >Update Attachment</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <?php
    function saveafile($afile, $now) {
        $extension = explode(".", $afile);
        $extension = $extension[1];
        $afile = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/announcements/";
        $target_file = $target_dir . basename($_FILES["afile"]["name"]);
        move_uploaded_file($_FILES["afile"]["tmp_name"], $target_file);
        rename("../syllabusfiles/announcements/" . $_FILES["afile"]["name"], "../syllabusfiles/announcements/" . $afile);
        $afile = "../syllabusfiles/announcements/" . $afile;
        return $afile;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["btnuploadafile"])){
            if(isset($_FILES["afile"]) && $_FILES["afile"]["name"] != "" && !empty($_POST["id1"]) && isset($_POST["id1"])){
                $id = $_POST["id1"];
                $afile = $_FILES["afile"];
                $admin = new User();
                $now = new DateTime();
                $afile = saveafile($afile["name"], $now);
                $status = $admin->updateAnnouncementFile($id, $afile);
                if ($status == 1) {
                    displaymessage("success", "Attachment Updated!", "New file has been uploaded successfully!");
                    echo "<script>setTimeout(function(){ location.reload(); }, 3000);</script>";
                } else {
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            }
            else{
                displaymessage("error", "Empty Empty Form!", "Please upload a file!");
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
            $("#title").val(block.children[1].innerText);
            $("#message").val(block.children[2].innerText);
        });
        $("#ajaxupdate").click(function () {
            let utitle = $("#title").val();
            let umessage = $("#message").val();
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "updateAnnouncement",
                    title: utitle,
                    message: umessage
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Announcement updated successfully!");
                        block.children[1].innerText = utitle;
                        block.children[2].innerText = umessage;
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
                    action: "deleteAnnouncement"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Announcement deleted successfully!");
                        block.remove();
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $(".btn-file").click(function(){
            id = this.id;
            $("#id1").val(id);
            $("#updateafile").modal("toggle");
        });
        $('#afile').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "docx" || ext == "doc" || ext == "DOCX" || ext == "DOC" || ext == "pdf" || ext == "PDF" || ext == "zip" || ext == "rar" || ext == "xlsx") {
                //no comments
            } else {
                alert("Please upload a doc, excel, pdf or zip file only");
                $('#afile').val("");
            }
        });
    </script>
    <?php require './footer.php'; ?>