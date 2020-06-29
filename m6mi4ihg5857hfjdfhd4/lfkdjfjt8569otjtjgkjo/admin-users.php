<?php include("includes/admin-header.php")?>
<div style="min-height: 85vh;">
  <div class="row" style="margin-left: 20px; margin-top: 32px; margin-right: 20px;">
    <div class="col-lg-12 col-md-12">
      <div class="card admin-search-card">
        <input type="text" id="search-input" name="search-input" placeholder="Search Username">
      </div>
      <div class="col-lg-12 col-md-12 text-center">
          <button id="save-changes-button" onclick="executeSearch()" type="button" class="btn btn-success" style="margin-bottom: 17px;width: 164px;">SEARCH</button>
      </div>
    </div>
  </div>
  <div class="row" style="margin-left: 20px; margin-top: 32px; margin-right: 20px;">
<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header card-header-warning" style="background: linear-gradient(60deg, #4CAF50, #66BB6A) !important">
      <h4 class="card-title">Latest Users</h4>
      <p class="card-category">Sorted By Date - Newest 50 Users</p>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover">
        <thead class="text-warning" style="color: #4CAF50 !important">
          <th>#</th>
          <th>Username</th>
          <th>Email</th>
          <th>Date</th>
        </thead>
        <tbody>
        <?php
            $historyQuery = mysqli_query($sqlConnection, "SELECT * FROM users ORDER BY signupDate DESC LIMIT 0, 50");
            $position = 0;
            while($row = mysqli_fetch_array($historyQuery)){
              $position++;
              $email = $row['email'];
              $username = $row['username'];
              $userId = $row['id'];
              $date = date_create($row['signupDate']);
              $signupDate = date_format($date,"Y-m-d");
              echo "<tr>
                      <td>$position</td>
                      <td><a href='admin-view-user.php?id=$userId'>$username</a></td>
                      <td>$email</td>
                      <td>$signupDate</td>
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
<script>
  function executeSearch(){
    var searchTerm = $("#search-input").val();
    window.location.href = "admin-search.php?q="+encodeURIComponent(searchTerm);
  }
</script>
<?php include("includes/footer.php")?>