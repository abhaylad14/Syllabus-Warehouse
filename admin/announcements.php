<?php require("header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Announcements</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Announcements</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="tab-pane fade show active" id="nav-announcement" role="tabpanel" aria-labelledby="nav-announcement-tab">
            <!--Announcements-->
            <?php
            $admin = new User();
            $result = $admin->displayAllAnnouncements();
            foreach ($result as $row) {
                ?>
                <div class="card mt-3 col-sm-6 mx-auto">
                    <div class="card-header">
                        <strong class="text-primary"><i class="fas fa-thumbtack text-muted mx-2"></i> <?php echo $row[1]; ?></strong>
                    </div>
                    <div class="card-body">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><p> <?php echo $row[2]; ?></p></li>
                            <li class="list-group-item"><strong>Date: </strong> <?php echo $row[3]; ?></li>
                            <li class="list-group-item"><strong>By: </strong> <?php echo $row[5]; ?></li>
                            <li class="list-group-item"><strong>Attachment: </strong><?php
                                if ($row[4] != "") {
                                    echo "<a href='$row[4]' class='mx-2' target='_blank'>View</a>";
                                } else {
                                    echo "No Attachment";
                                }
                                ?></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- /.content -->
    <?php require("footer.php"); ?>
