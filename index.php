<?php

require("header.php");
if (empty($_SESSION["userId"]) && empty($_SESSION["userType"])) {
    
} else {
    $utype = $_SESSION["userType"];
    if ($utype == 2) {
        header("Location: faculty/dashboard.php");
    } else if ($utype == 1) {
        header("Location: admin/dashboard.php");
    } else if ($utype == 3) {
        header("Location: director/dashboard.php");
    } else if ($utype == 4) {
        header("Location: student/dashboard.php");
    } else {
        header("Location: index.php");
    }
}
?>
<style>
    body {
        background-color: #f8f9fa !important;
    }
    .inpstyle {
        border-top: none;
        border-left: none;
        border-right: none;
    }
</style>
<div class="h-100 container">
    <div class="col-md-6 mx-auto">
        <div class="card shadow mb-5 bg-white rounded" style="margin-top:100px; margin-bottom: 100px;">
            <img class="border-1" src="Images/SyllabusWarehouse.png" height="200" alt="image error" />
            <div class="card-body col-sm-10 mx-auto ">
                <form method="post">
                    <div class="form-horizontal">
                        <div class="form-group row my-4">
                            <label for="username" class="col-sm-3">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control inpstyle" id="username" name="username" maxlength="30" placeholder="Enter email" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control inpstyle" id="password" name="password" maxlength="30" placeholder="Enter password" required />
                                <div style="float:right;"><small><a href="forgetpassword.php" class="text-muted">Forgot Password?</a></small></div>
                            </div>
                        </div>

                    </div>
                    <div class="text-center">
                        <input type="submit" name="btnlogin" value="Login" class="btn btn-outline-success px-4 my-2" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["btnlogin"])) {
        if (isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $result = checklogin($username, $password);
            if ($result == 1) {
                $id = getUserId($username);
                $utype = getUserType($id);
                $_SESSION["userId"] = $id;
                $_SESSION["userType"] = $utype;
                if ($utype == 2) {
                    //faculty
                    header("Location: faculty/dashboard.php");
                } else if ($utype == 3) {
                    //director
                    header("Location: director/dashboard.php");
                } else if ($utype == 1) {
                    //admin
                    header("Location: admin/dashboard.php");
                } else if ($utype == 0) {
                    
                }
                displaymessage("success", "Login success!", "");
            } else {
                $result = checkstudentlogin($username, $password);
                if ($result == 1) {
                    $id = getStudentId($username);
                    $_SESSION["userId"] = $id;
                    $_SESSION["userType"] = 4;
                    //students
                    header("Location: student/dashboard.php");
                } else {
                    displaymessage("error", "Invalid Credentials!", "Please enter valid Username and Password!");
                }
            }
        } else {
            displaymessage("error", "Empty form!", "Please fill the required details!");
        }
    }
}
?>
<?php require("footer.php"); ?>