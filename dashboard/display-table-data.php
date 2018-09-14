<?php
session_start();

// parameters of session
include '../connect/session-time-admin.php';
// connect to database
include_once '../connect/database-connect.php';

// SQL
$sql = "SELECT * FROM register ORDER BY lastname";
$q = $pdo->query($sql);
                                     // PDOStatement::setFetchMode — Set the default fetch mode for this statement 
$q->setFetchMode(PDO::FETCH_ASSOC);  // PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set

// php MySQL code help: http://www.mysqltutorial.org/php-querying-data-from-mysql-table/

?>


<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta lang="en" charset="utf-8">
        <link href="css/style.css" rel="stylesheet">       
        <style>
            body {font-family: Helvetica, Arial, sans-serif;font-size:14px;}    
            .data-table table, th, td{
                border: 1px solid #000; 
                padding: 0.5em;              
            }
            .data-table table{
                border-collapse: collapse;
                width: 95%; 
                overflow:hidden;
            }
            .data-table th{
                background-color: #072C58;
                color:#fff;
                text-align: left;
            }
            .data-table td {             
                vertical-align: bottom;
            }
            .data-table table td{
                 height: 100%;
            }
        </style>
        <script>
            function goBack(){window.history.go(-1);}
        </script>
    </head>
        <body>
            <div class="data-table">
                <h1>Database Content <span style="font-size: 80%;">- ordered by last name</span></h1> 
                <div style="margin-bottom:1em;"><button class="btn-default btn2b" onclick="goBack(-1)">Go Back</button> &nbsp;&nbsp;<a href="../" title="Click to return to home page"> Home Page</a></div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Username</th>
                            <th>Login Password</th>
                            <th>Encrypted Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($r = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($r['id']); ?></td>
                            <td><?php echo htmlspecialchars($r['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($r['firstname'])?></td>  <!-- htmlspecialchars — Convert special characters to HTML entities; http://php.net/manual/en/function.htmlspecialchars.php -->
                            <td><?php echo htmlspecialchars($r['username']); ?></td>
                            <td><?php echo htmlspecialchars($r['original']); ?></td>
                            <td><?php echo htmlspecialchars($r['password']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </body>
</html>