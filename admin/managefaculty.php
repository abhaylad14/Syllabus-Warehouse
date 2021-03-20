<?php require("header.php"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Faculty</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Manage Faculty</li>
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
                            <th scope="col">Profile</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin = new User();
                        $result = $admin->displayUsers();
                        while ($row = $result->fetch()) {
                            if ($row['Gender'] == 'm') {
                                $gender = "Male";
                            } else {
                                $gender = "Female";
                            }
                            if ($row["Status"] == 0) {
                                $statusclass = "btn btn-success btn-xs btn-status";
                                $status = "Active";
                            } else if ($row["Status"] == 1) {
                                $statusclass = "btn btn-danger btn-xs btn-status";
                                $status = "Inactive";
                            }

                            echo "<tr>";
                            echo "<td><img class='img-fluid' width='100' height='100' src='{$row['ProfileImage']}'/></td>";
                            echo "<td>{$row['FullName']}</td>";
                            echo "<td>{$row['Username']}</td>";
                            echo "<td>{$row['Contact']}</td>";
                            echo "<td>{$gender}</td>";
                            echo "<td><button id='{$row['Id']}' class='$statusclass'>$status</button></td>";
                            echo "<td>"
                            . "<button id='{$row['Id']}' class='btn btn-outline-warning btn-sm fas fa-edit border-0 btn-edit'></button>"
                            . "<button id='{$row['Id']}' class='btn btn-outline-danger btn-sm fas fa-trash-alt border-0 btn-delete'></button>"
                            . "</td>";
                            echo "</tr>";
                        }
                        ?>
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
                    Are you sure want to delete this User?
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
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter full name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label for="cnum" class="form-label">Contact</label>
                        <input type="text" maxlength="10" class="form-control" id="cnum" placeholder="Enter full name">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label mr-4">Gender</label>
                        <input type="radio" name="gender" id="male" value="male" > <label for="male">Male</label>
                        <input type="radio" name="gender" id="female" value="female" > <label for="female">Female</label>
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
            $("#name").val(block.children[1].innerText);
            $("#email").val(block.children[2].innerText);
            $("#cnum").val(block.children[3].innerText);
        });
        $("#ajaxupdate").click(function () {
            let name = $("#name").val();
            let email = $("#email").val();
            let contact = $("#cnum").val();
            let gender = "";
            if ($("#male").prop("checked") == true) {
                gender = "m";
                genderval = "Male";
            } else {
                gender = "f";
                genderval = "Female";
            }
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    id: id,
                    action: "updateuser",
                    uname: name,
                    uemail: email,
                    ucontact: contact,
                    ugender: gender
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "User updated successfully!");
                        block.children[1].innerText = name;
                        block.children[2].innerText = email;
                        block.children[3].innerText = contact;
                        block.children[4].innerText = genderval;
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
                    action: "deleteuser"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "User deleted successfully!");
                        block.remove();
                    } else {
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
                    action: "changestatus"
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