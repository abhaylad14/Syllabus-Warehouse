<?php require("header.php"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Deleted Faculty</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Deleted Faculty</li>
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
                <table class="table">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">Profile</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin = new User();
                        $result = $admin->displayDeletedUsers();
                        while ($row = $result->fetch()) {
                            if ($row['Gender'] == 'm') {
                                $gender = "Male";
                            } else {
                                $gender = "Female";
                            }

                            echo "<tr>";
                            echo "<td><img class='img-fluid' width='100' height='100' src='{$row['ProfileImage']}'/></td>";
                            echo "<td>{$row['FullName']}</td>";
                            echo "<td>{$row['Username']}</td>";
                            echo "<td>{$row['Contact']}</td>";
                            echo "<td>{$gender}</td>";
                            echo "<td>"
                            . "<button id='{$row['Id']}' class='btn btn-outline-success btn-sm border-0 btn-redo'><i class='fas fa-redo'></i></button>"
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

    <!-- Restore Modal -->
    <div class="modal fade" id="restoremodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to restore this User?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="ajaxrestore">Restore</button>
                </div>
            </div>
        </div>
    </div>
   
    <script>
        let id = "";
        let block = "";
       
       
        $(".btn-redo").click(function () {
            id = this.id;
            $('#restoremodal').modal('toggle');
            block = this.parentElement.parentElement;
        });
        $("#ajaxrestore").click(function () {
            $.ajax({
                type: "POST",
                url : "ajaxops.php",
               data: {
                    id: id,
                    action: "restoreuser"
                },
                success: function (result) {
                    if (result =="done") {
                        displaymessage("success", "Success!", "User restored successfully!");
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
    </script>
    <?php require("footer.php") ?>