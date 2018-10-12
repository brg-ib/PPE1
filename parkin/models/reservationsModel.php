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
function add_reservation($idUser,$idPlace,$dateDebut,$dateFin)
{
	$reqAddreservation=$bdd->query("insert into reservation(nomreservation) values('".$nomreservation."')");
}
function delete_reservation($idUser,$idPlace,$dateDebut)
{
			$reqDeletereservation=$bdd->query("delete from reservation where idUser=".$idReservation." and idPlace=".$idPlace." and dateDebut=".$dateDebut);
}
?>