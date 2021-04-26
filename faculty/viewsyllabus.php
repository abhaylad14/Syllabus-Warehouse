<?php
require './header.php';
$y = date("Y") - 1;
$x = strval($y + 1);
$ayear = $y . '-' . $x[2] . $x[3];
if (empty($_SESSION["pid"])) {
    $_SESSION["pid"] = 0;
}
if ($_SESSION["pid"] == 0) {
    $program = "5 years Integrated Master of Science(Information Technology)";
} else if ($_SESSION["pid"] == 1) {
    $program = "Bachelor of Science(Information Technology)";
} else if ($_SESSION["pid"] == 2) {
    $program = "Master of Science(Information Technology)";
}
if (empty($_SESSION["sem"])) {
    $_SESSION["sem"] = 1;
}

function convertToZero($val) {
    if ($val == "-") {
        $val = 0;
    }
    return $val;
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Syllabus</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">View Syllabus</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card bg-light border-primary">
            <div class="card-body">
                <form method="post">
                    <div class="row col-sm-8 mx-auto">
                        <div class="col-sm-4">
                            <label for="pid" class="form-label">Course</label>
                            <select id="pid" class="form-control" name="pid" required >
                                <option value="" selected disabled>---Select Course---</option>
                                <option value="0">5 years Integrated M.Sc. IT</option>
                                <option value="1">B.Sc. IT</option>
                                <option value="2">M.Sc. IT</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="sem" class="form-label">Semester</label>
                            <select id="sem" name="sem" class="form-control" required>
                                <option selected disabled value="">---Select Semester---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select> 
                        </div>
                        <div class="col-sm-2" >
                            <br/>
                            <button type="submit" name="btnview" class="mt-2 btn btn-primary px-4">View</button>
                        </div>
                    </div>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["btnview"]) && isset($_POST["pid"]) && isset($_POST["sem"])) {
                        $_SESSION["pid"] = $_POST["pid"];
                        $_SESSION["sem"] = $_POST["sem"];
//                    echo '<script>location.reload();</script>';
                    } else {
                        displaymessage("error", "Error", "Something went wrong!");
                    }
                }
                ?>
                <hr/>
                <table class="table-responsive-md table-bordered table" >
                    <thead class="table-primary">
                        <?php
                        if ($_SESSION["sem"] <= 6) {
                            ?>
                            <tr>
                                <th colspan="14" class="text-center">Uka Tarsadia University</th>
                            </tr>
                            <tr>
                                <th colspan="14" class="text-center">Teaching Evaluation Scheme</th>
                            </tr>
                            <tr>
                                <td colspan="3">Programme Name: <?php echo $program; ?></td>
                                <td colspan="7">Semester: <?php echo $_SESSION["sem"]; ?></td>
                                <td colspan="4">Academic Year: <?php echo $ayear; ?></td>
                            </tr>   
                            <tr class="text-center">
                                <td rowspan="3" colspan="1" class="align-middle">Sr. No.</td>
                                <td rowspan="3" colspan="1" class="align-middle">Course Code</td>
                                <td rowspan="3" colspan="1" class="align-middle">Course Title</td>
                                <td rowspan="1" colspan="4" class="align-middle">Teaching Scheme Hours</td>
                                <td rowspan="1" colspan="3" class="align-middle">Credits</td>
                                <td rowspan="1" colspan="3" class="align-middle">Examination Marks</td>
                                <td rowspan="3" colspan="1" class="align-middle">Total Marks</td>
                            </tr>
                            <tr class="text-center">
                                <td rowspan="2" colspan="1" class="align-middle" >Theory</td>
                                <td rowspan="2" colspan="1" class="align-middle">Practical</td>
                                <td rowspan="2" colspan="1" class="align-middle">Tutorial</td>
                                <td rowspan="2" colspan="1" class="align-middle">Total</td>
                                <td rowspan="2" colspan="1" class="align-middle">Theory</td>
                                <td rowspan="2" colspan="1" class="align-middle">Practical</td>
                                <td rowspan="2" colspan="1" class="align-middle">Total</td>
                                <td rowspan="1" colspan="2" class="align-middle">Theory</td>
                                <td rowspan="1" colspan="1" class="align-middle">Practical</td>
                            </tr>
                            <tr class="text-center">
                                <td>Internal</td>
                                <td>External</td>
                                <td>CIE</td>
                            </tr>
<?php } else { ?>
                            <tr>
                                <th colspan="15" class="text-center">Uka Tarsadia University</th>
                            </tr>
                            <tr>
                                <th colspan="15" class="text-center">Teaching Evaluation Scheme</th>
                            </tr>
                            <tr>
                                <td colspan="3">Programme Name: <?php echo $program; ?></td>
                                <td colspan="8">Semester: <?php echo $_SESSION["sem"]; ?></td>
                                <td colspan="4">Academic Year: <?php echo $ayear; ?></td>   
                            </tr>   
                            <tr class="text-center">
                                <td rowspan="3" colspan="1" class="align-middle">Sr. No.</td>
                                <td rowspan="3" colspan="1" class="align-middle">Course Code</td>
                                <td rowspan="3" colspan="1" class="align-middle">Course Title</td>
                                <td rowspan="1" colspan="4" class="align-middle">Teaching Scheme Hours</td>
                                <td rowspan="1" colspan="3" class="align-middle">Credits</td>
                                <td rowspan="1" colspan="4" class="align-middle">Examination Marks</td>
                                <td rowspan="3" colspan="1" class="align-middle">Total Marks</td>
                            </tr>
                            <tr class="text-center">
                                <td rowspan="2" colspan="1" class="align-middle" >Theory</td>
                                <td rowspan="2" colspan="1" class="align-middle">Practical</td>
                                <td rowspan="2" colspan="1" class="align-middle">Tutorial</td>
                                <td rowspan="2" colspan="1" class="align-middle">Total</td>
                                <td rowspan="2" colspan="1" class="align-middle">Theory</td>
                                <td rowspan="2" colspan="1" class="align-middle">Practical</td>
                                <td rowspan="2" colspan="1" class="align-middle">Total</td>
                                <td rowspan="1" colspan="2" class="align-middle">Theory</td>
                                <td rowspan="1" colspan="2" class="align-middle">Practical</td>
                            </tr>
                            <tr class="text-center">
                                <td>Internal</td>
                                <td>External</td>
                                <td>Internal</td>
                                <td>External</td>
                            </tr>
<?php } ?>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $result1 = genericTesx1($ayear, $_SESSION["sem"], $_SESSION["pid"]);
                        if ($_SESSION["sem"] <= 6) {
                            $colspan = 14;
                        } else {
                            $colspan = 15;
                        }
                        if (count($result1) == 0) {
                            ?>
                            <tr>
                                <td colspan="<?php echo $colspan; ?>" class="text-center"> 
                                    No data available
                                </td>
                            </tr>
                        <?php
                        }
                        foreach ($result1 as $row) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td><?php echo $row[11]; ?></td>
                                <td><?php echo $row[12]; ?></td>
                                <td class="text-center"><?php
                                    echo $row[16];
                                    $th = convertToZero($row[16]);
                                    ?></td>
                                <td class="text-center"><?php
                                    echo $row[17];
                                    $ph = convertToZero($row[17]);
                                    ?></td>
                                <td class="text-center">-</td>
                                <td class="text-center"><?php echo $th + $ph; ?></td>
                                <td class="text-center"><?php
                                    echo $row[14];
                                    $tc = convertToZero($row[14]);
                                    ?></td>
                                <td class="text-center"><?php
                                    echo $row[15];
                                    $pc = convertToZero($row[15]);
                                    ?></td>
                                <td class="text-center"><?php echo $tc + $pc; ?></td>
                                <td class="text-center"><?php
                                    echo $row[20];
                                    $tint = convertToZero($row[20]);
                                    ?></td>
                                <td class="text-center"><?php
                                    echo $row[21];
                                    $text = convertToZero($row[21]);
                                    ?></td>
                                    <?php if ($_SESSION["sem"] <= 6) { ?>
                                    <td class="text-center"><?php
                                        echo $row[22];
                                        $cie = convertToZero($row[22]);
                                        ?></td>
                                    <td class="text-center"><?php echo $tint + $text + $cie; ?></td>
                                    <?php } else { ?>
                                    <td class="text-center"><?php
                                        echo $row[23];
                                        $pint = convertToZero($row[23]);
                                        ?></td>
                                    <td class="text-center"><?php
                                        echo $row[24];
                                        $pext = convertToZero($row[24]);
                                        ?></td>
                                    <td class="text-center"><?php echo $tint + $text + $pint + $pext; ?></td>
                            <?php } ?>

                            </tr>
                            <?php
                            $i++;
                        }
                        $eresult = getElectiveGroup($ayear, $_SESSION["sem"]);
                        foreach ($eresult as $rows) {
                            $result2 = genericTesx2($ayear, $_SESSION["sem"], $rows[1], $_SESSION["pid"]);
                            if ($_SESSION["sem"] <= 6) {
                                $colspan = 14;
                            } else {
                                $colspan = 15;
                            }
                            ?>
                            <tr>
                                <td colspan="<?php echo $colspan; ?>" class="text-center">List of subjects for Elective-<?php echo $rows[1]; ?> (Number of Elective Subject to be choosen 1)</td>
                            </tr>

                            <?php
                            $z = 1;
                            foreach ($result2 as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row[11]; ?></td>
                                    <td><?php echo $row[12]; ?></td>
                                    <?php
                                    if ($z == 1) {
                                        $z++;
                                        ?>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                            echo $row[16];
                                            $th = convertToZero($row[16]);
                                            ?></td>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                            echo $row[17];
                                            $ph = convertToZero($row[17]);
                                            ?></td>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>">-</td>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php echo $th + $ph; ?></td>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                            echo $row[14];
                                            $tc = convertToZero($row[14]);
                                            ?></td>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                            echo $row[15];
                                            $pc = convertToZero($row[15]);
                                            ?></td>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php echo $tc + $pc; ?></td>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                            echo $row[20];
                                            $tint = convertToZero($row[20]);
                                            ?></td>
                                        <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                            echo $row[21];
                                            $text = convertToZero($row[21]);
                                            ?></td>
                                            <?php if ($_SESSION["sem"] <= 6) { ?>
                                            <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                                echo $row[22];
                                                $cie = convertToZero($row[22]);
                                                ?></td>
                                            <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php echo $tint + $text + $cie; ?></td>
                                            <?php } else { ?>
                                            <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                                echo $row[23];
                                                $pint = convertToZero($row[23]);
                                                ?></td>
                                            <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php
                                                echo $row[24];
                                                $pext = convertToZero($row[24]);
                                                ?></td>
                                            <td class="align-middle text-center" rowspan="<?php echo $rows[0]; ?>"><?php echo $tint + $text + $pint + $pext; ?></td>
                                            <?php
                                            $i++;
                                        }
                                        ?>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <script>
        let link = document.getElementById("viewsyllabus");
        link.classList.add("text-info");
        $("#pid").change(function () {
            let x = $("#pid").val();
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
        });
    </script>
<?php require './footer.php'; ?>