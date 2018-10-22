<?php 
function liste_clients($bdd)
{
	$Users=$bdd->query("Select * from users where levelUser<3");
	return $Users->fetchALL();
}
function get_client($bdd,$idUser)
{
	$User=$bdd->query("Select * from users where idUser=".$idUser);
	return $User->fetch();
}
function details_client($bdd,$idUser)
{
	$Users=$bdd->query("Select u.*,r.* from users u, reservation r where u.idUser=r.idUser and r.idUser=".$idUser);
	return $Users->fetchALL();
}

function ajouter_client($nomUser,$prenomUser,$mailUser,$passwordUser,$telUser,$bdd)
{
	$reqAddUser=$bdd->query("insert into users(nomUser,prenomUser,mailUser,telUser,passwordUser) values('".$nomUser."','".$prenomUser."','".$mailUser."','".$telUser."',sha1('".$passwordUser."'))");
}



function update_client($nomUser,$prenomUser,$mailUser,$telUser,$passwordUser,$idUser,$bdd)
{
	$reqUpdateUser=$bdd->query("update users SET nomUser='".$nomUser."',prenom_user='".$prenomUser."',mailUser='".$mailUser."',telUser='".$telUser."',passwoedUser='sha1(".$passwordUser.")' where idUser=".$idUser);
}
function activate_client($bdd,$idUser)
{
		$reqUpdateUser=$bdd->query("update users SET levelUser=2 where idUser=".$idUser);
}
function desactivate_client($bdd,$idUser)
{
		$reqUpdateUser=$bdd->query("update users SET levelUser=1 where idUser=".$idUser);
		
}
function delete_client($bdd,$idUser)
{
			$reqDeleteUser=$bdd->query("delete from users where idUser=".$idUser);
}

function connecter($bdd,$mailUser,$passwordUser)
{
			$reqConnexion=$bdd->query("select * from users where mailUser= '".$mailUser."' and passwordUser=sha1('".$passwordUser."')");
			$Client=$reqConnexion->fetch();
			if($Client)
			{
			session_start();
			$_SESSION['connected']=true;
			$_SESSION['id']=$Client['idUser'];
			$_SESSION['login']=$Client['nomUser']." ".$Client['prenomUser'];
			$_SESSION['level']=$Client['levelUser'];
			return $Client;
			}
			
}
function deconnecter()
{
	session_start();
	session_destroy();
}
function is_connected()
{
	if(isset($_SESSION['connected']))
		return true;
	else
		return false;
}
function historiqueClient($bdd,$idUser)
{
	$Place=$bdd->query("Select p.*,r.*,u.* from place p, reservation r, users u where u.idUser= r.idUser and p.idPlace=r.idPlace and u.idUser=".$idUser);
	return $Place->fetchALL();
}

function already_reserved ($bdd,$idUser)
{
	$reservation=$bdd->query("select p.*,r.* from reservation r, place p where p.idPlace=r.idPlace and dateDebut<=now() and dateFin>=now() and idUser =".$idUser);
	return $reservation->fetch();
}

?>