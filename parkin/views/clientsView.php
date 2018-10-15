
<header class="masthead2 text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
		<div class="col-lg-10 mx-auto">
<?php if (isset($_SESSION)) { ?>
		<h1 class="text-uppercase">
			  Gestion des clients
            </h1> 
<?php } else{ ?>
<h1 class="text-uppercase">
			  Connexion
            </h1>
			<?php } ?>
            <hr>
          </div>
          
        </div>
      </div>
    </header>
<?php
function afficher_clients($Clients)
{
	?>
	      <div class="container">
	  
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		  <div style="float: right;padding:12px 30px 14px"><a href="index.php?module=clients&action=form_add" class="btn btn-b btn-sm smooth"><i class="fa fa-plus"></i> Ajouter une client</a></div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th colspan="2">Opérations</th>
            </tr>
        </thead>
        <tbody>
		<?php
	foreach  ($Clients as $Client)
	{
		?>
		<tr>
		<td><a href="index.php?module=clients&action=details&idClient=<?=$Client['idClient']?>"><?= $Client['nomClient'];?></a></td>
		<td><a href="index.php?module=clients&action=form_update&idClient=<?=$Client['idClient']?>"><i class="fa fa-edit"></i></a></td>
		<td><a href="index.php?module=clients&action=delete&idClient=<?=$Client['idClient']?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée'));"><i class="fa fa-trash-alt"></i></a></td>
		</tr>
	<?php
	}
	?>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th colspan="2">Opérations</th>
            </tr>
        </tfoot>
    </table>

          </div>
        </div>
      </div>
	
	
	<?php
} 
function form_add_client()
{
	?>
      <div class="container">
	  
        <div class="row">
          <div class="col-lg-8 mx-auto">
		  <h2>Ajouter une client</h2>
	<form>
  <div class="form-group">
    <label for="nomUser">Nom</label>
    <input type="text" class="form-control"  clientholder="Nom de la client" name="nomClient">
  </div>
 <input type="submit" class="btn btn-primary" name="ajouter" value="Ajouter" />
	 <input type="hidden" name="module" value="clients" />
	<input type="hidden" name="action" value="add" />
</form>
</div>
</div>
</div>
	
	<?php
}

function form_update_client($bdd,$idClient)
{
	$Client=get_client($bdd,$idClient);
	?>
      <div class="container">
	  
        <div class="row">
          <div class="col-lg-8 mx-auto">
		  		  <h2>Modifier une client : <?=$Client['nomClient']?></h2>

	<form>
  <div class="form-group">
    <label for="nomUser">Nom</label>
    <input type="text" class="form-control"  clientholder="Nom de la client" name="nomClient" value="<?= $Client['nomClient']; ?>" />
  </div>
 <input type="submit" class="btn btn-primary" name="ajouter" value="Modifier" />
	 <input type="hidden" name="module" value="clients" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="idClient" value="<?= $idClient; ?>" />
</form>
</div>
</div>
</div>
	<?php
}
function form_details_client($bdd,$idClient)
{
		$Pl=get_client($bdd,$idClient);
		$Clients=details_client($bdd,$idClient);

	?>
	
	      <div class="container">
	  
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		
		  		  <h2>Détails du client : <?=$Pl['nomUser']." ".$Pl['prenomUser']?></h2>

        </div></div></div>		
	
	<?php
}
function form_connexion()
{
	?>
	<section>
	 <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
	<form>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="mailUser">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="passwordUser">
  </div>
  <div class="form-group form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox"> Remember me
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <input type="hidden" name="module" value="clients" />
  <input type="hidden" name="action" value="connexion" />
</form>
</div></div></div></section>
	<?php
}
?>