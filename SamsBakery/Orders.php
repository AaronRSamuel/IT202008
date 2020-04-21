<?php
require ("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try{
  $db= new PDO($connection_string, $dbuser, $dbpass);
  echo "should have connected";
  $sql = $db->prepare("SELECT user_id, phone_number, item_id, comment, date_created from Orders");
  $sql->execute();
}
catch(Exception $e){
echo $e->getMessage();
exit("It didn't work");
}
?>

<html lang="en" dir="ltr">
  <head>
    <title></title>
  </head>
  <body>
    <table>
    <thead>
        <tr>
            <th>User ID |</th>
            <th>Phone Number|</th>
            <th>Item ID|</th>
            <th>Item|</th>
            <th>Date created|</th>
        </tr>
    </thead>
    <tbody>
        <?php while( $row = $sql->fetch()) : ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><?php echo $row['item_id']; ?></td>
            <td><?php echo $row['comment']; ?></td>
            <td><?php echo $row['date_created']; ?></td>
        </tr>
        <?php endwhile ?>
    </tbody>
</table>
  </body>
</html>
