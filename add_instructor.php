<html>
    <head>
         <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Add Instructor </h1>

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
                    $sql = "SELECT departmentName FROM departments";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

            ?>

                        <form action="add_instructor_result.php" method="post">
                            <p>First name: <input type="text" name="FName" value = "" /></p>
                            <p>Last name: <input type="text" name="LName" value = "" /></p>
                            Departments: 
                            <select name="department">
                                <?php while ( $row = $result->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row["departmentName"] ?>"><?php echo $row["departmentName"] ?></option>
                                <?php } ?>
                            </select>
                            <p><input type="submit" value = "Create Record"/></p>
                        </form>
                <?php
                    }

                    else{
                ?>
                        echo "No department in DB, First create a department!"
                        <form action="add_department.php" method="post">
                        <p><input type="submit" value = "Create Department"/></p>
                        </form>
                <?php    
                    }

                    ?>
                    <br>
                        Click <a href = "dashboard.php"> here</a> to return to Dashboard. <br />
                    <br>
                    <?php

                }

                else{
                    ?>
                    <br>
                       Unrestricted Area! Click <a href = "dashboard.php"> here </a> to return to Dashboard. <br />
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