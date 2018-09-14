<?php
$password = '1';

$hash = password_hash($password, PASSWORD_DEFAULT);
    //echo "$hash: " . $hash . "<br><br>";
    
if(password_verify($password, $hash)) 
{
    echo "Password valid! <br>";
}
 else 
{
   echo "Password not valid. <br>" ;
}

echo "<hr>";

////************************************************************////

// password from db table
$hash = '$2y$10$HFVRLN1Lb/6gsVXeRUVHgeWl4Q5D9OeOg2mxjVx7pq095BPa3DQ9S';  

if(password_verify('123!@#', $hash))
{
    echo "Password valid!<br><br>";
}
else
{
    echo  "Password does not match.<br><hr><br>br>";
}

echo "<hr>";

////************************************************************////


$hash = password_hash('123!@#', PASSWORD_DEFAULT);
        echo "hashed password: " . $hash . "<br><br>";
        
        $count = strlen($hash);
        echo "String length of hash: " . $count . " characters <br><br>";

        
$password = password_verify('123!@#', $hash);
        echo "Key: 1 = true;0 = false. Answer: " . $password , "<br><br><br><br>";
        echo "<hr><br>";
        
////************************************************************////
        
//       Associative Array         //
        
$debts = array("Al"=>100.55,"Bill"=>50.00,"Charlie"=>45.00,"Dave"=>35.00,"Earl"=>95.00);
        //echo "$" . $debts['Al'] . "<br><br><hr>";
        foreach($debts as $key => $value)
        {
            echo "Name: " . $key . "<br> Owes: " . $value . "<br><br>";
        }
        
 echo "<br><br><hr>"; 
        
////************************************************************////
 function profit_margin($cost,$sale_price){
     $margin = ($sale_price - $cost)/$sale_price;
     $margin = $margin * 100;
     $margin = round($margin, 1);
     echo "Profit margin: " . $margin . "%";
 }
 
 $cost = 1.00;
 $sale_price = 3.00;
 
 profit_margin($cost, $sale_price);

 
  echo "<br><br><hr>"; 
 ////************************************************************////
    
// connect to database
include 'database-connect.php';

$id='3'; // Collecting one record with id=3
$count=$pdo->prepare("select * from register where id = :id");
$count->bindParam(":id",$id,PDO::PARAM_INT,1);

if($count->execute()){
echo " Success! <br>";
$row = $count->fetch(PDO::FETCH_OBJ);  //PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set
print_r($row);
echo "<hr><br>Username = $row->username";
echo "<br> Password =$row->password<br>";
echo "<hr>";

}else{
//$row=$count->fetchAll();
print_r($pdo->errorInfo());
}

////************************************************************////
?>


<html>
    <head>
        
    </head>
    <body>
        <?php 
            $arr = array(1,4,9,16,25,36,49,64,81,100);
            foreach($arr as $value)
            {
                echo "Square: " . $value . "<br>";
            }
        ?>
        <hr>
    </body>
    
</html>

<!-- ************************************************************-->
<html>
    <head>
        
    </head>
    <body>
        <?php
            $arr = array( array("Name"=>"Roger Federer", "Country"=>"Switzerland", "Rank"=>"3"),array("Name"=>"Rafael Nadal", "Country"=>"Spain", "Rank"=>"2") );
            foreach($arr as $var)
            {
                foreach($var as $attribute=>$info)
                {
                    echo "<b>{$attribute}</b> : {$info}" . "<br>";
                }
                echo "<br>";
            }
        ?>
    </body>
</html>
