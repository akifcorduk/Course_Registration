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
                $sql = "SELECT ID, courseName FROM courses WHERE department = '" .  $_POST['department'] . "'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

        ?>

                    <form action="register_course_result.php" method="post">
                        Course:
                        <select name="course">
                            <?php while ( $row = $result->fetch_assoc() ){  ?>
                                    <option value = "<?php echo $row["ID"] ?>" > <?php echo $row["courseName"]  ?> </option>
                            <?php } ?> 
                        </select>

                        <p><input type="submit" value = "Submit"/></p>
                    </form>
            <?php
                }

                else{
            ?>
                    echo "There is no course to select"
            <?php    
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
        <h6> University Registration</h6>

        

    </body>
</html>