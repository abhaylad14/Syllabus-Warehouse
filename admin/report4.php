<?php
require "header.php";
if(!isset($_POST["term"])){
    $_POST["term"] = "1";
}
if(empty($_SESSION["term"])){
    $_SESSION["term"] = "1";
}
?>
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
                    <h1 class="m-0">Term wise configured subjects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Term wise configured subjects</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card col-sm-4 mx-auto">
            <div class="card-body">
                <form method="post">
                    <div class="form-row">
                        <div class="col-sm-9">
                            <label for="term" class="form-label">Term</label>
                            <select id="term" name="term" class="form-control" required>
                                <option selected disabled value="">---Select Term---</option>
                                <option value="1">1st Term(Odd)</option>
                                <option value="2">2nd Term(Even)</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <br/>
                            <button class="btn btn-primary mt-2" type="submit" id="btnsubmit" name="btnsubmit" >Submit</button>
                        </div>
                    </div>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["btnsubmit"]) && isset($_POST["term"])) {
                        $_SESSION["term"] = $_POST["term"];
                    }
                    else{
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
                ?>
            </div>
        </div>
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
                        $result = $admin->Report4($_POST["term"]);
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td scope="row"><?php echo $row[11]; ?></td>
                                <td scope="row"><?php echo $row[12]; ?></td>
                                <td scope="row"><?php echo $row[2]; ?></td>
                                <td scope="row"><?php
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
                                <td scope="row"><?php $x = explode("-", $row[13]);
                                echo $x[0]; ?></td>
                                <td scope="row"><?php echo $row[1]; ?></td>
                            </tr>
                            <?php $i++;
                        }
                        ?>
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
                        messageTop: 'Term wise configured subjects Report \t\t Term:' + '<?php echo $_SESSION["term"]; ?>',
                        messageBottom: 'The information in this table is copyright to Babu Madhav Institute of Information Technology.',
                        filename: "Term wise configured subjects Report_term" + '<?php echo $_SESSION["term"]; ?>',
                    },
                    {
                        extend: 'pdf',
                        title: "Babu Madhav Institute of Information Technology",
                        messageTop: 'Term wise configured subjects Report \t\t Term:' + '<?php echo $_SESSION["term"]; ?>',
                        messageBottom: 'The information in this table is copyright to Babu Madhav Institute of Information Technology.',
                        filename: "Term wise configured subjects Report_term" + '<?php echo $_SESSION["term"]; ?>',
                    },
                    {
                        extend: 'print',
                        title: "Babu Madhav Institute of Information Technology",
                        messageTop: 'Term wise configured subjects Report \t\t Term:' + '<?php echo $_SESSION["term"]; ?>',
                        messageBottom: 'The information in this table is copyright to Babu Madhav Institute of Information Technology.',
                        filename: "Term wise configured subjects Report_term" + '<?php echo $_SESSION["term"]; ?>',
                    },
                    'colvis'
                ]

            });

        });


    </script>

    <?php require("footer.php"); ?>
