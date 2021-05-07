<?php require "header.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Backup Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Backup Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card col-sm-8 mx-auto">
            <div class="card-body mx-auto">
                <div>
                    Click here to Backup Database: 
                    <a class="btn btn-sm btn-outline-success" href="backupdatabase.php">Backup Database</a>
                </div>
            </div>
        </div>
        <div class="card col-sm-8 mx-auto">
            <div class="card-body mx-auto">
                <div>
                    Click here to Backup TES(Google Drive): 
                    <a class="btn btn-sm btn-outline-success" target="_blank" href="http://localhost:3000/upload">Backup TES</a>
                </div>
            </div>
        </div>
        <div class="card col-sm-8 mx-auto">
            <div class="card-body mx-auto">
                <form method="post" enctype="multipart/form-data"
                      id="frm-restore">
                    <div class="form-row">
                        <label>Choose Backup File: </label>
                        <div>
                            <input type="file" class="form-control ml-2" accept=".sql" name="backup_file" class="input-file" />
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="restore" value="Restore"
                               class="btn-action btn-primary btn mt-3" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php
    $conn = mysqli_connect("localhost", "root", "", "syllabus_warehouse");
    if (!empty($_FILES)) {
        // Validating SQL file type by extensions
        if (!in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
                    "sql"
                ))) {
            $response = array(
                "type" => "error",
                "message" => "Invalid File Type"
            );
        } else {
            if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
                move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
                $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
            }
        }
        displaymessage("success", "Database Restored!", "Database has been restored successfully!");
    }

    function restoreMysqlDB($filePath, $conn) {
        $sql = '';
        $error = '';

        if (file_exists($filePath)) {
            $lines = file($filePath);

            foreach ($lines as $line) {

                // Ignoring comments from the SQL script
                if (substr($line, 0, 2) == '--' || $line == '') {
                    continue;
                }

                $sql .= $line;

                if (substr(trim($line), - 1, 1) == ';') {
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        $error .= mysqli_error($conn) . "\n";
                    }
                    $sql = '';
                }
            } // end foreach

            if ($error) {
                $response = array(
                    "type" => "error",
                    "message" => $error
                );
            } else {
                $response = array(
                    "type" => "success",
                    "message" => "Database Restore Completed Successfully."
                );
            }
        } // end if file exists
        return $response;
    }
    ?>
    <?php require './footer.php'; ?>