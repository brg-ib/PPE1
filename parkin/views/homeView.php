    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Park'in</strong>
			  <?php if (is_admin()) { ?> <h4>Adminisration</h4> <?php } else {?>

			  <h4>Résrevez votre place de parking!!</h4> <?php } ?>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Il y a des places disponibles</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="index.php?module=reserver&action=reserver&idUser=<?=$_SESSION['idUser'];?>">Réserver</a>
          </div>
        </div>
      </div>
    </header>