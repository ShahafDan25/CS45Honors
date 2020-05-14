<?php include "funcs.php"?>
<?php
    $c = connDB();
    $sql = "SELECT ID, FirstName, LastName FROM Instructors WHERE Reader = 1";
    $s = $c -> prepare($sql);
    $s -> execute();
    $r = $s -> fetch(PDO::FETCH_ASSOC);
    $id = $r['ID'];
    $f = $r['FirstName'];
    $l = $r['LastName'];
?>
<DOCYTPE! html>
<html>
    <head>
        <title>Admin</title>

        <!-- <link rel="shortcut icon" href="./The Market_files/lpcsgLogo.jpg"> -->

            <!-- Bootstrap for CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <!-- CSS HARDCODE FILE LINK -->
        <link rel="stylesheet" type="text/css" href="lpcrmp.css"> 

        <!-- Bootstrap for JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- MORRIS.JS (for graphing utilities from PHP data) LINKS -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    </head>
    <div class = "cover">
            
            <button class = "sm2 sp2 btn btn-info inline pull-left" onclick = "location.replace('admin.php');"> ADMIN </button>
            <button class = "sm2 sp2 btn btn-info inline pull-left" onclick = "location.replace('login.html');"> LOGIN PAGE </button>
            <button class = "sm2 sp2 btn btn-info inline pull-left" onclick = "location.replace('index.php');"> HOME PAGE </button>

            <h1 class = "titler inline">LPC - RMP</h1>
            <hr class = "sep" size = "10">
        </div>
    <body>
        <div class = "container">
            <br>
            <h1> Welcome !</h1>
            <h4> Here are some of the comments other students left about <u>Professor <?php echo $f.' '.$l;?></u></h4>

            <table class = "table commentTable">
                <thead>
                    <th> Feedbacker: </th>
                    <th> Comment: </th>
                    <th> Date </th>
                </thead>
                <tbody>
                    <?php populateCommentTable(connDB()); ?>
                </tbody>
            </table>
        </div>
    </body>


    <footer class = "footer">
        <p> <strong>Las Positas College | Academic Year 2020</strong></p>
        <p> Special Thanks to the <u>www.thekomanetskys.com</u></p>
        <p> Shahaf Dan Production (All rights reserved)</p>
    </footer>



    <script></script>

</html>