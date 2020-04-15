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
            <th>This</th>
            <th>That</th>
            <th>The Other</th>
        </tr>
    </thead>
    <tbody>
        <!--Use a while loop to make a table row for every DB row-->
        <?php while( $row = $sql->fetch()) : ?>
        <tr>
            <!--Each table column is echoed in to a td cell-->
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
