<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Login Page </h1>

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
           ?>
           			<form action="dashboard.php" method="post">
                        <p>You're already logged in: <input type="submit" value = "Dashboard"/></p>
                    </form>
                <?php
                }
                else{
                ?>
	                <form action="login_result.php" method="post">
	                    <p>Username: <input type="text" name="username" value = "" /></p>
	                    <p>Password: <input type="password" name="password" value = "" /></p>
	                    <p><input type="submit" value = "Login"/></p>
	                </form>
        <?php
        			echo "Click <a href = 'dashboard.php'> here </a> to return to dashboard. <br />";
        		}
            }
            $conn->close();
        ?>
        <h6> University Registration </h6>

    </body>
</html>
