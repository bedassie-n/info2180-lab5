<?php
header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$value = $_GET["country"];
$context = $_GET["context"];
?>
<?php if($context == "none"){?>
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
<?php } elseif($context == "cities"){
if(empty($value)){
  echo("<p><strong>Please enter a country in the search bar.</strong></p>");
} else {?>
<table>
<tr>
  <th>Name</th>
  <th>District</th>
  <th>Population</th>
</tr>
<?php
  $stmt1 = $conn->prepare("SELECT code FROM countries WHERE `name` LIKE ?");
  $stmt1->execute(array("%$value%"));
  $country_codes = $stmt1->fetchAll();

  $stmt2 = $conn->prepare("SELECT name, district, population FROM cities WHERE `country_code` LIKE ?");
  foreach ($country_codes as $row):
    $stmt2->execute(array("%".$row["code"]."%"));
    $result = $stmt2->fetchAll();?>
    <?php foreach ($result as $row): ?>
      <tr><td><?= $row['name']?></td><td><?=$row['district']?></td><td><?=$row['population']?></td></tr>
    <?php endforeach; ?>
<?php endforeach; }?>
</table>

<?php }?>