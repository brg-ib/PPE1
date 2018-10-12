<?php 
function liste_file()
{
	$places=$bdd->query("Select * from users where rangUser <> NULL or rangUser <> 0 and levelUser=2");
	return $places->fetchALL();
}

function next_in_file()
{
	$nextPlace=$bdd->query("Select max(rangUser) as last from users where rangUser <> NULL or rangUser <> 0 and levelUser=2");
	$next=$nextPlace->fetch();
	return $next['last']+1;
}
function add_to_file($idUser)
{
	$Place=$bdd->query("update users set rangUser=".next_in_file()." where idUser=".$idUser);
}

function delete_from_file($idUser)
{
	$Place=$bdd->query("update users set rangUser=NULL where idUser=".$idUser);
}

function up_to_file($idUser)
{
		$Place=$bdd->query("update users set rangUser=rangUser+1 where idUser=".$idUser);
}

function down_to_file($idUser)
{
		$Place=$bdd->query("update users set rangUser=rangUser-1 where idUser=".$idUser);
}

function to_place($idUser)
{
	if()
	{
	delete_from_file($idUser);
	}
}
?>