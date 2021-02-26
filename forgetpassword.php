<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'header.php';
// Load Composer's autoloader
require 'vendor/autoload.php';
?>
<div class="h-100">
    <div class="col-sm-5 mx-auto">
        <div class="card shadow mb-5 bg-white rounded" style="margin-top:100px; margin-bottom: 100px;">
            <form method="post">
                <div class="card-body col-sm-10 mx-auto ">
                    <h5 class="text-center">Forgot Password</h5>
                    <hr />
                    <div class="form-horizontal">
                        <div class="form-group row my-4">
                            <label for="username" class="col-sm-3">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" maxlength="30" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Enter email" required />
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Send OTP" class="btn btn-success px-4 my-2" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) && isset($_POST["email"])) {
        $email = trim($_POST["email"]);
        $result = checkEmail($email);
        if ($result == 1) {
            $otp = rand(100000, 999999);
            $subject = "Syllabus Warehouse";
            $message = "Your OTP for change password is: $otp Please do not share your OTP with anyone else.";


            $status = sendEmail($email, $subject, $message);
            if ($status == 1) {
                $_SESSION["otp"] = $otp;
                $_SESSION["email"] = $email;
                header("Location: verifyotp.php");
            } else {
                displaymessage("error", "Error!", "Something went wrong while sending email!");
            }
        } else {
            displaymessage("error", "Invalid Email!", "Your Email is not registered!");
        }
    } else {
        displaymessage("error", "Empty Form!", "Email address is required!");
    }
}
?>
<?php require 'footer.php'; ?>