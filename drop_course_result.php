<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Drop a Course </h1>

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

                // Delete the record
                $sql = "DELETE FROM takes_course WHERE courseID = " . $_POST['course'];

                if ($conn->query($sql) === TRUE) {
                    echo "Course was dropped successfully <br />";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
                $sql = "UPDATE courses SET numberOfStudents = numberOfStudents - 1 WHERE ID =" . "'" . $_POST['course'] . "'";

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
        <h6> University Registration </h6>

    </body>
</html>
