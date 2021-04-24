<?php require './header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subject Revision</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Subject Revision</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="card col-sm-6 mx-auto">
            <div class="card-body">
                <form method="post">
                    <div class="row g-3 mb-2">
                        <div class="col-sm-1"><input type="radio" id="rbtn1" name="selection"/></div>
                        <div class="col">
                            <label for="inpsub" class="form-label">Enter Subject</label>
                            <input type="text" id="inpsub" class="form-control" maxlength="100" name="subject" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col">
                            <div class="row">
                                <div class="col-sm-1"><input type="radio" id="rbtn2" name="selection" /></div>
                                <div class="col">
                                    <label for="selectsub" class="form-label">Select Subject</label>
                                    <select id="selectsub" name="subject" class="form-control" required>
                                        <option value="" selected disabled>--- Select Subject ---</option>
                                        <?php
                                        $sub = new Subject();
                                        $result = $sub->displaysubjects();
                                        foreach ($result as $row) {
                                            ?>
                                            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?> - <?php echo $row[2]; ?> - <?php echo $row[3]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="selectnum" class="form-label">Members</label>
                            <select class="form-control" id="selectnum" name="selectnum" required >
                                <option selected disabled value="">---</option>
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
                    <table class="table" id="tbl1">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Select</th>
                                <th scope="col">Select Leader</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user = new User();
                            $result = $user->displayUsers();
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <th scope="row">#</th>
                                    <td><?php echo $row[4]; ?></td>
                                    <td><input type="checkbox" value="<?php echo $row[0]; ?>" class="chkfaculty" name="chkfaculty[]" /></td>
                                    <td><input type="radio" value="<?php echo $row[0]; ?>" class="isleader" name="isleader" /></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-primary mt-2">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["btnsubmit"])) {
            if (isset($_POST["subject"]) && isset($_POST["chkfaculty"]) && isset($_POST["isleader"])) {
                $subject = $_POST["subject"];
                $facid = $_POST["chkfaculty"];
                $isleader = $_POST["isleader"];
                $admin = new Subject();
                $status = $admin->assignSubject($subject, $facid, $isleader);
                if ($status == 1) {
                    displaymessage("success", "Subject Assigned", "Subject has been assigned!");
                } else if ($status == 2) {
                    displaymessage("error", "Assigned already", "This subject has been already added for revision");
                } else {
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            } else if (isset($_POST["selectsub"]) && isset($_POST["chkfaculty"]) && !isset($_POST["isleader"])) {
                displaymessage("error", "No leader is selected", "Please select a leader");
            } else {
                displaymessage("error", "Invalid Form", "Please fill in required details");
            }
        } else {
            displaymessage("error", "Invalid Request", "");
        }
    }
    ?>
    <script>
        $(document).ready(function () {
            document.getElementById("rbtn1").checked = true;
            document.getElementById("selectsub").disabled = true;
            $('.table').DataTable({
                "scrollY": "200px",
                "scrollCollapse": true,
                "paging": false,
            });
            $("#btnsubmit").prop('disabled', true);
            $(".isleader").prop('disabled', true);
        });
        let num = 0;
        $("#selectnum").change(function () {
            num = $("#selectnum").val();
        });

        $(".chkfaculty").change(function () {
            let count = 0;
            this.parentElement.parentElement.children[3].children[0].disabled = false;
            let x = document.getElementsByClassName("chkfaculty");
            for (let i = 0; i < x.length; i++) {
                if (x[i].checked) {
                    count++;
                } else {
                    x[i].parentElement.parentElement.children[3].children[0].disabled = true;
                }
            }
            if (count == num) {
                $("#btnsubmit").prop('disabled', false);
            } else {
                $("#btnsubmit").prop('disabled', true);
            }
        });

        let rbtn1 = document.getElementById("rbtn1");
        let rbtn2 = document.getElementById("rbtn2");
        $("#rbtn1, #rbtn2").change(function(){
        if (rbtn1.checked){
        document.getElementById("selectsub").disabled = true;
                document.getElementById("inpsub").disabled = false;
        }
        else if (rbtn2.checked){
        document.getElementById("selectsub").disabled = false;
                document.getElementById("inpsub").disabled = true;
        }
        }
        );

    </script>
    <?php require './footer.php'; ?>