<?php 
  ob_start();
  session_start();
  if(isset($_SESSION['userLoggedIn'])){
    include("includes/header.php");
  }else{
    include("includes/login_header.php");
  }
?>
<div class="px-lg-5 py-lg-1" style="min-height: 85vh;">

<div class="row" style="margin-left: 12px; margin-right: 12px;">
    <div style="width: 100%;">
      <div class="row" style="margin: 8px">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px; width: 100%">
          <div class="card-body p-0">
            <div class="col-md-12 p-0">
              <img style="margin: auto; display: block; width: 100%; margin-bottom: 16px;" src="assets/img/roblox-image.jpg" alt="free robux image"/>
              <h1 class="card-title px-2" style="color: #4CAF50; width: 100%; text-align: center; font-size: 36px">Roblox - The BEST Game Ever!!!</h1>
              <p class="card-text px-2" style="color: #4CAF50; width: 100%; text-align: center; font-size: 1.125rem; line-height: 1.5em;">
                Roblox is one of the most popular online multiplayer games. Roblox comes with a revolutionary game creation system. 
                This allows users to create games and play dozens more created by other players.
                <br><br>The platform includes virtual worlds covering dozens of genres, ranging from role-playing games to obstacle courses and racing. 
                Roblox is one of the biggest games in the world with over 100 MILLION monthly active users.
                <br><br>Roblox allows users to buy and sell virtual items. Various items can be bought using Roblox's main currency - Robux. 
                Having Robux will significantly increase your gaming experience. 
                <br><br>TheRobux.com is one of the best websites to earn free Robux by completing surveys. 
                We aim to provide you with the BEST Roblox gaming experience.
                <br><br>What are you waiting for?
                <br><a class="text-uppercase" title="register-page" href="register.php">Start earning free Robux NOW.</a>
                <br><br><a class="text-uppercase" title="roblox" href="https://www.roblox.com/" target="_blank">Open Roblox</a>
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

</div>
<?php include("includes/footer.php")?>