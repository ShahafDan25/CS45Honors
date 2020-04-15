<?php
    // ----------------------------------- //
    // ----------- POSTS ----------------- //
    // ----------------------------------- //
    if($_POST['message'] == "insertProfessor")
    {
        $c = connDB();
        $fn = $_POST['firstname'];
        $ln = $_POST['lastname'];
        if(empty($_POST['taken'])) $taken = true;
        else $taken = false;
        insertProfessor($c, $fn, $ln, $taken);
        //return to page - CHANGE TO INDEX.PHP LATER
        echo '<script>location.replace("index.php");</script>';
    }
   
    if($_POST['message'] == "feedAboutProf")
    {
        $p = $_POST['profSelected'];
        updateProfFeed($c, $p);
        echo '<script>location.replace("comment.php");</script>';

    }
   
    // ----------------------------------- //
    // ---------- FUNCTIONS -------------- //
    // ----------------------------------- //
    function updateProfFeed($c, $p)
    {
        $sql = "UPDATE Instructors SET Comment = 1 WHERE ID = ".$p;
        $stmt = $conn -> prepare($sql);
        $stmt -> execute();
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