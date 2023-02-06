<?php
session_start();

if (isset($_POST['Submit'])){
 $maxCapacity=$_POST['maxCapacity'];
 $currentUsage=$_POST['currentUsage'];
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "webjti";

 try {    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // prepare sql and bind parameters
    $stmt = $conn->prepare("Select train_id,journey_code,capacity,usage_rate from train_info where capacity>=:maxCapacity and usage_rate>=:currentUsage");
    $stmt->bindParam(':maxCapacity', $maxCapacity);
    $stmt->bindParam(':currentUsage', $currentUsage);
    $results = $stmt->execute();
    if ($results){
     // xxxxxxxx results display code xxxxxxxx
     $rows =$stmt->fetchAll();	
     echo '<h1>22053105 Ruly Januar Fachmi</h1>';
     foreach ($rows as $row){
       echo 'Train ID = '.$row["train_id"].'<br/>';
       echo 'Journey Code = '.$row["journey_code"].'<br/>';
       echo 'Maximum passenger capacity = '.$row["capacity"].'<br/>';
       echo 'Current usage rate = '.$row["usage_rate"].'<br/><br/>';
	}

    }
 }
 catch(PDOException $e)
 {
    echo "Error: " . $e->getMessage();
 }
 $db = null;
 echo('<a href="index.php">Go back to search page</a>');
}
else
{
?>
<h1>22053105 Ruly Januar Fachmi</h1>
Search trains: <br/>
<form method="POST" action="#" >
  Maximum capacity greater than or equals : 
  <input type="text" name="maxCapacity" id="maxCapacity"><br/>
  Current usage rate less than : 
  <input type="text" name="currentUsage" id="currentUsage"><br/>
  <input type="Submit" name="Submit" id="Submit" value='Submit'>
</form>

<?php
}
?>
