<?php 
function liste_places($bdd)
{

	$places=$bdd->query("Select * from place");
	return $places->fetchALL();
}
function details_place($bdd,$idPlace)
{
	$Place=$bdd->query("Select * from place where idPlace=".$idPlace);
	return $Place->fetch();
}
function add_place($bdd,$nomPlace)
{
	echo "add place-> Model";
	$reqAddPlace=$bdd->query("insert into place(nomPlace) values('".$nomPlace."')");
}
function update_place($bdd,$nomPlace,$idPlace)
{
	$reqUpdatePlace=$bdd->query("update place SET nomPlace='".$nomPlace."' where idPlace=".$idPlace);
}
function delete_place($bdd,$idPlace)
{
	$reqDeletePlace=$bdd->query("delete from place where idPlace=".$idPlace);
}
?>