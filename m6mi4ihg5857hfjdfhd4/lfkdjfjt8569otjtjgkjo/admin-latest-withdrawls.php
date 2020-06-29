<?php include("includes/admin-header.php")?>
<div style="min-height: 85vh;">
<div class="row" style="margin-left: 20px; margin-top: 32px; margin-right: 20px;">
<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header card-header-warning" style="background: linear-gradient(60deg, #4CAF50, #66BB6A) !important">
      <h4 class="card-title">Wthdrawl History</h4>
      <p class="card-category">Sorted By Date - Last 100 Withdrawls</p>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover">
        <thead class="text-warning" style="color: #4CAF50 !important">
          <th>#</th>
          <th>Roblox Username</th>
          <th>Username</th>
          <th>Robux Withdrawn</th>
          <th>Date</th>
        </thead>
        <tbody>
        <?php
            $historyQuery = mysqli_query($sqlConnection, "SELECT * FROM withdrawls ORDER BY date ASC LIMIT 0, 100");
            $position = 0;
            while($row = mysqli_fetch_array($historyQuery)){
              $position++;
              $robloxUsername = $row['robuxUsername'];
              $uid = $row['userId'];

              $usernameQuery = mysqli_query($sqlConnection, "SELECT username FROM users WHERE id='$uid'");
              $username = mysqli_fetch_array($usernameQuery)['username'];
              
              $amount = $row['amount'];
              $date = date_create($row['date']);
              $finalDate = date_format($date,"Y-m-d");
              echo "<tr>
                      <td>$position</td>
                      <td>$robloxUsername</td>
                      <td><a href='admin-view-user.php?id=$uid'>$username</a></td>
                      <td>R$ $amount</td>
                      <td>$finalDate</td>
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