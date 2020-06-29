
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

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else{
    $page = 1;
  }

  $usernameQuery = mysqli_query($sqlConnection, "SELECT username FROM users WHERE id='$uid'");
  $username = mysqli_fetch_array($usernameQuery)['username'];

  $maxPageQuery = mysqli_query($sqlConnection, "SELECT COUNT(*) FROM withdrawls WHERE userId='$uid'");

  $itemsPerPage = 50;
  $offset = ($page - 1) * $itemsPerPage;
  $total_rows = mysqli_fetch_array($maxPageQuery)[0];
  $total_pages = ceil($total_rows/$itemsPerPage);
?>
<div style="min-height: 85vh;">
<div class="row" style="margin-left: 20px; margin-top: 32px; margin-right: 20px;">
<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header card-header-warning" style="background: linear-gradient(60deg, #4CAF50, #66BB6A) !important">
      <h4 class="card-title">Withdrawls - <?php echo $username?></h4>
      <p class="card-category">Sorted By Date</p>
    </div>
    <div class="card-body table-responsive">
      <table class="table table-hover">
        <thead class="text-warning" style="color: #4CAF50 !important">
          <th>Roblox Username</th>
          <th>Username</th>
          <th>Robux Withdrawn</th>
          <th>Date</th>
        </thead>
        <tbody>
        <?php
            $historyQuery = mysqli_query($sqlConnection, "SELECT * FROM withdrawls WHERE userId='$uid' ORDER BY date DESC LIMIT $offset, $itemsPerPage");
            while($row = mysqli_fetch_array($historyQuery)){
              $robloxUsername = $row['robuxUsername'];
              $uid = $row['userId'];
              
              $amount = $row['amount'];
              $date = date_create($row['date']);
              $finalDate = date_format($date,"Y-m-d");
              echo "<tr>
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

<div class="row justify-content-center" style="width:100%; margin-left: 20px; margin-top: 32px; margin-right: 20px;">
  <a href="admin-user-earnings.php?id=<?php echo $uid;?>&page=<?php $prevPage = $page - 1; echo $prevPage;?>" style="<?php if($page == 1 || $total_pages < 2) echo 'display: none;'?>"><button id="save-changes-button" type="button" class="btn btn-success" style="margin-bottom: 17px; width: 164px;">< PREVIOUS</button></a>
  <a href="admin-user-earnings.php?id=<?php echo $uid;?>&page=<?php $nextPage = $page + 1; echo $nextPage;?>" style="<?php if($page == $total_pages || $total_pages < 2) echo 'display: none;'?>"><button id="save-changes-button" type="button" class="btn btn-success" style="margin-bottom: 17px;width: 164px;">NEXT ></button></a>
</div>

</div>
          </div>
<?php include("includes/footer.php")?>