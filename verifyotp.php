<?php
require 'header.php';
if ($_SESSION["otp"] == "") {
    header("Location: index.php");
}
?>
<!-- Reset password Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reset Password</h5>
                <button type="button" class="fas fa-times bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pass1" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Enter your password" required maxlength="30" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                               title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" >
                    </div>
                    <div class="mb-3">
                        <label for="pass2" class="form-label">Re-Enter New Password</label>
                        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Re-Enter your password" required maxlength="30" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="btnsubmit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="h-100">
    <div class="col-sm-5 mx-auto">
        <div class="card shadow mb-5 bg-white rounded" style="margin-top:100px; margin-bottom: 100px;">
            <form method="post">
                <div class="card-body col-sm-10 mx-auto ">
                    <h5 class="text-center">Verify OTP</h5>
                    <hr />
                    <div class="form-horizontal">
                        <div class="form-group row my-4">
                            <label for="username" class="col-sm-3">OTP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="txtotp" name="txtotp" maxlength="6" placeholder="Enter OTP" required />
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="verify" value="Verify" class="btn btn-success px-4 my-2" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["verify"])) {
        if (!empty($_POST["txtotp"]) && isset($_POST["txtotp"])) {
            $otp = trim($_POST["txtotp"]);
            if ($otp == $_SESSION["otp"]) {
                echo "<script>var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));myModal.toggle();</script>";
            } else {
                displaymessage("error", "Invalid OTP!", "Please enter valid OTP");
            }
        } else {
            displaymessage("error", "Empty Form!", "Please enter your OTP");
        }
    } else if (isset($_POST["btnsubmit"])) {
        if (!empty($_POST["pass1"]) && isset($_POST["pass1"]) && !empty($_POST["pass2"]) && isset($_POST["pass2"])) {
            $pass1 = $_POST["pass1"];
            $pass2 = $_POST["pass2"];
            if ($pass1 == $pass2) {
                $status = resetPassword($_SESSION["email"], $pass1);
                if ($status == 1) {
                    header("Location: index.php");
                } else {
                    displaymessage("error", "Error!", "Something went wrong!");
                }
            } else {
                displaymessage("error", "Password does not match!", "Password and Re-Enter Password are not same");
            }
        } else {
            displaymessage("error", "Empty Form!", "Please enter required details");
        }
    } else {
        displaymessage("error", "Error", "Invalid form submission");
    }
}
?>
<?php require 'footer.php'; ?>