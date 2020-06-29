<?php include("includes/admin-login-header.php")?>
<?php
    include("includes/classes/Constants.php");
    include("includes/classes/AdminAccount.php");

    //session_destroy();

    if(isset($_SESSION['adminLoggedIn'])){
        header("Location: admin-dashboard.php");
    }
    
    $account = new Account($sqlConnection);

    if(isset($_POST['login-button'])){
        $email = $_POST['email-form-login'];
        $password = $_POST['password-form-login'];
    
        $loginSuccessful = $account->login($sqlConnection, $email, $password);

        if($loginSuccessful){
            $_SESSION['adminLoggedIn'] = $account->getCurrentUserId();
			
			      $currUserId = $_SESSION['adminLoggedIn'];
            header("Location: admin-dashboard.php");
        }
    }
    function getInputValue($name){
      if(isset($_POST[$name])){
          echo $_POST[$name];
      }
    }
?>
<div style="min-height: 85vh;">
<div class="row" style="-margin-top: 48px; margin-left: 12px; margin-right: 12px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" action="admin-login.php" method="POST">
              <div class="card-header card-header-primary text-center" style="margin-top: 16px; background: #4caf50 !important;">
                <h4 class="card-title" style="font-family: 'Roboto'">Welcome Admin</h4>
              </div>
              <p class="description text-center" style="margin-top: 16px;">Login Here:</p>
              <div class="card-body" style="margin-top: 48px;">
              <p style="margin-top: 27px; padding-left: 15px; padding-right: 15px;">
                  <?php echo $account->getError(Constants::$loginFailed); ?>
                  <div class="input-group" style="margin-top: 5px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">mail</i>
                      </span>
                    </div>
                    <input type="email" class="form-control" name="email-form-login" placeholder="Email" id="email-form-login" value="<?php getInputValue('email-form-login'); ?>" required>
                  </div>
              </p>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" name="password-form-login" placeholder="Password" id="password-form-login" required>
                </div>
              </div>
              <div class="footer text-center">
                <button type="submit" name="login-button" class="btn btn-primary" style="margin-top: 16px; background-color: #4caf50; color: #fff">Login</button>
              </div>
            </form>
            <p class="description text-center">Forgot Password? <a href="forgot-password.php">Click Here</a></p>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>
<?php include("includes/footer.php")?>