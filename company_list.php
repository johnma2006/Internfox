<?php 
session_start(); 
include "config.php";
include "require_admin.php";
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Internfox &middot; Company List</title>
    <?php include "head.php" ?>
</head>

<body>

    <?php include "header.php" ?>

    <div class="container">
        <div class="well" class="content">

            <h2 style="display:inline">Company List</h2>
            <a href="company_add.php" class="btn" id="company-info-button" style="float:right"><i class="icon-plus"></i> Add Company   </a>
            <br /><br />

            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width:200px">Name</th>
                  <th style="width:250px">Email</th>
                  <th style="width:200px">Contact Person</th>
                  <th style="width:130px">Company Listing</th>
                  <th style="width:120px">Company Info</th>
                  <th style="width:120px">Posted</th>
                </tr>
              </thead>
              <tbody>

              <?php 

              $result = mysql_query("SELECT * FROM companies");

                while($row = mysql_fetch_array($result))
                {
                    $name = $row['name'];
                    $company_displayname = $row['company_displayname'];
                    $contact_email = $row['contact_email'];
                    $contact_person = $row['contact_person'];
                    $isPosted = $row['isPosted'];

                      echo '<tr>
                                <td>' . $company_displayname . '</td>
                                <td>' . $contact_email . '</td>
                                <td>' . $contact_person . '</td>
                                <td>&nbsp;&nbsp;&nbsp;<a href="company.php?name=' . $name . ' "target="_blank">View</a></td>
                                <td>&nbsp;&nbsp;&nbsp;<a href="company_info.php?name=' . $name . '">View / Edit</a></td>';
                                if ($isPosted) echo '<td>Yes</td>'; else echo '<td>No</td>';
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
