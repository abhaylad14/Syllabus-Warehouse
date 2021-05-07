<?php
require("header.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Subject</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Subject</li>
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
                            <input type="text" class="form-control" id="subcode" name="subcode" maxlength="15" placeholder="eg. ITxxxx" title="Only alphanumeric characters are allowed" pattern="^[A-Za-z0-9]+$" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="subname" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="subname" name="subname" maxlength="100" placeholder="Enter Subject Name"
                                   title="Only alphanumeric characters are allowed" pattern="^[A-Z a-z0-9]+$" required>
                        </div>
                        <div class="col">
                            <label for="eyear" class="form-label">Effective Year</label>
                            <input type="month" class="form-control" id="eyear" name="eyear" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-sm-4">
                            <label for="sfile" class="form-label">Syllabus Word(Docx) File (Optional)</label>
                            <input type="file" class="form-control" id="sfile" name="sfile" accept=".doc, .docx">
                        </div>
                        <div class="col-sm-4">
                            <label for="pfile" class="form-label">Syllabus File PDF (Optional)</label>
                            <input type="file" class="form-control" id="pfile" name="pfile" accept=".PDF, .pdf">
                        </div>
                    </div>
                    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active text-info" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Theory</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-info" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Practical</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-info" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Theory + Practical</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="form-row mt-2">
                                <div class="col-sm-2">
                                    <label for="tcredit" class="form-label">Theory Credit</label>
                                    <input type="text" class="form-control" id="tcredit" title="Invalid input" pattern="^[0-2]*[ 0-9\-]$" maxlength="2" name="tcredit1" >
                                </div>
                                <div class="col-sm-2">
                                    <label for="thour" class="form-label">Theory Hours</label>
                                    <input type="text" class="form-control" id="thour" title="Invalid input" pattern="^[0-2]*[ 0-9\-]$" maxlength="2" name="thour1" >
                                </div>
                                <div class="col-sm-2">
                                    <label for="tmarksint" class="form-label">Theory Marks(Internal)</label>
                                    <input type="text" class="form-control" id="tmarksint" title="Invalid input" pattern="^[ 0-9\-]+$" maxlength="3" name="tmarksint1">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tmarksext" class="form-label">Theory Marks(External)</label>
                                    <input type="text" class="form-control" id="tmarksext" title="Invalid input" maxlength="3" pattern="^[ 0-9\-]+$" name="tmarksext1">
                                </div>
                                <div class="col-sm-2 mt-2">
                                    <br/>
                                    <button type="submit" name="btnsubmit1" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade mx-auto col-sm-8" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="form-row mt-2">
                                <div class="col-sm-4">
                                    <label for="pcredit" class="form-label">Practical Credit</label>
                                    <input type="text" class="form-control" id="pcredit" title="Invalid input" pattern="^[0-2]*[0-9]$" maxlength="2" name="pcredit2">
                                </div>
                                <div class="col-sm-4">
                                    <label for="phour" class="form-label">Practical Hours</label>
                                    <input type="text" class="form-control" id="phour" title="Invalid input" pattern="^[0-2]*[0-9]$" maxlength="2" name="phour2" >
                                </div>
                            </div>
                            <div class="col mt-3">
                                <div class="col">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">CIE</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Int + Ext</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="form-row">
                                                <div class="col-sm-4">
                                                    <label for="ciemarks" class="form-label">Cie marks</label>
                                                    <input type="number" class="form-control" id="ciemarks" title="Invalid input" pattern="^[0-9]+$" maxlength="3" name="ciemarks2">
                                                </div>
                                                <div class="col-sm-4 mt-2">
                                                    <br/>
                                                    <button type="submit" name="btnsubmit2" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="form-row">
                                                <div class="col-sm-4">
                                                    <label for="cieint" class="form-label">Internal marks</label>
                                                    <input type="text" class="form-control" id="cieint" title="Invalid input" pattern="^[0-9]+$" maxlength="3" name="cieint3" >
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="cieint" class="form-label">External marks</label>
                                                    <input type="text" class="form-control" id="cieext" title="Invalid input" pattern="^[0-9]+$" maxlength="3" name="cieext3" >
                                                </div>
                                                <div class="col-sm-4 mt-2">
                                                    <br/>
                                                    <button type="submit" name="btnsubmit3" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="form-row mt-2">
                                <div class="col-sm-2">
                                    <label for="tcredit" class="form-label">Theory Credit</label>
                                    <input type="text" class="form-control" id="tcredit" title="Invalid input" pattern="^[0-2]*[0-9]$" maxlength="2" name="tcredit4">
                                </div>
                                <div class="col-sm-2">
                                    <label for="thour" class="form-label">Theory Hours</label>
                                    <input type="text" class="form-control" id="thour" title="Invalid input" pattern="^[0-2]*[0-9]$" maxlength="2" name="thour4">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tmarksint" class="form-label">Theory Marks(Internal)</label>
                                    <input type="text" class="form-control" id="tmarksint" title="Invalid input" pattern="^[0-9]+$" maxlength="3" name="tmarksint4">
                                </div>
                                <div class="col-sm-2">
                                    <label for="tmarksext" class="form-label">Theory Marks(External)</label>
                                    <input type="text" class="form-control" id="tmarksext" title="Invalid input" pattern="^[0-9]+$" maxlength="3" name="tmarksext4">
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="col-sm-2">
                                    <label for="pcredit" class="form-label">Practical Credit</label>
                                    <input type="text" class="form-control" id="pcredit" title="Invalid input" pattern="^[0-9]+$" maxlength="2" name="pcredit4">
                                </div>
                                <div class="col-sm-2">
                                    <label for="phour" class="form-label">Practical Hours</label>
                                    <input type="text" class="form-control" id="phour" title="Invalid input" pattern="^[0-9]+$" maxlength="2" name="phour4">
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
                                                    <input type="text" class="form-control" id="ciemarks" title="Invalid input" pattern="^[0-9]+$" maxlength="3" name="ciemarks4">
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <br/>
                                                    <button type="submit" name="btnsubmit4" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tptab2" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="form-row">
                                                <div class="col-sm-3">
                                                    <label for="cieint5" class="form-label">Internal marks</label>
                                                    <input type="text" class="form-control" id="cieint5" title="Invalid input" pattern="^[0-9]+$" maxlength="3" name="cieint5">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="cieext5" class="form-label">External marks</label>
                                                    <input type="text" class="form-control" id="cieext5" title="Invalid input" pattern="^[0-9]+$" maxlength="3" name="cieext5" >
                                                </div>
                                                <div class="col-sm-3 mt-2">
                                                    <br/>
                                                    <button type="submit" name="btnsubmit5" class="btn btn-primary">Submit</button>
                                                </div>
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
    <?php

    function dashfornull($var) {
        if ($var == "") {
            $var = "-";
        }
        return $var;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["subcode"]) && isset($_POST["subcode"]) && !empty($_POST["subname"]) && isset($_POST["subname"]) &&
                !empty($_POST["eyear"]) && isset($_POST["eyear"])) {
            $subcode = trim($_POST["subcode"]);
            $subname = trim($_POST["subname"]);
            $eyear = trim($_POST["eyear"]);
            $sfile = $_FILES["sfile"]["name"];
            $pfile = $_FILES["pfile"]["name"];
            $sfile = dashfornull($sfile);
            $pfile = dashfornull($pfile);
            $addsubject = new Subject();
            $now = new DateTime();

            if ($sfile != "-" && $pfile != "-") {
                $extension = explode(".", $sfile);
                $extension = $extension[1];
                $sfile = $now->getTimestamp() . "." . $extension;
                $target_dir = "../syllabusfiles/";
                $target_file = $target_dir . basename($_FILES["sfile"]["name"]);
                move_uploaded_file($_FILES["sfile"]["tmp_name"], $target_file);
                rename("../syllabusfiles/" . $_FILES["sfile"]["name"], "../syllabusfiles/" . $sfile);
                $sfile = "../syllabusfiles/" . $sfile;

                $extension = explode(".", $pfile);
                $extension = $extension[1];
                $pfile = $now->getTimestamp() . "." . $extension;
                $target_dir = "../syllabusfiles/";
                $target_file = $target_dir . basename($_FILES["pfile"]["name"]);
                move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file);
                rename("../syllabusfiles/" . $_FILES["pfile"]["name"], "../syllabusfiles/" . $pfile);
                $pfile = "../syllabusfiles/" . $pfile;
            } else if ($sfile != "-") {
                $extension = explode(".", $sfile);
                $extension = $extension[1];
                $sfile = $now->getTimestamp() . "." . $extension;
                $target_dir = "../syllabusfiles/";
                $target_file = $target_dir . basename($_FILES["sfile"]["name"]);
                move_uploaded_file($_FILES["sfile"]["tmp_name"], $target_file);
                rename("../syllabusfiles/" . $_FILES["sfile"]["name"], "../syllabusfiles/" . $sfile);
                $sfile = "../syllabusfiles/" . $sfile;
            } else if ($pfile != "-") {
                $extension = explode(".", $pfile);
                $extension = $extension[1];
                $pfile = $now->getTimestamp() . "." . $extension;
                $target_dir = "../syllabusfiles/";
                $target_file = $target_dir . basename($_FILES["pfile"]["name"]);
                move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file);
                rename("../syllabusfiles/" . $_FILES["pfile"]["name"], "../syllabusfiles/" . $pfile);
                $pfile = "../syllabusfiles/" . $pfile;
            }
            if (isset($_POST["btnsubmit1"])) {

                if (isset($_POST["tcredit1"]) && $_POST["tcredit1"] != "" && isset($_POST["thour1"]) && $_POST["thour1"] != "" &&
                        isset($_POST["tmarksint1"]) && $_POST["tmarksint1"] != "" && isset($_POST["tmarksext1"]) && $_POST["tmarksext1"] != "") {
                    $tc = trim($_POST["tcredit1"]);
                    $th = trim($_POST["thour1"]);
                    $tmi = trim($_POST["tmarksint1"]);
                    $tme = trim($_POST["tmarksext1"]);

                    $tcredit = dashfornull($tc);
                    $thour = dashfornull($th);
                    $tmarksint = dashfornull($tmi);
                    $tmarksext = dashfornull($tme);

                    $status = $addsubject->addsubject1($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext);
                    if ($status == 1) {
                        displaymessage("success", "Success", "Subject added successfully!");
                    } else if ($status == 2) {
                        displaymessage("error", "Error", "Subject is already added!");
                    } else {
                        displaymessage("error", "Error", "Something went wrong!");
                    }
                } else {
                    displaymessage("error", "Empty Form!", "Please fill all the required details for Theory Subject!");
                }
            } else if (isset($_POST["btnsubmit2"])) {
                if (isset($_POST["pcredit2"]) && $_POST["pcredit2"] != "" && isset($_POST["phour2"]) && $_POST["phour2"] != "" && isset($_POST["ciemarks2"]) && $_POST["ciemarks2"] != "") {
                    $pc = trim($_POST["pcredit2"]);
                    $ph = trim($_POST["phour2"]);
                    $cie = trim($_POST["ciemarks2"]);

                    $pcredit = dashfornull($pc);
                    $phour = dashfornull($ph);
                    $ciemarks = dashfornull($cie);

                    $addsubject2 = new Subject();
                    $status = $addsubject->addsubject2($subcode, $subname, $eyear, $sfile, $pfile, $pcredit, $phour, $ciemarks);
                    if ($status == 1) {
                        displaymessage("success", "Success", "Subject added successfully!");
                    } else if ($status == 2) {
                        displaymessage("error", "Error", "Subject is already added!");
                    } else {
                        displaymessage("error", "Error", "Something went wrong!");
                    }
                } else {
                    displaymessage("error", "Empty Form!", "Please fill all the required details for Practical Subject!");
                }
            } else if (isset($_POST["btnsubmit3"])) {
                if (isset($_POST["pcredit2"]) && $_POST["pcredit2"] != "" && isset($_POST["phour2"]) && $_POST["phour2"] != "" &&
                        isset($_POST["cieint3"]) && $_POST["cieint3"] != "" && isset($_POST["cieext3"]) && $_POST["cieext3"] != "") {
                    $pc = trim($_POST["pcredit2"]);
                    $ph = trim($_POST["phour2"]);
                    $cieint = trim($_POST["cieint3"]);
                    $cieext = trim($_POST["cieext3"]);

                    $pcredit = dashfornull($pc);
                    $phour = dashfornull($ph);
                    $cieint3 = dashfornull($cieint);
                    $cieext3 = dashfornull($cieext);

                    $addsubject3 = new Subject();
                    $status = $addsubject->addsubject3($subcode, $subname, $eyear, $sfile, $pfile, $pcredit, $phour, $cieint3, $cieext3);
                    if ($status == 1) {
                        displaymessage("success", "Success", "Subject added successfully!");
                    } else if ($status == 2) {
                        displaymessage("error", "Error", "Subject is already added!");
                    } else {
                        displaymessage("error", "Error", "Something went wrong!");
                    }
                } else {
                    displaymessage("error", "Empty Form!", "Please fill all the required details for Practical Subject!");
                }
            } else if (isset($_POST["btnsubmit4"])) {
                if (isset($_POST["tcredit4"]) && $_POST["tcredit4"] != "" && isset($_POST["thour4"]) && $_POST["thour4"] != "" &&
                        isset($_POST["tmarksint4"]) && $_POST["tmarksint4"] != "" && isset($_POST["tmarksext4"]) && $_POST["tmarksext4"] != "" &&
                        isset($_POST["pcredit4"]) && $_POST["pcredit4"] != "" && isset($_POST["phour4"]) && $_POST["phour4"] != "" &&
                        isset($_POST["ciemarks4"]) && $_POST["ciemarks4"] != "") {
                    $tc = trim($_POST["tcredit4"]);
                    $th = trim($_POST["thour4"]);
                    $tmi = trim($_POST["tmarksint4"]);
                    $tme = trim($_POST["tmarksext4"]);
                    $pc = trim($_POST["pcredit4"]);
                    $ph = trim($_POST["phour4"]);
                    $cie = trim($_POST["ciemarks4"]);

                    $tcredit = dashfornull($tc);
                    $thour = dashfornull($th);
                    $tmarksint = dashfornull($tmi);
                    $tmarksext = dashfornull($tme);
                    $pcredit = dashfornull($pc);
                    $phour = dashfornull($ph);
                    $ciemarks = dashfornull($cie);
                    $status = $addsubject->addsubject4($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $ciemarks);
                    if ($status == 1) {
                        displaymessage("success", "Success", "Subject added successfully!");
                    } else if ($status == 2) {
                        displaymessage("error", "Error", "Suject is already added!");
                    } else {
                        displaymessage("error", "Error", "Something went wrong!");
                    }
                } else {
                    displaymessage("error", "Empty Form!", "Please fill all the required details for Subject!");
                }
            } else if (isset($_POST["btnsubmit5"])) {
                if (isset($_POST["tcredit4"]) && $_POST["tcredit4"] != "" && isset($_POST["thour4"]) && $_POST["thour4"] != "" &&
                        isset($_POST["tmarksint4"]) && $_POST["tmarksint4"] != "" && isset($_POST["tmarksext4"]) && $_POST["tmarksext4"] != "" &&
                        isset($_POST["pcredit4"]) && $_POST["pcredit4"] != "" && isset($_POST["phour4"]) && $_POST["phour4"] != "" &&
                        isset($_POST["cieint5"]) && $_POST["cieint5"] != "" && isset($_POST["cieext5"]) && $_POST["cieext5"] != "") {
                    $tc = trim($_POST["tcredit4"]);
                    $th = trim($_POST["thour4"]);
                    $tmi = trim($_POST["tmarksint4"]);
                    $tme = trim($_POST["tmarksext4"]);
                    $pc = trim($_POST["pcredit4"]);
                    $ph = trim($_POST["phour4"]);
                    $cieint = trim($_POST["cieint5"]);
                    $cieext = trim($_POST["cieext5"]);

                    $tcredit = dashfornull($tc);
                    $thour = dashfornull($th);
                    $tmarksint = dashfornull($tmi);
                    $tmarksext = dashfornull($tme);
                    $pcredit = dashfornull($pc);
                    $phour = dashfornull($ph);
                    $cieint5 = dashfornull($cieint);
                    $cieext5 = dashfornull($cieext);

                    $status = $addsubject->addsubject5($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint5, $cieext5);
                    if ($status == 1) {
                        displaymessage("success", "Success", "Subject added successfully!");
                    } else if ($status == 2) {
                        displaymessage("error", "Error", "Suject is already added!");
                    } else {
                        displaymessage("error", "Error", "Something went wrong!");
                    }
                }
                else{
                    displaymessage("error", "Empty Form!", "Please fill all the required details for Subject!");
                }
            }
        } else {
            displaymessage("error", "Empty Form!", "Please fill the required details!");
        }
    }
    ?>
    <script>
        var myfile = "";

        $('#sfile').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "docx" || ext == "doc" || ext == "DOCX" || ext == "DOC") {
                //no comments
            } else {
                alert("Please upload a document file only");
                $('#sfile').val("");
            }
        });
        $('#pfile').on('change', function () {
            myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "pdf" || ext == "PDF") {
                //no comments
            } else {
                alert("Please upload a document file only");
                $('#pfile').val("");
            }
        });
        $("#home-tab").keyup(function () {
            this.click();
        });
        $("#profile-tab").keyup(function () {
            this.click();
        });
        $("#contact-tab").keyup(function () {
            this.click();
        });
    </script>
    <!-- /.content -->
    <?php require("footer.php"); ?>
