<?php include("includes/login_header.php");?>
<?php
    include("includes/classes/Constants.php");
    include("includes/classes/ForgottenAccount.php");

    $account = new ForgottenAccount($sqlConnection);

    function sanitizeEmail($text){
      $text = strip_tags($text);
      $text = str_replace(" ", "", $text);
      return $text;
    }
    function getInputValue($name){
      if(isset($_POST[$name])){
          echo $_POST[$name];
      }
    }
    if(isset($_POST['resetPasswordButton'])){
        $email = sanitizeEmail($_POST['email-form']);

        $changeSuccessful = $account->sendToken($email);
    }
?>
<div style="min-height: 85vh;">
<div class="row" style="margin-top: 48px; margin-left: 12px; margin-right: 12px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-7 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" action="forgot-password.php" method="POST">
              <div class="card-header card-header-primary text-center" style="background: #4caf50 !important;">
                <h4 class="card-title" style="font-family: 'Roboto'; margin-top: 0">Reset Password</h4>
              </div>
              <p class="description text-center" style="margin-top: 48px;">Enter Email to Reset Password:</p>
              <div class="card-body" style="margin-top: 48px;">
              <p style="margin-top: 27px; padding-left: 15px; padding-right: 15px;">
                  <?php echo $account->getError(Constants::$googleLinkedAccount); ?>
                  <?php echo $account->getError(Constants::$emailNotFound); ?>
                  <?php echo $account->getSuccess(Constants::$tokenSent); ?>
                  <div class="input-group" style="margin-top: 5px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">person</i>
                      </span>
                    </div>
                    <input type="email" class="form-control" name="email-form" placeholder="Enter Email" id="email-form" value="<?php getInputValue('email-form'); ?>" required>
                  </div>
              </p>
              <div class="footer text-center">
                <button type="submit" name="resetPasswordButton" class="btn btn-primary btn-link btn-wd btn-lg" style="color: #4caf50;">Continue</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>
<?php include("includes/footer.php")?>