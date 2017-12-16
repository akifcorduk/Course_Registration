<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE university";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

echo "<br>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create Table
$sql = "CREATE TABLE departments (
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
departmentName VARCHAR(30) NOT NULL,
UNIQUE (departmentName)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table departments created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE TABLE instructors (
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
FName VARCHAR(30) NOT NULL,
LName VARCHAR(30) NOT NULL,
department VARCHAR(30) NOT NULL,
FOREIGN KEY (department) REFERENCES departments (departmentName)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Table instructors created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE TABLE users (
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
FName VARCHAR(30) NOT NULL,
LName VARCHAR(30) NOT NULL,
username VARCHAR(30) NOT NULL,
password CHAR(128) NOT NULL,
department VARCHAR(30) NOT NULL,
isAdmin INT(1) NOT NULL,
UNIQUE (username)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE TABLE courses (
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
courseName VARCHAR(30) NOT NULL,
instructorID INT(6) UNSIGNED NOT NULL,
department VARCHAR(30) NOT NULL,
qouta INT(6) UNSIGNED NOT NULL,
numberOfStudents INT(6) UNSIGNED NOT NULL,
FOREIGN KEY (instructorID) REFERENCES instructors (ID)
	ON DELETE CASCADE
	ON UPDATE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Table courses created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE TABLE takes_course (
ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
userID INT(6) UNSIGNED NOT NULL,
courseID INT(6) UNSIGNED NOT NULL

)";

if ($conn->query($sql) === TRUE) {
    echo "Table courses created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

echo "<br>";

$sql = "CREATE PROCEDURE `list_instructors`(IN Department VARCHAR(30))IF Department!='ALL' THEN
SELECT courses.instructorID, courses.courseName FROM courses WHERE courses.department IN(SELECT departments.departmentName FROM departments WHERE departments.departmentName = Department);
 ELSE 
 SELECT courses.instructorID, courses.courseName FROM courses;
 END IF" ;

if ($conn->query($sql) === TRUE) {
    echo "List instructors procedure created successfully";
} else {
    echo "Error creating stored procedure: " . $conn->error;
}

echo "<br>";

$sql = "CREATE PROCEDURE `list_students`(IN Department VARCHAR(30))IF Department!='ALL' THEN
SELECT * FROM takes_course WHERE takes_course.userID IN(SELECT users.studentID FROM users WHERE users.department IN(SELECT departmentName FROM departments WHERE departments.departmentName = Department));

ELSE 
SELECT * FROM users WHERE isAdmin = 0;
END IF" ;

if ($conn->query($sql) === TRUE) {
    echo "List students procedure created successfully";
} else {
    echo "Error creating stored procedure: " . $conn->error;
}


$sql = "CREATE TRIGGER `quota_before_update`     
  BEFORE UPDATE ON `courses`     
  FOR EACH ROW  
  
   BEGIN
        IF NEW.quota < OLD.numberOfStudents THEN
            SET NEW.quota = OLD.quota;
        END IF;
   END;
";

echo "<br>";


$sql ="INSERT INTO departments(ID,departmentName)". " VALUES(1, 'IT')" ;
$conn->query($sql);
$sql ="INSERT INTO departments(ID,departmentName)". " VALUES(2, 'CmpE')" ;
$conn->query($sql);
$sql ="INSERT INTO departments(ID,departmentName)". " VALUES(3, 'IE')" ;
$conn->query($sql);
$sql ="INSERT INTO departments(ID,departmentName)". " VALUES(4, 'EE')" ;


if ($conn->query($sql)  === TRUE) {
    echo "Department added successfully\r\n";
} else {
    echo "Error adding department: " . $conn->error;
}
echo "<br>";

$hash = password_hash('password', PASSWORD_DEFAULT);
$sql = "INSERT INTO users(FName, LName, username, password,department, isAdmin) " .
    "VALUES('Akif', 'Corduk', 'admin', '" . $hash . "', 'IT', 1)";  

if ($conn->query($sql) === TRUE) {
    echo "Admin created successfully: <br>Username: admin <br>Password: password";
} else {
    echo "Error creating admin: " . $conn->error;
}


echo "<br><br><a href = \"dashboard.php\">Dashboard</a><br /><br />";

$conn->close();
?>

