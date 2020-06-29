<?php 
http_response_code(404);
include("includes/banned-header.php")?>
<div style="min-height: 85vh;">
<div class="row" style="margin-top: 48px; margin-left: 12px; margin-right: 12px;">
    <div class="container">
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <img class="material-icons" style="margin: auto; display: block; width: 100px; height: 100px; margin-bottom: 16px; margin-top: 16px;" src="assets/img/icons/circled-x.png"/>
              <h3 class="card-title" style="color: #d50000; width: 100%; text-align: center;">You've Been Banned</h3>
              <h4 class="card-text" style="color: #d50000; width: 100%; text-align: center;">Unfortunately your account has been banned for suspicious behaviour. If you think that there has been a mistake please contact support@flashrobux.com</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
  </div>
<?php include("includes/footer.php")?>