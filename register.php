<?php include("includes/login_header.php")?>
<?php
    include("includes/classes/Constants.php");
    include("includes/classes/Account.php");
    
    if(isset($_SESSION['userLoggedIn'])){
        header("Location: earn.php");
    }
    
    if(isset($_GET['rid'])){
      $rID = $_GET['rid'];
      $_SESSION['rid'] = $rID;
    }else{
      $rID = -1;
    }

    $account = new Account($sqlConnection);

    function sanitizeString($text){
        $text = strip_tags($text);
        $text = str_replace(" ", "", $text);
        $text = ucfirst(strtolower($text));
        return $text;
    }
    function sanitizeEmail($text){
        $text = strip_tags($text);
        $text = str_replace(" ", "", $text);
        return $text;
    }
    function sanitizeUsername($text){
      $text = strip_tags($text);
      $text = str_replace(" ", "", $text);
      return $text;
    }
    function sanitizePassword($text){
        $text = strip_tags($text);
        return $text;
    }
    function getInputValue($name){
      if(isset($_POST[$name])){
          echo $_POST[$name];
      }
    }
    if(isset($_POST['signupButton'])){
        $email = sanitizeEmail($_POST['email-form-signup']);
        $username = sanitizeUsername($_POST['username-form-signup']);
        $emailConfirm = sanitizeEmail($_POST['confirm-email-form-signup']);
        $password = sanitizePassword($_POST['password-form-signup']);
        $passwordConfirm = sanitizePassword($_POST['confirm-password-form-signup']);
    
        $registerSuccessful = $account->register($rID, $username, $email, $emailConfirm, $password, $passwordConfirm);
    
        if($registerSuccessful){
            $account->login($email, $password);
            $_SESSION['userLoggedIn'] = $account->getCurrentUserId();
			
			$currUserId = $_SESSION['userLoggedIn'];
			$currentIpAddress = getUserIpAddr();
			$ipUpdateQuery = mysqli_query($sqlConnection, "UPDATE users SET ipAddress='$currentIpAddress' WHERE id='$currUserId'");
			
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
            <form class="form" action="<?php if($rID == -1) echo "register.php"; else echo "register.php?rid=$rID";?>" method="POST">
              <div class="card-header card-header-primary text-center" style="background: #4caf50 !important;">
                <h4 class="card-title" style="font-family: 'Roboto'">Login Using:</h4>
                <div class="social-line">
                  <a title="Login With Steam" href="?steam-login" class="btn btn-just-icon btn-link">
                    <img src="assets/img/icons/steam.svg" style="height: 28px;">
                  </a>
                  <a title="Login With Google" href="<?php echo $client->createAuthUrl() ?>" class="btn btn-just-icon btn-link">
                    <img src="assets/img/icons/google.svg" style="height: 28px;">
                  </a>
                </div>
              </div>
              <p class="description text-center" style="margin-top: 16px;">Or Create An Account:</p>
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
                    <input type="text" class="form-control" name="username-form-signup" placeholder="Enter Username" id="username-form-signup" value="<?php getInputValue('username-form-signup'); ?>" required>
                  </div>
              </p>
              <p style="margin-top: 27px; padding-left: 15px; padding-right: 15px;">
                  <?php echo $account->getError(Constants::$emailsDontMatchError); ?>
                  <?php echo $account->getError(Constants::$emailInvalidError); ?>
                  <?php echo $account->getError(Constants::$emailTaken); ?>
                  <div class="input-group" style="margin-top: 5px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">mail</i>
                      </span>
                    </div>
                    <input type="email" class="form-control" name="email-form-signup" placeholder="Enter Email" id="email-form-signup" value="<?php getInputValue('email-form-signup'); ?>" required>
                  </div>
              </p>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">assignment_turned_in</i>
                    </span>
                  </div>
                  <input type="email" class="form-control" name="confirm-email-form-signup" placeholder="Confirm Email" id="confirm-email-form-signup" required>
                </div>
                <p style="margin-top: 27px; padding-left: 15px; padding-right: 15px;">
                  <?php echo $account->getError(Constants::$passwordsDontMatchError); ?>
                  <?php echo $account->getError(Constants::$passwordLengthError); ?>
                  <div class="input-group" style="margin-top: 5px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                    <input type="password" class="form-control" name="password-form-signup" placeholder="Enter Password" id="password-form-signup" required>
                  </div>
                </p>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">assignment_turned_in</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" name="confirm-password-form-signup" placeholder="Confirm Password" id="confirm-password-form-signup" required>
                </div>
              </div>
              <p class="description text-center" style="margin-top: 24px">By Creating An Account You Agree with our <a href="terms-of-service.php">Terms Of Service</a> and <a href="privacy-policy.php">Privacy Policy</a></p>
              <div class="footer text-center">
                <button type="submit" name="signupButton" class="btn btn-primary" style="margin-bottom: 16px; background-color: #4caf50; color: #fff">Register</button>
              </div>
            </form>
            <p class="description text-center">Already Have An Account?</p>
              <div class="footer text-center">
                <a href="login.php" class="btn btn-primary btn-link btn-wd btn-lg" style="margin-top: 0px; color: #4caf50;">Login</a>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>
<?php include("includes/footer.php")?>