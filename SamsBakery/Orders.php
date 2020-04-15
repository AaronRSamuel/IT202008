<html lang="en" dir="ltr">
  <head>
    <title></title>
  </head>
  <style>
    table.db-table 		{ border-right:1px solid #ccc; border-bottom:1px solid #ccc; }
    table.db-table th	{ background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
    table.db-table td	{ padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
  </style>
  <body>

  </body>
</html>
<?php
require ("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
mysql_select_db('Orders',$connection);
$result = mysql_query('SHOW TABLES',$connection) or die('cannot show tables');
while($tableName = mysql_fetch_row($result)) {

	$table = $tableName[0];

	echo '<h3>',$table,'</h3>';
	$result2 = mysql_query('SHOW COLUMNS FROM '.$table) or die('cannot show columns from '.$table);
	if(mysql_num_rows($result2)) {
		echo '<table cellpadding="0" cellspacing="0" class="db-table">';
		echo '<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default<th>Extra</th></tr>';
		while($row2 = mysql_fetch_row($result2)) {
			echo '<tr>';
			foreach($row2 as $key=>$value) {
				echo '<td>',$value,'</td>';
			}
			echo '</tr>';
		}
		echo '</table><br />';
	}
}
?>
