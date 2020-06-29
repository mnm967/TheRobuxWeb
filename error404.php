<?php
  http_response_code(404);

  ob_start();
  session_start();
  if(isset($_SESSION['userLoggedIn'])){
    include("includes/header.php");
  }else{
    include("includes/login_header.php");
  }
?>
<div style="min-height: 85vh;">
<div class="row" style="margin-top: 48px; margin-left: 12px; margin-right: 12px;">
    <div class="container">
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <img class="material-icons" style="margin: auto; display: block; width: 100px; height: 100px; margin-bottom: 16px; margin-top: 16px;" src="assets/img/icons/circled-x.png"/>
              <h3 class="card-title" style="color: #d50000; width: 100%; text-align: center;">Error 404</h3>
              <h4 class="card-text" style="color: #d50000; width: 100%; text-align: center;">Sorry we couldn't find that page.<br><a href="https://www.therobux.com/">Home</a></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>
<?php include("includes/footer.php")?>