<?php include("includes/admin-header.php")?>
<div style="min-height: 85vh;">
<div class="row" style="margin-left: 20px; margin-top: 32px; margin-right: 20px;">
<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header card-header-warning" style="background: linear-gradient(60deg, #4CAF50, #66BB6A) !important">
      <h4 class="card-title">Earning History</h4>
      <p class="card-category">Sorted By Date - Last 100 Completed Offers</p>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover">
        <thead class="text-warning" style="color: #4CAF50 !important">
        <th>#</th>
          <th>Offerwall</th>
          <th>Username</th>
          <th>Points Earned</th>
          <th>Admin Payout</th>
          <th>Date</th>
        </thead>
        <tbody>
        <?php
            $historyQuery = mysqli_query($sqlConnection, "SELECT * FROM earnings_history ORDER BY earnedDate DESC LIMIT 0, 100");
            $position = 0;
            while($row = mysqli_fetch_array($historyQuery)){
              $position++;
              $offerwallName = $row['offerwallName'];
              $earnUserId = $row['userId'];
              $earnId = $row['id'];

              $usernameQuery = mysqli_query($sqlConnection, "SELECT username FROM users WHERE id='$earnUserId'");
              $adminPayoutQuery = mysqli_query($sqlConnection, "SELECT amount FROM admin_earnings WHERE earnId='$earnId'");
            
              $username = mysqli_fetch_array($usernameQuery)['username'];
              $payout = mysqli_fetch_array($adminPayoutQuery)['amount'];
              $amount = $row['amountEarned'];
              $date = date_create($row['earnedDate']);
              $earnedDate = date_format($date,"Y-m-d");
              echo "<tr>
                      <td>$position</td>
                      <td>$offerwallName</td>
                      <td><a href='admin-view-user.php?id=$earnUserId'>$username</a></td>
                      <td>R$ $amount</td>
                      <td>$ $payout</td>
                      <td>$earnedDate</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
          </div>
<?php include("includes/footer.php")?>