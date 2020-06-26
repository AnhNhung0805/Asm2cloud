<!DOCTYPE html>
<html>
<head>
<title>Customer information</title>
</head>

<body>

<h1>Customer information</h1>

<?php
ini_set('display_errors', 1);
echo "Hello manager!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-50-17-90-177.compute-1.amazonaws.com;user=mpuuionqjzgkvu;password=a63f38f68ec309293693571cb4c0a78b4dfed06de246551e81377102a06d0945;dbname=d9m8970h10o6at",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "SELECT * FROM customer";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Customer information:</p>';

?>

<div id="container">
<table id="t01" class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th>CustomerID</th>
        <th>Customername</th>
        <th>Phonenumber</th>
        <th>Address</th>
        
      </tr>
    </thead>
    <tbody>
      <?php
      // tạo vòng lặp 
         //while($r = mysql_fetch_array($result)){
             foreach ($resultSet as $row) {
      ?>
   
      <tr>
        <td scope="row"><?php echo $row['customerid'] ?></td>
        <td><?php echo $row['customername'] ?></td>
        <td><?php echo $row['phonenumber'] ?></td>
        <td><?php echo $row['address'] ?></td>
        
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
<a href="DeleteCustomer.php" target="_blank">Delete customer information</a>
<a href="UpdateCustomer.php" target="_blank">Update customer information</a>
</body>
</html>