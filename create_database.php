<?php 
session_start(); 
include "config.php";
?>
<!DOCTYPE html>

<html lang="en">

<?php include "head.php" ?>

<body>

    <?php include "header.php" ?>
    <div class="container">
        <div class="well" class="content">

        <?php

        if (isset($_POST["ac"])) {
            if ($_POST["ac"]=="log") {
                if (isset($_POST['createdatabase'])) {

                    if (mysql_query("CREATE DATABASE internfoxdatabase",$con))
                        echo "<strong>Database created</strong><br />";
                    else
                        echo "<strong>Error creating database: " . mysql_error() . "</strong><br /><br />";
                }

                if (isset($_POST['createuserstable'])) {

                    $sql = "CREATE TABLE users 
                    (
                        id INT NOT NULL AUTO_INCREMENT,
                        email VARCHAR(30) NOT NULL UNIQUE,
                        password VARCHAR(64) NOT NULL,
                        salt VARCHAR(3) NOT NULL,
                        fname VARCHAR(30),
                        lname VARCHAR(30),
                        dob DATE,
                        gender VARCHAR(6);
                        zipcode INT(5),
                        objective VARCHAR(8000),
                        technology_interest BOOL, 
                        science_interest BOOL,
                        government_interest BOOL,
                        business_interest BOOL,
                        journalism_interest BOOL,

                        isConfirmed BOOL,

                        PRIMARY KEY(id)
                    );
                    CREATE TABLE activities
                    (
                        id INT NOT NULL,
                        activity_id INT NOT NULL AUTO_INCREMENT,
                        activity_name VARCHAR(100),
                        activity_description VARCHAR(8000),

                        PRIMARY KEY(activity_id)
                    );
                    CREATE TABLE companies
                    (
                        company_id INT NOT NULL AUTO_INCREMENT,
                        name VARCHAR(100),
                        company_displayname VARCHAR(100),
                        company_about VARCHAR(8000),
                        company_website VARCHAR(200),
                        company_logo VARCHAR(200),
                        company_operatinghours VARCHAR(200),

                        internship_name VARCHAR(8000),
                        internship_description VARCHAR(8000),
                        internship_type VARCHAR(200),
                        internship_date VARCHAR(200),
                        internship_deadline VARCHAR(200),
                        internship_location VARCHAR(200),
                        internship_compensation VARCHAR(200),
                        internship_hours VARCHAR(200),

                        contact_email VARCHAR(200),
                        contact_person VARCHAR(200),

                        isPosted BOOL,

                        PRIMARY KEY(company_id)
                    );
                    CREATE TABLE applications
                    (
                        application_id INT NOT NULL AUTO_INCREMENT,
                        company_id INT,
                        user_id INT,
                        date DATE,
                        isVerified BOOL,

                        PRIMARY KEY(application_id)
                    )
                    ";

                    mysql_query($sql,$con);



                    echo "<strong>'users' Table Created</strong><br /><br />";
                }

                if (isset($_POST['addcolumns'])) {
                    
                    $sql = "ALTER TABLE users
                            ADD (technology_interest BOOL , science_interest BOOL, government_interest BOOL, business_interest BOOL, journalism_interest BOOL)";

                    mysql_query($sql,$con);

                    echo "<strong>Columns added</strong><br /><br />";
                }
            }
        }

        mysql_close($con)

        ?>

        <form action="createdatabase.php" method="post"><input type="hidden" name="ac" value="log" />
            Create Database: <input type="checkbox" name="createdatabase" /><br />
            Create "users" Table: <input type="checkbox" name="createuserstable" /><br />
            Add columns: <input type="checkbox" name="addcolumns" /><br />
            <input type="submit" />
        </form>

        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
