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
                    $sql = "SELECT ID,departmentName FROM departments";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
        ?>
                    <form action="add_course2.php" method="post">
                        Department:
                        <select name= "department">
                            <?php while ( $row = $result->fetch_assoc() ){  ?>
                                    <option value = "<?php echo $row["departmentName"] ?>"> <?php echo $row["departmentName"]  ?> </option>
                                     <?php
                       
                            }?> 
                        </select>
                       <p><input type="submit" value = "Create Record"/></p>
                    </form>

        <?php
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
