<?php 
function liste_clients($bdd)
{
	$Users=$bdd->query("Select * from users where levelUser<3");
	return $Users->fetchALL();
}
function get_client($bdd,$idUser)
{
	$User=$bdd->prepare("Select * from users where idUser=?");
	$User->execute(array($idUser));
	return $User->fetch();
}
function details_client($bdd,$idUser)
{
	$Users=$bdd->prepare("Select u.*,r.* from users u, reservation r where u.idUser=r.idUser and r.idUser=?");
	$Users->execute(array($idUser));
	return $Users->fetchALL();
}

function ajouter_client($nomUser,$prenomUser,$mailUser,$passwordUser,$telUser,$bdd)
{
	$reqAddUser=$bdd->prepare("insert into users(nomUser,prenomUser,mailUser,telUser,passwordUser) values(?,?,?,?,sha1(?))");
	$reqAddUser->execute(array($nomUser,$prenomUser,$mailUser,$telUser,$passwordUser));
	}



function update_client($nomUser,$prenomUser,$telUser,$idUser,$bdd)
{
	$reqUpdateUser=$bdd->prepare("update users SET nomUser=?,prenomUser=?,telUser=? where idUser=?");
	$reqUpdateUser->execute(array($nomUser,$prenomUser,$telUser,$idUser));
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
	$reqDeleteUser=$bdd->prepare("delete from users where idUser=?");
	$reqDeleteUser->execute(array($idUser));
	var_dump($reqDeleteUser);
}
function forgot($bdd,$mailUser)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring = $characters[rand(0, strlen($characters))];
    }
	
	$reqforgot=$bdd->prepare("update users set codeUser=?");
	
	$reqforgot->execute(array($randstring));
	$message="Bonjour, Pour modifier votre mot de passe veuillez utiliser le code suivant : ".$randstring;
	
	$to      = $mailUser;
$subject = 'Modification de mot de passe PARKiN';
$headers = array(
    'From' => 'webmaster@parkin.com',
    'X-Mailer' => 'PHP/' . phpversion()
);

mail($to, $subject, $message, $headers);


}


function connecter($bdd,$mailUser,$passwordUser)
{
			$reqConnexion=$bdd->prepare("select * from users where mailUser= ? and passwordUser=sha1(?)");
			$reqConnexion->execute(array($mailUser,$passwordUser));
			$Client=$reqConnexion->fetch();		

			if ($Client) {
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