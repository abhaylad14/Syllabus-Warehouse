<?php require 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr/>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <?php
    $email = getAdminEmail($_SESSION["userId"]);
    ?>
    <div class="content">
        <div class="card col-sm-4 mx-auto">
            <div class="card-body">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="<?php echo $email; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <button type="button" id="password" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-block btn-secondary btn-sm">Change Password</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <!-- Change password Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                    <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="opass" class="form-label">Enter Current Password</label>
                        <input type="password" class="form-control" id="opass" name="opass" placeholder="Enter your current password" required maxlength="30">
                    </div>
                    <div class="mb-3">
                        <label for="pass1" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Enter your password" required maxlength="30">
                    </div>
                    <div class="mb-3">
                        <label for="pass2" class="form-label">Re-Enter New Password</label>
                        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Re-Enter your password" required maxlength="30">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="btnsubmit" name="btnsubmit" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#btnsubmit").click(function () {
            $.ajax({
                type: "POST",
                url: "ajaxops.php",
                data: {
                    opass: $("#opass").val(),
                    pass1: $("#pass1").val(),
                    pass2: $("#pass2").val(),
                    action: "changepassword"
                },
                success: function (result) {
                    if (result == "done") {
                        displaymessage("success", "Success!", "Your password is successfully updated!");
                    } else if (result == "error") {
                        displaymessage("error", "Error!", "Something went wrong!");
                    } else if (result == "err2") {
                        displaymessage("error", "Password does not match!", "Password and Re-Enter Password are not same!");
                    } else if (result == "err3") {
                        displaymessage("error", "Current Password does not match!", "Please enter a valid current Password!");
                    } else {
                        displaymessage("error", "Empty Form!", "Please enter required details!");
                    }
                    $("#opass").val('');
                    $("#pass1").val('');
                    $("#pass2").val('');

                }
            });
        });
    </script>
<?php require 'footer.php'; ?>
