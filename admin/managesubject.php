<?php require("header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Subject</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Manage Subject</li>
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
                <table class="table table-responsive">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Subject Code</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Effective Year</th>
                            <th scope="col">Theory Credit</th>
                            <th scope="col">Practical Credit</th>
                            <th scope="col">Theory Hours</th>
                            <th scope="col">Practical Hours</th>
                            <th scope="col">Syllabus (Word)</th>
                            <th scope="col">Syllabus (PDF)</th>
                            <th scope="col">Theory Marks (Internal)</th>
                            <th scope="col">Theory Marks (External)</th>
                            <th scope="col">CIE</th>
                            <th scope="col">Practical Marks (Internal)</th>
                            <th scope="col">Practical Marks (External)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $admin = new Subject();
                        $data = $admin->displaysubjects();
                        foreach ($data as $row) {
                        ?>
                        <tr>
                            <td scope="row">#</td>
                            <td><?php echo $row[1]; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td><?php echo $row[4]; ?></td>
                            <td><?php echo $row[5]; ?></td>
                            <td><?php echo $row[6]; ?></td>
                            <td><?php echo $row[7]; ?></td>
                            <?php if($row[8] != "-"){ ?>
                            <td><a href="<?php echo $row[8]; ?>" target="_blank">View</a></td>
                            <?php } else { ?>
                            <td><?php echo $row[8]; ?></a></td>
                            <?php } ?>
                            <?php if($row[9] != "-"){ ?>
                            <td><a href="<?php echo $row[9]; ?>" target="_blank">View</a></td>
                            <?php } else { ?>
                            <td><?php echo $row[9]; ?></a></td>
                            <?php } ?>
                            <td><?php echo $row[10]; ?></td>
                            <td><?php echo $row[11]; ?></td>
                            <td><?php echo $row[12]; ?></td>
                            <td><?php echo $row[13]; ?></td>
                            <td><?php echo $row[14]; ?></td>
                            <td>
                                <a class="btn btn-sm btn-outline-success border-0" href="editsubject.php?id=<?php echo $row[0]; ?>"><i class="fas fa-edit"></i></a>
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
                    Are you sure want to delete this Subject?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="ajaxdelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
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
                    action: "deletesubject"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Subject deleted successfully!");
                        block.remove();
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
    </script>
    
    <?php require("footer.php"); ?>