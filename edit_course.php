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

                // Fetch the record
                $sql = "SELECT ID, courseName, instructorID, qouta,department FROM courses WHERE ID = " . $_GET['id'] ;
                $result = $conn->query($sql);

                // If the record actually exists
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    $sql = "SELECT FName, LName,ID FROM instructors ";
                    $resultU = $conn->query($sql);

                    $sql = "SELECT ID, departmentName FROM departments";
                    $resultB = $conn->query($sql);

                    ?>
                    <form action="edit_course_result.php" method="post">
                        <p>Course ID: <input type="text" name="ID" value = "<?php echo $row["ID"] ?>" readonly /></p>
                        <p>Course Name: <input type="text" name="courseName" value = "<?php echo $row["courseName"] ?>"  /></p>
                        <p>Qouta: <input type="number" name="qouta" value = "<?php echo $row["qouta"] ?>"  /></p>

                        <br> Department: <br> 
                        <select name="department">
                            <?php while ( $rowB = $resultB->fetch_assoc() ){  ?>
                                    <option value = "<?php echo $rowB["departmentName"] ?>"> <?php echo $rowB["departmentName"] ?> </option>
                            <?php } ?>
                        </select>
                        <br>
                        <br> Instructor: <br> 
                        <select name="instructor">
                            <?php while ( $rowU = $resultU->fetch_assoc() ){  ?>
                                    <option value = "<?php echo $rowU["ID"] ?>"> <?php echo $rowU["FName"] ?> </option>
                            <?php } ?>
                        </select>
                        <p><input type="submit" value = "Save changes"/></p>
                    </form>
                    <?php

                } else {
                    echo "Record does not exist";
                }
                echo "Click <a href = 'dashboard.php'> here </a> to return to dashboard. <br />";
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
