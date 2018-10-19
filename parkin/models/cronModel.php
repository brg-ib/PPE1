<?php
 function refresh_reservations($bdd)
 {
	 //$reqUpdateReservation=$bdd->query("delete from reservation where idUser=".$idUser." and idPlace=".$idPlace." and dateDebut=".$dateDebut);

	 
 }
function refresh_file($bdd)
 {
require_once 'models/reservationsModel.php';
$Reservations=reservations_now($bdd);
if(!$Reservations)
{
 $reqUpdateFile=$bdd->query("update users set rangUserfrom=NULL where levelUser=2");
}
 }

?>