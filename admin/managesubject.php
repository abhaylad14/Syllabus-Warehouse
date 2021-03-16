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
                            <td><?php echo $row[8]; ?></td>
                            <td><?php echo $row[9]; ?></td>
                            <td><?php echo $row[10]; ?></td>
                            <td><?php echo $row[11]; ?></td>
                            <td><?php echo $row[12]; ?></td>
                            <td><?php echo $row[13]; ?></td>
                            <td><?php echo $row[14]; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
    <!-- /.content -->
    <?php require("footer.php"); ?>