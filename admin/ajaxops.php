<?php

session_start();
require_once ("../database/adminops.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "changepassword") {
        if (!empty($_POST["opass"]) && isset($_POST["opass"]) && !empty($_POST["pass1"]) && isset($_POST["pass1"]) && !empty($_POST["pass2"]) && isset($_POST["pass2"])) {
            $pass1 = $_POST["pass1"];
            $pass2 = $_POST["pass2"];
            $opass = $_POST["opass"];
            $result = checkPassword($opass, $_SESSION["userId"]);
            if ($result == 1) {
                if ($pass1 == $pass2) {
                    $status = ChangePassword($pass1, $_SESSION["userId"]);
                    if ($status == 1) {
                        echo "done";
                    } else {
                        echo "error";
                    }
                } else {
                    echo "err2";
                }
            } else {
                echo "err3";
            }
        } else {
            echo "empty";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "deleteuser") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new User();
            $status = $admin->deleteUser($id);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "changestatus") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $ustatus = $_POST["ustatus"];
            $admin = new User();
            $status = $admin->changeUserStatus($id, $ustatus);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "updateuser") {
        if (!empty($_POST["id"]) && isset($_POST["id"]) && !empty($_POST["uname"]) && isset($_POST["uname"]) 
                && !empty($_POST["ucontact"]) && isset($_POST["ucontact"]) && !empty($_POST["uemail"]) && isset($_POST["uemail"])
                && !empty($_POST["ugender"]) && isset($_POST["ugender"])) {
            $id = $_POST["id"];
            $name = $_POST["uname"];
            $email = $_POST["uemail"];
            $contact = $_POST["ucontact"];
            $gender = $_POST["ugender"];
            $admin = new User();
            $status = $admin->updateUser($id, $name, $email, $contact, $gender);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } 
    else if (isset($_POST["action"]) && $_POST["action"] == "restoreuser") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new User();
            $status = $admin->restoreUser($id);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
    else {
        echo "error";
    }
}
?>