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

                // Fetch the record
                $sql = "SELECT ID, userID, courseID FROM takes_course WHERE userID = " . $_SESSION['user_id'];
                $result = $conn->query($sql);
               
                
                    
                if ($result->num_rows > 0) {
                    ?>
                    <form action="drop_course_result.php" method="post">
                            <select name="course">
                            <?php while ( $row = $result->fetch_assoc() ){
                                     $sql = "SELECT courseName, ID FROM courses WHERE ID = " . $row["courseID"];
                                     $resultU = $conn->query($sql);
                                     $rowU = $resultU->fetch_assoc();  ?>
                                    <option value = "<?php echo $rowU["ID"] ?>"> <?php echo $rowU["courseName"] ?> </option>
                            <?php } ?>
                            </select>
         
                        <p><input type="submit" value = "Drop Course" /></p>
                    </form>

            <?php
                }

                else{
            ?>
                    w"There is no course to select"
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
        <h6> University Registration </h6>

    </body>
</html>