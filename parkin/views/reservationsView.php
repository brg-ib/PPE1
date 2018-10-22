<header class="masthead2 text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
			  Réservations
            </h1>
            <hr>
          </div>
          
        </div>
      </div>
    </header>
<?php
function afficher($bdd,$Elements)
{
					 require_once 'models/reservationsModel.php';
	?>
	<section>
	      <div class="container">
	  
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
				<th>Client</th>
				<th>Date Début</th>
				<th>Date fin</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
		<?php
		if($Elements){
	foreach  ($Elements as $Element)
	{
		?>
		<tr>
		<td><a href="index.php?module=clients&action=details&idClient=<?=$Element['idUser']?>"><?=$Element['nomUser']." ".$Element['prenomUser']?></a></td>
		<td><?=$Element['dateDebut']?></td>
		<td><?=$Element['dateFin']?></td>
		<td>
		<?php
		require_once 'models/placesModel.php';
		$P=actual_place($bdd,$Element['idPlace']);
				if(($P) &&($P[0]['dateDebut']<= date("Y-m-d H:i:s")) && ($P[0]['dateFin']>= date("Y-m-d H:i:s"))){
				echo "<span class='btn btn-danger' >Occupée</span>";}
				else{
			echo "<span class='btn btn-success' >Libre</span>";}
		?>
		</td>
		</tr>
	<?php
		}}
		else { echo "<tr><td colspan='3'>Pas de réservations pour le moment</td></tr>";
	?>
		<?php } ?>
        <tfoot>
            <tr>
                <th>Client</th>
				<th>Date Début</th>
				<th>Date fin</th>
				<th>Etat</th>
            </tr>
        </tfoot>
    </table>

          </div>
        </div>
      </div>
	
	</section>
	<?php
} 