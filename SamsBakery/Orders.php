<?php
require ("config.php");
echo "DBUser: " . $dbuser;
echo "\n\r";

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

$result = mysqli_query($connection_string,"SELECT * FROM Orders");

echo "<table border='1'>
<tr>
<th>id</th>
<th>user_id</th>
<th>phone_number</th>
<th>item_id</th>
<th>comment</th>
<th>date_created</th>
<th>date_due</th>
<th>is_active</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['user_id'] . "</td>";
echo "<td>" . $row['phone_number'] . "</td>";
echo "<td>" . $row['item_id'] . "</td>";
echo "<td>" . $row['comment'] . "</td>";
echo "<td>" . $row['date_created'] . "</td>";
echo "<td>" . $row['date_due'] . "</td>";
echo "<td>" . $row['is_active'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($connection_string);
?>
