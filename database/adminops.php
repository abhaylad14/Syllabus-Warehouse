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

    public function uploadSubjectRevision($sid, $sfile) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_syllabus_config_assign set DocText = :sfile where SubjectId = :sid";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["sid" => $sid, "sfile" => $sfile]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function displaysubjects() {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select * from tbl_subjects where Isactive = '0'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_NUM);
        $objcon->disconnect();
        return $status;
    }

    public function getSubjectById($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select  *  from tbl_subjects where Id = :id";
        $stmt = $con->prepare($sql);
        try {
            $stmt->execute(["id" => $id]);
            $status = $stmt->fetch(PDO::FETCH_NUM);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function deleteSubject($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_subjects set Isactive = '1' where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function assignSubject($subid, $facid, $leader) {
        $objcon = new connection();
        $con = $objcon->connect();
        try {
            $sql = "select count(*) from tbl_syllabus_config_assign where SubjectId = :subid and VerifyDate is null";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["subid" => $subid]);
            $count = $stmt->fetchColumn();
            if ($count == 0) {
                $sql = "insert into tbl_syllabus_config_assign (SubjectId, UserId,AssignDate) values(:subid, :facid,CURDATE())";
                $stmt = $con->prepare($sql);
                for ($i = 0; $i < count($facid); $i++) {
                    $status = $stmt->execute(["subid" => $subid, "facid" => $facid[$i]]);
                }
                if ($status == 1) {
                    $sql = "select Id from tbl_syllabus_config_assign where SubjectId = :subid and UserId = :facid";
                    $stmt = $con->prepare($sql);
                    $status = $stmt->execute(["subid" => $subid, "facid" => $leader]);
                    $result = $stmt->fetchColumn();
                    $sql = "update tbl_syllabus_config_assign set Isleader = '1' where Id = :id";
                    $stmt = $con->prepare($sql);
                    $status = $stmt->execute(["id" => $result]);
                } else {
                    return 0;
                }
            } else {
                $status = 2;
            }
        } catch (Exception $e) {
            $status = 0;
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
        $objcon->disconnect();
        return $status;
    }

    public function viewAssignedSubjects() {
        $objcon = new connection();
        $con = $objcon->connect();
        try {
            $sql = "select a.Id, s.SubjectCode, s.SubjectName, s.EffectiveYear, u.FullName, a.AssignDate, a.VerifyDate, "
                    . "a.Status, a.DocText, a.SubjectId from tbl_syllabus_config_assign a INNER JOIN tbl_subjects s on a.SubjectId = s.Id INNER JOIN "
                    . "tbl_users u on a.UserId = u.Id where a.Isleader = '1' order by AssignDate";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            
        }
        $objcon->disconnect();
        return $status;
    }
    
    public function viewAssignedSubjectsFacultyWise($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        try {
            $sql = "select a.Id, s.SubjectCode, s.SubjectName, s.EffectiveYear, a.Isleader, a.AssignDate, a.VerifyDate, "
                    . "a.Status, a.DocText, a.SubjectId, a.Comments from tbl_syllabus_config_assign a INNER JOIN tbl_subjects s on a.SubjectId = s.Id INNER JOIN "
                    . "tbl_users u on a.UserId = u.Id where a.UserId = :id order by AssignDate";
            $stmt = $con->prepare($sql);
            $stmt->execute(["id" => $id]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            
        }
        $objcon->disconnect();
        return $status;
    }
    public function viewMembers($subid) {
        $objcon = new connection();
        $con = $objcon->connect();
        try {
            $sql = "select u.FullName from tbl_users u INNER JOIN tbl_syllabus_config_assign a on a.UserId = u.Id where SubjectId = :subid";
            $stmt = $con->prepare($sql);
            $stmt->execute(["subid" => $subid]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function ViewSubjectList1Append($data) {
        $objcon = new connection();
        $con = $objcon->connect();
        $data = implode(",", $data);
        $data = trim($data, '\'"');
        $status = 0;
        try {
            $sql = "SELECT Id, SubjectCode, SubjectName, EffectiveYear from tbl_subjects where Id not in ($data) and EffectiveYear not like :year";
            $stmt = $con->prepare($sql);
            $stmt->execute(["year" => date("Y") . "%"]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            
        }
        $objcon->disconnect();
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
        $objcon->disconnect();
        return $status;
    }

    public function UpdateSubject1($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cie, $id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "UPDATE tbl_subjects SET SubjectCode= :subcode,SubjectName=:subname,EffectiveYear=:eyear,TheoryCredit=:tcredit,"
                . "PracticalCredit=:pcredit,TheoryHour=:thour,PracticalHour=:phour,DocText=:sfile,DocPdf=:pfile,TheoryMarksInt=:tmarksint,"
                . "TheoryMarksExt=:tmarksext,Cie=:cie,CieInt='-',CieExt='-' where Id = :id";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["subcode" => $subcode, "subname" => $subname, "eyear" => $eyear,
            "tcredit" => $tcredit, "pcredit" => $pcredit, "thour" => $thour, "phour" => $phour, "sfile" => $sfile, "pfile" => $pfile,
            "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "cie" => $cie, "id" => $id]);
        $objcon->disconnect();
        return $status;
    }

    public function xUpdateSubject1($subcode, $subname, $eyear, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cie, $id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "UPDATE tbl_subjects SET SubjectCode= :subcode,SubjectName=:subname,EffectiveYear=:eyear,TheoryCredit=:tcredit,"
                . "PracticalCredit=:pcredit,TheoryHour=:thour,PracticalHour=:phour,TheoryMarksInt=:tmarksint,"
                . "TheoryMarksExt=:tmarksext,Cie=:cie,CieInt='-',CieExt='-' where Id = :id";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["subcode" => $subcode, "subname" => $subname, "eyear" => $eyear,
            "tcredit" => $tcredit, "p"
            . "credit" => $pcredit, "thour" => $thour, "phour" => $phour,
            "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "cie" => $cie, "id" => $id]);
        $objcon->disconnect();
        return $status;
    }

    public function x1UpdateSubject1($subcode, $subname, $eyear, $sfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cie, $id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "UPDATE tbl_subjects SET SubjectCode= :subcode,SubjectName=:subname,EffectiveYear=:eyear,TheoryCredit=:tcredit,"
                . "PracticalCredit=:pcredit,TheoryHour=:thour,PracticalHour=:phour,DocText=:sfile,TheoryMarksInt=:tmarksint,"
                . "TheoryMarksExt=:tmarksext,Cie=:cie,CieInt='-',CieExt='-' where Id = :id";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["subcode" => $subcode, "subname" => $subname, "eyear" => $eyear,
            "tcredit" => $tcredit, "pcredit" => $pcredit, "thour" => $thour, "phour" => $phour, "sfile" => $sfile,
            "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "cie" => $cie, "id" => $id]);
        $objcon->disconnect();
        return $status;
    }

    public function x2UpdateSubject1($subcode, $subname, $eyear, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cie, $id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "UPDATE tbl_subjects SET SubjectCode= :subcode,SubjectName=:subname,EffectiveYear=:eyear,TheoryCredit=:tcredit,"
                . "PracticalCredit=:pcredit,TheoryHour=:thour,PracticalHour=:phour,DocPdf=:pfile,TheoryMarksInt=:tmarksint,"
                . "TheoryMarksExt=:tmarksext,Cie=:cie,CieInt='-',CieExt='-' where Id = :id";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["subcode" => $subcode, "subname" => $subname, "eyear" => $eyear,
            "tcredit" => $tcredit, "pcredit" => $pcredit, "thour" => $thour, "phour" => $phour, "pfile" => $pfile,
            "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "cie" => $cie, "id" => $id]);
        $objcon->disconnect();
        return $status;
    }

    public function UpdateSubject2($subcode, $subname, $eyear, $sfile, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext, $id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "UPDATE tbl_subjects SET SubjectCode= :subcode,SubjectName=:subname,EffectiveYear=:eyear,TheoryCredit=:tcredit,"
                . "PracticalCredit=:pcredit,TheoryHour=:thour,PracticalHour=:phour,DocText=:sfile,DocPdf=:pfile,TheoryMarksInt=:tmarksint,"
                . "TheoryMarksExt=:tmarksext,CieInt=:cieint,CieExt=:cieext,Cie='-' where Id = :id";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["subcode" => $subcode, "subname" => $subname, "eyear" => $eyear,
            "tcredit" => $tcredit, "pcredit" => $pcredit, "thour" => $thour, "phour" => $phour, "sfile" => $sfile, "pfile" => $pfile,
            "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "cieint" => $cieint, "cieext" => $cieext, "id" => $id]);
        $objcon->disconnect();
        return $status;
    }

    public function xUpdateSubject2($subcode, $subname, $eyear, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext, $id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "UPDATE tbl_subjects SET SubjectCode= :subcode,SubjectName=:subname,EffectiveYear=:eyear,TheoryCredit=:tcredit,"
                . "PracticalCredit=:pcredit,TheoryHour=:thour,PracticalHour=:phour,TheoryMarksInt=:tmarksint,"
                . "TheoryMarksExt=:tmarksext,CieInt=:cieint,CieExt=:cieext,Cie='-' where Id = :id";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["subcode" => $subcode, "subname" => $subname, "eyear" => $eyear,
            "tcredit" => $tcredit, "pcredit" => $pcredit, "thour" => $thour, "phour" => $phour,
            "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "cieint" => $cieint, "cieext" => $cieext, "id" => $id]);
        $objcon->disconnect();
        return $status;
    }

    public function x1UpdateSubject2($subcode, $subname, $eyear, $sfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext, $id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "UPDATE tbl_subjects SET SubjectCode= :subcode,SubjectName=:subname,EffectiveYear=:eyear,TheoryCredit=:tcredit,"
                . "PracticalCredit=:pcredit,TheoryHour=:thour,PracticalHour=:phour,DocText=:sfile,TheoryMarksInt=:tmarksint,"
                . "TheoryMarksExt=:tmarksext,CieInt=:cieint,CieExt=:cieext,Cie='-' where Id = :id";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["subcode" => $subcode, "subname" => $subname, "eyear" => $eyear,
            "tcredit" => $tcredit, "pcredit" => $pcredit, "thour" => $thour, "phour" => $phour, "sfile" => $sfile,
            "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "cieint" => $cieint, "cieext" => $cieext, "id" => $id]);
        $objcon->disconnect();
        return $status;
    }

    public function x2UpdateSubject2($subcode, $subname, $eyear, $pfile, $tcredit, $thour, $tmarksint, $tmarksext, $pcredit, $phour, $cieint, $cieext, $id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "UPDATE tbl_subjects SET SubjectCode= :subcode,SubjectName=:subname,EffectiveYear=:eyear,TheoryCredit=:tcredit,"
                . "PracticalCredit=:pcredit,TheoryHour=:thour,PracticalHour=:phour,DocPdf=:pfile,TheoryMarksInt=:tmarksint,"
                . "TheoryMarksExt=:tmarksext,CieInt=:cieint,CieExt=:cieext,Cie='-' where Id = :id";
        $stmt = $con->prepare($sql);
        $status = $stmt->execute(["subcode" => $subcode, "subname" => $subname, "eyear" => $eyear,
            "tcredit" => $tcredit, "pcredit" => $pcredit, "thour" => $thour, "phour" => $phour, "pfile" => $pfile,
            "tmarksint" => $tmarksint, "tmarksext" => $tmarksext, "cieint" => $cieint, "cieext" => $cieext, "id" => $id]);
        $objcon->disconnect();
        return $status;
    }

    public function config1($ayear, $sem, $pid, $data) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select count(*) from tbl_syllabus_config_master where AcademicYear = :ayear and sem = :sem and ProgramId = :pid";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $result = $stmt->execute(["ayear" => $ayear, "sem" => $sem, "pid" => $pid]);
            $result = $stmt->fetchColumn();
            if ($result >= 1) {
                return 2;
            } else {
                $sql = "insert into tbl_syllabus_config_master(AcademicYear,sem,ProgramId) values(:ayear,:sem,:pid)";
                $stmt = $con->prepare($sql);
                $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem, "pid" => $pid]);
                if ($status != 1) {
                    return 0;
                } else {
                    $sql = "select Id from tbl_syllabus_config_master ORDER by Id desc limit 1";
                    $stmt = $con->prepare($sql);
                    $result = $stmt->execute();
                    $result = $stmt->fetchColumn();


                    $sql = "insert into tbl_syllabus_config_transaction(ConfigId,SubjectId,IsElective,ElectiveGroup) values(:cid,:sid,:elective,:egroup)";
                    for ($i = 0; $i < count($data["id"]); $i++) {
                        $stmt = $con->prepare($sql);
                        $status = $stmt->execute(["cid" => $result, "sid" => $data["id"][$i], "elective" => $data["iselective"][$i], "egroup" => $data["egroup"][$i]]);
                    }
                    if ($status != 1) {
                        return 0;
                    }
                }
            }
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
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

function count_subject() {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select count(*) from tbl_subjects";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute();
        $status = $stmt->fetch(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();

    return $status;
}

function count_faculty() {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select count(*) from tbl_users where UserType='2'";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute();
        $status = $stmt->fetch(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();

    return $status;
}

function count_student() {
    $objcon = new connection();
    $con = $objcon->connect();
    $sql = "select count(*) from tbl_users where UserType='4'";
    $stmt = $con->prepare($sql);
    $status = 0;
    try {
        $status = $stmt->execute();
        $status = $stmt->fetch(PDO::FETCH_NUM);
    } catch (Exception $ex) {
        return 0;
    }
    $objcon->disconnect();

    return $status;
}

?>
