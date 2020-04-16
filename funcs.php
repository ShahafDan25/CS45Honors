<?php
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
   
    // ----------------------------------- //
    // ---------- FUNCTIONS -------------- //
    // ----------------------------------- //
    function insertComment($c, $a, $co, $t, $y, $g, $com)
    {
        //first: retrieve professor ID
        $sql = "SELECT ID FROM Instructors WHERE Comment = 1";
        $s = $c -> prepare();
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
            $data .= "<option>".$row['Name']."  ( ".$row['Code']." ) </option>";
        }
        return $data;
    }

    function insertProfessor($c, $f, $l, $t)
    {
        $sql = "INSERT INTO Instructors (FirstName, LastName) VALUES ('".$f."', '".$l."');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c->exec($sql);
        //add echo script to go to comment page
    }

    function populateYearDropdown($c)
    {
        $data = "";
        $sql = "SELECT DISTINCT Year FROM Courses_have_Instructors";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($row = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option>".$row['Year']."</option>";
        }
        return;
    }

   function connDB() {
        //CONNECTION ESTABLISHMENT TO LOCAL HOST
        $username = "root";
        $password = "MMB3189@A";
        $dsn = 'mysql:dbname=LPCRMP;host=127.0.0.1;port=3306;socket=/tmp/mysql.sock';  
        //try and catch block to connect to MySQL, or throw an error
        try {
            $conn = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
        echo 'Connection Failed: ' . $e -> getMessage();
        } // end of try and catch
        return $conn;
    }
?>