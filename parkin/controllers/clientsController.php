<?php
require_once 'models/clientsModel.php';
include 'views/clientsView.php';
if(isset($_GET['action']))
{$action=$_GET['action'];}
else
{$action='liste';}
switch($action)
{
	case 'liste':$Clients=liste_clients($bdd); afficher_clients($Clients); break;
	case 'form_add': form_add_client(); break;
	case 'get':$idClient=$_GET['idClient']; get_client($bdd,$idClient); break;
	case 'add': $nomClient=$_REQUEST['nomClient']; add_client($bdd,$nomClient);   header('Location:index.php?module=clients'); break;
	case 'details':$idClient=$_REQUEST['idClient']; form_details_client($bdd,$idClient); break;
	case 'form_update': $idClient=$_GET['idClient']; form_update_client($bdd,$idClient); break;
	case 'update':$idClient=$_GET['idClient']; $nomClient=$_REQUEST['nomClient'];  update_client($bdd,$nomClient,$idClient);  header('Location:index.php?module=clients'); break;
	case 'delete': $idClient=$_GET['idClient']; delete_client($bdd,$idClient); break;
	case 'form_connexion' : form_connexion(); break;
	case 'connexion' : $mailUser=$_REQUEST['mailUser']; $passwordUser=$_REQUEST['passwordUser']; if(connecter($bdd,$mailUser,$passwordUser)) { header('Location:index.php'); } else {header('Location:index.php?module=clients&action=form_connexion');} break;
	case 'deconnexion':deconnecter();  header('Location:index.php'); break;

	}
 ?>