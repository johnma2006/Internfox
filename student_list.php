<?php 
session_start(); 
include "config.php";
include "require_admin.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Student Profile List</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="well" class="content">

            <h2>Student List</h2><br />
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width:240px">Name</th>
                  <th style="width:280px">Email</th>
                  <th style="width:180px">Availability</th>
                  <th style="width:150px">Profile</th>
                  <th style="width:150px">Resume</th>
                  <th style="width:20px">Confirmed</th>
                </tr>
              </thead>
              <tbody>

              <?php 

              $result = mysql_query("SELECT * FROM users");

                while($row = mysql_fetch_array($result))
                {
                    $temp_id = $row['id'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $email = $row['email'];
                    $isConfirmed = $row['isConfirmed'];

                      echo '<tr>
                                <td>' . $fname . ' ' . $lname . '</td>
                                <td>' . $email . '</td>
                                <td>…</td>
                                <td><a href="student_info.php?id=' . $temp_id . '">View Profile</a></td>
                                <td><a href="#">View Resume</a></td>';
                      if ($isConfirmed) echo '<td>Yes</td>'; else echo '<td>No</td>';
                            echo '</tr>';
                }

                ?>

              </tbody>
            </table>

        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>
