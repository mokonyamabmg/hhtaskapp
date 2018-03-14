<?php
$conn = mysql_connect('localhost','root', '');
$db= mysql_select_db('taskmanagementtool_db');

if($db)
{
	
	
}else
{
	echo 'ERROR'.mysql_error();
}

?>