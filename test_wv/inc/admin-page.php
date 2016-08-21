<?php
// Logout
if ( isset( $_POST['logout'] ) ) {
  if( isset( $_SESSION['user_name'] ) )
      unset( $_SESSION['user_name'] );
  if( isset( $_SESSION['logged_in'] ) )
      unset( $_SESSION['logged_in'] );
  session_destroy();

  header( "Location: " . baseUrl() );
  exit;
}
?>

<?php if ( isset( $_SESSION['logged_in'] ) ) : ?>
  <div class="row">

    <div class="col-md-4">
      <h3>Hello Admin <?php echo ucfirst( $_SESSION['user_name'] ); ?></h3>
      <form action="" method="post" class="form-group">
        <button name="logout" type="submit" class="btn btn-primary btn-xs">Logout</button>
      </form>
    </div>

    <div class="col-md-8">
      <div class="bs-component">
        <ul class="nav nav-pills navbar-right">
          <li><a href="#">Settings <span class="badge">7</span></a></li>
          <li><a href="#">Profile <span class="badge"></span></a></li>
          <li><a href="#">Messages <span class="badge">3</span></a></li>
        </ul>
      </div>
    </div>

  </div>

  <hr />
<?php endif; ?>

<div class="row">
  <?php if ( isset( $_SESSION['logged_in'] ) ) : ?>
    <div class="col-md-4">
      <div class="list-group table-of-contents">
        <a class="list-group-item" href="<?php echo baseUrl() . '?page=admin'; ?>">Home</a>
        <a class="list-group-item" href="<?php echo baseUrl() . '?page=admin&form=member_add'; ?>">Add members</a>
        <a class="list-group-item" href="<?php echo baseUrl() . '?page=admin&form=member_list'; ?>">List members</a>
        <a class="list-group-item" href="<?php echo baseUrl() . '?page=admin&form=export'; ?>">Export to CSV</a>
      </div>
    </div>
  <?php endif; ?>

  <div class="col-md-8">
    <?php
    if ( isset( $_SESSION['logged_in'] ) && isset( $_GET['form'] ) ) {
      if ( $_GET['form'] === 'member_add' ) {
        require "member-add.php";
      } else if ( $_GET['form'] === 'member_list' ) {
        require "member-list.php";
      } else if ( $_GET['form'] === 'member_update' ) {
        require "member-update.php";
      } else if ( $_GET['form'] === 'export' ) {
        require "export-form.php";
      }
    } else {
    ?>
    <h1>Admin page</h1>
    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
    <?php } ?>
  </div>

  <!-- ********** START SIGN-UP FORM ********** -->
  <?php if ( !isset( $_SESSION['logged_in'] ) ) : ?>
    <div class="col-md-4">
      <?php
      if ( isset( $_GET['page'] ) && isset( $_GET['form'] ) ) {
        if ( $_GET['page'] === 'admin' && $_GET['form'] === 'admin_register' )
          require "admin-register.php";
        if ( $_GET['page'] === 'admin' && $_GET['form'] === 'admin_signin' )
          require "admin-login.php";
      }
      ?>
    </div>
  <?php endif; ?>
  <!-- ********** END SIGN-UP FORM ********** -->

</div><!-- ***** END .row ***** -->
