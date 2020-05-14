<?php
    include "conndb.php";
    // ----------------------------------- //
    // ----------- POSTS ----------------- //
    // ----------------------------------- //
    if($_POST['message'] == "insertProfessor")
    {
        $fn = $_POST['firstname'];
        $ln = $_POST['lastname'];
        if(empty($_POST['taken'])) $taken = true;
        else $taken = false;
        insertProfessor(connDB(), $fn, $ln, $taken);
        //return to page - CHANGE TO INDEX.PHP LATER
        echo '<script>location.replace("index.php");</script>';
    }
   
    if($_POST['message'] == "commentary")
    {
        $a = "";
        if($_POST['annoStatus'] == "anno") $a = "Anonymous";
        else $a = $_POST['commenterName'];
        $subject = $_POST['subjectTaken'];
        $class = $_POST['courseTaken'];
        $term = $_POST['termTaken'];
        $year = $_POST['yearTaken'];
        $grade = $_POST['grade'];
        $comment = $_POST['comment'];
        date_default_timezone_set("America/Los_Angeles"); /// set time zone
        $datetimestamp = date ("Y-m-d H:i:s"); //current time in that time zone
        comment(connDB(), $grade, $comment, $a, $term, $year, $datetimestamp, $subject, $class);
        echo '<script>alert("Comment Succesfully Stored!");location.replace("index.php");</script>';
    }

    if($_POST['message'] == "feedAboutProf")
    {
        $p = $_POST['profSelected'];
        updateProfFeed(connDB(), $p);
        echo '<script>location.replace("comment.php");</script>';

    }

    if($_POST['message'] == "readAboutProf")
    {
        updateProfRead(connDB(), $_POST['profSelected']);
        echo '<script>location.replace("read.php");</script>';
    }
   
    if($_POST['message'] == 'insertNewProf')
    {
        $f = $_POST['firstName'];
        $l = $_POST['lastName'];
        $d = $_POST['dept'];
        $c = connDB();
        insertNewProf($c, $f, $l, $d); //insert to db
        echo '<script>location.replace("admin.php")</script>';; //go back to admin page
    }

    if($_POST['message'] == 'insertNewCourse')
    {
        newCourse(connDb(), $_POST['courseName'], $_POST['courseNumber']. $_POST['subject']);
        //courseLog(connDb(), $_POST['courseNumber'], $_POST['subject'], $_POST['year'], $_POST['term'], $_['prof']);
    }

    if($_POST['message'] == "chooseSubject")
    {
        updateChosenSubject(connDb(), $_POST['subject']);
        echo '<script>location.replace("admin.php");</script>';
    }

    if($_POST['message'] == "addExists")
    {
        courseLog(connDb(), $_POST['subject'], $_POST['number'], $_POST['prof'], $_POST['term'], $_POST['year']);
        echo '<script>location.replace("admin.php");</script>';
    }

    if($_POST['message'] == "logincheck")
    {
        if(checkcredentials(connDB(), $_POST['un'], $_POST['pw'])) echo '<script>location.replace("index.php");</script>';
        else echo '<script>alert("Error, Wrong Credentials"); location.replace("login.html");</script>';
    }

    if($_POST['message'] == "signup")
    {
        userSignUp(connDB(), $_POST['zonemail'], $_POST['pw2']);
        echo '<script>alert("Sign Up Was Successful! Go Ahead and Log In Please");location.replace("login.html");</script>';
    }
    // ----------------------------------- //
    // ---------- FUNCTIONS -------------- //
    // ----------------------------------- //
    
    function comment($c, $g, $text, $a, $t, $y, $dt, $subject, $course)
    {
        $sql1 = "SELECT ID FROM Instructors WHERE Comment = 1";
        $s = $c -> prepare($sql1);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $idi = $r['ID'];
        $sql2 = "SELECT MAX(ID)+1 FROM Comments;";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn();

        $sql = "INSERT INTO Comments (ID, Grade, TEXT, Name, Term, Year, DateTimeStamp, Courses_Number, Courses_Subjects_Code, Instructors_ID) VALUES (".$max.",'".$g."', '".$text."', '".$a."', '".$t."', ".$y.", '".$dt."', ".$course.", '".$subject."', ".$idi.");";

        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);
        return;
    }

    function updateProfRead($c, $p)
    {   
        $sql = "UPDATE Instructors SET Reader = 0;";
        $sql .= "UPDATE Instructors SET Reader = 1 WHERE ID = ".$p.";";
        $c -> prepare($sql) -> execute();
        return;
    }
    function checkcredentials($c, $m, $p)
    {
        //verify password is correct for the given email address
        $sql = "SELECT password FROM Credentials WHERE zonemail = '".$m."';";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        if($r['password'] == $p) return true;
        else return false;        
    }
    
    function userSignUp($c, $m, $p)
    {
        //NOTE: c = connection, m = zonemail, p = password
        $sql = "INSERT INTO Credentials VALUES ('".$m."', '".$p."');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c->exec($sql);
        return;
    }

    function courseLog($c, $subject, $number, $prof, $term, $year)
    {
        $sql = "INSERT INTO ProfCourse VALUES (".$number.", '".$subject."', ".$prof.", '".$term."', ".$year.")";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c->exec($sql);
        return;
    }
    
    function newCourse($c, $name, $number, $subject)
    {
        $sql = "INSERT INTO Courses VALUES (".$number.", '".$subject."', '".$name."' )";
        return;
    }
    
    function insertNewProf($c, $f, $l, $d)
    {
        $sql = "INSERT INTO Instructors (FirstName, LastName, Subjects_Code) VALUES('".$f."', '".$l."', '".$d."');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c->exec($sql);
        return;
    }
    
    function updateProfFeed($c, $p)
    {
        $sql = "UPDATE Instructors SET Comment = 1 WHERE ID = ".$p;
        $s = $c -> prepare($sql);
        $s -> execute();
        //update everyone elses
        $sql2 = "UPDATE Instructors SET Comment = 0 WHERE NOT ID = ".$p;
        $s2 = $c -> prepare($sql2);
        $s2 -> execute();
        return;
    }


    function insertProfessor($c, $f, $l, $t)
    {
        $sql = "INSERT INTO Instructors (FirstName, LastName) VALUES ('".$f."', '".$l."');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c->exec($sql);
        //add echo script to go to comment page
    }





    /// ----------------- POPULATORS ---------------------///
    
    function populateALlSubjects($c)
    {
        $data = "";
        $sql = "SELECT * FROM Subjects";
        $s = $c ->prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value = ".$r['Code'].">".$r['Name']." [ ".$r['Code']." ]  </option>";
        }
        return $data;    
    }

    function populateAllClasses($c)
    {
        $data = "";
        $sql = "SELECT * FROM Courses";
        $s = $c ->prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value = ".$r['Number'].">".$r['Name']." [ ".$r['Subjects_Code']." ".$r['Number']." ]  </option>";
        }
        return $data;    
    }

    function populateYearDropdown($c)
    {
        $data = "";
        $sql = "SELECT DISTINCT Year FROM ProfCourse";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($row = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option>".$row['Year']."</option>";
        }
        return;
    }
    function populateProfDropdown($c)
    {
        $data = "";

        $sql = "SELECT FirstName, LastName, ID FROM Instructors";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($row = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value = ".$row['ID'].">".$row['FirstName']."  ".$row['LastName']."</option>";
        }
        return $data;
    }

    function populateMajorDropdown($c)
    {
        $data = "";

        $sql = "SELECT Code, Name FROM Subjects";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($row = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value = '".$row['Code']."'>".$row['Name']."  ( ".$row['Code']." ) </option>";
        }
        return $data;
    }

    function popYears()
    {
        $options = "";
        for($x = 0; $x <= 11; $x++)
        {
            $options .= '<option value = '.($x + 2010).'>  - '.($x+2010).'  -  </option>';
        }
        return $options;
    }

    function popTerms()
    {
        $options = '<option value = "summer">SUMMER</option>';
        $options .= '<option value = "fall">FALL</option>';
        $options .= '<option value = "spring">SPRING</option>';
        return $options;
    }

    function populateChosenSubjectNumber($c)
    {
        $sql = "SELECT Number, Name FROM Courses;";
        $s = $c -> prepare($sql);
        $s -> execute();
        $data = "";
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= '<option value = '.$r["Number"].'>'.$r['Number'].' [ '.$r["Name"].' ] </option>';
        }
        return $data;
    }

    function populateCommentTable($c)
    {
        $sql = "SELECT Name, TEXT, DateTimeStamp FROM Comments WHERE Instructors_ID = (SELECT ID FROM Instructors WHERE Reader = 1);";
        $s = $c ->prepare($sql);
        $s -> execute();
        $table = "";
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $table .= '<tr><td>'.$r['Name'].'</td>';
            $table .= '<td>'.$r['TEXT'].'</td>';
            $table .= '<td>'.$r['DateTimeStamp'].'</td>';
            $table .= '</tr>';
        }
        echo $table;
    }
?>