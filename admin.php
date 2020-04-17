<?php include "funcs.php"; ?>
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

        <body>
            <br><br>
            <h2> ADMIN PAGE </h2><br>
            <h4> ACTIVITIES ONLY THE ADMIN CAN DO</h4>
            <div class = "btnOptions">
                <br><br>
                <button class = "btn btn-warning inline" data-toggle = "collapse" data-target = "#newClass" aria-expanded="false"> Insert New Class </button>
                <button class = "btn btn-warning inline" data-toggle = "collapse" data-target = "#newProf" aria-expanded="false"> Insert New Professor </button>
            </div>
            <br><br><hr class = "sep"><br><br>
            <div class = "collapse" id = "newProf">
                <h3>INSERT A NEW INSTRUCTOR TO THE DATABASE</h3>
                <br>
                <form action = "funcs.php" method = "post" class = "commentForm">
                    <input type = "text" placeholder= "First Name" name = "firstName" class = "btn btn-input">
                    <input tpye = "text" placeholder= "Last Name" name = "lastName" class = "btn btn-input"><br><br>
                    <p class = "inline">Select Their <strong>Department</strong>:</p>
                    <select class = "btn btn-input inline" name = "dept" required>
                        <option>SELECT A SUBJECT</option>
                        <!-- PHP CODE TO POPULATE -->
                        <?php
                            echo populateMajorDropdown(connDB());
                        ?>
                    </select> <br><br>
                    <input type = "hidden" name = "message" value = "insertNewProf">
                    <button class = "btn btn-success sidePadder5">SUBMIT</button>
                </form>
            </div>
            <div class = "collapse" id = "newClass">
                <h3>INSERT A NEW CLASS TO THE DATABASE</h3>
                <br>
                <form action = "funcs.php" method = "post" class = "commentForm">
                    <select class = "btn btn-input" name = "courseName">
                        <option>SELECT A SUBJECT</option>
                        <!-- PHP CODE TO POPULATE -->
                        <?php
                            echo populateMajorDropdown(connDB());
                        ?>
                    </select> <br><br>
                    <input type = "text" name = "courseNumber" placeholder="Course Number" class = "btn btn-input">
                    <input type = "text" name = "courseName" placeholder = "class name" class = "btn btn-input"><br>
                    <input type = "hidden" name = "message" value = "insertNewCourse"><br>
                    <button class = "btn btn-success sidePadder5">SUBMIT</button>
                </form>
            </div>
        </body>
    </html>