<?php 
function liste_reservations()
{
	$reservations=$bdd->query("Select * from reservation");
	return $reservations->fetchALL();
}
function details_reservation($idUser,$idPlace,$dateDebut)
{
	$reservation=$bdd->query("Select * from reservation where idUser=".$idReservation." and idPlace=".$idPlace." and dateDebut=".$dateDebut);
	return $reservation->fetch();
}
function add_reservation($bdd,$idUser,$idPlace)
{
	$reqDuree=$bdd->query("Select valeurSetting as duree from settings where cleSetting='duree'");
	$duree=$reqDuree->fetch();
	$reqDateFin=$bdd->query("SELECT DATE_ADD(now(), INTERVAL ".$duree['duree']." DAY) as dateFin");
	$dateFinReservation=$reqDateFin->fetch();
	$reqAddreservation=$bdd->query("insert into reservation(idUser,idPlace,dateDebut,dateFin) values(".$idUser.",".$idPlace.",now(),'".$dateFinReservation['dateFin']."')");
	var_dump($reqAddreservation);
	}
function delete_reservation($idUser,$idPlace,$dateDebut)
{
			$reqDeletereservation=$bdd->query("delete from reservation where idUser=".$idReservation." and idPlace=".$idPlace." and dateDebut=".$dateDebut);
}
function reservations_now($bdd)
{
	$reservation=$bdd->query("Select p.idPlace from place p where p.idPlace not in (select idPlace from reservation where dateDebut<=now() and dateFin>=now())");
	return $reservation->fetchALL();
}

function time_next($bdd,$idUser)
{
	$reqDuree=$bdd->query("Select valeurSetting as duree from settings where cleSetting='duree'");
	$duree=$reqDuree->fetch();
	
	
	
	$reservation=$bdd->query("Select max(dateFin) as dateFin from reservation where dateDebut<=now() and dateFin>=now()");
	$Last=$reservation->fetch();
	
	
	require_once 'models/clientsModel.php';
	$User=get_client($bdd,$idUser);
	$rangUser=$User['rangUser'];
	
	
	
		$reqDateFin=$bdd->query("SELECT DATE_ADD('".$Last['dateFin']."', INTERVAL ".$duree['duree']*$rangUser." DAY) as dateFin");
		$date_next=$reqDateFin->fetch();
	
	return $date_next;
	
}
?>