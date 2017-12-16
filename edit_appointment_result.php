<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Edit Course </h1>

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

                $sql = "UPDATE courses SET ID = '" . $_POST['ID'] . "', courseName = '" . $_POST['courseName'] .
                    "', instructorID = '" . $_POST['instructor']. "', qouta = '" . $_POST['qouta'] . "', department = '" . $_POST['department'] . "' WHERE ID = " . $_POST['ID'];

                if ($conn->query($sql) === TRUE) {
                    echo "Course was updated successfully <br />";
                } else {
                    echo "Error updating appointment: " . $conn->error; 
                }
                echo "<br>Click <a href = 'dashboard.php'> here </a> to return to dashboard. <br />";

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
        <h6> Hospital Suyunu </h6>

    </body>
</html>
