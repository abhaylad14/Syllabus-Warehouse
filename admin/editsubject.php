<?php
require("header.php");
if (!$_GET["id"]) {
    header("Location: ./managesubject.php");
} else {
    $id = trim($_GET["id"]);
    $admin = new Subject();
    $data = $admin->getSubjectById($id);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Subject</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Subject</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card col-sm-10 mx-auto">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-sm-3">
                            <label for="subcode" class="form-label">Subject Code</label>
                            <input type="text" value="<?php echo $data[1]; ?>" class="form-control" id="subcode" name="subcode" maxlength="15" placeholder="eg. ITxxxx" title="Only alphanumeric characters are allowed" pattern="^[A-Za-z0-9]+$" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="subname" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" value="<?php echo $data[2]; ?>" id="subname" name="subname" maxlength="100" pattern="^[A-Z a-z0-9]+$" required>
                        </div>
                        <div class="col">
                            <label for="eyear" class="form-label">Effective Year</label>
                            <input type="month" class="form-control" value="<?php echo $data[3]; ?>" id="eyear" name="eyear" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-sm-4">
                            <label for="sfile" class="form-label">Syllabus File Docx</label>
                            <input type="file" class="form-control" id="sfile" name="sfile" accept=".doc, .docx">
                        </div>
                        <div class="col-sm-4">
                            <label for="pfile" class="form-label">Syllabus File PDF</label>
                            <input type="file" class="form-control" id="pfile" name="pfile" accept=".PDF, .pdf">
                        </div>
                    </div>
                    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-info" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Subject Details</a>
                        </li>
                    </ul>
                    <div class="tab-pane" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="form-row mt-2">
                            <div class="col-sm-2">
                                <label for="tcredit" class="form-label">Theory Credit</label>
                                <input type="text" class="form-control" value="<?php echo $data[4]; ?>" id="tcredit" pattern="^[0-2]*[0-9\-]$" maxlength="2" name="tcredit">
                            </div>
                            <div class="col-sm-2">
                                <label for="thour" class="form-label">Theory Hours</label>
                                <input type="text" class="form-control" value="<?php echo $data[6]; ?>" id="thour" pattern="^[0-2]*[0-9\-]$" maxlength="2" name="thour">
                            </div>
                            <div class="col-sm-2">
                                <label for="tmarksint" class="form-label">Theory Marks(Internal)</label>
                                <input type="text" class="form-control" value="<?php echo $data[10]; ?>" id="tmarksint" pattern="^[0-9\-]+$" maxlength="3" name="tmarksint">
                            </div>
                            <div class="col-sm-2">
                                <label for="tmarksext" class="form-label">Theory Marks(External)</label>
                                <input type="text" class="form-control" value="<?php echo $data[11]; ?>" id="tmarksext" pattern="^[0-9\-]+$" maxlength="3" name="tmarksext">
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-sm-2">
                                <label for="pcredit" class="form-label">Practical Credit</label>
                                <input type="text" class="form-control" value="<?php echo $data[5]; ?>" id="pcredit" pattern="^[0-9\-]+$" maxlength="2" name="pcredit">
                            </div>
                            <div class="col-sm-2">
                                <label for="phour" class="form-label">Practical Hours</label>
                                <input type="text" class="form-control" value="<?php echo $data[7]; ?>" id="phour" pattern="^[0-9\-]+$" maxlength="2" name="phour">
                            </div>
                            <div class="col mt-3">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#tptab1" role="tab" aria-controls="pills-home" aria-selected="true">CIE</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#tptab2" role="tab" aria-controls="pills-profile" aria-selected="false">Int + Ext</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="tptab1" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="form-row">
                                            <div class="col-sm-3">
                                                <label for="ciemarks" class="form-label">Cie marks</label>
                                                <input type="text" class="form-control" value="<?php echo $data[12]; ?>" id="ciemarks" pattern="^[0-9\-]+$" maxlength="3" name="ciemarks">
                                            </div>
                                            <div class="col-sm-3 mt-2">
                                                <br/>
                                                <button type="submit" name="btnupdate1" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tptab2" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="form-row">
                                            <div class="col-sm-3">
                                                <label for="cieint5" class="form-label">Internal marks</label>
                                                <input type="text" class="form-control" id="cieint" value="<?php echo $data[13]; ?>" pattern="^[0-9\-]+$" maxlength="3" name="cieint">
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="cieext5" class="form-label">External marks</label>
                                                <input type="text" class="form-control" id="cieext" value="<?php echo $data[14]; ?>" pattern="^[0-9\-]+$" maxlength="3" name="cieext" >
                                            </div>
                                            <div class="col-sm-3 mt-2">
                                                <br/>
                                                <button type="submit" name="btnupdate2" class="btn btn-primary">Update</button> 
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- /.content -->
    <?php
    $sfile = $pfile = "";

    function dashfornull($var) {
        if ($var == "") {
            $var = "-";
        }
        return $var;
    }

    function savesfile($sfile, $now) {
        $extension = explode(".", $sfile);
        $extension = $extension[1];
        $sfile = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/";
        $target_file = $target_dir . basename($_FILES["sfile"]["name"]);
        move_uploaded_file($_FILES["sfile"]["tmp_name"], $target_file);
        rename("../syllabusfiles/" . $_FILES["sfile"]["name"], "../syllabusfiles/" . $sfile);
        $sfile = "../syllabusfiles/" . $sfile;
        return $sfile;
    }

    function savepfile($pfile, $now) {
        $extension = explode(".", $pfile);
        $extension = $extension[1];
        $pfile = $now->getTimestamp() . "." . $extension;
        $target_dir = "../syllabusfiles/";
        $target_file = $target_dir . basename($_FILES["pfile"]["name"]);
        move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file);
        rename("../syllabusfiles/" . $_FILES["pfile"]["name"], "../syllabusfiles/" . $pfile);
        $pfile = "../syllabusfiles/" . $pfile;
        return $pfile;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["subcode"]) && !empty($_POST["subcode"]) && isset($_POST["subname"]) && !empty($_POST["subname"]) && isset($_POST["eyear"]) && !empty($_POST["eyear"])) {
            $subcode = trim($_POST["subcode"]);
            $subname = trim($_POST["subname"]);
            $eyear = trim($_POST["eyear"]);
            $sfile = $_FILES["sfile"];
            $pfile = $_FILES["pfile"];
            $tcredit = $_POST["tcredit"];
            $thour = $_POST["thour"];
            $tmarksint = $_POST["tmarksint"];
            $tmarksext = $_POST["tmarksext"];
            $pcredit = $_POST["pcredit"];
            $phour = $_POST["phour"];
            $cie = $_POST["ciemarks"];
            $cieint = $_POST["cieint"];
            $cieext = $_POST["cieext"];

            $tcredit = dashfornull($tcredit);
            $thour = dashfornull($thour);
            $tmarksint = dashfornull($tmarksint);
            $tmarksext = dashfornull($tmarksext);
            $pcredit = dashfornull($pcredit);
            $phour = dashfornull($phour);
            $cie = dashfornull($cie);
            $cieint = dashfornull($cieint);
            $cieext = dashfornull($cieext);

            $admin = new Subject();
            $now = new DateTime();
            if (isset($_POST["btnupdate1"]) && $_POST["cieint"] == "-" || $_POST["cieint"] == "" && $_POST["cieext"] == "-" || $_POST["cieext"] == "") {
                if ($_FILES["sfile"]["name"] != "" && $_FILES["pfile"]["name"] != "") {
                    $sfile = savesfile($sfile["name"],$now);
                    $pfile = savepfile($pfile["name"],$now);
                    $status = $admin->UpdateSubject1($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cie, $id);
                    if ($status == 1) {
                        header("Location: managesubject.php");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                } else if ($_FILES["sfile"]["name"] == "" && $_FILES["pfile"]["name"] == "") {
                    $status = $admin->xUpdateSubject1($subcode, $subname, $eyear, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cie, $id);
                    if ($status == 1) {
                        header("Location: managesubject.php");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                } else if ($_FILES["sfile"]["name"] != "" && $_FILES["pfile"]["name"] == "") {
                    $sfile = savesfile($sfile["name"],$now);
                    $status = $admin->x1UpdateSubject1($subcode, $subname, $eyear, $sfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cie, $id);
                    if ($status == 1) {
                        header("Location: managesubject.php");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                } else if ($_FILES["sfile"]["name"] == "" && $_FILES["pfile"]["name"] != "") {
                    $pfile = savepfile($pfile["name"],$now);
                    $status = $admin->x2UpdateSubject1($subcode, $subname, $eyear, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cie, $id);
                    if ($status == 1) {
                        header("Location: managesubject.php");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            } else if (isset($_POST["btnupdate2"]) && $_POST["ciemarks"] == "-" || $_POST["ciemarks"] == "") {
                if ($_FILES["sfile"]["name"] != "" && $_FILES["pfile"]["name"] != "") {
                    $sfile = savesfile($sfile["name"],$now);
                    $pfile = savepfile($pfile["name"],$now);
                    $status = $admin->UpdateSubject2($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext, $id);
                    if ($status == 1) {
                        header("Location: managesubject.php");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                } else if ($_FILES["sfile"]["name"] == "" && $_FILES["pfile"]["name"] == "") {
                    $status = $admin->xUpdateSubject2($subcode, $subname, $eyear, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext, $id);
                    if ($status == 1) {
                        header("Location: managesubject.php");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                } else if ($_FILES["sfile"]["name"] != "" && $_FILES["pfile"]["name"] == "") {
                    $status = $admin->x1UpdateSubject2($subcode, $subname, $eyear, $sfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext, $id);
                    if ($status == 1) {
                        $sfile = savesfile($sfile["name"],$now);
                        header("Location: managesubject.php");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                } else if ($_FILES["sfile"]["name"] == "" && $_FILES["pfile"]["name"] != "") {
                    $status = $admin->x2UpdateSubject2($subcode, $subname, $eyear, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext, $id);
                    if ($status == 1) {
                        $pfile = savepfile($pfile["name"],$now);
                        header("Location: managesubject.php");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            } else {
                displaymessage("error", "Invalid Form!", "Please enter valid details");
            }
        } else {
            displaymessage("error", "Empty Form!", "Please enter required details");
        }
    }
    ?>
    <?php require("footer.php"); ?>