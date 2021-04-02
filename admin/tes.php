<?php require "header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Teaching Evaluation Scheme</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">TES</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container col-sm-8 overflow-hidden">
            <div class="gy-5">
                <div class="mx-auto col-sm-6 mt-4">
                    <button data-bs-toggle="modal" data-bs-target="#tes1modal" class="p-3 border border-primary bg-light btn-block text-center">Academic-year wise subjects</button>
                </div>
                <div class="mx-auto col-sm-6 mt-4">
                    <button data-bs-toggle="modal" data-bs-target="#tes2modal" class="p-3 border border-primary bg-light btn-block text-center">Academic-year + semester wise subjects</button>
                </div>
                <div class="mx-auto col-sm-6 mt-4">
                    <button data-bs-toggle="modal" data-bs-target="#tes3modal" class="p-3 border border-primary bg-light btn-block text-center">Term wise subjects</button>
                </div>
                <div class="mx-auto col-sm-6 mt-4">
                    <button data-bs-toggle="modal" data-bs-target="#tes4modal" class="p-3 border border-primary bg-light btn-block text-center">Term + sem wise subjects</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <!-- TES1 Modal -->
    <div class="modal fade" id="tes1modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Academic-year wise TES</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <label for="selectyear">Select Academic Year</label>
                        <select id="ayear" class="form-control" name="ayear" required >
                            <option value="" selected disabled>---Select Year---</option>
                            <?php
                            $y = date("Y");
                            for ($i = 2010; $i < $y + 3; $i++) {
                                $x = strval($i + 1);
                                echo "<option value='$i-$x[2]$x[3]' >$i-$x[2]$x[3]</option>";
                            }
                            ?></select>
                        <label for="pid1">Select Programme</label>
                        <select id="pid1" class="form-control" name="pid" required >
                            <option value="" selected disabled>---Select Programme---</option>
                            <option value="0">5 years Integrated M.Sc. IT</option>
                            <option value="1">B.Sc. IT</option>
                            <option value="2">M.Sc. IT</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="gentes1" class="btn btn-success" >Generate TES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- TES2 Modal -->
    <div class="modal fade" id="tes2modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Different semesters subject wise TES</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <label for="selectyear">Select Academic Year</label>
                        <select id="ayear" class="form-control" name="ayear" required >
                            <option value="" selected disabled>---Select Year---</option>
                            <?php
                            $y = date("Y");
                            for ($i = 2010; $i < $y + 3; $i++) {
                                $x = strval($i + 1);
                                echo "<option value='$i-$x[2]$x[3]' >$i-$x[2]$x[3]</option>";
                            }
                            ?></select>
                        <label for="pid2">Select Programme</label>
                        <select id="pid2" class="form-control" name="pid" required >
                            <option value="" selected disabled>---Select Programme---</option>
                            <option value="0">5 years Integrated M.Sc. IT</option>
                            <option value="1">B.Sc. IT</option>
                            <option value="2">M.Sc. IT</option>
                        </select>
                        <label for="sem" class="form-label">Semester</label>
                        <select id="sem" name="sem" class="form-control" required>
                            <option selected disabled value="">---Select Semester---</option>
                            <option id="sem1" value="1">1</option>
                            <option id="sem2" value="2">2</option>
                            <option id="sem3" value="3">3</option>
                            <option id="sem4" value="4">4</option>
                            <option id="sem5" value="5">5</option>
                            <option id="sem6" value="6">6</option>
                            <option id="sem7" value="7">7</option>
                            <option id="sem8" value="8">8</option>
                            <option id="sem9" value="9">9</option>
                            <option id="sem10" value="10">10</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="gentes2" class="btn btn-success" >Generate TES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- TES3 Modal -->
    <div class="modal fade" id="tes3modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Term wise subjects</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <label for="selectyear">Select Academic Year</label>
                        <select id="ayear" class="form-control" name="ayear" required >
                            <option value="" selected disabled>---Select Year---</option>
                            <?php
                            $y = date("Y");
                            for ($i = 2010; $i < $y + 3; $i++) {
                                $x = strval($i + 1);
                                echo "<option value='$i-$x[2]$x[3]' >$i-$x[2]$x[3]</option>";
                            }
                            ?></select>
                        <label for="pid1">Select Programme</label>
                        <select id="pid1" class="form-control" name="pid" required >
                            <option value="" selected disabled>---Select Programme---</option>
                            <option value="0">5 years Integrated M.Sc. IT</option>
                            <option value="1">B.Sc. IT</option>
                            <option value="2">M.Sc. IT</option>
                        </select>
                        <label for="term">Select Term</label>
                        <select id="term" class="form-control" name="term" required >
                            <option value="" selected disabled>---Select Term---</option>
                            <option value="1">Winter (ODD)</option>
                            <option value="2">Summer (EVEN)</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="gentes3" class="btn btn-success" >Generate TES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- TES4 Modal -->
    <div class="modal fade" id="tes4modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Term wise subjects</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <label for="selectyear">Select Academic Year</label>
                        <select id="ayear" class="form-control" name="ayear" required >
                            <option value="" selected disabled>---Select Year---</option>
                            <?php
                            $y = date("Y");
                            for ($i = 2010; $i < $y + 3; $i++) {
                                $x = strval($i + 1);
                                echo "<option value='$i-$x[2]$x[3]' >$i-$x[2]$x[3]</option>";
                            }
                            ?></select>
                        <label for="pid4">Select Programme</label>
                        <select id="pid4" class="form-control" name="pid" required >
                            <option value="" selected disabled>---Select Programme---</option>
                            <option value="0">5 years Integrated M.Sc. IT</option>
                            <option value="1">B.Sc. IT</option>
                            <option value="2">M.Sc. IT</option>
                        </select>
                        <label for="xterm">Select Term</label>
                        <select id="xterm" class="form-control" name="term" required >
                            <option value="" selected disabled>---Select Term---</option>
                            <option value="1">Winter (ODD)</option>
                            <option value="2">Summer (EVEN)</option>
                        </select>
                        <label for="tsem" class="form-label">Semester</label>
                        <select id="tsem" name="sem" class="form-control" required>
                            <option selected disabled value="">---Select Semester---</option>
                            <option id="sem1" value="1">1</option>
                            <option id="sem2" value="2">2</option>
                            <option id="sem3" value="3">3</option>
                            <option id="sem4" value="4">4</option>
                            <option id="sem5" value="5">5</option>
                            <option id="sem6" value="6">6</option>
                            <option id="sem7" value="7">7</option>
                            <option id="sem8" value="8">8</option>
                            <option id="sem9" value="9">9</option>
                            <option id="sem10" value="10">10</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="gentes4" class="btn btn-success" >Generate TES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#pid2").change(function () {
                let x = $("#pid2").val();
                let sem = document.getElementById("sem");
                if (x == 1) {
                    sem.options[1].style.display = "block";
                    sem.options[2].style.display = "block";
                    sem.options[3].style.display = "block";
                    sem.options[4].style.display = "block";
                    sem.options[5].style.display = "block";
                    sem.options[6].style.display = "block";
                    sem.options[7].style.display = "none";
                    sem.options[8].style.display = "none";
                    sem.options[9].style.display = "none";
                    sem.options[10].style.display = "none";
                } else if (x == 2) {
                    sem.options[1].style.display = "none";
                    sem.options[2].style.display = "none";
                    sem.options[3].style.display = "none";
                    sem.options[4].style.display = "none";
                    sem.options[5].style.display = "none";
                    sem.options[6].style.display = "none";
                    sem.options[7].style.display = "block";
                    sem.options[8].style.display = "block";
                    sem.options[9].style.display = "block";
                    sem.options[10].style.display = "block";
                } else {
                    sem.options[1].style.display = "block";
                    sem.options[2].style.display = "block";
                    sem.options[3].style.display = "block";
                    sem.options[4].style.display = "block";
                    sem.options[5].style.display = "block";
                    sem.options[6].style.display = "block";
                    sem.options[7].style.display = "block";
                    sem.options[8].style.display = "block";
                    sem.options[9].style.display = "block";
                    sem.options[10].style.display = "block";
                }
            })
            $("#xterm").change(function () {
                let pid = $("#pid4").val();
                let x = $("#xterm").val();
                let sem = document.getElementById("tsem");
                if (pid == 0 && x == 1) {
                    sem.options[1].style.display = "block";
                    sem.options[2].style.display = "none";
                    sem.options[3].style.display = "block";
                    sem.options[4].style.display = "none";
                    sem.options[5].style.display = "block";
                    sem.options[6].style.display = "none";
                    sem.options[7].style.display = "block";
                    sem.options[8].style.display = "none";
                    sem.options[9].style.display = "block";
                    sem.options[10].style.display = "none";
                } else if (pid == 0 && x == 2) {
                    sem.options[1].style.display = "none";
                    sem.options[2].style.display = "block";
                    sem.options[3].style.display = "none";
                    sem.options[4].style.display = "block";
                    sem.options[5].style.display = "none";
                    sem.options[6].style.display = "block";
                    sem.options[7].style.display = "none";
                    sem.options[8].style.display = "block";
                    sem.options[9].style.display = "none";
                    sem.options[10].style.display = "block";
                } else if (pid == 1 && x == 1) {
                    sem.options[1].style.display = "block";
                    sem.options[2].style.display = "none";
                    sem.options[3].style.display = "block";
                    sem.options[4].style.display = "none";
                    sem.options[5].style.display = "block";
                    sem.options[6].style.display = "none";
                    sem.options[7].style.display = "none";
                    sem.options[8].style.display = "none";
                    sem.options[9].style.display = "none";
                    sem.options[10].style.display = "none";
                }
                else if (pid == 1 && x == 2) {
                    sem.options[1].style.display = "none";
                    sem.options[2].style.display = "block";
                    sem.options[3].style.display = "none";
                    sem.options[4].style.display = "block";
                    sem.options[5].style.display = "none";
                    sem.options[6].style.display = "block";
                    sem.options[7].style.display = "none";
                    sem.options[8].style.display = "none";
                    sem.options[9].style.display = "none";
                    sem.options[10].style.display = "none";
                }
                else if (pid == 2 && x == 1) {
                    sem.options[1].style.display = "none";
                    sem.options[2].style.display = "none";
                    sem.options[3].style.display = "none";
                    sem.options[4].style.display = "none";
                    sem.options[5].style.display = "none";
                    sem.options[6].style.display = "none";
                    sem.options[7].style.display = "block";
                    sem.options[8].style.display = "none";
                    sem.options[9].style.display = "block";
                    sem.options[10].style.display = "none";
                }
                else if (pid == 2 && x == 2) {
                    sem.options[1].style.display = "none";
                    sem.options[2].style.display = "none";
                    sem.options[3].style.display = "none";
                    sem.options[4].style.display = "none";
                    sem.options[5].style.display = "none";
                    sem.options[6].style.display = "none";
                    sem.options[7].style.display = "none";
                    sem.options[8].style.display = "block";
                    sem.options[9].style.display = "none";
                    sem.options[10].style.display = "block";
                }
            });
        });
    </script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["gentes1"]) && isset($_POST["ayear"]) && isset($_POST["pid"])) {
            $_SESSION["ayear"] = $_POST["ayear"];
            $_SESSION["pid"] = $_POST["pid"];
            header("Location: tes1.php");
        } else if (isset($_POST["gentes2"]) && isset($_POST["ayear"]) && isset($_POST["pid"]) && isset($_POST["sem"])) {
            $_SESSION["ayear"] = $_POST["ayear"];
            $_SESSION["pid"] = $_POST["pid"];
            $_SESSION["sem"] = $_POST["sem"];
            header("Location: tes2.php");
        } else if (isset($_POST["gentes3"]) && isset($_POST["ayear"]) && isset($_POST["pid"]) && isset($_POST["term"])) {
            $_SESSION["ayear"] = $_POST["ayear"];
            $_SESSION["pid"] = $_POST["pid"];
            $_SESSION["term"] = $_POST["term"];
            header("Location: tes3.php");
        }
        else if (isset($_POST["gentes4"]) && isset($_POST["ayear"]) && isset($_POST["pid"]) && isset($_POST["term"]) && isset($_POST["sem"])) {
            $_SESSION["ayear"] = $_POST["ayear"];
            $_SESSION["pid"] = $_POST["pid"];
            $_SESSION["term"] = $_POST["term"];
            $_SESSION["sem"] = $_POST["sem"];
            header("Location: tes2.php");
        }
    }
    ?>

    <?php require("footer.php"); ?>
