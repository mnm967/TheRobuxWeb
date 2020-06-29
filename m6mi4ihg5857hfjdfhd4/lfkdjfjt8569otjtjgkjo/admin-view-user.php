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
  $userQuery = mysqli_query($sqlConnection, "SELECT * FROM users WHERE id='$uid'");
  if(mysqli_num_rows($userQuery) == 0) header("Location: admin-users.php");
  else $userRow = mysqli_fetch_array($userQuery);
?>
<div style="min-height: 85vh;">
<div class="row" style="margin-top: 48px; margin-left: 12px; margin-right: 12px;">
    <div class="container">
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <h3 class="card-title" style="color: #4CAF50; width: 100%; text-align: center;">Username</h3>
              <h4 class="card-text" style="color: #4CAF50; width: 100%; text-align: center;"><?php echo $userRow['username']?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <h3 class="card-title" style="color: #4CAF50; width: 100%; text-align: center;">Email</h3>
              <h4 class="card-text" style="color: #4CAF50; width: 100%; text-align: center;"><?php echo $userRow['email']?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <h3 class="card-title" style="color: #4CAF50; width: 100%; text-align: center;">Current Points</h3>
              <h4 class="card-text" style="color: #4CAF50; width: 100%; text-align: center;"><?php echo "R$ ".number_format($userRow['currentPoints'], 0, ".", " ")?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <h3 class="card-title" style="color: #4CAF50; width: 100%; text-align: center;">Total Points Earned</h3>
              <h4 class="card-text" style="color: #4CAF50; width: 100%; text-align: center;"><?php echo "R$ ".number_format($userRow['totalPointsEarned'], 0, ".", " ")?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <h3 class="card-title" style="color: #4CAF50; width: 100%; text-align: center;">Total Offers Completed</h3>
              <h4 class="card-text" style="color: #4CAF50; width: 100%; text-align: center;"><?php echo $userRow['totalOffersCompleted']?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <h3 class="card-title" style="color: #4CAF50; width: 100%; text-align: center;">Last Login IP Address</h3>
              <h4 class="card-text" style="color: #4CAF50; width: 100%; text-align: center;"><?php echo $userRow['ipAddress']?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
          <div class="card-body">
            <div class="col-md-12">
              <h3 class="card-title" style="color: #4CAF50; width: 100%; text-align: center;">Status</h3>
              <h4 class="card-text" style="color: #4CAF50; width: 100%; text-align: center;"><?php if($userRow['isBanned'] == 1) echo "User Currently Banned"; else echo "User Not Banned"; ?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card" style="margin-bottom: 0; padding-bottom: 16px">
          <div id="headingThree">
            <h3 class="mb-0" style="margin-top: 8px !important;">
            <a href="admin-user-earnings.php?id=<?php echo $uid; ?>">
              <button style="color: #4CAF50; font-weight: bold; width: 100%;" class="help-button">
              View Earnings History
              </button>
            <a>
            </h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card" style="margin-bottom: 0; padding-bottom: 16px">
          <div id="headingThree">
            <h3 class="mb-0" style="margin-top: 8px !important;">
            <a href="admin-user-withdrawls.php?id=<?php echo $uid; ?>">
              <button style="color: #4CAF50; font-weight: bold; width: 100%;" class="help-button">
              View Withdrawl History
              </button>
            <a>
            </h3>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
          <div class="card admin-ban-card" style="width: 100%">
              <input type="text" id="ban-input" name="ban-input" placeholder="User Ban Reason" value="<?php echo $userRow['bannedReason']?>">
            </div>
          </div>
        <div class="col-lg-12 col-md-12 text-center">
            <button id="ban-user-button" onclick="onBanClick()" type="button" class="btn <?php if($userRow['isBanned']==1) echo 'btn-success'; else echo 'btn-danger';?>" style="margin-bottom: 17px;width: 164px;"><?php if($userRow['isBanned']==1) echo 'UNBAN USER'; else echo 'BAN USER';?></button>
        </div>
    </div>
  </div>
</div>
  </div>
  <script>
    var isLoading = false;
    function onBanClick(){
		if(!isLoading){
			var userId = <?php echo $uid ?>;
			var banReason = $("#ban-input").val();
			if(banReason == ""){
				isLoading = false;
				showModal("Fill In Ban Reason", "Please provide a Reason for the Ban.");
				return;
			}
			isLoading = true;
			$("#ban-user-button").html("PROCESSING...");
      var userIsBanned = <?php if($userRow['isBanned']==1) echo 'true'; else echo 'false';?>;

      var ban = 0;
      if(userIsBanned) ban = 0;
      else ban = 1;

			$.post("includes/ajax/ban_user.php", {userId: userId, banReason: banReason, userIsBanned: ban}, function(result){
        $("#ban-user-button").html("<?php if($userRow['isBanned']==1) echo 'UNBAN USER'; else echo 'BAN USER';?>");
				if(result == 0){
          if(userIsBanned) window.location.href = "user-unban-successful.php?id="+userId;
          else window.location.href = "user-ban-successful.php?id="+userId;
				}else if(result == 1){
          showModal("Something Went Wrong", "Something Went Wrong. Please Try Again.");
        }
				isLoading = false;
			});
		}
	}
  </script>
<?php include("includes/footer.php")?>