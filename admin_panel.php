<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Admin Panel </h1>

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

                    // List Instructers
                    $sql = "SELECT ID, FName, LName, department FROM instructors";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <h2> Instructors </h2>
                        <table border = 1>
                            <tr>
                                <th>Operations</th>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <a href = "delete_instructor.php?id=<?php echo $row["ID"]; ?>"><img src = "img/delete.png" alt = "Delete" /></a>
                                    <a href = "edit_instructor.php?id=<?php echo $row["ID"]; ?>"><img src = "img/edit.png" alt = "Edit" /></a>
                                </td>
                                <td><?php echo $row["ID"]; ?></td>
                                <td><?php echo $row["FName"]; ?></td>
                                <td><?php echo $row["LName"]; ?></td>
                                <td><?php echo $row["department"]; ?></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </table>
                        <?php
                    } else {
                        echo "The instructor table is empty";
                    }

                    ?>

                    <br>
                    <a href = "add_instructor.php">Add a new instructor</a><br />
                    <br>

                    <?php

                    // List Courses
                    $sql = "SELECT ID, courseName,department,qouta,numberOfStudents FROM courses";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <h2> Courses </h2>
                        <table border = 1>
                            <tr>
                                <th>Operations</th>
                                <th>ID</th>
                                <th>Course Name</th>
                                <th>Department Name</th>
                                <th>Qouta</th>
                                <th>Number of students</th>
                        <?php

                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <a href = "delete_course.php?id=<?php echo $row["ID"]; ?>"><img src = "img/delete.png" alt = "Delete" /></a>
                                    <a href = "edit_course.php?id=<?php echo $row["ID"]; ?>"><img src = "img/edit.png" alt = "Edit" /></a>
                                </td>
                                <td><?php echo $row["ID"]; ?></td>
                                <td><?php echo $row["courseName"]; ?></td>
                                <td><?php echo $row["department"]; ?></td>
                                <td><?php echo $row["qouta"]; ?></td>
                                <td><?php echo $row["numberOfStudents"]; ?></td>
                            </tr>
                            <?php
                        }

                        ?>
                        </table>
                        <?php
                    } else {
                        echo "The course table is empty";
                    }
                    ?>

                    <br>
                    <a href = "add_course.php">Add a new course</a><br />
                    <br>

                    <?php
                    $sql = "SELECT courseName FROM courses";
                    $result = $conn->query($sql);


                    ?>


                    <br>
                    Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                    <br>
                    
                    <?php
                }
                else{
                    ?>
                    <br>
                       Unrestricted Area! Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                    <br>
                    <?php
                }
            }
            else{
                ?>
                <br>
                   You're not even logged in! Click <a href = "dashboard.php"> here</a> to return to dashboard. <br />
                <br>
                <?php
            }

            $conn->close();
        ?>
        <h6> University Registration </h6>

    </body>
</html>
