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
                    <div class="row g-3 mb-4">
                        <div class="col">
                            <label for="selectsub" class="form-label">Select Subject</label>
                            <select id="selectsub" name="selectsub" class="form-control" required>
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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["btnsubmit"])){
            if(isset($_POST["selectsub"]) && isset($_POST["chkfaculty"]) && isset($_POST["isleader"])){
                $subid = $_POST["selectsub"];
                $facid = $_POST["chkfaculty"];
                $isleader = $_POST["isleader"]; 
                $admin = new Subject();
                $status = $admin->assignSubject($subid, $facid, $isleader);
                if($status == 1){
                    displaymessage("success", "Subject Assigned", "Subject has been assigned!");
                }
                else if($status == 2){
                    displaymessage("error", "Assigned already", "This subject has been already added for revision");
                }
                else{
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            }
            else if(isset($_POST["selectsub"]) && isset($_POST["chkfaculty"]) && !isset($_POST["isleader"])){
                displaymessage("error", "No leader is selected", "Please select a leader");
            }
            else{
                displaymessage("error", "Invalid Form", "Please fill in required details");
            }
        }
        else{
            displaymessage("error", "Invalid Request", "");
        }
    }
    ?>
    <script>
        $(document).ready(function () {
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
    </script>
    <?php require './footer.php'; ?>