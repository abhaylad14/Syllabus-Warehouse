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
        <div class="card col-sm-10 mx-auto">
            <div class="card-body">
                <form>
                    <div class="form-row col-sm-6 mx-auto">
                        <div class="col">
                            <label for="ayear" class="form-label">Academic Year</label>
                            <input type="text" class="form-control" id="ayear" name="ayear" placeholder="eg. 2020-21" pattern="^[0-9]{4}-[0-9][0-9]$" maxlength="7" required>
                        </div>
                        <div class="col">
                            <label for="inputPassword4" class="form-label">Semester</label>
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
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php require("footer.php"); ?>