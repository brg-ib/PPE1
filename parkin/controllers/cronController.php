<?php
include 'models/cronModel.php';
//refresh_reservations();
$action=$_GET['action'];
switch($action)
{
	case 'refresh_file': refresh_file($bdd); break;
}

?>