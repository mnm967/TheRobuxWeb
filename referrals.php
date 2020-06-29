<?php include("includes/header.php")?>
<div style="min-height: 85vh;">
<div class="row" style="margin-left: 20px; margin-right: 20px;">
  <div class="card card-nav-tabs text-center" style="margin-bottom: 0;">
    <div class="card-body">
      <h3 class="card-title" style="color: #4CAF50;">My Referral Link:</h3>
      <h4 class="card-text" style="color: #4CAF50;" id="link-text">https://www.therobux.com/register.php?rid=<?php echo $_SESSION['userLoggedIn']?></h4>
      <a href="#0" class="btn btn-primary" style="background: #4CAF50 !important" id="copy-button">Select Link</a>
    </div>
  </div>
</div>
<div class="row" style="margin-left: 20px; margin-right: 20px;">
  <div class="card card-nav-tabs text-center" style="margin-bottom: 0; padding-bottom: 16px">
    <div class="card-body">
    <div class="row">
    <div class="col-md-4">
        <img class="material-icons" style="display: block; width: 100%; height: 124px; margin-bottom: 16px; margin-top: 16px;" src="assets/img/icons/teamwork.svg"/>
        <h3 class="card-title" style="color: #4CAF50;">Step 1:</h3>
        <h4 class="card-text" style="color: #4CAF50;">Invite your friends to Sign Up using the link above</h4>
      </div>
      <div class="col-md-4">
        <img class="material-icons" style="display: block; width: 100%; height: 124px; margin-bottom: 16px; margin-top: 16px;" src="assets/img/icons/get-money.svg"/>
        <h3 class="card-title" style="color: #4CAF50;">Step 2:</h3>
        <h4 class="card-text" style="color: #4CAF50;">Once someone signed up on our website using your referral link and completes an offer you will receive your Robux points here, then you can go to Withdraw page to claim your points</h4>
      </div>
      <div class="col-md-4">
        <img class="material-icons" style="display: block; width: 100%; height: 124px; margin-bottom: 16px; margin-top: 16px;" src="assets/img/icons/joystick.svg"/>
        <h3 class="card-title" style="color: #4CAF50;">Step 3:</h3>
        <h4 class="card-text" style="color: #4CAF50;">Enjoy buying cool items using the free robux you received!</h4>
      </div>
    </div>
    </div>
  </div>
</div>
</div>
<script>
  function selectText(node) {
    node = document.getElementById(node);

    if (document.body.createTextRange) {
        const range = document.body.createTextRange();
        range.moveToElementText(node);
        range.select();
    } else if (window.getSelection) {
        const selection = window.getSelection();
        const range = document.createRange();
        range.selectNodeContents(node);
        selection.removeAllRanges();
        selection.addRange(range);
    } else {
        console.warn("Could not select text in node: Unsupported browser.");
    }
  }

  const clickable = document.querySelector('#copy-button');
  clickable.addEventListener('click', () => selectText('link-text'))
</script>
<?php include("includes/footer.php")?>