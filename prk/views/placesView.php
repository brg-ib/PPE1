<?php
function afficher_places($Places)
{
	?>
	<table><th>nom</th><th colspan="2">Opérations</th>
	<?php
	foreach  ($Places as $Place)
	{
		echo "<tr><td>".$Place['nomPlace']."</td><td><a href='index.php?module=places&action=form_update&idPlace=".$Place['idPlace']."'>Modifier</a></td><td><a href='index.php?module=places&action=delete&idPlace=".$Place['idPlace']."'>Supprimer</a></td></tr>";
	}
	?>
	</table>
	<?php
} 
function form_add_place()
{
	?>
	<form>
	nom : <input type="text" name="nomPlace"/>
	 <input type="submit" name="ajouter" value="Envoyer" />
	 <input type="hidden" name="module" value="places" />
	<input type="hidden" name="action" value="add" />

	</form>
	<?php
}

function form_update_place($bdd,$idPlace)
{
	$Place=details_place($bdd,$idPlace);
	?>
	<form>
	nom : <input type="text" name="nomPlace" value="<?= $Place['nomPlace']; ?>" />
	 <input type="submit" name="modifier" value="Envoyer" />
	 <input type="hidden" name="module" value="places" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="idPlace" value="<?= $idPlace; ?>" />

	</form>
	<?php
}

?>