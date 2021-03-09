<?php require_once("connection.php") ?>
<?php

class User {

    public function addUser($email, $password, $name, $cnum, $gender, $profile) {
        $objcon = new connection();
        $con = $objcon->connect();
        $password = hash('sha256', $password);
        $sql = "insert into tbl_users(Username,Password,FullName,Contact,Gender,ProfileImage) values (:email,:pass,:name,:contact,:gender,:profile)";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $status = $stmt->execute(["email" => $email, "pass" => $password, "name" => $name, "contact" => $cnum, "gender" => $gender, "profile" => $profile]);
        } catch (Exception $e) {
            echo "<script>Lobibox.notify('error',{title: 'Error',msg: 'User has been already added!',sound: false,delay: '2000',icon: true, iconSource: 'fontAwesome'});</script>";
        }
        $objcon->disconnect();
        return $status;
    }

    public function displayUsers() {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select * from tbl_users where UserType = '2'and Status != '2'";
        $result = $con->query($sql);
        $objcon->disconnect();
        return $result;
    }

    public function displayDeletedUsers() {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select * from tbl_users where Status = '2'";
        $result = $con->query($sql);
        $objcon->disconnect();
        return $result;
    }

    public function updateUser($id, $name, $email, $contact, $gender) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_users set FullName = :name, Username = :email, Contact = :contact, Gender = :gender where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id, "name" => $name, "email" => $email, "contact" => $contact, "gender" => $gender]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function deleteUser($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_users set Status = '2' where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function restoreUser($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_users set Status = '0' where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function changeUserStatus($id, $ustatus) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_users set Status = :status where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id, "status" => $ustatus]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

}

class Subject {

    public function addsubject1($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select count(*) from tbl_subjects where SubjectCode = :code and SubjectName = :name and EffectiveYear = :year";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $result = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear]);
            $result = $stmt->fetchColumn();
            if ($result >= 1) {
                return 2;
            } else {
                $sql = "insert into tbl_subjects(SubjectCode,SubjectName,EffectiveYear,TheoryCredit,TheoryHour,DocText,DocPdf,"
                        . "TheoryMarksInt, TheoryMarksExt) values(:code,:name,:year,:tcredit,:thour,:doc,:pdf,:tmarksint,:tmarksext)";
                $stmt = $con->prepare($sql);
                $status = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear, "tcredit" => $tcredit, "thour" => $thour, "doc" => $sfile, "pdf" => $pfile, "tmarksint" => $tmarksint, "tmarksext" => $tmarksext]);
                if ($status != 1) {
                    return 0;
                }
            }
        } catch (Exception $e) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function addsubject2($subcode, $subname, $eyear, $sfile, $pfile, $pcredit, $phour, $ciemarks) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select count(*) from tbl_subjects where SubjectCode = :code and SubjectName = :name and EffectiveYear = :year";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $result = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear]);
            $result = $stmt->fetchColumn();
            if ($result >= 1) {
                return 2;
            } else {
                $sql = "insert into tbl_subjects(SubjectCode,SubjectName,EffectiveYear,PracticalCredit,PracticalHour,DocText,DocPdf,"
                        . "Cie) values(:code,:name,:year,:pcredit,:phour,:doc,:pdf,:cie)";
                $stmt = $con->prepare($sql);
                $status = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear, "pcredit" => $pcredit, "phour" => $phour, "doc" => $sfile, "pdf" => $pfile, "cie" => $ciemarks]);
                if ($status != 1) {
                    return 0;
                }
            }
        } catch (Exception $e) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function addsubject3($subcode, $subname, $eyear, $sfile, $pfile, $pcredit, $phour, $cieint, $cieext) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select count(*) from tbl_subjects where SubjectCode = :code and SubjectName = :name and EffectiveYear = :year";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $result = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear]);
            $result = $stmt->fetchColumn();
            if ($result >= 1) {
                return 2;
            } else {
                $sql = "insert into tbl_subjects(SubjectCode,SubjectName,EffectiveYear,PracticalCredit,PracticalHour,DocText,DocPdf,"
                        . "CieInt,CieExt) values(:code,:name,:year,:pcredit,:phour,:doc,:pdf,:cieint,:cieext)";
                $stmt = $con->prepare($sql);
                $status = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear, "pcredit" => $pcredit, "phour" => $phour, "doc" => $sfile, "pdf" => $pfile, "cieint" => $cieint, "cieext" => $cieext]);
                if ($status != 1) {
                    return 0;
                }
            }
        } catch (Exception $e) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function addsubject4($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $ciemarks) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select count(*) from tbl_subjects where SubjectCode = :code and SubjectName = :name and EffectiveYear = :year";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $result = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear]);
            $result = $stmt->fetchColumn();
            if ($result >= 1) {
                return 2;
            } else {
                $sql = "insert into tbl_subjects(SubjectCode,SubjectName,EffectiveYear,TheoryCredit,TheoryHour,DocText,DocPdf,"
                        . "TheoryMarksInt, TheoryMarksExt,PracticalCredit,PracticalHour,Cie) "
                        . "values(:code,:name,:year,:tcredit,:thour,:doc,:pdf,:tmarksint,:tmarksext,:pcredit,:phour,:cie)";
                $stmt = $con->prepare($sql);
                $status = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear, "tcredit" => $tcredit, "thour" => $thour, "doc" => $sfile, "pdf" => $pfile, "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "pcredit" => $pcredit, "phour" => $phour, "cie" => $ciemarks]);
                if ($status != 1) {
                    return 0;
                }
            }
        } catch (Exception $e) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function addsubject5($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select count(*) from tbl_subjects where SubjectCode = :code and SubjectName = :name and EffectiveYear = :year";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $result = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear]);
            $result = $stmt->fetchColumn();
            if ($result >= 1) {
                return 2;
            } else {
                $sql = "insert into tbl_subjects(SubjectCode,SubjectName,EffectiveYear,TheoryCredit,TheoryHour,DocText,DocPdf,"
                        . "TheoryMarksInt, TheoryMarksExt,PracticalCredit,PracticalHour,CieInt, CieExt) "
                        . "values(:code,:name,:year,:tcredit,:thour,:doc,:pdf,:tmarksint,:tmarksext,:pcredit,:phour,:cieint, :cieext)";
                $stmt = $con->prepare($sql);
                $status = $stmt->execute(["code" => $subcode, "name" => $subname, "year" => $eyear, "tcredit" => $tcredit, "thour" => $thour, "doc" => $sfile, "pdf" => $pfile, "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "pcredit" => $pcredit, "phour" => $phour, "cieint" => $cieint, "cieext" => $cieext]);
                if ($status != 1) {
                    return 0;
                }
            }
        } catch (Exception $e) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function ViewSubjectList1($academicyear, $sem) {
        $objcon = new connection();
        $con = $objcon->connect();
        $tempyear = explode("-", $academicyear);
        $sql = "select count(*) from tbl_syllabus_config_master where AcademicYear like :year and Sem = :sem";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $result = $stmt->execute(["year" => $tempyear[0] - 1 . "%", "sem" => $sem]);
            $result = $stmt->fetchColumn();
            if ($result < 1) {
                $sql = "SELECT Id,SubjectCode,SubjectName,EffectiveYear FROM tbl_subjects WHERE EffectiveYear not like :year";
                $stmt = $con->prepare($sql);
                $status = $stmt->execute(["year" => date("Y") . "%"]);
                $status = $stmt->fetchAll(PDO::FETCH_NUM);
            } else {
                $sql = "SELECT s.Id,s.SubjectCode, s.SubjectName, s.EffectiveYear from tbl_subjects s INNER JOIN "
                        . "tbl_syllabus_config_transaction t on s.Id = t.SubjectId INNER JOIN tbl_syllabus_config_master m "
                        . "on t.ConfigId = m.Id where m.AcademicYear like :year and m.Sem = :sem";
                $stmt = $con->prepare($sql);
                $status = $stmt->execute(["year" => $tempyear[0] - 1 . "%", "sem" => $sem]);
                $status = $stmt->fetchAll(PDO::FETCH_NUM);
            }
        } catch (Exception $ex) {
            
        }
        return $status;
    }

    public function ViewSubjectList1Append($data) {
        $objcon = new connection();
        $con = $objcon->connect();
        $data = implode(",", $data);
        $data = trim($data,'\'"');
        $status = 0;
        try {
            $sql = "SELECT Id, SubjectCode, SubjectName, EffectiveYear from tbl_subjects where Id not in ($data) and EffectiveYear not like :year";
            $stmt = $con->prepare($sql);
            $stmt->execute(["year" => date("Y") . "%"]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
//            $sql = "SELECT Id, SubjectCode, SubjectName, EffectiveYear from tbl_subjects";
//            $stmt = $con->prepare($sql);
//            $stmt->execute();
//            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        }
        return $status;
    }

    public function ViewSubjectList2() {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT Id,SubjectCode,SubjectName,EffectiveYear FROM tbl_subjects WHERE EffectiveYear like :year";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["year" => date("Y") . "%"]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        return $status;
    }

}

class Student {

    public function addStudents($file) {
        $objcon = new connection();
        $con = $objcon->connect();
        if ($file['name']) {
            $filename = explode(".", $file['name']);
            if ($filename[1] == 'csv') {
                $handle = fopen($file['tmp_name'], "r");
                while ($data = fgetcsv($handle)) {
                    $enro = $data[0];
                    $email = $data[1];
                    $name = $data[2];
                    $pass = rand(11111111, 99999999);
                    $query = "INSERT into tbl_students(Enro, Username, Password, FullName) values(:enro, :email, :pass, :name)";
                    $stmt = $con->prepare($query);
                    try {
                        $status = $stmt->execute(["enro" => $enro, "email" => $email, "pass" => $pass, "name" => $name]);
                    } catch (Exception $ex) {
                        if ($con->errorCode() == "00000") {
                            return 2;
                        }
                        return 0;
                    }
                }
                fclose($handle);
            }
            $objcon->disconnect();
            return $status;
        }
    }

    public function addSingleStudent($enro, $name, $email) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "insert into tbl_students(Enro,Username,Password,FullName) values(:enro,:email,:pass,:name)";
        $stmt = $con->prepare($sql);
        $pass = rand(11111111, 99999999);
        try {
            $status = $stmt->execute(["enro" => $enro, "name" => $name, "email" => $email, "pass" => $pass]);
        } catch (Exception $e) {
            if ($con->errorCode() == "00000") {
                return 2;
            }
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

}

function getAdminEmail($id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select Username from tbl_users where id = :id";
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

function checkPassword($pass, $id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $pass = hash("sha256", $pass);
    $sql = "select count(*) from tbl_users where id = :id and Password = :pass";
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

function ChangePassword($pass, $id) {
    $objcon = new connection();
    $con = $objcon->connect();
    $pass = hash("sha256", $pass);
    $sql = "update tbl_users set Password = :pass where id = :id";
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

?>
