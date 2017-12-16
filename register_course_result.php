<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Register to a Course </h1>

        <?php

            session_start();

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "university";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            else if (isset($_SESSION['user_id'])) {
                // Insert the record
                $sql = "SELECT ID, userID, courseID FROM takes_course WHERE userID = " . $_SESSION['user_id'];
                $result = $conn->query($sql);
                $duplicate = 0;
                while($row = $result->fetch_assoc()){
                    if($row["courseID"] === $_POST['course']){
                        $duplicate = 1;
                    }

                }
                if($duplicate === 1){
                    echo "Already registered to the course";
                }else{
                     $sql = "INSERT INTO takes_course(userID, courseID) " .
                    "VALUES('" . $_SESSION['user_id'] . "', '" . $_POST['course'] . "')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Registered to the course successfully <br />";
                    } else {
                        echo "Error registering to a course:  " . $conn->error; 
                    }
                    $sql = "UPDATE courses SET numberOfStudents = numberOfStudents + 1 WHERE ID =" . "'" . $_POST['course'] . "'";

                    if ($conn->query($sql) === TRUE) {
                        echo "Registered to the course successfully <br />";
                    } else {
                        echo "Error registering to a course:  " . $conn->error; 
                    }
                    echo "<br>Click <a href = 'dashboard.php'> here </a> to return to dashboard. <br />";
                }
               
            }
            else{
                ?>
                <br>
                   You're not even logged in! Click <a href = "dashboard.php"> here </a> to return to dashboard. <br />
                <br>
                <?php
            }
            $conn->close();
        ?>
        <h6> University Registration</h6>

    </body>
</html>
