<<<<<<< HEAD
<?php 
function liste_clients($bdd)
=======
<?php
function liste_clients()
>>>>>>> 812a827f2638910f51059e79b913a00d5ceac787
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

function add_client($nomUser,$prenomUser,$mailUser,$telUser)
{
	$reqAddUser=$bdd->query("insert into users(nomUser,prenomUSer,mailUSer,telUser,levelUser) values('".$nomUser."','".$prenomUSer."','".$mailUser."','".$telUser."',0)");
}

function update_client($nomUser,$prenomUser,$mailUser,$telUser,$idUser)
{
	$reqUpdateUser=$bdd->query("update users SET nomUser='".$nomUser."',prenom_user='".$prenomUSer."',mailUser='".$mailUser."',telUser='".$telUser."' where idUser=".$idUser);
}
function activate_client($id_user)
{
		$reqUpdateUser=$bdd->query("update users SET levelUser=1");
}
function desactivate_client($id_user)
{
		$reqUpdateUser=$bdd->query("update users SET levelUser=0");

}
function delete_client($idUser)
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

function inscription(){

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
