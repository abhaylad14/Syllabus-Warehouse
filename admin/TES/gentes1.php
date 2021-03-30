<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <style>
            body{
                font-family: Cambria,Georgia,serif; 
            }
        </style>
        <title>TES</title>
    </head>
    <body>
        <?php
        require '../../vendor/autoload.php';
        require '../../database/adminops.php';
        $ayear = $_SESSION["ayear"];
        $sem = 1;

        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        use PhpOffice\PhpSpreadsheet\Style\Border;

$startpoint = 2;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        for ($x = 0; $x < 10; $x++) {
            $admin = new TES();
            $result1 = $admin->Tes1x1($ayear, $sem);
            $result2 = $admin->Tes1x2($ayear, $sem);
            $resulte = $admin->getElectiveGroup($ayear, $sem);
            $rowcount = count($result1) + count($result2) + count($resulte);
            $program = $admin->getProgramName($ayear, $sem);
            if ($program == 0) {
                $program = "5 years Integrated Master of Science(Information Technology)";
            } else if ($program == 1) {
                $program = "Bachelor of Science(Information Technology)";
            } else if ($program == 2) {
                $program = "Master of Science(Information Technology)";
            } else if ($program == 3) {
                $program = "5 years Integrated M.Sc.IT, B.Sc.IT";
            } else if ($program == 4) {
                $program = "5 years Integrated M.Sc.IT, M.Sc.IT";
            }
            if ($sem <= 6) {
                header1($startpoint, $rowcount, $sem, $ayear, $program, $sheet);
            } else {
                header2($startpoint, $rowcount, $sem, $ayear, $program, $sheet);
            }
            $i = $startpoint + 6;
            $c = 1;
            foreach ($result1 as $row) {
                $sheet->setCellValue('A' . $i, $c);
                $sheet->setCellValue('B' . $i, $row[11]);
                $sheet->setCellValue('C' . $i, $row[12]);
                $sheet->setCellValue('D' . $i, $row[16]);
                $th = convertToZero($row[16]);
                $sheet->setCellValue('E' . $i, $row[17]);
                $ph = convertToZero($row[17]);
                $sheet->setCellValue('F' . $i, "-");
                $sheet->setCellValue('G' . $i, $th + $ph);
                $sheet->setCellValue('H' . $i, $row[14]);
                $tc = convertToZero($row[14]);
                $sheet->setCellValue('I' . $i, $row[15]);
                $pc = convertToZero($row[15]);
                $sheet->setCellValue('J' . $i, $tc + $pc);
                $sheet->setCellValue('K' . $i, $row[20]);
                $tint = convertToZero($row[20]);
                $sheet->setCellValue('L' . $i, $row[21]);
                $text = convertToZero($row[21]);
                if ($sem <= 6) {
                    $sheet->setCellValue('M' . $i, $row[22]);
                    $cie = convertToZero($row[22]);
                    $sheet->setCellValue('N' . $i, $tint + $text + $cie);
                } else {
                    $sheet->setCellValue('M' . $i, $row[23]);
                    $pint = convertToZero($row[23]);
                    $sheet->setCellValue('N' . $i, $row[24]);
                    $pext = convertToZero($row[24]);
                    $sheet->setCellValue('O' . $i, $tint + $text + $pint + $pext);
                }
                $i++;
                $c++;
            }
            foreach ($resulte as $rows) {
                if ($sem <= 6) {
                    $sheet->mergeCells('A' . $i . ':N' . $i);
                    $sheet->setCellValue('A' . $i, "List of subjects for Elective-$rows[1] (Number of Elective Subject to be choosen 1)");
                    $sheet->getStyle('A' . $i . ':N' . $i)->getAlignment()->setHorizontal("center");
                } else {
                    $sheet->mergeCells('A' . $i . ':O' . $i);
                    $sheet->setCellValue('A' . $i, "List of subjects for Elective-$rows[1] (Number of Elective Subject to be choosen 1)");
                    $sheet->getStyle('A' . $i . ':O' . $i)->getAlignment()->setHorizontal("center");
                }
                $i++;
                $result2 = $admin->getElectiveSubjectsByGroup($ayear, $sem, $rows[1]);
                $sheet->mergeCells('D' . $i . ':D' . $i + $rows[0] - 1);
                $sheet->mergeCells('E' . $i . ':E' . $i + $rows[0] - 1);
                $sheet->mergeCells('F' . $i . ':F' . $i + $rows[0] - 1);
                $sheet->mergeCells('G' . $i . ':G' . $i + $rows[0] - 1);
                $sheet->mergeCells('H' . $i . ':H' . $i + $rows[0] - 1);
                $sheet->mergeCells('I' . $i . ':I' . $i + $rows[0] - 1);
                $sheet->mergeCells('J' . $i . ':J' . $i + $rows[0] - 1);
                $sheet->mergeCells('K' . $i . ':K' . $i + $rows[0] - 1);
                $sheet->mergeCells('L' . $i . ':L' . $i + $rows[0] - 1);
                $sheet->mergeCells('M' . $i . ':M' . $i + $rows[0] - 1);
                $sheet->mergeCells('N' . $i . ':N' . $i + $rows[0] - 1);
                if ($sem <= 6) {
                    $sheet->getStyle('D' . $i . ':N' . $i + $rows[0] - 1)->getAlignment()->setVertical("center");
                } else {
                    $sheet->mergeCells('O' . $i . ':O' . $i + $rows[0] - 1);
                    $sheet->getStyle('D' . $i . ':O' . $i + $rows[0] - 1)->getAlignment()->setVertical("center");
                }

                foreach ($result2 as $row) {
                    $sheet->setCellValue('A' . $i, $c);
                    $sheet->setCellValue('B' . $i, $row[11]);
                    $sheet->setCellValue('C' . $i, $row[12]);
                    $sheet->setCellValue('D' . $i, $row[16]);
                    $th = convertToZero($row[16]);
                    $sheet->setCellValue('E' . $i, $row[17]);
                    $ph = convertToZero($row[17]);
                    $sheet->setCellValue('F' . $i, "-");
                    $sheet->setCellValue('G' . $i, $th + $ph);
                    $sheet->setCellValue('H' . $i, $row[14]);
                    $tc = convertToZero($row[14]);
                    $sheet->setCellValue('I' . $i, $row[15]);
                    $pc = convertToZero($row[15]);
                    $sheet->setCellValue('J' . $i, $tc + $pc);
                    $sheet->setCellValue('K' . $i, $row[20]);
                    $tint = convertToZero($row[20]);
                    $sheet->setCellValue('L' . $i, $row[21]);
                    $text = convertToZero($row[21]);
                    if ($sem <= 6) {
                        $sheet->setCellValue('M' . $i, $row[22]);
                        $cie = convertToZero($row[22]);
                        $sheet->setCellValue('N' . $i, $tint + $text + $cie);
                    } else {
                        $sheet->setCellValue('M' . $i, $row[23]);
                        $pint = convertToZero($row[23]);
                        $sheet->setCellValue('N' . $i, $row[24]);
                        $pext = convertToZero($row[24]);
                        $sheet->setCellValue('O' . $i, $tint + $text + $pint + $pext);
                    }

                    $i++;
                    $c++;
                }
            }
            $startpoint = $startpoint + $rowcount + 9;
            $sem++;
        }
        $writer = new Xlsx($spreadsheet);
        $name = "GeneratedTES/Academic-year wise TES_{$_SESSION['ayear']}.xlsx";
        $writer->save("GeneratedTES/Academic-year wise TES_{$_SESSION['ayear']}.xlsx");

//        echo "<script>location.replace('$name');</script>";
        function convertToZero($val) {
            if ($val == "-") {
                $val = 0;
            }
            return $val;
        }

        function header1($startpoint, $rowcount, $sem, $ayear, $program, $sheet) {
            $headingstyle = array(
                'font' => array(
                    'bold' => true,
                    'size' => 11,
                    'name' => 'times new roman',
            ));
            $styleArray = array(
                'font' => array(
                    'size' => 11,
                    'name' => 'times new roman',
            ));
            $sheet->getStyle('A' . $startpoint . ':N' . $startpoint + $rowcount + 5)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('A' . $startpoint + 3 . ':N' . $startpoint + $rowcount + 5)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A' . $startpoint + 3 . ':N' . $startpoint + $rowcount + 5)->applyFromArray($styleArray);
            $sheet->getStyle('C' . $startpoint + 6 . ':C' . $startpoint + $rowcount + 5)->getAlignment()->setHorizontal('left');

            $sheet->mergeCells("A$startpoint:N$startpoint");
            $sheet->setCellValue('A' . $startpoint, 'Uka Tarsadia University');
            $sheet->getStyle('A' . $startpoint . ':N' . $startpoint)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A' . $startpoint . ':N' . $startpoint)->applyFromArray($headingstyle);


            $sheet->mergeCells('A' . $startpoint + 1 . ':N' . $startpoint + 1);
            $sheet->setCellValue('A' . $startpoint + 1, 'Teaching and Evaluation Scheme ');
            $sheet->getStyle('A' . $startpoint + 1 . ':N' . $startpoint + 1)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A' . $startpoint + 1 . ':N' . $startpoint + 1)->applyFromArray($headingstyle);

            $sheet->mergeCells('A' . $startpoint + 2 . ':C' . $startpoint + 2);
            $sheet->setCellValue('A' . $startpoint + 2, $program);

            $sheet->mergeCells('D' . $startpoint + 2 . ':J' . $startpoint + 2);
            $sheet->setCellValue('D' . $startpoint + 2, 'Semester: ' . $sem);

            $sheet->mergeCells('K' . $startpoint + 2 . ':N' . $startpoint + 2);
            $sheet->setCellValue('K' . $startpoint + 2, "Academic Year: " . $ayear);

            $sheet->mergeCells('A' . $startpoint + 3 . ':A' . $startpoint + 5);
            $sheet->setCellValue('A' . $startpoint + 3, 'Sr. No.');
            $sheet->getStyle('A' . $startpoint + 3 . ':A' . $startpoint + 5)->getAlignment()->setVertical('center');

            $sheet->mergeCells('B' . $startpoint + 3 . ':B' . $startpoint + 5);
            $sheet->setCellValue('B' . $startpoint + 3, 'Course Code');
            $sheet->getStyle('B' . $startpoint + 3 . ':B' . $startpoint + 5)->getAlignment()->setVertical('center');

            $sheet->mergeCells('C' . $startpoint + 3 . ':C' . $startpoint + 5);
            $sheet->setCellValue('C' . $startpoint + 3, 'Course Title');
            $sheet->getStyle('C' . $startpoint + 3 . ':C' . $startpoint + 5)->getAlignment()->setVertical('center');

            $sheet->mergeCells('D' . $startpoint + 3 . ':G' . $startpoint + 3);
            $sheet->setCellValue('D' . $startpoint + 3, 'Teaching Scheme Hours');

            $sheet->mergeCells('D' . $startpoint + 4 . ':D' . $startpoint + 5);
            $sheet->setCellValue('D' . $startpoint + 4, 'Theory');
            $sheet->getStyle('D' . $startpoint + 4 . ':D' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('E' . $startpoint + 4 . ':E' . $startpoint + 5);
            $sheet->setCellValue('E' . $startpoint + 4, 'Practical');
            $sheet->getStyle('E' . $startpoint + 4 . ':E' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('F' . $startpoint + 4 . ':F' . $startpoint + 5);
            $sheet->setCellValue('F' . $startpoint + 4, 'Tutorial');
            $sheet->getStyle('F' . $startpoint + 4 . ':F' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('G' . $startpoint + 4 . ':G' . $startpoint + 5);
            $sheet->setCellValue('G' . $startpoint + 4, 'Total');
            $sheet->getStyle('G' . $startpoint + 4 . ':G' . $startpoint + 5)->getAlignment()->setVertical('center');

            $sheet->mergeCells('H' . $startpoint + 3 . ':J' . $startpoint + 3);
            $sheet->setCellValue('H' . $startpoint + 3, 'Credits');

            $sheet->mergeCells('H' . $startpoint + 4 . ':H' . $startpoint + 5);
            $sheet->setCellValue('H' . $startpoint + 4, 'Theory');
            $sheet->getStyle('H' . $startpoint + 4 . ':H' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('I' . $startpoint + 4 . ':I' . $startpoint + 5);
            $sheet->setCellValue('I' . $startpoint + 4, 'Practical');
            $sheet->getStyle('I' . $startpoint + 4 . ':I' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('J' . $startpoint + 4 . ':J' . $startpoint + 5);
            $sheet->setCellValue('J' . $startpoint + 4, 'Total');
            $sheet->getStyle('J' . $startpoint + 4 . ':J' . $startpoint + 5 . '')->getAlignment()->setVertical('center');

            $sheet->mergeCells('K' . $startpoint + 3 . ':M' . $startpoint + 3);
            $sheet->setCellValue('K' . $startpoint + 3, 'Examination Marks');

            $sheet->mergeCells('K' . $startpoint + 4 . ':L' . $startpoint + 4);
            $sheet->setCellValue('K' . $startpoint + 4, 'Theory');
            $sheet->setCellValue('M' . $startpoint + 4, 'Practical');
            $sheet->setCellValue('K' . $startpoint + 5, 'Internal');
            $sheet->setCellValue('L' . $startpoint + 5, 'External');
            $sheet->setCellValue('M' . $startpoint + 5, 'CIE');

            $sheet->mergeCells('N' . $startpoint + 3 . ':N' . $startpoint + 5);
            $sheet->setCellValue('N' . $startpoint + 3, 'Total Marks');
            $sheet->getStyle('N' . $startpoint + 3 . ':N' . $startpoint + 5)->getAlignment()->setVertical('center');
        }

        function header2($startpoint, $rowcount, $sem, $ayear, $program, $sheet) {
            $headingstyle = array(
                'font' => array(
                    'bold' => true,
                    'size' => 11,
                    'name' => 'times new roman',
            ));
            $styleArray = array(
                'font' => array(
                    'size' => 11,
                    'name' => 'times new roman',
            ));
            $sheet->getStyle('A' . $startpoint . ':O' . $startpoint + $rowcount + 5)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('A' . $startpoint + 3 . ':O' . $startpoint + $rowcount + 5)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A' . $startpoint + 3 . ':O' . $startpoint + $rowcount + 5)->applyFromArray($styleArray);
            $sheet->getStyle('C' . $startpoint + 6 . ':C' . $startpoint + $rowcount + 5)->getAlignment()->setHorizontal('left');

            $sheet->mergeCells("A$startpoint:O$startpoint");
            $sheet->setCellValue('A' . $startpoint, 'Uka Tarsadia University');
            $sheet->getStyle('A' . $startpoint . ':O' . $startpoint)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A' . $startpoint . ':O' . $startpoint)->applyFromArray($headingstyle);


            $sheet->mergeCells('A' . $startpoint + 1 . ':O' . $startpoint + 1);
            $sheet->setCellValue('A' . $startpoint + 1, 'Teaching and Evaluation Scheme ');
            $sheet->getStyle('A' . $startpoint + 1 . ':O' . $startpoint + 1)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A' . $startpoint + 1 . ':O' . $startpoint + 1)->applyFromArray($headingstyle);

            $sheet->mergeCells('A' . $startpoint + 2 . ':C' . $startpoint + 2);
            $sheet->setCellValue('A' . $startpoint + 2, $program);

            $sheet->mergeCells('D' . $startpoint + 2 . ':J' . $startpoint + 2);
            $sheet->setCellValue('D' . $startpoint + 2, 'Semester: ' . $sem);

            $sheet->mergeCells('K' . $startpoint + 2 . ':O' . $startpoint + 2);
            $sheet->setCellValue('K' . $startpoint + 2, "Academic Year: " . $ayear);

            $sheet->mergeCells('A' . $startpoint + 3 . ':A' . $startpoint + 5);
            $sheet->setCellValue('A' . $startpoint + 3, 'Sr. No.');
            $sheet->getStyle('A' . $startpoint + 3 . ':A' . $startpoint + 5)->getAlignment()->setVertical('center');

            $sheet->mergeCells('B' . $startpoint + 3 . ':B' . $startpoint + 5);
            $sheet->setCellValue('B' . $startpoint + 3, 'Course Code');
            $sheet->getStyle('B' . $startpoint + 3 . ':B' . $startpoint + 5)->getAlignment()->setVertical('center');

            $sheet->mergeCells('C' . $startpoint + 3 . ':C' . $startpoint + 5);
            $sheet->setCellValue('C' . $startpoint + 3, 'Course Title');
            $sheet->getStyle('C' . $startpoint + 3 . ':C' . $startpoint + 5)->getAlignment()->setVertical('center');

            $sheet->mergeCells('D' . $startpoint + 3 . ':G' . $startpoint + 3);
            $sheet->setCellValue('D' . $startpoint + 3, 'Teaching Scheme Hours');

            $sheet->mergeCells('D' . $startpoint + 4 . ':D' . $startpoint + 5);
            $sheet->setCellValue('D' . $startpoint + 4, 'Theory');
            $sheet->getStyle('D' . $startpoint + 4 . ':D' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('E' . $startpoint + 4 . ':E' . $startpoint + 5);
            $sheet->setCellValue('E' . $startpoint + 4, 'Practical');
            $sheet->getStyle('E' . $startpoint + 4 . ':E' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('F' . $startpoint + 4 . ':F' . $startpoint + 5);
            $sheet->setCellValue('F' . $startpoint + 4, 'Tutorial');
            $sheet->getStyle('F' . $startpoint + 4 . ':F' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('G' . $startpoint + 4 . ':G' . $startpoint + 5);
            $sheet->setCellValue('G' . $startpoint + 4, 'Total');
            $sheet->getStyle('G' . $startpoint + 4 . ':G' . $startpoint + 5)->getAlignment()->setVertical('center');

            $sheet->mergeCells('H' . $startpoint + 3 . ':J' . $startpoint + 3);
            $sheet->setCellValue('H' . $startpoint + 3, 'Credits');

            $sheet->mergeCells('H' . $startpoint + 4 . ':H' . $startpoint + 5);
            $sheet->setCellValue('H' . $startpoint + 4, 'Theory');
            $sheet->getStyle('H' . $startpoint + 4 . ':H' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('I' . $startpoint + 4 . ':I' . $startpoint + 5);
            $sheet->setCellValue('I' . $startpoint + 4, 'Practical');
            $sheet->getStyle('I' . $startpoint + 4 . ':I' . $startpoint + 5)->getAlignment()->setVertical('center');
            $sheet->mergeCells('J' . $startpoint + 4 . ':J' . $startpoint + 5);
            $sheet->setCellValue('J' . $startpoint + 4, 'Total');
            $sheet->getStyle('J' . $startpoint + 4 . ':J' . $startpoint + 5 . '')->getAlignment()->setVertical('center');

            $sheet->mergeCells('K' . $startpoint + 3 . ':N' . $startpoint + 3);
            $sheet->setCellValue('K' . $startpoint + 3, 'Examination Marks');

            $sheet->mergeCells('K' . $startpoint + 4 . ':L' . $startpoint + 4);
            $sheet->setCellValue('K' . $startpoint + 4, 'Theory');
            $sheet->mergeCells('M' . $startpoint + 4 . ':N' . $startpoint + 4);
            $sheet->setCellValue('M' . $startpoint + 4, 'Practical');
            $sheet->setCellValue('K' . $startpoint + 5, 'Internal');
            $sheet->setCellValue('L' . $startpoint + 5, 'External');
            $sheet->setCellValue('M' . $startpoint + 5, 'Internal');
            $sheet->setCellValue('N' . $startpoint + 5, 'External');

            $sheet->mergeCells('O' . $startpoint + 3 . ':O' . $startpoint + 5);
            $sheet->setCellValue('O' . $startpoint + 3, 'Total Marks');
            $sheet->getStyle('O' . $startpoint + 3 . ':O' . $startpoint + 5)->getAlignment()->setVertical('center');
        }
        ?>
        <div class="container my-5">
            <h3>Your Download will begin soon...</h3>
            <p>If your download does not start... <a href="<?php echo $name; ?>" id="link">Click here to Download file</a></p>
        </div>
        <script>
            let x = document.getElementById("link");
            x.click();
        </script>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
        -->
    </body>
</html>