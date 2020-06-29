<?php include("includes/admin-header.php")?>
<?php 
    $availabilityQuery = mysqli_query($sqlConnection, "SELECT * FROM config WHERE id='1'");
    $row = mysqli_fetch_array($availabilityQuery);
    $isAdgateAvailable = $row['isAdgateAvailable'] == 1;
    $isOffertoroAvailable = $row['isOffertoroAvailable'] == 1;
    $isWannadsAvailable = $row['isWannadsAvailable'] == 1;
    $isOffertoroAltAvailable = $row['isOffertoroAltAvailable'] == 1;
?>
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
            <h3 class="card-title" style="color: #4CAF50;">Total Admin Earnings</h3>
            <h3 class="card-text"  style="color: #4CAF50;"><?php
                    $totalQuery = mysqli_query($sqlConnection, "SELECT SUM(amount) AS totalEarned FROM admin_earnings");
                    $totalAmount = mysqli_fetch_array($totalQuery)['totalEarned'];
                    echo "$ " . number_format($totalAmount, 2, ".", " ");
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
            <h3 class="card-title" style="color: #4CAF50;">Current Robux Stock</h3>
            <h3 class="card-text"  style="color: #4CAF50;"><?php
                    $userId = $_SESSION['adminLoggedIn'];
                    $currentQuery = mysqli_query($sqlConnection, "SELECT currentRobuxStock FROM config WHERE id='1'");
                    $currentAmount = mysqli_fetch_array($currentQuery)['currentRobuxStock'];
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
            <h3 class="card-title" style="color: #4CAF50;">Offers Completed By Users</h3>
            <h3 class="card-text"  style="color: #4CAF50;"><?php
                    $offersCompletedQuery = mysqli_query($sqlConnection, "SELECT SUM(totalOffersCompleted) AS totalOffers FROM users");
                    $offersCompletedAmount = mysqli_fetch_array($offersCompletedQuery)['totalOffers'];
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
                <h3 class="card-title" style="color: #4caf50;">Update Settings</h3>
                <h4 class="card-subtitle mb-2" style="color: #4caf50;">Group ID:</h4>
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-static">Enter Group ID (Number)</label>
                  <input type="text" id="roblox-groupid-input" class="form-control" placeholder="Your Group ID Here (Number)" value="<?php
                    $userId = $_SESSION['adminLoggedIn'];
                    $currentQuery = mysqli_query($sqlConnection, "SELECT robuxGroupId FROM config WHERE id='1'");
                    $currentAmount = mysqli_fetch_array($currentQuery)['robuxGroupId'];
                    echo $currentAmount;
                ?>">
                </div>
                <h4 class="card-subtitle mb-2" style="color: #4caf50;">Cookie:</h4>
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-static">Enter Cookie</label>
                  <input type="text" id="roblox-cookie-input" class="form-control" placeholder="Your Cookie Here" value="<?php
                    $userId = $_SESSION['adminLoggedIn'];
                    $currentQuery = mysqli_query($sqlConnection, "SELECT cookie FROM config WHERE id='1'");
                    $currentAmount = mysqli_fetch_array($currentQuery)['cookie'];
                    echo $currentAmount;
                ?>">
                </div>
                <h4 class="card-subtitle mb-2" style="color: #4caf50;">Current Robux Stock:</h4>
                <div class="form-group bmd-form-group">
                  <label class="bmd-label-static">Enter Current Robux Stock (Number)</label>
                  <input type="text" id="roblox-currentstock-input" class="form-control" placeholder="Your Stock Here (Number)" value="<?php
                    $userId = $_SESSION['adminLoggedIn'];
                    $currentQuery = mysqli_query($sqlConnection, "SELECT currentRobuxStock FROM config WHERE id='1'");
                    $currentAmount = mysqli_fetch_array($currentQuery)['currentRobuxStock'];
                    echo $currentAmount;
                ?>">
                </div>
                <h4 class="card-subtitle mb-2" style="color: #4caf50;">Visible Offerwalls:</h4>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" id="adgate-checkbox" type="checkbox" value="" <?php if($isAdgateAvailable) echo 'checked';?>>
                        Adgate Media
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" id="offertoro-checkbox" type="checkbox" value="" <?php if($isOffertoroAvailable) echo 'checked';?>>
                        Offertoro
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" id="wannads-checkbox" type="checkbox" value="" <?php if($isWannadsAvailable) echo 'checked';?>>
                        Wannads
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" id="offertoro-alt-checkbox" type="checkbox" value="" <?php if($isOffertoroAltAvailable) echo 'checked';?>>
                        Offertoro 2
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>

                <h4 class="card-subtitle mb-2" style="color: #4caf50; margin-top: 1.5rem !important;">Save Changes</h4>
                <button id="save-changes-button" onclick="onSaveClick()" type="button" class="btn btn-success" style="margin-bottom: 17px;">SAVE CHANGES</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
	var isLoading = false;
	function onSaveClick(){
		if(!isLoading){
			var robloxGroupId = $("#roblox-groupid-input").val();
			var robloxCookie = $("#roblox-cookie-input").val();
			var robloxCurrentStock = $("#roblox-currentstock-input").val();
			if(robloxGroupId == "" || robloxCookie == "" || robloxCurrentStock == ""){
				isLoading = false;
				showModal("Fill In All Fields", "Ensure all fields are filled in.");
				return;
			}
			isLoading = true;
			$("#save-changes-button").html("PROCESSING...");

      var isAdgateAvailable = $("#adgate-checkbox").prop("checked") ? 1:0;
      var isOffertoroAvailable = $("#offertoro-checkbox").prop("checked") ? 1:0;
      var isWannadsAvailable = $("#wannads-checkbox").prop("checked") ? 1:0;
      var isOffertoroAltAvailable = $("#offertoro-alt-checkbox").prop("checked") ? 1:0;

			$.post("includes/ajax/update_admin_settings.php", {robloxGroupId: robloxGroupId, 
      robloxCookie: robloxCookie, 
      isAdgateAvailable: isAdgateAvailable, 
      isOffertoroAvailable: isOffertoroAvailable, 
      isWannadsAvailable: isWannadsAvailable, 
      isOffertoroAltAvailable: isOffertoroAltAvailable, 
      robloxCurrentStock: robloxCurrentStock}, function(result){
				$("#save-changes-button").html("SAVE CHANGES");
				if(result == 0){
          window.location.href = "admin-changes-successful.php";
				}else if(result == 1){
          showModal("Something Went Wrong", "Something Went Wrong. Please Try Again.");
        }
				isLoading = false;
			});
		}
	}
</script>
<?php include("includes/footer.php")?>