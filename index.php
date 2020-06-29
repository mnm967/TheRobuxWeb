<?php 
  ob_start();
  session_start();
  if(isset($_SESSION['userLoggedIn'])){
    include("includes/header.php");
  }else{
    include("includes/login_header.php");
  }
?>
<div style="min-height: 85vh;">

<div class="row" style="margin-left: 12px; margin-right: 12px;">
    <div style="width: 100%;">
      <div class="row" style="margin: 8px">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px; width: 100%">
          <div class="card-body">
            <div class="col-md-12">
              <img class="material-icons" style="margin: auto; display: block; width: 100px; height: 100px; margin-bottom: 16px; margin-top: 16px;" src="assets/img/icons/pay-per-click.svg" alt="free robux image"/>
              <h1 class="card-title" style="color: #4CAF50; width: 100%; text-align: center; font-size: 32px">Get Ready to Earn Free Robux</h1>
              <p class="card-text" style="color: #4CAF50; width: 100%; text-align: center; font-size: 1.125rem; line-height: 1.5em;">
              Are you ready to earn free Robux? Earning Robux has never been this easy! Welcome to TheRobux.com, the BEST website to earn free Robux.<br>
              Getting Started is as easy as 1,2,3. Simply create an account and complete offers to earn Robux.<br>
              Once you've earned enough Robux, you can immediately send them directly to your Roblox Account and have fun with your free robux.<br>
              Get Started and unlock new possibilities by earning Free Robux with TheRobux.com!
               <br><br><a title="register-page" href="register.php">Click Here to Start Earning Free Robux NOW!</a>
               <br><br><a title="roblox-page" href="roblox.php">About Roblox</a>
               </p>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row" style="margin-left: 20px; margin-right: 20px;">
    <a title="discord-group" style="width: 100%" href="https://discord.gg/6szyDGH" target="_blank">
        <div class="card card-nav-tabs text-center grow" style="background: #7289da !important; margin-bottom: 0; padding-bottom: 18px">
            <div class="card-body">
                <div class="col-md-12">
                    <h3 class="card-text" style="color: #fff; width: 100%; text-align: center; line-height: 1em;">
                        <img src="assets/img/icons/discord.png" alt="discord icon" height="32px" width="32px" style="margin-right: 8px"> Join Our Discord Server
                    </h3>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="row" style="margin-left: 20px; margin-right: 20px;">
  <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
    <div class="card-body">
    <div class="row">
    <div class="col-md-4">
        <img class="material-icons" style="display: block; width: 100%; height: 124px; margin-bottom: 16px; margin-top: 16px;" alt="robux_account" src="assets/img/icons/consent.svg"/>
        <h2 class="card-title" style="color: #4CAF50; font-size: 1.5625rem; line-height: 1.4em;">Step 1: Create Account</h2>
        <p class="card-text" style="color: #4CAF50; font-size: 1.125rem; line-height: 1.5em;">Create An Account on Our Website. Alternatively, you can use Google and Steam to Log In.</p>
      </div>
      <div class="col-md-4">
        <img class="material-icons" style="display: block; width: 100%; height: 124px; margin-bottom: 16px; margin-top: 16px;" alt="robux_earn" src="assets/img/icons/cursor.svg"/>
        <h2 class="card-title" style="color: #4CAF50; font-size: 1.5625rem; line-height: 1.4em;">Step 2: Earn FREE Robux</h2>
        <p class="card-text" style="color: #4CAF50; font-size: 1.125rem; line-height: 1.5em;">Complete offers such as Surveys and Downloading Apps to earn free Robux.</p>
      </div>
      <div class="col-md-4">
        <img class="material-icons" style="display: block; width: 100%; height: 124px; margin-bottom: 16px; margin-top: 16px;" alt="robux_rewards" src="assets/img/icons/piggy-bank.svg"/>
        <h2 class="card-title" style="color: #4CAF50; font-size: 1.5625rem; line-height: 1.4em;">Step 3: Withdraw</h2>
        <p class="card-text" style="color: #4CAF50; font-size: 1.125rem; line-height: 1.5em;">Withdraw your earned Robux and Enjoy buying cool items using the free robux you received!</p>
      </div>
    </div>
    </div>
  </div>
</div>
</div>
<?php include("includes/footer.php")?>