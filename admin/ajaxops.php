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
        if (!empty($_POST["id"]) && isset($_POST["id"]) && !empty($_POST["uname"]) && isset($_POST["uname"]) && !empty($_POST["ucontact"]) && isset($_POST["ucontact"]) && !empty($_POST["uemail"]) && isset($_POST["uemail"]) && !empty($_POST["ugender"]) && isset($_POST["ugender"])) {
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
    } else if (isset($_POST["action"]) && $_POST["action"] == "restoreuser") {
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
    } else if (isset($_POST["action"]) && $_POST["action"] == "subjectlist1") {
        if (!empty($_POST["academicyear"]) && isset($_POST["academicyear"]) && !empty($_POST["sem"]) && isset($_POST["sem"])) {
            $ayear = $_POST["academicyear"];
            $sem = $_POST["sem"];
            $admin = new Subject();
            $status = $admin->ViewSubjectList1($ayear, $sem);
            if ($status != null) {
                $json = json_encode($status);
                echo $json;
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "subjectlist1append") {
        $data = $_POST["data"];
        $admin = new Subject();
        $status = $admin->ViewSubjectList1Append($data);
        if ($status != null) {
            $json = json_encode($status);
            echo $json;
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "subjectlist2") {
        $admin = new Subject();
        $status = $admin->ViewSubjectList2();
        if ($status != null) {
            $json = json_encode($status);
            echo $json;
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "config1") {
        if (!empty($_POST["ayear"]) && isset($_POST["ayear"]) && !empty($_POST["sem"]) && isset($_POST["sem"]) && $_POST["pid"] != null) {
            $ayear = $_POST["ayear"];
            $sem = $_POST["sem"];
            $pid = $_POST["pid"];
            $data = $_POST["subjects"];
            $admin = new Subject();
            $status = $admin->config1($ayear, $sem, $pid, $data);
            if ($status == 1) {
                echo "done";
            } else if ($status == 2) {
                echo "exists";
            } else if ($status == 3) {
                echo "nomatch";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "deletesubject") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new Subject();
            $status = $admin->deleteSubject($id);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "viewmembers") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new Subject();
            $status = $admin->viewMembers($id);
            if ($status >= 1) {
                $json = json_encode($status);
                echo $json;
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
        
    }
    else if (isset($_POST["action"]) && $_POST["action"] == "viewremarks") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new Subject();
            $status = $admin->viewRemarks($id);
            if ($status >= 1) {
                $json = json_encode($status);
                echo $json;
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
        
    }
    else if (isset($_POST["action"]) && $_POST["action"] == "updateBOS") {
        if (!empty($_POST["id"]) && isset($_POST["id"]) && !empty($_POST["name"]) && isset($_POST["name"]) &&
                !empty($_POST["venue"]) && isset($_POST["venue"]) && !empty($_POST["date"]) && isset($_POST["date"])) {
            $id = $_POST["id"];
            $mname = trim($_POST["name"]);
            $mvenue = trim($_POST["venue"]);
            $mdate = $_POST["date"];
            $admin = new Subject();
            $status = $admin->updateBOSdetails($id, $mname, $mvenue, $mdate);
            if ($status >= 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "empty";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "deleteBOS") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new Subject();
            $status = $admin->deleteBOSdetails($id);
            if ($status >= 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "changeStudentstatus") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $ustatus = $_POST["ustatus"];
            $admin = new Student();
            $status = $admin->changeStudentStatus($id, $ustatus);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "updateStudent") {
        if (!empty($_POST["id"]) && isset($_POST["id"]) && !empty($_POST["uname"]) && isset($_POST["uname"]) && !empty($_POST["uenro"]) && isset($_POST["uenro"]) && !empty($_POST["uemail"]) && isset($_POST["uemail"])) {
            $id = $_POST["id"];
            $name = $_POST["uname"];
            $email = $_POST["uemail"];
            $enro = $_POST["uenro"];
            $admin = new Student();
            $status = $admin->updateStudent($id, $name, $email, $enro);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "empty";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "deleteStudent") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new Student();
            $status = $admin->deleteStudent($id);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "deleteAnnouncement") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new User();
            $status = $admin->deleteAnnouncement($id);
            if ($status >= 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "updateAnnouncement") {
        if (!empty($_POST["id"]) && isset($_POST["id"]) && !empty($_POST["title"]) && isset($_POST["title"]) && !empty($_POST["message"]) && isset($_POST["message"])) {
            $id = $_POST["id"];
            $title = $_POST["title"];
            $message = $_POST["message"];
            $admin = new User();
            $status = $admin->updateAnnouncement($id, $title, $message);
            if ($status == 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "empty";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "deleteconfig") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new Subject();
            $status = $admin->deleteConfig($id);
            if ($status >= 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else if (isset($_POST["action"]) && $_POST["action"] == "publishconfig") {
        if (!empty($_POST["id"]) && isset($_POST["id"])) {
            $id = $_POST["id"];
            $admin = new Subject();
            $status = $admin->publishConfig($id);
            if ($status >= 1) {
                echo "done";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>