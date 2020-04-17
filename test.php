<?php
    echo "WELCOME TO TESTING \n";
    
    insertCourse(connDb());
    echo "GOODBYE\n";


    function insertCourse($c)
    {
        
        echo "FUNCTION: INSERT MORE COURSES \n";
        $answer = 0;
        $c = connDB();
        while($answer != 1)
        {
            $cd = readline("CODE: "  );
            echo "\n";
            $n = readline("NAME:  " );
            echo "\n";
            $sql = "INSERT INTO Subjects (Code, Name) VALUES ('".$cd."', '".$n."');";
            $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $c->exec($sql); 
            $answer = readline("CONTINUE? [0 = yes, 1 = no]  ");
        }
        return;
    }


    function connDB() 
   {
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