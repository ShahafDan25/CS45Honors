<?php include "funcs.php"; ?>
<DOCYTPE! html>
    <html>
        <head>
            <title>LPC RMP (CS45 Honors)</title>

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
            <div class = "upperBody">
                <button class = "pull-left btn btn-into" onclick = "goToAdmin()"> ADMIN </button>
                <br>
                <h2> Rate My Professor </h2>
                <h4> Las Positas College </h4> <br>
                <ul class = "objectives">
                    <li> Leave a feedback about an instructor! </li>
                    <li> Learn about your professors at LPC! </li>
                    <li> Design and establish an academic path at LPC! </li>
                </ul>
            </div>
            <br>
            <hr class = "sep" size = "10">
            <div class = "lowerBody">
                <br><br>
                    <span>
                        <div class = "option_a">
                            <h3> Leave Feedback </h3>
                            <button class = "btn btn-warning" data-toggle = "collapse" data-target = "#leaveFeedback"> Go To Form </button>
                        </div>

                        <div class = "option_b"> 
                            <h3> Read Feedback </h3>
                            <button class = "btn btn-warning" data-toggle = "collapse" data-target = "#readFeedback" aria-expanded="false"> Go To Forum </button>
                        </div>

                        <div class = "option_c">
                            <h3> Plan Ahead </h3>
                            <button class = "btn btn-warning" data-toggle = "collapse" data-target = "#planner" aria-expanded="false"> Go To Planner</button>
                        </div>
                    </span> <!-- END OF INLINE OBJECTS -->
                    <br> <br> <hr class = "sep"> <br>
                    <div id = "leaveFeedback" class = "collapse centrize">
                        <h4> Fill out the form below to leave a feeback </h4>
                        <p> Choose a professor from the below dropdown, or else insert his information </p>
                        <br><hr class = "sep"><br>
                        <h4> Choose a Professor </h4>
                        <form class = "optionForm" action = "funcs.php" method = "post">
                            
                            <select class = "btn browser-default inline sideMargger5 increaseHeight btn-input" name = "profSelected">
                                <option>SELECT A PROFESSOR</option>
                                
                                    <?php
                                        echo populateProfDropdown(connDB());
                                    ?>
                                
                            </select>
                            &nbsp;
                            <input type = "hidden" name = "message" value = "feedAboutProf">
                            <button class = "btn btn-success sidePadder5 sideMargger5 inline">SUBMIT </button>
                            
                        </form>
                        <br><hr class = "sep"><br>
                        <h4> Feedback New Professor </h4>
                        <form class = "optionForm" action = "funcs.php" method = "post">
                            <input type = "text" placeholder = "First Name" required name = "firstname" class = "btn btn-input sideMargger5">
                            <input type = "text" placeholder = "Last Name" required name = "lastname" class = "btn btn-input sideMargger5"><br><br>
                            <label class="btn btn-secondary active">
                                <input type="checkbox" required name = "taken"> I had a class with this instructor
                            </label>
                            <br> <!-- SAFE NICE SPACING -->
                            <input type = "hidden" name = "message" value = "insertProfessor">
                            <button class = "btn btn-success sideMargger5 sidePadder5"> SUBMIT </button>
                        </form>
                    </div>

                    <div id = "readFeedback" class = "collapse centrize">
                        <h4> Choose a professor from the drop down to read feebacks</h4>
                        <br><hr class = "sep"><br>
                        <h4> Choose a Professor </h4>
                        <form class = "optionForm" action = "funcs.php" method = "post">
                            
                            <select class = "btn browser-default inline sideMargger5 increaseHeight btn-input" name = "profSelected">
                                <option>SELECT A PROFESSOR</option>
                                
                                    <?php
                                        echo populateProfDropdown(connDB());
                                    ?>
                            
                            </select>
                            &nbsp;
                            <input type = "hidden" name = "message" value = "readAboutProf">
                            <button class = "btn btn-success sidePadder5 sideMargger5 inline">SUBMIT </button>
                            
                        </form>
                    </div>

                    <div id = "planner" class = "collapse centrize">
                        <h4> Plan your own academic path! </h4>
                        <br><hr class = "sep"><br>
                        <h4> Choose Your Major </h4>
                        <form class = "optionForm">
                            
                            <select class = "btn browser-default inline sideMargger5 increaseHeight btn-input" name = "profSelected">
                                <option>SELECT A MAJOR</option>
                                
                                    <?php
                                        echo populateMajorDropdown(connDB());
                                    ?>
                            
                            </select>
                            &nbsp;
                            <input type = "hidden" name = "message" value = "chooseAProf">
                            <button class = "btn btn-success sidePadder5 sideMargger5 inline">SUBMIT </button>
                            
                        </form>
                    </div>
                <br>
            </div>
            
        </body>
    </html>
