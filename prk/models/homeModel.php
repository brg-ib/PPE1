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
?>