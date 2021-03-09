<?php require("header.php");?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Configure Syllabus</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Configure Syllabus</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="card col mx-auto">
            <div class="card-body">
                <form>
                    <div class="form-row col-sm-6 mx-auto">
                        <div class="col">
                            <label for="ayear" class="form-label">Academic Year</label>
                            <select id="ayear" class="form-control" name="ayear" required >
                                <option value="" selected disabled>---Select Year---</option>
                                <option value="<?php
                                $y = date("Y");
                                $y1 = $y - 1;
                                $year = $y1 . "-" . $y[2] . $y[3];

                                echo $year;
                                ?>"><?php echo $year; ?></option>
                                <option value="<?php
                                $y = date("Y");
                                $y1 = $y + 1;
                                $y1 = str_split($y1);
                                // $y1 = explode(".", $y1);
                                $year = $y . "-" . $y1[2] . $y1[3];
                                echo $year;
                                ?>"><?php echo $year; ?></option>
                                <option value="<?php
                                $y = date("Y") + 1;
                                $y1 = $y + 1;
                                $y1 = str_split($y1);
                                // $y1 = explode(".", $y1);
                                $year = $y . "-" . $y1[2] . $y1[3];
                                echo $year;
                                ?>"><?php echo $year; ?></option>


                            </select>
                        </div>
                        <div class="col">
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
                    </div>
                    <hr/>
                    <h4 class="text-center bg-secondary">Select Subjects</h4>
                    <hr/>
                    <div class="form-row col mx-auto mt-4">
                        <div class="col-sm-6">
                            <label for="subjects" class="form-label">Subject list:</label>
                            <table class="table" id="tbl1">
                                <thead class="table-secondary">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Effective Year</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody1">
<!--                                    <tr>
                                        <th scope="row"><input type="checkbox" name="" value=""></th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <label for="subjects" class="form-label">Newly added subjects:</label>
                            <table class="table" id="tbl2">
                                <thead class="table-secondary">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Effective Year</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody2">
<!--                                    <tr>
                                        <th scope="row"><input type="checkbox" name="" value=""></th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <hr/>
            <table class="table" id="tbl3">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Effective Year</th>
                    </tr>
                </thead>
                <tbody id="tbody3">
<!--                                    <tr>
                        <th scope="row"><input type="checkbox" name="" value=""></th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>-->
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.content -->
    <script>
        let ids = [];
        $("#sem").change(function () {
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    academicyear: $("#ayear").val(),
                    sem: $("#sem").val(),
                    action: "subjectlist1"
                },
                success: function (result) {

                    if (result) {
                        let r = JSON.parse(result);
                        let html = "";
                        for (let i = 0; i < r.length; i++) {
                            ids[i] = r[i][0];
                            html += `<tr><th scope="row">
                                        <input type="checkbox" onclick='docheck()' class="subcheck" name="${r[i][0]}" value="${r[i][0]}" id="${r[i][0]}" checked></th>
                                        <td>${r[i][1]}</td>
                                        <td>${r[i][2]}</td>
                                        <td>${r[i][3]}</td></tr>`;
                        }

                        let x = document.getElementById("tbody1");
                        x.innerHTML = html;
                        //displaymessage("success", "Success!", "User restored successfully!");
                        $.ajax({
                            type: "POST",
                            url: "ajaxops.php",
                            data: {
                                data: ids,
                                action: "subjectlist1append"
                            },
                            success: function (result) {
                    alert(result);
                                if (result) {
                                    let r = JSON.parse(result);
                                    let html = "";
                                    for (let i = 0; i < r.length; i++) {

                                        html += `<tr><th scope="row">
                                        <input type="checkbox" onclick='docheck()' class="subcheck" name="${r[i][0]}" value="${r[i][0]}" id="${r[i][0]}"></th>
                                        <td>${r[i][1]}</td>
                                        <td>${r[i][2]}</td>
                                        <td>${r[i][3]}</td></tr>`;
                                    }

                                    let x = document.getElementById("tbody1");
                                    x.innerHTML += html;
//                        displaymessage("success", "Success!", "User successfully!");
                                } else {
                                    displaymessage("error", "Error!", "Something went wrong!");
                                }
                            }
                        });
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                    docheck();
                }
            });

        });
        function docheck() {
            let html = "";
            let x = "";
            let subjects = document.getElementsByClassName("subcheck");
            for (let i = 0; i < subjects.length; i++) {
                x = subjects[i].parentElement.parentElement;
                if (subjects[i].checked) {
                    html += `<tr><th scope="row">
                                        <span class="subid">${i+1}</span></th>
                                        <td>${x.children[1].innerText}</td>
                                        <td>${x.children[2].innerText}</td>
                                        <td>${x.children[3].innerText}</td></tr>`;
                }
                let tbl = document.getElementById("tbody3");
                tbl.innerHTML = html;
            }
        }
        
        $(document).ready(function () {
            $('#tbl1').DataTable({
                "scrollY": "300px",
                "scrollCollapse": true,
                "paging": false
            });
            $('#tbl2').DataTable({
                "scrollY": "300px",
                "scrollCollapse": true,
                "paging": false
            });
            $('#tbl3').DataTable();
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    academicyear: $("#ayear").val(),
                    sem: $("#sem").val(),
                    action: "subjectlist2"
                },
                success: function (result) {

                    if (result) {
                        let r = JSON.parse(result);
                        let html = "";
                        for (let i = 0; i < r.length; i++) {

                            html += `<tr><th scope="row">
                                        <input type="checkbox" onclick='docheck()' class="subcheck" name="${r[i][0]}" value="${r[i][0]}" id="${r[i][0]}"></th>
                                        <td>${r[i][1]}</td>
                                        <td>${r[i][2]}</td>
                                        <td>${r[i][3]}</td></tr>`;
                        }

                        let x = document.getElementById("tbody2");
                        x.innerHTML = html;
                        // displaymessage("success", "Success!", "User restored successfully!");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });

        });
    </script>
    <?php require("footer.php");?>