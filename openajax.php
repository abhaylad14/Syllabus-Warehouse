<?php

session_start();
require_once ("./database/adminops.php");
require_once ("./database/openops.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "updateprofile") {
        if (!empty($_POST["name"]) && isset($_POST["name"]) && !empty($_POST["gender"]) && isset($_POST["gender"]) && !empty($_POST["contact"]) && isset($_POST["contact"])) {
            $name = $_POST["name"];
            $contact = $_POST["contact"];
            $gender = $_POST["gender"];
            $status = updateProfile($_SESSION["userId"], $name, $contact, $gender);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "empty";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "changepassword") {
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
    }
    else if(isset($_POST["action"]) && $_POST["action"] == "acceptsubject"){
        if(isset($_POST["id"]) && !empty($_POST["id"])){
            $id = $_POST["id"];
            $status = acceptSubject($id);
            if($status == 1){
                echo "done";
            }
            else{
                echo "error";
            }
        }
        else{
            echo "error";
        }
    }
    else if(isset($_POST["action"]) && $_POST["action"] == "rejectsubject"){
        if(isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["comments"]) && !empty($_POST["comments"])){
            $id = $_POST["id"];
            $comments = trim($_POST["comments"]);
            $status = rejectSubject($id, $comments);
            if($status == 1){
                echo "done";
            }
            else{
                echo "error";
            }
        }
        else{
            echo "error";
        }
    }
}
?>