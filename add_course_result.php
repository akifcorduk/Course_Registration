<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Add Course </h1>

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
                $sql = "SELECT isAdmin FROM users WHERE ID = " . $_SESSION['user_id'];
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if($row["isAdmin"] == 1){
                    // Insert the record
                    $sql = "INSERT INTO courses(department, courseName,qouta,instructorID,numberOfStudents) " .
                        "VALUES('" . $_POST['department'] . "', ' ".$_POST['courseName'] . "', '". $_POST['qouta']."', '". $_POST['instructor']."', '". $_POST['numberOfStudents'] ."')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Course was created successfully <br />";
                    } else {
                        echo "Error adding record: " . $conn->error;
                    }
                    echo "<br>Click <a href = 'dashboard.php'> here </a> to return to dashboard. <br />";
                }
                else{
                    ?>
                    <br>
                       Unrestricted Area! Click <a href = "dashboard.php"> here </a> to return to dashboard. <br />
                    <br>
                    <?php
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
        <h6> University Registration </h6>

    </body>
</html>