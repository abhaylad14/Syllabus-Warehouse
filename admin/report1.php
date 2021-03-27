<?php require "header.php"; ?>
<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All configured subjects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">All configured subjects</li>
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
                <table class="table table-bordered table-striped">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Semester</th>
                            <th>Programme</th>
                            <th>Effective year</th>
                            <th>Academic Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $admin = new Reports();
                        $result = $admin->Report1();
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td scope="row"><?php echo $row[11]; ?></td>
                                <td scope="row"><?php echo $row[12]; ?></td>
                                <td scope="row"><?php echo $row[2]; ?></td>
                                <td scope="row"><?php 
                                if($row[3] == 0){
                                    echo 'Integrated M.Sc.IT';
                                }
                                else if($row[3] == 1){
                                    echo 'B.Sc.IT';
                                }
                                else if($row[3] == 2){
                                    echo 'M.Sc.IT';
                                }
                                else if($row[3] == 3){
                                    echo 'Integrated M.Sc.IT, B.Sc.IT';
                                }
                                else if($row[3] == 4){
                                    echo 'Integrated M.Sc.IT, M.Sc.IT';
                                }
                                ?></td>
                                <td scope="row"><?php $x = explode("-",$row[13]); echo $x[0]; ?></td>
                                <td scope="row"><?php echo $row[1]; ?></td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <!-- DataTables  & Plugins -->
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap5.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function () {
            var printCounter = 0;

            // Append a caption to the table before the DataTables initialisation
            $('.table').append('<caption style="caption-side: bottom">BMIIT\'s syllabus details table.</caption>');

            $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    "copy",
                    {
                        extend: 'excel',
                        title: "Babu Madhav Institute of Information Technology",
                        messageTop: 'All Configured Subjects Report',
                        messageBottom: 'The information in this table is copyright to Babu Madhav Institute of Information Technology.',
                        filename: "All configured subjects Report",
                    },
                    {
                        extend: 'pdf',
                        title: "Babu Madhav Institute of Information Technology",
                        messageTop: 'All Configured Subjects Report',
                        messageBottom: 'The information in this table is copyright to Babu Madhav Institute of Information Technology.',
                        filename: "All configured subjects Report",
                    },
                    {
                        extend: 'print',
                        title: "Babu Madhav Institute of Information Technology",
                        messageTop: 'All Configured Subjects Report',
                        messageBottom: 'The information in this table is copyright to Babu Madhav Institute of Information Technology.',
                        filename: "All configured subjects Report",
                    },
                    'colvis'
                ]

            });


//            let x = document.getElementsByClassName("pagination");
//            for (let i = 0; i < x[0].childElementCount; i++) {
//                x[0].children[i].classList.add("px-0");
//            }
//            $(".page-link").click(function () {
//                let x = document.getElementsByClassName("pagination");
//                for (let i = 0; i < x[0].childElementCount; i++) {
//                    x[0].children[i].classList.add("px-0");
//                }
//            })
        });


    </script>

    <?php require("footer.php"); ?>
