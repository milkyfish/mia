<?php
use DB\DB as DB;
$db = new DB();
$db->bind('name', 'inActiveMessage');
$msg = $db->query('SELECT * FROM mia_settings WHERE name = :name');
?>
<p><?=$msg[0]['value']?></p>