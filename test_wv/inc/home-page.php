<?php
if ( isset( $_SESSION['logged_in'] ) ) {
  // check if user is logged in - redirect to home if not
  header( "Location: " . baseUrl() . '?page=admin' );

  exit;
}
?>

<div class="row">
  <div class="col-md-8">
    <h1>Welcome</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
  </div>

  <!-- ********** START SIGN-UP FORM ********** -->
  <div class="col-md-4">
    <?php require "signup.php"; ?>
  </div>
  <!-- ********** END SIGN-UP FORM ********** -->
</div>
