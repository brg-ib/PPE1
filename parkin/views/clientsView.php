
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
	?><section>
	      <div class="container">
	  
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		  <div style="float: right;padding:12px 30px 14px"><a href="index.php?module=clients&action=form_add" class="btn btn-b btn-sm smooth"><i class="fa fa-plus"></i> Ajouter une client</a></div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nom & Prénom</th>
				<th>E-mail</th>
				<th>Téléphone</th>
                <th colspan="4">Opérations</th>
            </tr>
        </thead>
        <tbody>
		<?php
	foreach  ($Clients as $Client)
	{
		?>
		<tr>
		<td><a href="index.php?module=clients&action=details&idClient=<?=$Client['idUser']?>"><?=$Client['nomUser']." ".$Client['prenomUser'];?></a></td>
		<td><?=$Client['mailUser']?>
		<td><?=$Client['telUser']?>
		<td><a href="index.php?module=clients&action=form_update&idClient=<?=$Client['idUser']?>"><i class="fa fa-edit"></i></a></td>
		<td><a href="index.php?module=clients&action=delete&idClient=<?=$Client['idUser']?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée'));"><i class="fa fa-trash-alt"></i></a></td>
		</tr>
	<?php
	}
	?>
        <tfoot>
            <tr>
                <th>Nom & Prénom</th>
				<th>E-mail</th>
				<th>Téléphone</th>
                <th colspan="4">Opérations</th>
            </tr>
        </tfoot>
    </table>

          </div>
        </div>
      </div>
	</section>
	
	<?php
} 
function form_add_client()
{
	?>
	<section>
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
	</section>
	<?php
}

function form_update_client($bdd,$idClient)
{
	$Client=get_client($bdd,$idClient);
	?>
	<section>
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
</section>
	<?php
}
function form_details_client($bdd,$idClient)
{
		$Pl=get_client($bdd,$idClient);
		$Clients=details_client($bdd,$idClient);

	?>
	<section>
	      <div class="container">
	  
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
		
		  		  <h2>Détails du client : <?=$Pl['nomUser']." ".$Pl['prenomUser']?></h2>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Place</th>
				<th>Date début</th>
				<th>Date Fin</th> 
            </tr>
        </thead>
        <tbody>
		<?php
		$Places=historiqueClient($bdd,$Pl['idUser']);
		if (!$Places)
		{
		?>
		<td colspan="4">Pas de réservations</td>
	<?php }
	foreach  ($Places as $Place)
	{
		?>
		<tr>
		
		<td><a href="index.php?module=clients&action=details&idClient=<?=$Place['idUser']?>">
		<?php
		
		echo $Place['nomPlace']; ?>
		</a></td>
		<td><?php 
		$date = new DateTime($Place['dateDebut']);
			echo 'Le <strong>'.$date->format('d-m-Y'.'</strong> à '.'H:i:s');
		
		?></td>
		<td><?php 
		$date = new DateTime($Place['dateFin']);
			echo 'Le <strong>'.$date->format('d-m-Y'.'</strong> à '.'H:i:s');
		if($Place['dateDebut']<= date("Y-m-d H:i:s") && $Place['dateFin']>= date("Y-m-d H:i:s"))
			echo "<span class='btn btn-info' > en cours</span>";
		?></td>		</tr>
	<?php
	}
	?>
        <tfoot>
            <tr>
                <th>Place</th>
				<th>Date début</th>
				<th>Date Fin</th> 
            </tr>
        </tfoot>
    </table>

          </div>
       
        </div></div></div>		
	</section>
	<?php
}
function form_connexion()
{
	?>
	<section>
	 <div class="container">

	<section>      
<?php if(isset($_GET['erreur'])) {
	?>
	<div class="alert alert-danger" role="alert">
  <strong><i class="fa fa-exclamation-circle"></i> ACHTUNG</strong> , Votre login ou mot de passe est incorrect
</div>
<?php }?>
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