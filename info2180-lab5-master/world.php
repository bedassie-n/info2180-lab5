<?php
header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$value = $_GET["country"];
?>
<table>
<tr>
  <th>Name</th>
  <th>Continent</th>
  <th>Independence</th>
  <th>Head of State</th>
</tr>

<?php
if(empty($value)){
  $stmt1 = $conn->query("SELECT * FROM countries");
  $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($results as $row): ?>
  <tr><td><?= $row['name']?></td><td><?=$row['continent']?></td><td><?=$row['independence_year']?></td><td><?=$row['head_of_state']; ?></td></tr>
<?php endforeach; ?>

<?php } else {
  $stmt2 = $conn->prepare("SELECT * FROM countries WHERE `name` LIKE ?");
  $stmt2->execute(array("%$value%"));
  $result = $stmt2->fetchAll();
?>
<?php foreach ($result as $row): ?>
  <tr><td><?= $row['name']?></td><td><?=$row['continent']?></td><td><?=$row['independence_year']?></td><td><?=$row['head_of_state']; ?></td></tr>
<?php endforeach; }?>
</table>