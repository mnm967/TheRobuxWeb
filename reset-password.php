<?php include("includes/login_header.php")?>
<?php
    include("includes/classes/Constants.php");
    include("includes/classes/ForgottenAccount.php");
    
    if(isset($_SESSION['userLoggedIn'])){
        header("Location: earn.php");
    }

    if(isset($_GET['token'])){
        $token = $_GET['token'];
    }else{
        header("Location: forgot-password.php");
    }

    $tokenQuery = mysqli_query($sqlConnection, "SELECT * FROM user_reset_tokens WHERE token_code='$token'");
    if(mysqli_num_rows($tokenQuery) > 0){
      $row = mysqli_fetch_array($tokenQuery);
      $tokenDateTime = $row['token_date_added'];
      $dateNow = date("Y-m-d H:i:s", time()+((1000*60*60)*2));

      $tokenTimestamp = strtotime($tokenDateTime);
      $nowTimestamp = time()+((1000*60*60)*2);

      if($tokenTimestamp > $nowTimestamp){
		$deleteQuery = mysqli_query($sqlConnection, "DELETE FROM user_reset_tokens WHERE token_code='$token'");
        header("Location: token-expired.php");
      }
    }else{
      header("Location: token-expired.php");
    }

    $account = new ForgottenAccount($sqlConnection);

    function sanitizePassword($text){
        $text = strip_tags($text);
        return $text;
    }
    function getInputValue($name){
      if(isset($_POST[$name])){
          echo $_POST[$name];
      }
    }
    if(isset($_POST['resetButton'])){
        $password = sanitizePassword($_POST['password-form-signup']);
        $passwordConfirm = sanitizePassword($_POST['confirm-password-form-signup']);
    
        $resetSuccessful = $account->resetPassword($token, $password, $passwordConfirm);
        //echo "<span>".$resetSuccessful."</span>";
        if($resetSuccessful){
            header("Location: reset-successful.php");
        }
    }
?>
<div style="min-height: 85vh;">
<div class="row" style="margin-top: 48px; margin-left: 12px; margin-right: 12px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-7 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" action="<?php echo "reset-password.php?token=$token" ?>" method="POST">
              <div class="card-header card-header-primary text-center" style="background: #4caf50 !important;">
                <h4 class="card-title" style="font-family: 'Roboto'; margin-top: 0;">Reset Password</h4>
              </div>
              <p class="description text-center" style="margin-top: 48px;">Create A New Password:</p>
              <div class="card-body" style="margin-top: 48px;">
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
              </div><div class="footer text-center">
                <button type="submit" name="resetButton" class="btn btn-primary btn-link btn-wd btn-lg" style="color: #4caf50;">Reset Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>
<?php include("includes/footer.php")?>