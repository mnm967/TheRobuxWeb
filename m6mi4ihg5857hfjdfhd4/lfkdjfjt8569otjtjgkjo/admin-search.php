<?php include("includes/admin-header.php")?>
<?php 
  if(isset($_GET['q'])){
    $searchTerm = urldecode($_GET['q']);
    if(empty($searchTerm)){
      header("Location: admin-users.php");
    }
  }else{
    header("Location: admin-users.php");
  }
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $maxPageQuery = mysqli_query($sqlConnection, "SELECT COUNT(*) FROM users WHERE username LIKE '%$searchTerm%'");

  $itemsPerPage = 50;
  $offset = ($page - 1) * $itemsPerPage;
  $total_rows = mysqli_fetch_array($maxPageQuery)[0];
  $total_pages = ceil($total_rows/$itemsPerPage);
?>
<div style="min-height: 85vh;">
  <div class="row justify-content-center" style="margin-left: 20px; margin-top: 32px; margin-right: 20px;">
    <div class="col-lg-12 col-md-12">
      <div class="card admin-search-card">
          <input type="text" id="search-input" name="search-input" placeholder="Search Username" value="<?php echo $searchTerm?>">
        </div>
      </div>
    <div class="col-lg-12 col-md-12 text-center">
        <button id="save-changes-button" onclick="executeSearch()" type="button" class="btn btn-success" style="margin-bottom: 17px;width: 164px;">SEARCH</button>
    </div>
  </div>
<div class="row" style="margin-left: 20px; margin-top: 32px; margin-right: 20px;">
  <div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header card-header-warning" style="background: linear-gradient(60deg, #4CAF50, #66BB6A) !important">
      <h4 class="card-title">Total Results: <?php echo $total_rows; ?></h4>
      <p class="card-category">Page: <?php echo $page;?></p>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover">
        <thead class="text-warning" style="color: #4CAF50 !important">
          <th>Username</th>
          <th>Email</th>
          <th>Date</th>
        </thead>
        <tbody>
        <?php
            $searchQuery = mysqli_query($sqlConnection, "SELECT * FROM users WHERE username LIKE '%$searchTerm%' LIMIT $offset, $itemsPerPage");
            while($row = mysqli_fetch_array($searchQuery)){
              $email = $row['email'];
              $username = $row['username'];
              $userId = $row['id'];
              $date = date_create($row['signupDate']);
              $signupDate = date_format($date,"Y-m-d");
              echo "<tr>
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

<div class="row justify-content-center" style="width:100%; margin-left: 20px; margin-top: 32px; margin-right: 20px;">
  <a href="admin-search.php?q=<?php echo $searchTerm;?>&page=<?php $prevPage = $page - 1; echo $prevPage;?>" style="<?php if($page == 1 || $total_pages < 2) echo 'display: none;'?>"><button id="save-changes-button" type="button" class="btn btn-success" style="margin-bottom: 17px; width: 164px;">< PREVIOUS</button></a>
  <a href="admin-search.php?q=<?php echo $searchTerm;?>&page=<?php $nextPage = $page + 1; echo $nextPage;?>" style="<?php if($page == $total_pages || $total_pages < 2) echo 'display: none;'?>"><button id="save-changes-button" type="button" class="btn btn-success" style="margin-bottom: 17px;width: 164px;">NEXT ></button></a>
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