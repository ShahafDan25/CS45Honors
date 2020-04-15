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
        echo '<script>location.replace("index.html");</script>';
    }
   
   
   
    // ----------------------------------- //
    // ---------- FUNCTIONS -------------- //
    // ----------------------------------- //

    function insertProfessor($c, $f, $l, $t)
    {
        $sql = "INSERT INTO Instructors (FirstName, LastName) VALUES ('".$f."', '".$d."');";
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