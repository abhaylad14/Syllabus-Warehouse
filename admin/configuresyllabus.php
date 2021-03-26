<?php require("header.php"); ?>
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
                    <div class="form-row col-sm-10 mx-auto">
                        <div class="col-sm-2">
                            <label for="ayear" class="form-label">Academic Year</label>
                            <select id="ayear" class="form-control" name="ayear" required >
                                <option value="" selected disabled>---Select Year---</option>
                                <?php 
                                $y = date("Y");
                                for($i = 2010; $i < $y + 3; $i++){
                                    $x = strval($i + 1) ;
                                    echo "<option value='$i-$x[2]$x[3]' >$i-$x[2]$x[3]</option>";
                                }
                                ?>
<!--                                <option value="<?php
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
                                ?>"><?php echo $year; ?></option>-->
                            </select>
                        </div>
                        <div class="col-sm-3">
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
                        <div class="col">
                            <label for="sem" class="form-label">Program</label>
                            <br>
                            <input type="checkbox" id="chkint"> <label class="font-weight-normal" for="chkint"> 5 years Integrated M.Sc. IT</label>
                            <input class="ml-2" type="checkbox" id="chkbsc"> <label class="font-weight-normal" for="chkbsc"> B.Sc. IT</label>
                            <input class="ml-2" type="checkbox" id="chkmsc"> <label class="font-weight-normal" for="chkmsc"> M.Sc. IT</label>
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
                                        <th scope="col"><input type="checkbox" id="checkall"></th>
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
            <div class="container">
                <table class="table" id="tbl3">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Effective Year</th>
                            <th scope="col">Is Elective</th>
                            <th scope="col">Elective Group</th>

                        </tr>
                    </thead>
                    <tbody id="tbody3">
                    </tbody>
                </table>
            </div>
            <hr/>
            <div class="text-center mb-4">
                <button id="btnconfigure" type="button" class="btn btn-outline-primary col-sm-2">Configure Syllabus</button>
            </div>
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
                        $.ajax({
                            type: "POST",
                            url: "ajaxops.php",
                            data: {
                                data: ids,
                                action: "subjectlist1append"
                            },
                            success: function (result) {
//                                alert(result);
                                if (result) {
                                    try{
                                    let r;
                                    r = JSON.parse(result);
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
                                    $('#tbl1').DataTable({
                                        "scrollY": "300px",
                                        "scrollCollapse": true,
                                        "paging": false,
                                    });
                                }catch(err){
                                    x.innerHTML += html;
                                    $('#tbl1').DataTable({
                                        "scrollY": "300px",
                                        "scrollCollapse": true,
                                        "paging": false,
                                    });
                                }
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
            let id = "";
            let subjects = document.getElementsByClassName("subcheck");
            for (let i = 0; i < subjects.length; i++) {
                x = subjects[i].parentElement.parentElement;
                id = subjects[i].id;
                if (subjects[i].checked) {
                    html += `<tr><th scope="row">
                                        <span id="${id}" class="subid">#</span></th>
                                        <td>${x.children[1].innerText}</td>
                                        <td>${x.children[2].innerText}</td>
                                        <td>${x.children[3].innerText}</td>
                                        <td><input type="checkbox" class="chkelective" name="elective" /></td>
                                        <td><select name="group" class="form-control col-sm-4" disabled>
                                            <option value="" disabled selected>select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select></td></tr>`;
                }
                let tbl = document.getElementById("tbody3");
                tbl.innerHTML = html;
            }
            $(".chkelective").change(function () {
                let x = this.parentElement.parentElement.children[5].children[0];
                if (this.checked) {
                    x.disabled = false;
                } else {
                    x.selectedIndex = 0;
                    x.disabled = true;
                }
            });
        }

        $(document).ready(function () {
            $("#chkbsc").change(function () {
                if (this.checked) {
                    document.getElementById("chkmsc").checked = false;
                }
            });
            $("#chkmsc").change(function () {
                if (this.checked) {
                    document.getElementById("chkbsc").checked = false;
                }
            });
            $('#tbl3').DataTable({
                "searching": false
            });
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
                        try {
                            let r = JSON.parse(result);

                            let html = "";
                            for (let i = 0; i < r.length; i++) {

                                html += `<tr><th scope="row">
                                        <input type="checkbox" onclick='docheck()' class="subcheck" name="${r[i][0]}" value="${r[i][0]}" id="${r[i][0]}"></th>
                                        <td>${r[i][1]}</td>
                                        <td>${r[i][2]}</td>
                                        <td>${r[i][3]}</td>
                                        </tr>`;
                            }

                            let x = document.getElementById("tbody2");
                            x.innerHTML = html;
                            $('#tbl2').DataTable({
                                "scrollY": "300px",
                                "scrollCollapse": true,
                                "paging": false,
                                "searching": false
                            });
                        } catch (err) {
                        }
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }

                }
            });

        });
        $("#btnconfigure").click(function () {
            let academicyear = $("#ayear").val();
            let csem = $("#sem").val();
            let cpid = "";
            let chkint = document.getElementById("chkint");
            let chkbsc = document.getElementById("chkbsc");
            let chkmsc = document.getElementById("chkmsc");
            if (chkint.checked && chkbsc.checked) {
                cpid = 3;
            } else if (chkint.checked && chkmsc.checked) {
                cpid = 4;
            } else if (chkint.checked) {
                cpid = '0';
            } else if (chkbsc.checked) {
                cpid = 1;
            } else if (chkmsc.checked) {
                cpid = 2;
            }
            let sdata = {
                id: [],
                iselective: [],
                egroup: []
            };
            let iselective;
            let tbl = document.getElementById("tbody3");
            for (let i = 0; i < tbl.childElementCount; i++) {
                sdata["id"][i] = tbl.children[i].children[0].children[0].id;
                if (tbl.children[i].children[4].children[0].checked) {
                    iselective = 1;
                } else {
                    iselective = 0;
                }
                sdata["iselective"][i] = iselective;
                sdata["egroup"][i] = tbl.children[i].children[5].children[0].value;
            }
            console.log(sdata);
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    ayear: academicyear,
                    sem: csem,
                    pid: cpid,
                    subjects: sdata,
                    action: "config1"
                },
                success: function (result) {
//                    alert(result);
                    if (result == "done") {
                        displaymessage("success", "Syllabus added!", "Syllabus added successfully!");
                    } else if (result == "exists") {
                        displaymessage("error", "Record already exists!", "");
                    } else if (result == "nomatch") {
                        displaymessage("error", "Invalid Elective Subjects!", "Please select elective subjects having same details");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $("#checkall").change(function () {
            let x = document.getElementsByClassName("subcheck");
            if (this.checked) {
                for (let i = 0; i < x.length; i++) {
                    x[i].checked = true;
                }
                docheck();
            } else {
                for (let i = 0; i < x.length; i++) {
                    x[i].checked = false;
                }
                docheck();
            }
        });
    </script>
    <?php require("footer.php"); ?>