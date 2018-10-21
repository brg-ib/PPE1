<?php
 function refresh_reservations($bdd)
 {
	 //$reqUpdateReservation=$bdd->query("delete from reservation where idUser=".$idUser." and idPlace=".$idPlace." and dateDebut=".$dateDebut);

	 
 }
function refresh_file($bdd)
 {
require_once 'models/reservationsModel.php';
$Reservations=verifier($bdd);
if(!$Reservations)
{
	$reqFistinFile=$bdd->query("select idUser from users where rangUser=1 Limit 0,1");
	$First=$reqFistinFile->fetch();
	$reqFirstPlace=$bdd->query("Select p.idPlace from place p where p.idPlace not in (select idPlace from reservation where dateDebut<=now() and dateFin>=now()) limit 0,1");;
	$FirstPlace=$reqFirstPlace->fetch();
	$reqDuree=$bdd->query("Select valeurSetting as duree from settings where cleSetting='duree'");
	$duree=$reqDuree->fetch();
	$reqDateFin=$bdd->query("SELECT DATE_ADD(now(), INTERVAL ".$duree['duree']." DAY) as dateFin");
	$dateFinReservation=$reqDateFin->fetch();
	$reqAddreservation=$bdd->query("insert into reservation(idUser,idPlace,dateDebut,dateFin) values(".$First['idUser'].",".$FirstPlace['idPlace'].",now(),'".$dateFinReservation['dateFin']."')");
	$reqUpdateFile=$bdd->query("update users set rangUser=NULL where idUser=".$First['idUser']);
	$reqUpdateReservation=;
}
 }
 
 

?>