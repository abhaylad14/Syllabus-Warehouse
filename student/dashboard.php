<?php require("header.php"); ?>
<div class="container my-4">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link bg-transparent active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-announcement" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                <i class="fas fa-bullhorn"></i> Announcements</button>
            <button class="nav-link bg-transparent" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
            <button class="nav-link bg-transparent" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                <i class="fas fa-user-cog"></i> Profile</button>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-announcement" role="tabpanel" aria-labelledby="nav-announcement-tab">
            <!--Announcements-->
            <?php
            $result = displayAnnouncements();
            foreach ($result as $row) {
                ?>
                <div class="card mt-3 col-xl-7  col-sm-6 mx-auto">
                    <div class="card-header">
                        <strong class="text-primary"><i class="fas fa-thumbtack text-muted mx-2"></i> <?php echo $row[1]; ?></strong>
                    </div>
                    <div class="card-body">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><p> <?php echo $row[2]; ?></p></li>
                            <li class="list-group-item"><strong>Date: </strong> <?php echo $row[3]; ?></li>
                            <li class="list-group-item"><strong>By: </strong> <?php echo $row[5]; ?></li>
                            <li class="list-group-item"><strong>Attachment: </strong><?php
                                if ($row[4] != "") {
                                    echo "<a href='$row[4]' class='mx-2' target='_blank'>View</a>";
                                } else {
                                    echo "No Attachment";
                                }
                                ?></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="content my-4">
                <div class="card col-sm-4 mx-auto">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="enro" class="form-label">Enrollment No.</label>
                            <input type="text" class="form-control" id="enro" placeholder="<?php echo $data[1]; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="<?php echo $data[2]; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label col-sm-4">Password</label>
                            <button type="button" id="password" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-secondary btn-sm col-sm-7">Change Password</button>
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
                        url: "../openajax.php",
                        data: {
                            opass: $("#opass").val(),
                            pass1: $("#pass1").val(),
                            pass2: $("#pass2").val(),
                            action: "changeStudentPassword"
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
            </script>
        </div>

    </div>
</div>
<?php require("footer.php"); ?>