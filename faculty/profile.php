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
    <div class="content">
        <div class="card col-sm-10 mx-auto">
            <div class="card-body">
                <div class="mx-auto">
                    <div class="text-center">
                        <img src="<?php echo $data[7]; ?>" id="profile" alt="profilepic" class="img-fluid rounded-circle" height="100" width="100" /><br />
                        <button type="button" id="changeimage" data-bs-toggle="modal" data-bs-target="#pp" class="btn btn-sm btn-secondary mt-2">Change Profile Picture</button>
                    </div>
                    <hr />
                    <div class="row col-sm-8 mx-auto">
                        <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                                <label for="fname">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" maxlength="50" value='<?php echo $data[4]; ?>' required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" placeholder="Email" value='<?php echo $data[1]; ?>' disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row col-sm-8 mx-auto">

                        <div class="col pl-md-1">
                            <div class="form-group">
                                <label for="lname">Contact</label>
                                <input type="text" class="form-control" id="cnum" name="cnum" placeholder="Contact Number" maxlength="10" value='<?php echo $data[5]; ?>' required>
                            </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control">
                                    <?php if ($data[6] == "m") { ?>
                                        <option value="m" selected>Male</option>
                                        <option value="f">Female</option>
                                    <?php } else { ?>
                                        <option value="m">Male</option>
                                        <option value="f" selected>Female</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 pl-md-1 mt-2">
                            <div class="form-group">
                                <br />
                                <button class="btn btn-sm btn-block btn-secondary" id="cp" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-center bg-white">
                <input type="submit" class="btn btn-outline-primary px-4" id="btnsave" value="Save" />
            </div>
        </div>
    </div>
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

    <!-- update profile picture Modal -->
    <div class="modal fade" id="pp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Change Profile Picture</h5>
                        <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <img id="preview" height="100" width="100" class="img-fluid mb-3" />
                            <input type="file" name="imgprofile" class="form-control" id="imgprofile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning" name="btnupdate" id="btn-update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["imgprofile"]) && isset($_POST["btnupdate"])) {

            $allowedExts = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
            $filename = $_FILES["imgprofile"]["name"];
            $now = new DateTime();
            $extension = explode(".", $filename);
            $extension = $extension[1];
            if ((($_FILES["imgprofile"]["type"] == "image/jpeg") || ($_FILES["imgprofile"]["type"] == "image/jpg") || ($_FILES["imgprofile"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
                if ($_FILES["imgprofile"]["size"] < 200000) {
                    $profile = $now->getTimestamp() . "." . $extension;
                    
                    $status = updateProfilePicture($_SESSION["userId"], $profile);
                    if ($status == 1) {
                        displaymessage("success", "Profile Picture changed!", "Your profile picture have been updated successfully!");
                        $target_dir = "../images/profile/";
                        $target_file = $target_dir . basename($_FILES["imgprofile"]["name"]);
                        move_uploaded_file($_FILES["imgprofile"]["tmp_name"], $target_file);
                        rename("../images/profile/" . $_FILES["imgprofile"]["name"], "../images/profile/" . $profile);
                        $profile = "../images/profile/" . $profile;
                        echo "<script>$('#profile').attr('src','$profile');</script>";
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                } else {
                    displaymessage("error", "File is too large!", "Image size should be less than 2 MB!");
                }
            } else {
                displaymessage("error", "Invalid Format!", "Only jpg,jpeg and png image files are allowed!");
            }
        } else {
            displaymessage("error", "Empty Form!", "No image found!");
        }
    }
    ?>
    <script>
        $("#btnsave").click(function () {
            let uname = $("#name").val();
            let ucontact = $("#cnum").val();
            let ugender = $("#gender").val();
            $.ajax({
                type: "POST",
                url: "../openajax.php",
                data: {
                    name: uname,
                    contact: ucontact,
                    gender: ugender,
                    action: "updateprofile"
                },
                success: function (result) {
                    result = result.trim();
                    if (result == "done") {
                        displaymessage("success", "Profile Updated!", "Your profile has been updated successfully!");
                    } else if (result == "empty") {
                        displaymessage("error", "Empty Form!", "Please fill the required details!");
                    } else {
                        displaymessage("error", "Error!", "Something went wrong!");
                    }
                }
            });
        });
        $("#btnsubmit").click(function () {
            $.ajax({
                type: "POST",
                url: "../openajax.php",
                data: {
                    opass: $("#opass").val(),
                    pass1: $("#pass1").val(),
                    pass2: $("#pass2").val(),
                    action: "changepassword"
                },
                success: function (result) {
                    result = result.trim();
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgprofile").change(function () {
            readURL(this);
        });
    </script>
    <!-- /.content -->
    <?php require 'footer.php'; ?>