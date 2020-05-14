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
   
    if($_POST['message'] == "feedAboutProf")
    {
        $p = $_POST['profSelected'];
        updateProfFeed(connDB(), $p);
        echo '<script>location.replace("comment.php");</script>';

    }

    if($_POST['message'] == 'commentary')
    {
        $c = connDB();
        if($_POST['annoStatus'] == "anno") $anno = "Anonymously";
        else $anno = $_POST['commenterName'];
        $course = $_POST['courseTaken'];
        $term = $_POST['termTaken'];
        $year = $_POST['yearTaken'];
        $grade = $_POST['grade'];
        $comment = $_POST['comment'];
        insertComment($c, $anno, $course, $term, $year, $grade, $comment);
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

    // ----------------------------------- //
    // ---------- FUNCTIONS -------------- //
    // ----------------------------------- //


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

    function insertComment($c, $a, $co, $t, $y, $g, $com)
    {
        //first: retrieve professor ID
        $sql = "SELECT ID FROM Instructors WHERE Comment = 1";
        $s = $c -> prepare($sql);
        $s -> execute();
        

        //second: insert comment with that ID
        $sql = "INSERT INTO Comments () VALUES ()";
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
        $sql = "SELECT Number, Name FROM Courses WHERE Subject_Code = (SELECT Code FROM Subjects WHERE chsoen = 1);";
        $s = $c -> prepare($sql);
        $s -> execute();
        $data = "";
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= '<option value = '.$r["Number"].'>'.$r['Number'].' [ '.$r["Name"].' ] </option>';
        }
        return $data;
    }
?>