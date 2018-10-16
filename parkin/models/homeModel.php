<?php
 function connexion_bd()
{
	global $bdd;
		try//connexion à la bdd
	{
		$bdd = new PDO("mysql:host=localhost;dbname=parkin; charset=utf8","root","");
	}
	catch(Exception $e)
	{
		die("bdd non trouvée");
	}
}

function is_admin()
{
	if(isset($_SESSION['level']) && ($_SESSION['level']==3)) { return true; }  else {return false; }
}
function is_activated()
{
	if(isset($_SESSION['level']) && ($_SESSION['level']==2)) { return true; }  else {return false; }
}


function is_full()
{
	$reqIsFull=$bdd->query("select u.*, r.* from users u,reservations r where rangUser is  null ");
	return($reqIsFull->fetchALL());
}

?>