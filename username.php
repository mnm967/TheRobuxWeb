<?php include("includes/username-header.php")?>
<?php
    include("includes/classes/Constants.php");
    include("includes/classes/Account.php");

    $account = new Account($sqlConnection);

    function sanitizeUsername($text){
      $text = strip_tags($text);
      $text = str_replace(" ", "", $text);
      return $text;
    }
    function getInputValue($name){
      if(isset($_POST[$name])){
          echo $_POST[$name];
      }
    }
    if(isset($_POST['continueButton'])){
        $username = sanitizeUsername($_POST['username-form']);
        $changeSuccessful = $account->changeUsername($_SESSION['userLoggedIn'], $username);
    
        if($changeSuccessful){
            header("Location: earn.php");
        }
    }
?>
<div style="min-height: 85vh;">
<div class="row" style="margin-top: 48px; margin-left: 12px; margin-right: 12px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-7 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" action="username.php" method="POST">
              <div class="card-header card-header-primary text-center" style="background: #4caf50 !important;">
                <h4 class="card-title" style="font-family: 'Roboto'; margin-top: 0">Public Username</h4>
              </div>
              <p class="description text-center" style="margin-top: 48px;">Choose A Public Username to Continue:</p>
              <div class="card-body" style="margin-top: 48px;">
              <p style="margin-top: 27px; padding-left: 15px; padding-right: 15px;">
                  <?php echo $account->getError(Constants::$usernameLengthError); ?>
                  <?php echo $account->getError(Constants::$usernameTaken); ?>
                  <div class="input-group" style="margin-top: 5px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">person</i>
                      </span>
                    </div>
                    <input type="text" class="form-control" name="username-form" placeholder="Enter Public Username" id="username-form" value="<?php getInputValue('username-form'); ?>" required>
                  </div>
              </p><div class="footer text-center">
                <button type="submit" name="continueButton" class="btn btn-primary btn-link btn-wd btn-lg" style="color: #4caf50;">Continue</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>
<?php include("includes/footer.php")?>