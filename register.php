<html>
    <head>
        <title>University Registration</title>
    </head>
    <body style="background-color: LavenderBlush   ; color: Indigo  ;">

        <h1> Register Page </h1>

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
                    <form action="register_result.php" method="post">
                        <p>First name: <input type="text" name="FName" value = "" /></p>
                        <p>Last name: <input type="text" name="LName" value = "" /></p>
                        <p>Department: <input type="text" name="department" value = "" /></p>
                        <p>username: <input type="text" name="username" value = "" /></p>
                        <p>password: <input type="password" name="password" value = "" /></p>
                        <p><input type="submit" value = "Create Record"/></p>
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
