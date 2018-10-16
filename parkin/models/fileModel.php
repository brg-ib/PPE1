<?php 
function liste_file($bdd)
{
	$places=$bdd->query("Select * from users where rangUser is not NULL and levelUser=2 order by rangUser");
	return $places->fetchALL();
}

function number($bdd)
{
	$places=$bdd->query("Select count(*) as nombre from users where rangUser is not NULL and levelUser=2 order by rangUser");
	return $places->fetch();
}

function next_in_file($bdd)
{
	$nextPlace=$bdd->query("Select max(rangUser) as last from users where rangUser <> NULL or rangUser <> 0 and levelUser=2");
	$next=$nextPlace->fetch();
	return $next['last']+1;
}
function add_to_file($bdd,$idUser)
{
	$Place=$bdd->query("update users set rangUser=".next_in_file($bdd)." where idUser=".$idUser);
	
	}

function delete_from_file($bdd,$idUser)
{
	$Place=$bdd->query("update users set rangUser=NULL where idUser=".$idUser);
}

function up_to_file($bdd,$idUser)
{require_once("models/clientsModel.php");

		$Client=get_client($bdd,$idUser);

		$rang=$Client['rangUser'];
		$rangSuivant=$rang-1;
		$z=$rang;
		$rang=$rangSuivant;
		$rangSuivant=$z;
		
		$rq1=$bdd->query("update users set rangUser=".$rangSuivant." where rangUser=".$rang);
		$rq2=$bdd->query("update users set rangUser=".$rang." where idUser=".$idUser);
		
}

function down_to_file($bdd,$idUser)
{
		
require_once("models/clientsModel.php");
		$Client=get_client($bdd,$idUser);

		$rang=$Client['rangUser'];
		$rangSuivant=$rang+1;
		$z=$rang;
		$rang=$rangSuivant;
		$rangSuivant=$z;
		
		$rq1=$bdd->query("update users set rangUser=".$rangSuivant." where rangUser=".$rang);
		$rq2=$bdd->query("update users set rangUser=".$rang." where idUser=".$idUser);

		}

function to_place($idUser)
{
	
}

?>