<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Edit Instructor </h1>

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

                    // Fetch the record
                    $sql = "SELECT ID, FName, LName,department FROM instructors ";
                    $result = $conn->query($sql);

                    // If the record actually exists
                    if ($result->num_rows > 0) {


                        $sql = "SELECT departmentName FROM departments";
                        $result2 = $conn->query($sql);

                        ?>
                        <form action="edit_instructor_result.php" method="post">


                        <?php
                        // Get the data
                        $row = $result->fetch_assoc();
                        ?>
                            <p>ID: <input type="text" name="ID" value = "<?php echo $row["ID"] ?>" readonly /></p>
                            <p>First name: <input type="text" name="FName" value = "<?php echo $row["FName"] ?>" /></p>
                            <p>Last name: <input type="text" name="LName" value = "<?php echo $row["LName"] ?>" /></p>
                            Departments: &nbsp
                            <select name="department">
                                <?php while ( $row2 = $result2->fetch_assoc() ){  ?>
                                        <option value = "<?php echo $row2["departmentName"] ?>"><?php echo $row2["departmentName"] ?></option>
                                <?php } ?>
                            </select>
                            <p><input type="submit" value = "Save Changes" /></p>
                        </form>
                        <?php
                    } else {
                        echo "Record does not exist";
                    }
                    echo "<br>Click <a href = 'dashboard.php'> here</a> to return to dashboard. <br />";
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
