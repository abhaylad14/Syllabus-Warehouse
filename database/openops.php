<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("connection.php");
?>

<?php

function checklogin($username, $password) {
    $objcon = new connection();
    $con = $objcon->connect();
    $password = hash('sha256', $password);
    $sql = "select count(*) from tbl_users where Username = :uname and Password = :pass and Status = 0";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["uname" => $username, "pass" => $password]);
        $status = $stmt->fetchColumn();
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function checkstudentlogin($username, $password) {
    $objcon = new connection();
    $con = $objcon->connect();
    $password = hash('sha256', $password);
    $sql = "select count(*) from tbl_students where Username = :uname and Password = :pass and Status = 0";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["uname" => $username, "pass" => $password]);
        $status = $stmt->fetchColumn();
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function getStudentId($email) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select Id from tbl_students where Username = :email";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["email" => $email]);
        $status = $stmt->fetchColumn();
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function getUserId($email) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select Id from tbl_users where Username = :email";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["email" => $email]);
        $status = $stmt->fetchColumn();
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function getUserType($id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select UserType from tbl_users where Id = :id";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["id" => $id]);
        $status = $stmt->fetchColumn();
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function checkEmail($email) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select count(*) from tbl_users where Username = :email";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["email" => $email]);
        $status = $stmt->fetchColumn();
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function checkStudentEmail($email) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select count(*) from tbl_students where Username = :email";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["email" => $email]);
        $status = $stmt->fetchColumn();
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function sendEmail($email, $subject, $message) {
    $mail = new PHPMailer(true);
    //Server settings                    // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = 'ladaebs14@gmail.com';                     // SMTP username
    $mail->Password = 'Abhay@123';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('ladaebs14@gmail.com', 'Abhay');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $status = 0;
    try {
        $status = $mail->send();
        $status = 1;
    } catch (Exception $ex) {
//        echo $ex;
    }
    return $status;
}

function resetPassword($email, $pass) {
    $objcon = new connection();
    $con = $objcon->connect();
    $pass = hash("sha256", $pass);
    if ($_SESSION["utype"] == "user") {
        $sql = "update tbl_users set Password = :pass where Username = :email";
    } else if ($_SESSION["utype"] == "student") {
        $sql = "update tbl_students set Password = :pass where Username = :email";
    }
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["pass" => $pass, "email" => $email]);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function getUserData($id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select * from tbl_users where Id = :id";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["id" => $id]);
        $status = $stmt->fetch(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function getStudentData($id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select * from tbl_students where Id = :id";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["id" => $id]);
        $status = $stmt->fetch(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function updateProfile($id, $name, $contact, $gender) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "update tbl_users set Fullname = :name, Contact = :contact, Gender = :gender where Id = :id";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["name" => $name, "contact" => $contact, "gender" => $gender, "id" => $id]);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function updateProfilePicture($id, $profile) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "update tbl_users set ProfileImage = :profile where Id = :id";
    $profile = "../images/profile/" . $profile;
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["profile" => $profile, "id" => $id]);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function acceptSubject($id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "update tbl_syllabus_config_assign set Status = '1', Comments ='',VerifyDate=CURDATE() where Subject = :id";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["id" => $id]);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function rejectSubject($id, $comments) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "update tbl_syllabus_config_assign set Status = '2', Comments=:comments where Subject = :id";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["id" => $id, "comments" => $comments]);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function displayAnnouncements() {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select a.id, a.Title, a.Message, a.AnnounceDate, a.attachment, u.FullName, a.Status "
            . "from tbl_announcements a INNER JOIN tbl_users u on a.UserId = u.Id where a.Status = 0 "
            . "order by Id desc";
    $stmt = $con->prepare($sql);
    try {
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        $status = 0;
    }
    $objcon->disconnect();
    return $status;
}

function checkStudentPassword($pass, $id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $pass = hash("sha256", $pass);
    $sql = "select count(*) from tbl_students where id = :id and Password = :pass";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["id" => $id, "pass" => $pass]);
        $status = $stmt->fetchColumn();
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function ChangeStudentPassword($pass, $id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $pass = hash("sha256", $pass);
    $sql = "update tbl_students set Password = :pass where id = :id";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute(["pass" => $pass, "id" => $id]);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function genericTesx1($ayear, $sem, $pid) {
    $objcon = new connection();
    $con = $objcon->connect();
    $status = 0;
    try {
        if ($pid == 0) {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem and t.IsElective = '0' and (m.ProgramId ='0' or m.ProgramId = '3' or m.ProgramId = '4') "
                    . "and m.PublishedOn != ''";
        } else if ($pid == 1) {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem and t.IsElective = '0' and (m.ProgramId ='1' or m.ProgramId = '3') "
                    . "and m.PublishedOn != ''";
        } else if ($pid == 2) {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem and t.IsElective = '0' and (m.ProgramId ='2' or m.ProgramId = '4') "
                    . "and m.PublishedOn != ''";
        }
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem]);
        $status = $stmt->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function getElectiveSubjectsByGroup($ayear, $sem, $groupno) {
    $objcon = new connection();
    $con = $objcon->connect();
    $status = 0;
    try {
        $sql = "SELECT *, t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                . ":ayear and m.Sem =:sem and t.IsElective = '1' and t.ElectiveGroup = :group "
                . "and m.PublishedOn != ''";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem, "group" => $groupno]);
        $status = $stmt->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function getElectiveGroup($ayear, $sem) {
    $objcon = new connection();
    $con = $objcon->connect();
    $status = 0;
    try {
        $sql = "SELECT count(*), t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                . ":ayear and m.Sem =:sem and t.IsElective = '1' GROUP BY t.ElectiveGroup "
                . "and m.PublishedOn != ''";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem]);
        $status = $stmt->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}

function genericTesx2($ayear, $sem, $groupno, $pid) {
    $objcon = new connection();
    $con = $objcon->connect();
    $status = 0;
    try {
        if ($pid == 0) {
            $sql = "SELECT *, t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                    . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                    . ":ayear and m.Sem =:sem and t.IsElective = '1' and t.ElectiveGroup = :group and (m.ProgramId ='0' or "
                    . "m.ProgramId = '3' or m.ProgramId = '4') and m.PublishedOn != ''";
        } else if ($pid == 1) {
            $sql = "SELECT *, t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                    . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                    . ":ayear and m.Sem =:sem and t.IsElective = '1' and t.ElectiveGroup = :group and (m.ProgramId ='1' or "
                    . "m.ProgramId = '3') and m.PublishedOn != ''";
        } else if ($pid == 2) {
            $sql = "SELECT *, t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                    . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                    . ":ayear and m.Sem =:sem and t.IsElective = '1' and t.ElectiveGroup = :group and (m.ProgramId ='2' or "
                    . "m.ProgramId = '4') and m.PublishedOn != ''";
        }
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem, "group" => $groupno]);
        $status = $stmt->fetchAll(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();
    return $status;
}
?>