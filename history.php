<?php include("includes/header.php")?>
<div style="min-height: 85vh;">
<div class="row" style="margin-left: 20px; margin-top: 32px; margin-right: 20px;">
<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header card-header-warning" style="background: linear-gradient(60deg, #4CAF50, #66BB6A) !important">
      <h4 class="card-title">Earning History</h4>
      <p class="card-category">Sorted By Date - Last 100 Offers</p>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover">
        <thead class="text-warning" style="color: #4CAF50 !important">
          <th>#</th>
          <th>Offerwall</th>
          <th>Points Earned</th>
          <th>Date</th>
        </thead>
        <tbody>
        <?php
            $userId = $_SESSION['userLoggedIn'];
            $historyQuery = mysqli_query($sqlConnection, "SELECT * FROM earnings_history WHERE userId='$userId' ORDER BY earnedDate DESC LIMIT 0, 100");
            $position = 0;
            while($row = mysqli_fetch_array($historyQuery)){
              $position++;
              $offerwallName = $row['offerwallName'];
              $amount = $row['amountEarned'];
              $date = date_create($row['earnedDate']);
              $earnedDate = date_format($date,"Y-m-d");
              echo "<tr>
                      <td>$position</td>
                      <td>$offerwallName</td>
                      <td>R$ $amount</td>
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