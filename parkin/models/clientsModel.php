<?php 
function liste_clients()
{
	$Users=$bdd->query("Select * from users where etatUser<=2");
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
function historiqueClient($idUser)
{
	$Users=$bdd->query("Select * from reservation where idUser=".$idUser);
	return $Users->fetchALL();
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
			session_start();
			$_SESSION['connected']=true;
			$_SESSION['id']=$Client['idUser'];
			$_SESSION['login']=$Client['nomUser']." ".$Client['prenomUser'];
			$_SESSION['level']=$Client['levelUser'];
			return $Client;
			
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

?>