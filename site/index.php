<?php
 include 'inc/header.php';
?>

<?php require_once 'inc/config.php'; ?>

<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Ld4l1AUAAAAANA22PczpSRTZoqWePcjRGNg3olq',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<div class="alert alert-warning">
    <strong>Warning!</strong> This alert box could indicate a warning that might need attention.
  </div>';
    } else {
        // If CAPTCHA is successfully completed...

        // Paste mail function or whatever else you want to happen here!
        echo '<br><p>CAPTCHA was completed successfully!</p><br>';
    }
} else { ?>
   <div class="container">
    <div class="row">
      <div class="span6" style="float: none; margin:0 auto;">
  <form action="#" method="POST">
  <div class="form-group row">
    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Mot de passe</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
  </div>
  <div class="form-check row">
    <div class="col-sm-10">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Se souvenir</label>
    </div>
  </div>
  <div class="g-recaptcha" data-sitekey="6Ld4l1AUAAAAAMdcK-K_Yt6NBcObiIcAm9W1xdrs"></div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>
</div>
</div>
</div>
<?php } ?>


<?php include 'inc/footer.php'; ?>
