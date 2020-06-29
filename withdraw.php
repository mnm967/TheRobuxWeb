<?php include("includes/header.php")?>
<div style="min-height: 85vh;">
<div class="row" style=" margin-left: 20px; margin-top: 32px; margin-right: 20px;">
  <div class="col-md-12">
    <div class="card text-center">
        <div class="card-header card-header-icon card-header-rose" style="background: #4caf50 !important;">
          <div class="card-icon">
            <i class="material-icons" style="font-size: 36px">account_balance</i>
          </div>
        </div>
        <div class="card-body">
            <h3 class="card-title" style="color: #4CAF50;">My Total Points Earned</h3>
            <h3 class="card-text"  style="color: #4CAF50;"><?php
                    $userId = $_SESSION['userLoggedIn'];
                    $totalQuery = mysqli_query($sqlConnection, "SELECT totalPointsEarned FROM users WHERE id='$userId'");
                    $totalAmount = mysqli_fetch_array($totalQuery)['totalPointsEarned'];
                    echo "R$ " . number_format($totalAmount, 0, ".", " ");
                ?></h3>
        </div>
    </div>
  </div>
</div>

<div class="row" style="margin-left: 20px; margin-right: 20px;">
  <div class="col-md-6">
    <div class="card text-center">
        <div class="card-header card-header-icon card-header-rose" style="background: #4caf50 !important;">
          <div class="card-icon">
            <i class="material-icons" style="font-size: 36px">account_balance_wallet</i>
          </div>
        </div>
        <div class="card-body">
            <h3 class="card-title" style="color: #4CAF50;">My Current Points</h3>
            <h3 class="card-text"  style="color: #4CAF50;"><?php
                    $userId = $_SESSION['userLoggedIn'];
                    $currentQuery = mysqli_query($sqlConnection, "SELECT currentPoints FROM users WHERE id='$userId'");
                    $currentAmount = mysqli_fetch_array($currentQuery)['currentPoints'];
                    echo "R$ " . number_format($currentAmount, 0, ".", " ");
                ?></h3>
        </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card text-center">
        <div class="card-header card-header-icon card-header-rose" style="background: #4caf50 !important;">
          <div class="card-icon">
            <i class="material-icons" style="font-size: 36px">assessment</i>
          </div>
        </div>
        <div class="card-body">
            <h3 class="card-title" style="color: #4CAF50;">Offers Completed</h3>
            <h3 class="card-text"  style="color: #4CAF50;"><?php
                    $userId = $_SESSION['userLoggedIn'];
                    $offersCompletedQuery = mysqli_query($sqlConnection, "SELECT totalOffersCompleted FROM users WHERE id='$userId'");
                    $offersCompletedAmount = mysqli_fetch_array($offersCompletedQuery)['totalOffersCompleted'];
                    echo number_format($offersCompletedAmount, 0, ".", " ");
                ?></h3>
        </div>
    </div>
  </div>
</div>
<div class="row" style="margin-left: 20px; margin-right: 20px;">
<div class="col-md-12">
        <div class="card" style="margin-top: 0;">
            <div class="card-body">
                <h3 class="card-title" style="color: #4caf50;">Withdraw</h3>
                <h4 class="card-subtitle mb-2" style="color: #4caf50;">Step 1: Roblox Username</h4>
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-static">Roblox Username</label>
                  <input type="text" id="roblox-username-input" class="form-control" placeholder="Your Username here">
                </div>
                <h4 class="card-subtitle mb-2" style="color: #4caf50; margin-top: 0.5rem !important;">Step 2: Join Payout Group</h4>
                <a href="<?php 
					$groupIdQuery = "SELECT robuxGroupId FROM config WHERE id = '1'";

					$result = mysqli_query($sqlConnection, $groupIdQuery);

					$row = mysqli_fetch_array($result);
					$groupId = $row['robuxGroupId'];
					
					echo "https://www.roblox.com/My/Groups.aspx?gid=$groupId"
					?>" target="_blank">
					<button type="button" class="btn btn-success" style="margin-bottom: 17px;">JOIN GROUP</button>
				</a>
                <h4 class="card-subtitle mb-2" style="color: #4caf50; margin-top: 0.5rem !important;">Step 3: Choose An Amount</h4>
                <form>
                  <div class="form-check form-check-radio">
                      <label class="form-check-label" style="color: #4caf50">
                          <input class="form-check-input" type="radio" name="myRadio" id="radio10" value="10" checked>
                          R$ 10
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                      </label>
                  </div>
                  <div class="form-check form-check-radio">
                      <label class="form-check-label" style="color: #4caf50">
                          <input class="form-check-input" type="radio" name="myRadio" id="radio25" value="25">
                          R$ 25
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                      </label>
                  </div>
                  <div class="form-check form-check-radio">
                      <label class="form-check-label" style="color: #4caf50">
                          <input class="form-check-input" type="radio" name="myRadio" id="radio50" value="50">
                          R$ 50
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                      </label>
                  </div>
                  <div class="form-check form-check-radio">
                      <label class="form-check-label" style="color: #4caf50">
                          <input class="form-check-input" type="radio" name="myRadio" id="radio100" value="100">
                          R$ 100
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                      </label>
                  </div>
                  <div class="form-check form-check-radio">
                      <label class="form-check-label" style="color: #4caf50">
                          <input class="form-check-input" type="radio" name="myRadio" id="radio250" value="250">
                          R$ 250
                          <span class="circle">
                              <span class="check"></span>
                          </span>
                      </label>
                  </div>
                </form>
                <h4 class="card-subtitle mb-2" style="color: #4caf50; margin-top: 1.5rem !important;">Step 4: Cash Out & Enjoy</h4>
                <button id="cash-out-button" onclick="onCashOutClick()" type="button" class="btn btn-success" style="margin-bottom: 17px;">CASH OUT</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
	var isLoading = false;
	function onCashOutClick(){
		if(!isLoading){
			var robloxUsername = $("#roblox-username-input").val();
			if(robloxUsername == ""){
				isLoading = false;
				showModal("No Roblox Username", "Please type in your Roblox username.");
				return;
			}
			isLoading = true;
			$("#cash-out-button").html("PROCESSING...");
			var amount = 10;
			if($("#radio10").is(":checked")) amount = 10;
			if($("#radio25").is(":checked")) amount = 25;
			if($("#radio50").is(":checked")) amount = 50;
			if($("#radio100").is(":checked")) amount = 100;
			if($("#radio250").is(":checked")) amount = 250;
			
			var uid = <?php echo $_SESSION['userLoggedIn']?>;
			$.post("includes/ajax/execute_payment.php", {userId: uid, amount: amount, robloxUsername: robloxUsername}, function(result){
				//alert(result);
				//0 = Success
				//1 = User Not Found
				//2 = Failed
				//4 - User Not In Payout Group
				//5 - Insufficient Funds
				//6 - Out of Stock
				$("#cash-out-button").html("CASH OUT");
				if(result == 0){
          window.location.href = "withdraw-successful.php";
				}else if(result == 1){
					showModal("User Not Found", "Sorry we couldn't find the specified user. Please check your Robux username.");
				}else if(result == 2){
					showModal("Something Went Wrong", "Something went wrong while Sending your Robux, please try again or contact support@flashrobux.com if the problem persists.");
				}else if(result == 4){
					showModal("User Not In Payout Group", "It appears that this User is not in our Payout Group - please join our Payout Group by clicking 'Join Group'");
				}else if(result == 5){
					showModal("Insufficient Funds", "Unfortunately you do not have enough Robux in your account to withdraw this amount. Complete Offers to Earn more Robux.");
				}else if(result == 6){
					showModal("Out of Stock", "There are currently not enough Robux in stock. Please Try Again Later.");
				}
				isLoading = false;
			});
		}
	}
</script>
<?php include("includes/footer.php")?>