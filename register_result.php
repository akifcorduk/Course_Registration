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
                    // Insert the record
                    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users(FName, LName, username, password,department, isAdmin) " .
                        "VALUES('" . $_POST['FName'] . "', '" . $_POST['LName'] .
                        "', '" . $_POST['username'] . "', '". $_POST['department']. "', '" . $hash . "', 0)";

                    if ($conn->query($sql) === TRUE) {
                        $sql = "SELECT ID FROM users WHERE username = " . "'" . $_POST['username'] . "'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $_SESSION["user_id"] = $row["ID"];

                        echo "Record was created successfully <br />";
                    } else {
                        echo "Error adding record: " . $conn->error;
                    }
                    echo "Click <a href = 'dashboard.php'> here </a> to return to dashboard. <br />";
                }
            }
            $conn->close();
        ?>
        <h6> University Registration</h6>

    </body>
</html>
