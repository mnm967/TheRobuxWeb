<?php include("includes/header.php")?>
<div style="min-height: 85vh;">
<div class="row" style="margin-left: 20px; margin-top: 32px; margin-right: 20px; min-height: 85vh;">
<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header card-header-warning" style="background: linear-gradient(60deg, #4CAF50, #66BB6A) !important">
      <h4 class="card-title">Leaderboard</h4>
      <p class="card-category">Ranked by the Amount of Points Earned - Top 100</p>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover">
        <thead class="text-warning" style="color: #4CAF50 !important">
          <th>#</th>
          <th>Username</th>
          <th>Points Earned</th>
        </thead>
        <tbody>
          <?php 
            $leaderboardQuery = mysqli_query($sqlConnection, "SELECT * FROM users ORDER BY totalPointsEarned DESC LIMIT 0, 100");
            $position = 0;
            while($row = mysqli_fetch_array($leaderboardQuery)){
              $position++;
              $username = $row['username'];
              $amount = $row['totalPointsEarned'];
              echo "<tr>
                      <td>$position</td>
                      <td>$username</td>
                      <td>R$ $amount</td>
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