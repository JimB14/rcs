<?php

// connect to database
include 'database-connect.php';

$stmt = $pdo->prepare("SELECT firstname,lastname,original FROM register");
$stmt->bindColumn('firstname', $firstname);  //PDOStatement::bindColumn() arranges to have a particular variable bound to a given column in the result-set from a query. 
$stmt->bindColumn('lastname', $lastname);   // Each call to PDOStatement::fetch() or PDOStatement::fetchAll() will update all the variables that are bound to columns. 
$stmt->bindColumn('original', $original);

$stmt->execute();

while($stmt->fetch(PDO::FETCH_BOUND)) // PDO::FETCH_BOUND (integer). Specifies that the fetch method shall return TRUE and assign the values of the columns   
                                      // in the result set to the PHP variables to which they were bound with the PDOStatement::bindParam() or PDOStatement::bindColumn() methods.   
//while($row = $stmt->fetch(PDO::FETCH_OBJ))
{
    $data = "Name = $firstname $lastname; Password = $original <br>";
    //$data = "Name = $row->firstname $row->lastname;   Password = $row->original . <br>";
    print $data;
}
?>
