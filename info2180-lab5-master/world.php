<?php
header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$value = $_GET["country"];
//echo("<p> $value </p>");
if(empty($value)){
  $stmt1 = $conn->query("SELECT * FROM countries");
  $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>

<?php } else {
  $stmt2 = $conn->prepare("SELECT * FROM countries WHERE `name` LIKE ?");
  $stmt2->execute(array("%$value%"));
  $result = $stmt2->fetchAll();
?>
<ul>
<?php foreach ($result as $row): ?>
  <li><?= $row['name'] . ' of region ' . $row['region'].' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; }?>
</ul>