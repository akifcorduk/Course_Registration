<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Logout Page </h1>

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
            else{
            	if (isset($_SESSION['user_id'])) {
                    session_unset(); 
                    // destroy the session 
                    session_destroy(); 
            ?>
                    Logout Succesful!
           			<br>
                    <a href = "dashboard.php">Dashboard</a><br />
                    <br>
                <?php
                }
                else{
                ?>
	                <br>
                    You're not even logged in! Click <a href = "dashboard.php"> here </a> to return to dashboard. <br />
                    <br>
        <?php
        		}
            }
            $conn->close();
        ?>
        <h6> University Registration </h6>

    </body>
</html>
