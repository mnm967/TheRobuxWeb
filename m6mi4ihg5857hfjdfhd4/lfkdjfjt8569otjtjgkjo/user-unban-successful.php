<?php include("includes/admin-header.php")?>
<?php 
  if(isset($_GET['id'])){
    $uid = $_GET['id'];
    if(empty($uid)){
      header("Location: admin-users.php");
    }
  }else{
    header("Location: admin-users.php");
  }
?>
<div style="min-height: 85vh;">
<div class="row" style="margin-top: 48px; margin-left: 12px; margin-right: 12px;">
    <div class="container">
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <img class="material-icons" style="margin: auto; display: block; width: 100px; height: 100px; margin-bottom: 16px; margin-top: 16px;" src="assets/img/icons/color-tick.svg"/>
              <h3 class="card-title" style="color: #4CAF50; width: 100%; text-align: center;">User Successfully Unbanned</h3>
              <h4 class="card-text" style="color: #4CAF50; width: 100%; text-align: center;">The User was Successfully Unbanned.</h4>
              <a href="admin-view-user.php?id=<?php echo $uid;?>" class="card-text" style="width: 100%; text-align: center;">Return to User Details</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
<?php include("includes/footer.php")?>