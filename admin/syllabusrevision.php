<?php require './header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Syllabus Revision</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Syllabus Revision</li>
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
                                    <td><input type="checkbox" class="chkfaculty" name="chkfaculty[]" /></td>
                                    <td><input type="radio" name="isleader" /></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "scrollY": "300px",
                "scrollCollapse": true,
                "paging": false,
            });
        });
        let num = 0;
        $("#selectnum").change(function (){
            num = this.val();
        });
        $(".chkfaculty").change(function(){
            let x = document.getElementsByClassName("chkfaculty");
            
        })
    </script>
    <!-- /.content -->
    <?php require './footer.php'; ?>