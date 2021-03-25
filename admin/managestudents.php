<?php require("header.php"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Students</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Manage Students</li>
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
                            <th scope="col">Enro</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin = new Student();
                        $result = $admin->displayStudents();
                        foreach ($result as $row) {
                            if ($row[5] == 0) {
                                $statusclass = "btn btn-success btn-xs btn-status";
                                $status = "Active";
                            } else if ($row[5] == 1) {
                                $statusclass = "btn btn-danger btn-xs btn-status";
                                $status = "Inactive";
                            }
                            ?>
                            <tr>
                                <th scope="row">#</th>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><button id='<?php echo $row[0]; ?>' class='<?php echo $statusclass ?>'><?php echo $status; ?></button></td>
                                <td>
                                    <button id='<?php echo $row[0]; ?>' class='btn btn-outline-warning btn-sm fas fa-edit border-0 btn-edit'></button>
                                    <button id='<?php echo $row[0]; ?>' class='btn btn-outline-danger btn-sm fas fa-trash-alt border-0 btn-delete'></button>
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
                    Are you sure want to delete this Student?
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
                        <label for="cnum" class="form-label">Enrollment Number</label>
                        <input type="number" class="form-control" id="enro" placeholder="Enter enrollment number">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="ajaxupdate">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let id = "";
        let block = "";
        $(".btn-edit").click(function () {
            id = this.id;
            $('#editmodal').modal('toggle');
            block = this.parentElement.parentElement;
            let genderval = block.children[4].innerText;
//            console.log(genderval);
            if (genderval == "Male") {
                $("#male").prop("checked", true);
            } else {
                $("#female").prop("checked", true);
            }
            $("#name").val(block.children[2].innerText);
            $("#email").val(block.children[3].innerText);
            $("#enro").val(block.children[1].innerText);
        });
        $("#ajaxupdate").click(function () {
            let name = $("#name").val();
            let email = $("#email").val();
            let enro = $("#enro").val();
            
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "updateStudent",
                    uname: name,
                    uemail: email,
                    uenro: enro
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Student updated successfully!");
                        block.children[1].innerText = enro;
                        block.children[2].innerText = name;
                        block.children[3].innerText = email;
                    }
                    else if(result == "empty"){
                        displaymessage("error", "Empty Form!", "Please fill required details!");
                    } 
                    else {
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
                    action: "deleteStudent"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Student deleted successfully!");
                        block.remove();
                    }
                    else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $(".btn-status").click(function () {
            let id = this.id;
            let element = this;
            let status = this.innerText;
            let sid = "";
            let newstatus = "";
            if (status == "Active") {
                newstatus = "Inactive";
                sid = 1;
            } else if (status == "Inactive") {
                newstatus = "Active";
                sid = 0;
            }
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    ustatus: sid,
                    action: "changeStudentstatus"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Status changed!");
                        element.innerText = newstatus;
                        if (sid == 0) {
                            element.classList.remove("btn-danger");
                            element.classList.add("btn-success");
                        } else {
                            element.classList.remove("btn-success");
                            element.classList.add("btn-danger");
                        }
                    } else {
                        alert(result);
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
    <?php require("footer.php") ?>