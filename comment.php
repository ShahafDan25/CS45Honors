<?php include "funcs.php"; ?>
<?php
    $sql = "SELECT ID, FirstName, LastName FROM Instructors WHERE Comment = 1"; //there has to be a professor
    $c = connDB();
    $s = $c -> prepare($sql);
    $s -> execute();
    $row = $s -> fetch(PDO::FETCH_ASSOC);
    $id = $row['ID'];
    $prof = $row['FirstName']."  ".$row['LastName'];

?>
<DOCTYPE! html>
    <html>
        <head>
            <title>Leave a Comment!</title>


            <!-- Bootstrap for CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            
            <!-- LINK TO OUT CSS CODE -->
            <link rel="stylesheet" type="text/css" href="lpcrmp.css">
            <!-- LINK TO OUT JS CODE -->
            <script src = "lpcrmp.js"></script>  

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
            <button class = "sm2 sp2 btn btn-info inline pull-left" onclick = "location.replace('login.php');"> LOGIN PAGE </button>
            <h1 class = "titler inline">LPC - RMP</h1>
            <hr class = "sep" size = "10">
        </div>
        <body class = "body">
            <br>
            <button class = "btn btn-info pull-left sideMargger5" onclick = backHome()> HOME PAGE </button>
            <h2> Comment about your experience with <?php echo $prof; ?></h2> 
            <br><hr class = "sep"><br>
            <form action = "funcs.php" method = "post" class = "commentForm">
                <label class="btn checkboxer">
                    <input type="checkbox" name = "annoStatus" value = "anno"> Comment Anonymously 
                </label> &nbsp; &nbsp;
                <label class="btn checkboxer">
                    <input type="checkbox"  name = "annoStatus" id = "nameCheck"> Enter My Name
                    <input id = "nameField" type = "text" name = "commenterName" class = "btn btn-input increaseHeight" disabled>
                </label>
                <br><hr class = "sep">
                <p> Select each one of the followings: </p>
                <table class = "table framer w60" style = "margin: 0px !important;">
                    <tbody>
                        <tr>
                            <td>Select A Course </td>
                            <td> <select name = "courseTaken" class = "inline sideMargger5 btnSelect" required><?php echo populateCoursesForProf($c); ?></select></td>
                        </tr>
                        <tr>
                            <td>Select An Academic Term and Year</td>
                            <td> <select name = "termTaken" class = "inline sideMargger5 btnSelect" required><?php echo popTerms()?></select><select name = "yearTaken" class = "inline sideMargger5 btnSelect" required><?php echo popYears();?></select> </td>
                        </tr>
                        <tr>
                            <td>What was Your Grade? </td>
                            <td><select name = "grade" class = "inline sideMargger5 btnSelect" required><?php echo popGrades();?></select> </td>
                        </tr>
                        <tr>
                            <td>How would you rate Professor <?php echo $prod?> ? </td>
                            <td><select name = "ratings" class = "inline sideMargger5 btnSelect" required><?php echo popRatings();?></select> </td>
                        </tr>
                    </tbody>
                </table>
                <br><hr class = "sep">
                <p> Leave you feedback below! </p>
                <textarea style = "border: 1px solid black; border-radius: 4px; width: 100% !important; padding: 2% !important;" placeholder = "Insert your comment here!" name = "comment"></textarea>
                <input type = "hidden" name = "message" value = "commentary">
                <br><br>
                <button class = "btn btn-success"> SUBMIT </button>
            </form>
            <br>
            
        </body>
    </html>
        <script>
            document.getElementById('nameCheck').onchange = function() 
            {
                document.getElementById('nameField').disabled = !this.checked;
            };
        </script>
</DOCTYPE>