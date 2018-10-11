<?php
require_once 'models/placesModel.php';
include 'views/placesView.php';
if(isset($_GET['action']))
{$action=$_GET['action'];}
else
{$action='liste';}
switch($action)
{
	case 'liste':$Places=liste_places($bdd); afficher_places($Places); break;
	case 'form_add': form_add_place(); break;
	case 'add': $nomPlace=$_REQUEST['nomPlace']; add_place($bdd,$nomPlace); break;
	case 'details':$idPlace=$_GET['idPlace']; details_places($idPlace); break;
	case 'form_update': $idPlace=$_GET['idPlace']; form_update_place($bdd,$idPlace); break;
	case 'update':$idPlace=$_GET['idPlace']; $nomPlace=$_REQUEST['nomPlace'];  update_place($bdd,$nomPlace,$idPlace); break;
}
 ?>