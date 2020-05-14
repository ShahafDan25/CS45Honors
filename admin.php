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
            <table class = "table optionTable">
                <thead>
                    <th> OPTION </th>
                    <th> CLICK BUTTON </th>
                </thead>
                <tbody>
                    <tr>
                        <td>Insert a new class to the database</td> 
                        <td><button class = "btn btn-warning" data-toggle = "collapse" data-target = "#newClass" aria-expanded="false"> Click Here  </button></td>
                    </tr>
                    <tr>
                        <td>Register a new Instructor to the School</td> 
                        <td><button class = "btn btn-warning" data-toggle = "collapse" data-target = "#newProf" aria-expanded="false"> Click Here </button></td>
                    </tr>
                    <tr>
                        <td>Add an existing class to an academic term</td> 
                        <td><button class = "btn btn-warning" data-toggle = "collapse" data-target = "#existClass" aria-expanded="false"> Click Here  </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br><hr class = "sep"><br><br>
        <div class = "collapse" id = "newClass">
            <h3>INSERT A NEW CLASS TO THE DATABASE</h3>
            <br>
            <form action = "funcs.php" method = "post" class = "commentForm">
                <select class = "btn btn-input" name = "subject">
                    <option>SUBJECTS</option>
                    <!-- PHP CODE TO POPULATE -->
                    <?php
                        echo populateMajorDropdown(connDB());
                    ?>
                </select>
                <p> SELECT ALL THE PROFESSORS THAT WILL TEACH THIS CLASS </p>
                <select class = "btn btn-input" name = "prof">
                    <option>PROFESSORS</option>
                    <!-- PHP CODE TO POPULATE -->
                    <?php
                        echo populateProfDropdown(connDB());
                    ?>
                </select> <br><br>
                <p> SELECT THE YEAR AND ACADEMIC TERM </p> 
                <select class = "btn btn-input inline" name = "year"><?php  echo popYears(); ?></select>
                <select class = "btn btn-input inline" name = "term"><?php  echo popTerms(); ?></select>
                <br><br>
                <input type = "text" name = "courseNumber" placeholder="Course Number" class = "btn btn-input">
                <input type = "text" name = "courseName" placeholder = "class name" class = "btn btn-input"><br>
                <input type = "hidden" name = "message" value = "insertNewCourse"><br>
                <button class = "btn btn-success sidePadder5">SUBMIT</button>
            </form>
        </div>
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
        <div class = "collapse" id = "existClass">
            <h3> ADD AN EXISTING CLASS TO AN ACADEMIC TERM </h3><br>
            <form action = "funcs.php" method = "post" class = "commentForm">
                <select class = "btn btn-input inline" name= "subject" required><?php echo populateAllSubjects(connDB()); ?></select>
                <select class = "btn btn-input inline" name= "number" required><?php echo populateAllClasses(connDB()); ?></select>
                <select class = "btn btn-input inline" name = "prof" required><?php echo populateProfDropdown(connDB()); ?></select>
                <br><br>
                <select class = "btn btn-input inline" name = "term" required><?php echo popTerms(); ?></select>
                <select class = "btn btn-input inline" name = "year" required><?php echo popYears(); ?></select>
                <br><br>
                <input type = "hidden" value = "addExists" name = "message">
                <button class = "btn btn-success sidePadder5"> SUBMIT </button>
            </form> 
    
        </div>  
    </body>
</html>