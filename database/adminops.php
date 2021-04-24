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
        $sql = "select * from tbl_users where UserType = '2'and Status != '2' order by Id desc";
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

    public function createAnnouncement($uid, $title, $message, $attachment) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "insert into tbl_announcements(UserId,Title,Message,Attachment) values(:id,:title,:message,:attachment)";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $uid, "title" => $title, "message" => $message, "attachment" => $attachment]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function displayAllAnnouncements() {
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

    public function displayAnnouncements($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select a.id, a.Title, a.Message, a.AnnounceDate, a.attachment, u.FullName, a.Status "
                . "from tbl_announcements a INNER JOIN tbl_users u on a.UserId = u.Id where a.Status = 0 and a.UserId = :id "
                . "order by Id desc";
        $stmt = $con->prepare($sql);
        try {
            $stmt->execute(["id" => $id]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function deleteAnnouncement($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_announcements set Status = '1' where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function updateAnnouncement($id, $title, $message) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_announcements set Title = :title, Message = :message where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id, "title" => $title, "message" => $message]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function updateAnnouncementFile($id, $afile) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "update tbl_announcements set Attachment = :afile where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id, "afile" => $afile]);
        } catch (Exception $ex) {
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
        $sql = "update tbl_syllabus_config_assign set DocText = :sfile, Status='0' where Subject = :sid";
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
        $sql = "select * from tbl_subjects where Isactive = '0' order by Id desc";
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

    public function assignSubject($subject, $facid, $leader) {
        $objcon = new connection();
        $con = $objcon->connect();
        try {
            $sql = "select count(*) from tbl_syllabus_config_assign where Subject = :sub and VerifyDate is null";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["sub" => $subject]);
            $count = $stmt->fetchColumn();
            if ($count == 0) {
                $sql = "insert into tbl_syllabus_config_assign (Subject, UserId,AssignDate) values(:sub, :facid,CURDATE())";
                $stmt = $con->prepare($sql);
                for ($i = 0; $i < count($facid); $i++) {
                    $status = $stmt->execute(["sub" => $subject, "facid" => $facid[$i]]);
                }
                if ($status == 1) {
                    $sql = "select Id from tbl_syllabus_config_assign where Subject = :sub and UserId = :facid";
                    $stmt = $con->prepare($sql);
                    $status = $stmt->execute(["sub" => $subject, "facid" => $leader]);
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
        $status = 0;
        try {
            $sql = "select a.Id, a.Subject, u.FullName, a.AssignDate, a.VerifyDate, a.Status, a.DocText from "
                    . "tbl_syllabus_config_assign a INNER JOIN tbl_users u on a.UserId = u.Id where a.Isleader = '1' order by AssignDate";
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
        $status = 0;
        try {
            $sql = "select a.Id, a.Subject, a.Isleader, a.AssignDate, a.VerifyDate, "
                    . "a.Status, a.DocText, a.Comments from tbl_syllabus_config_assign a INNER JOIN "
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
            $sql = "select u.FullName from tbl_users u INNER JOIN tbl_syllabus_config_assign a on a.UserId = u.Id where Subject = :subid";
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

    public function viewRemarks($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        try {
            $sql = "select Remark from tbl_bos where Id = :id";
            $stmt = $con->prepare($sql);
            $stmt->execute(["id" => $id]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }
    public function addBOS($mname, $mvenue, $mdate, $magenda, $szip, $teszip, $minutes, $remarks) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "insert into tbl_bos(MeetingName,MeetingVenue,MeetingDate,MeetingAgenda,Minutes,SyllabusZip,TesZip,Remark) "
                . "values(:mname,:mvenue,:mdate,:magenda,:minutes,:szip,:teszip,:remark)";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["mname" => $mname, "mvenue" => $mvenue, "mdate" => $mdate, "magenda" => $magenda,
                "szip" => $szip, "teszip" => $teszip, "minutes" => $minutes, "remark"=>$remarks]);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }
    public function viewConfiguredSyllabus() {
        $objcon = new connection();
        $con = $objcon->connect();
        try {
            $sql = "select * from tbl_syllabus_config_master";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }
    public function deleteConfig($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "delete from tbl_syllabus_config_master where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id]);
            $sql = "delete from tbl_syllabus_config_transaction where ConfigId = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id]);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }
    public function publishConfig($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "update tbl_syllabus_config_master set PublishedOn=CURDATE() where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id]);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function viewBOSdetails() {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT * from tbl_bos where Status = '0' order by Id desc";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute();
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function updateBOSdetails($id, $mname, $mvenue, $mdate) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "update tbl_bos set MeetingName = :name, MeetingVenue = :venue, MeetingDate = :date where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["name" => $mname, "venue" => $mvenue, "date" => $mdate, "id" => $id]);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function deleteBOSdetails($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "update tbl_bos set Status = '1' where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id]);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function updateBOSagenda($id, $agenda) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "update tbl_bos set MeetingAgenda = :agenda where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id, "agenda" => $agenda]);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function updateBOSminutes($id, $minutes) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "update tbl_bos set Minutes = :minutes where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id, "minutes" => $minutes]);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function updateBOSszip($id, $szip) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "update tbl_bos set SyllabusZip = :szip where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id, "szip" => $szip]);
        } catch (Exception $ex) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function updateBOSteszip($id, $teszip) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "update tbl_bos set TesZip = :teszip where Id = :id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["id" => $id, "teszip" => $teszip]);
        } catch (Exception $ex) {
            $status = 0;
        }
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

    public function deleteStudent($id) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_students set Status = '2' where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function updateStudent($id, $name, $email, $enro) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_students set FullName = :name, Username = :email, Enro = :enro where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id, "name" => $name, "email" => $email, "enro" => $enro]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function changeStudentStatus($id, $ustatus) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "update tbl_students set Status = :status where id = :id";
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute(["id" => $id, "status" => $ustatus]);
        } catch (Exception $e) {
            $status = 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function displayStudents() {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select * from tbl_students where Status != '2' order by Id desc";
        $result = $con->query($sql);
        $objcon->disconnect();
        return $result;
    }

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
                    $pass1 = hash("sha256", $pass);
                    $query = "INSERT into tbl_students(Enro, Username, Password, FullName) values(:enro, :email, :pass, :name)";
                    $stmt = $con->prepare($query);
                    $status = 1;
                    $mailflag = 1;
                    try {
                        $status = $stmt->execute(["enro" => $enro, "email" => $email, "pass" => $pass1, "name" => $name]);
                        $mailflag = sendEmail($email, "Syllabus Warehouse", "Your password is: " . $pass);
                    } catch (Exception $ex) {
                        if ($con->errorCode() == "00000") {
                            continue;
                        }
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
        $pass1 = hash("sha256", $pass);
        try {
            $status = $stmt->execute(["enro" => $enro, "name" => $name, "email" => $email, "pass" => $pass1]);
            $mailflag = sendEmail($email, "Syllabus Warehouse", "Your password is: " . $pass);
            if ($status == 1 && $mailflag == 1) {
                return $status;
            } else {
                return 3;
            }
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

class Reports {

    public function Report1() {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute();
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Report2($ayear) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["ayear" => $ayear]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Report3($sem) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.Sem = :sem";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["sem" => $sem]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Report4($term) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        if ($term == 1) {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.Sem = '1' or m.Sem = '3' or "
                    . "m.Sem = '5' or m.Sem = '7' or m.Sem = '9'";
        } else if ($term == 2) {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.Sem = '2' or m.Sem = '4' or "
                    . "m.Sem = '6' or m.Sem = '8' or m.Sem = '10'";
        }
        $stmt = $con->prepare($sql);
        try {
            $status = $stmt->execute();
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Report5($ayear, $sem) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Report6($ayear, $term) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        $sql = "";
        try {
            if ($term == 1) {
                $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                        . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear and (m.Sem = '1' or m.Sem = '3' or "
                        . "m.Sem = '5' or m.Sem = '7' or m.Sem = '9')";
            } else if ($term == 2) {
                $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                        . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear and (m.Sem = '2' or m.Sem = '4' or "
                        . "m.Sem = '6' or m.Sem = '8' or m.Sem = '10')";
            }
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["ayear" => $ayear]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Report7($batch) {
        $objcon = new connection();
        $con = $objcon->connect();
        $year1 = $batch;
        $year2 = intval($batch + 1);
        $year3 = intval($batch + 2);
        $year4 = intval($batch + 3);
        $year5 = intval($batch + 4);
        $status = 0;
        try {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on m.Id = t.ConfigId "
                    . "INNER JOIN tbl_subjects s on t.SubjectId = s.Id where (m.Sem = '1' and m.AcademicYear like :year1) or "
                    . "(m.Sem = '2' and m.AcademicYear like :year1) or (m.Sem = '3' and m.AcademicYear like :year2) or "
                    . "(m.Sem = '4' and m.AcademicYear like :year2) or (m.Sem = '5' and m.AcademicYear like :year3) or "
                    . "(m.Sem = '6' and m.AcademicYear like :year3) or (m.Sem = '7' and m.AcademicYear like :year4) or "
                    . "(m.Sem = '8' and m.AcademicYear like :year4) or (m.Sem = '9' and m.AcademicYear like :year5) or "
                    . "(m.Sem = '10' and m.AcademicYear like :year5)";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["year1" => $year1 . "%", "year2" => $year2 . "%", "year3" => $year3 . "%",
                "year4" => $year4 . "%", "year5" => $year5 . "%"]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Report8($pid) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        if ($pid == 0) {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.ProgramId = '0' or "
                    . "m.ProgramId = '3' or m.ProgramId = '4'";
        } else if ($pid == 1) {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.ProgramId = '1' or "
                    . "m.ProgramId = '3'";
        } else if ($pid == 2) {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.ProgramId = '2' or "
                    . "m.ProgramId = '4'";
        }
        try {
            $stmt = $con->prepare($sql);
            $status = $stmt->execute();
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

}

class TES {

    public function getProgramName($ayear, $sem) {
        $objcon = new connection();
        $con = $objcon->connect();
        $sql = "select ProgramId from tbl_syllabus_config_master where AcademicYear = :ayear and Sem = :sem";
        $stmt = $con->prepare($sql);
        $status = 0;
        try {
            $status = $stmt->execute(["ayear" => $ayear, "sem"=>$sem]);
            $status = $stmt->fetchColumn();
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function getElectiveSubjectsByGroup($ayear, $sem, $groupno) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT *, t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                    . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                    . ":ayear and m.Sem =:sem and t.IsElective = '1' and t.ElectiveGroup = :group";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem, "group" => $groupno]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function getElectiveGroup($ayear, $sem) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT count(*), t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                    . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                    . ":ayear and m.Sem =:sem and t.IsElective = '1' GROUP BY t.ElectiveGroup";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Tes1x1($ayear, $sem) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem and t.IsElective = '0'";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }

    public function Tes1x2($ayear, $sem) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem and t.IsElective = '1'";
            $stmt = $con->prepare($sql);
            $status = $stmt->execute(["ayear" => $ayear, "sem" => $sem]);
            $status = $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            return 0;
        }
        $objcon->disconnect();
        return $status;
    }
    
    public function genericTesx1($ayear, $sem, $pid) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            if($pid == 0){
            $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem and t.IsElective = '0' and (m.ProgramId ='0' or m.ProgramId = '3' or m.ProgramId = '4')";
            }
            else if($pid == 1){
                $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem and t.IsElective = '0' and (m.ProgramId ='1' or m.ProgramId = '3')";
            }
            else if($pid == 2){
                $sql = "SELECT * from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction t on "
                    . "m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = :ayear "
                    . "and m.Sem = :sem and t.IsElective = '0' and (m.ProgramId ='2' or m.ProgramId = '4')";
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
    public function genericTesx2($ayear, $sem, $groupno, $pid) {
        $objcon = new connection();
        $con = $objcon->connect();
        $status = 0;
        try {
            if($pid == 0){
            $sql = "SELECT *, t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                    . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                    . ":ayear and m.Sem =:sem and t.IsElective = '1' and t.ElectiveGroup = :group and (m.ProgramId ='0' or "
                    . "m.ProgramId = '3' or m.ProgramId = '4')";
            }
            else if($pid == 1){
                $sql = "SELECT *, t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                    . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                    . ":ayear and m.Sem =:sem and t.IsElective = '1' and t.ElectiveGroup = :group and (m.ProgramId ='1' or "
                    . "m.ProgramId = '3')";
            }
            else if($pid == 2){
                $sql = "SELECT *, t.ElectiveGroup from tbl_syllabus_config_master m INNER JOIN tbl_syllabus_config_transaction "
                    . "t on m.Id = t.ConfigId INNER JOIN tbl_subjects s on t.SubjectId = s.Id where m.AcademicYear = "
                    . ":ayear and m.Sem =:sem and t.IsElective = '1' and t.ElectiveGroup = :group and (m.ProgramId ='2' or "
                    . "m.ProgramId = '4')";
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
    $sql = "select count(*) from tbl_subjects where Isactive = '0'";
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
    $sql = "select count(*) from tbl_users where UserType='2' and Status = '0'";
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
    $sql = "select count(*) from tbl_students where Status = '0';";
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
