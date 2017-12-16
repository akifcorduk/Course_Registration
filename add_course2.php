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
                    $sql2 = "SELECT ID,FName,LName,department FROM instructors WHERE department = '".$_POST['department']."'"  ;
                    $result2 = $conn->query($sql2);
                    
                    if ($result2->num_rows > 0) {
        ?>
                    <form action="add_course_result.php" method="post">
                        <br/>
                        Instructor:
                        <select name = "instructor">  
                            <?php while ( $row = $result2->fetch_assoc() ){ ?>
                                           
                                    <option value = "<?php echo $row["ID"] ?>"> <?php echo $row["FName"]." ".$row["LName"]  ?> </option>
                            <?php       } ?>
                        </select>
                        <br/>        
                           
                        <p hidden><input type="text" name="department" value = "<?php echo $_POST['department'] ?>" />  </p>             
                        <p>Course name: <input type="text" name="courseName" value = "" /></p>
                        <p>Qouta: <input type="number" name="qouta" value = "" /></p>
                        <p>Number of students: <input type="number" name="numberOfStudents" value = "0" /></p>
                        <p><input type="submit" value = "Create Record"/></p>
                    </form>

        <?php
                    }else{
                        echo "<br>No instructors in this department. <br />";
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
