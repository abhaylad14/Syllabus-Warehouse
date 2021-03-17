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
function resetPassword($email,$pass){
    $objcon = new connection();
    $con = $objcon->connect();
    $pass = hash("sha256", $pass);
    if($_SESSION["utype"] == "user"){
    $sql = "update tbl_users set Password = :pass where Username = :email";
    }
    else if($_SESSION["utype"] == "student"){
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
function getUserData($id){
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
function getStudentData($id){
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
function updateProfile($id,$name,$contact,$gender){
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
function updateProfilePicture($id,$profile){
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
?>