<?php require './header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Assigned Subjects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Assigned Subjects</li>
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
                            <th scope="col">Subject Code</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Year</th>
                            <th scope="col">Leader</th> 
                            <th scope="col">Assigned Date</th>
                            <th scope="col">Verify Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">File</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admin = new Subject();
                        $result = $admin->viewAssignedSubjects();
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <th scope="row">#</th>
                                <td><?php echo $row[1]; ?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[5]; ?></td>
                                <td><?php
                                    if ($row[6] == "") {
                                        echo "-";
                                    } else {
                                        echo $row[6];
                                    }
                                    ?></td>
                                <td><?php
                                    if ($row[7] == 0) {
                                        echo '<span class="badge bg-secondary">Pending</span>';
                                    } else if ($row[7] == 1) {
                                        echo '<span class="badge bg-success">Accepted</span>';
                                    } else if ($row[7] == 2) {
                                        echo '<span class="badge bg-danger">Rejected</span>';
                                    }
                                    ?></td>
                                <td><?php
                                    if ($row[8] == "") {
                                        echo "-";
                                    } else {
                                        echo "<a href='$row[8]'>View</a>";
                                    }
                                    ?></td>
                                <td>
                                    <button id='<?php echo $row[9]; ?>' class='btn btn-outline-success btn-sm fas fa-eye border-0 btn-view'></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <!-- View Modal -->
    <div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Members</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="data">

                </div>
            </div>
        </div>
    </div>
    <script>

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
                    action: "viewmembers"
                },
                success: function (result) {
                    result = JSON.parse(result);
                    let html = "";
                    for (let i = 0; i < result.length; i++) {
                            html += `<i class="fas fa-user ml-4"></i> ${result[i]}<br>`;
                    }
                    $("#data").html(html);
                }
            });
            $('#viewmodal').modal('toggle');
        });
    </script>
    <?php require './footer.php'; ?>

