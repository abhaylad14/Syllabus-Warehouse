<?php
require "header.php";
if (empty($_SESSION["ayear"])) {
    header("Location: tes.php");
}
?>
<style>
    .center{
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Academic-year wise subjects TES</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Academic-year wise subjects TES</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?php
        $ayear = $_SESSION["ayear"];
        $program = $_SESSION["pid"];

        function convertToZero($val) {
            if ($val == "-") {
                $val = 0;
            }
            return $val;
        }

        if ($program == 0) {
            $start = 1;
            $end = 10;
            $sem = 1;
        } else if ($program == 1) {
            $start = 1;
            $end = 6;
            $sem = 1;
        } else if ($program == 2) {
            $start = 7;
            $end = 10;
            $sem = 7;
        }
        $admin = new TES;
        $all = 1;
        for ($x = $start; $x <= $end; $x++) {

            if ($program == 0) {
                $program = "5 years Integrated Master of Science(Information Technology)";
            } else if ($program == 1) {
                $program = "Bachelor of Science(Information Technology)";
            } else if ($program == 2) {
                $program = "Master of Science(Information Technology)";
            }
            ?>
            <hr />
            <?php if ($all == 1) { ?>
                <div class="text-center mr-2"><a id="dwall" class="btn btn-primary mb-2">Download All TES</a></div>
            <?php } $all++; ?>
            <div class="text-right mr-2"><a class="btn btn-outline-success btntes" target="_blank" href="TES/generateTES1.php?sem=<?php echo $sem; ?>">Download TES for Semester: <?php echo $sem; ?></a></div>
            <hr/>
            <table class="table-responsive-md table-bordered table" >
                <thead class="table-primary">
                    <?php
                    if ($sem <= 6) {
                        ?>
                        <tr>
                            <th colspan="14" class="text-center">Uka Tarsadia University</th>
                        </tr>
                        <tr>
                            <th colspan="14" class="text-center">Teaching Evaluation Scheme</th>
                        </tr>
                        <tr>
                            <td colspan="3">Programme Name: <?php echo $program; ?></td>
                            <td colspan="7">Semester: <?php echo $sem; ?></td>
                            <td colspan="4">Academic Year: <?php echo $_SESSION["ayear"]; ?></td>
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
                            <td colspan="8">Semester: <?php echo $sem; ?></td>
                            <td colspan="4">Academic Year: <?php echo $_SESSION["ayear"]; ?></td>
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
                    $result1 = $admin->genericTesx1($ayear, $sem, $_SESSION["pid"]);

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
                            <?php if ($sem <= 6) { ?>
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
                    $eresult = $admin->getElectiveGroup($ayear, $sem);
                    foreach ($eresult as $rows) {
                        $result2 = $admin->genericTesx2($ayear, $sem, $rows[1], $_SESSION["pid"]);
                        if ($sem <= 6) {
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
                                    <?php if ($sem <= 6) { ?>
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
            <?php
            $sem++;
        }
        ?>
    </div>
    <script>
        $("#dwall").click(function () {
            let x = document.getElementsByClassName("btntes");
            for(let i = 0; i < x.length; i++){
                x[i].click();
            }
        });
    </script>
    <!-- /.content -->
    <?php require("footer.php"); ?>
