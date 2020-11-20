<?php
$host = getenv('IP');
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if(isset($_GET)){
    $country = $_GET['country'];
$context =$_GET['context'];
 
if($context=="cities"){
   
$stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE \"%$country%\" ORDER BY countries.name ASC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 }else{
     $countrieswhere = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
     $whereresults= $countrieswhere->fetchAll(PDO::FETCH_ASSOC);
 }
}

 

?>
 <table>
    <?php if($context=="cities"): ?>
            <th> Country Name</th>
            <th> District</th>
            <th> Population</th>
            <?php foreach ($results as $row): ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['district']; ?></td>
                <td><?=$row['population']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
            <th> Country Name</th>
            <th> Continent</th>
            <th> Independence Year</th>
            <th> Head of State</th>
        <?php foreach ($whereresults as $row): ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['continent']; ?></td>
                <td><?=$row['independence_year']; ?></td>
                <td><?= $row['head_of_state']; ?> </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
   
 </table>