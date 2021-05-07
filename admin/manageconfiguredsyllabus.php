<?php require("header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Configured Syllabus</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Manage Configured Syllabus</li>
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
                <table class="table table-responsive-md">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Academic Year</th>
                            <th scope="col">Sem</th>
                            <th scope="col">Programme</th>
                            <th scope="col">Published Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin = new Subject();
                        $data = $admin->viewConfiguredSyllabus();
                        foreach ($data as $row) {
                            ?>
                            <tr>
                                <td scope="row">#</td>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php
                                    if ($row[3] == 0) {
                                        echo 'Integrated M.Sc.IT';
                                    } else if ($row[3] == 1) {
                                        echo 'B.Sc.IT';
                                    } else if ($row[3] == 2) {
                                        echo 'M.Sc.IT';
                                    } else if ($row[3] == 3) {
                                        echo 'Integrated M.Sc.IT, B.Sc.IT';
                                    } else if ($row[3] == 4) {
                                        echo 'Integrated M.Sc.IT, M.Sc.IT';
                                    }
                                    ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning border-0 btn-view" id="<?php echo $row[0]; ?>"> <i class="fas fa-eye"></i> </button>
                                    <?php if($row[4] == ""){ ?>
                                    <button class="btn btn-sm btn-outline-success border-0 btn-publish" id="<?php echo $row[0]; ?>"> <i class="fas fa-check"> Publish</i> </button>
                                    <?php } ?>
                                    <button class="btn btn-sm btn-outline-danger border-0 btn-delete" id="<?php echo $row[0]; ?>"><i class="fas fa-trash-alt"></i></button>
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
                    Are you sure want to delete this Configuration?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="ajaxdelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Publish Modal -->
    <div class="modal fade" id="publishmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to publish this Configuration?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="ajaxpublish">Publish</button>
                </div>
            </div>
        </div>
    </div>
    <!-- View Modal -->
    <div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subjects</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="data">

                </div>
            </div>
        </div>
    </div>
    <script>
        let block = "";
        let id = "";
        $(document).ready(function () {
            $('.table').DataTable();
        });
        $(".btn-delete").click(function () {
            id = this.id;
            $('#deletemodal').modal('toggle');
            block = this.parentElement.parentElement;
        });
        $(".btn-publish").click(function () {
            id = this.id;
            $('#publishmodal').modal('toggle');
            block = this.parentElement.parentElement;
        });
        $("#ajaxpublish").click(function () {
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "publishconfig"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Configuration Published successfully!");
                        let date = new Date();
                        block.children[4].innerHTML = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $("#ajaxdelete").click(function () {
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "deleteconfig"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Configuration deleted successfully!");
                        block.remove();
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $(document).ready(function () {
            $('.table').DataTable();
        });
        $(".btn-view").click(function () {
            let id = this.id;
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "viewSyllabusX"
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

<?php require("footer.php"); ?>