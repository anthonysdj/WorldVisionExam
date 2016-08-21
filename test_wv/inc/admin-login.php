<?php
$user_name = "";
$password  = "";

if ( $_POST ) {

  $user_name = trim( $_POST['user_name'] );
  $password  = trim( $_POST['password'] );

  $error = array();

  // If there are no errors, login the user
  if ( empty( $error ) ) {

    //Query
    $db->query( "SELECT * FROM users WHERE user_name = :user_name OR email = :user_name" );
    $db->bind( ':user_name', $user_name );

    $row = $db->single();
    $count = count( $row );

    if( $count > 0 && password_verify( $password, $row['password'] ) ) {
      //Assign session variables
      $_SESSION['user_name']  = $row['user_name'];
      $_SESSION['logged_in'] = 1;

      session_regenerate_id();

      header( "Location: " . baseUrl() );
      exit;
    } else {
      $error['error'] = 'Invalid username or password';
    }

  }

}
?>
<div class="well bs-component">
  <form action="" method="post" class="form-horizontal">
    <fieldset>
      <legend>Admin Login Form</legend>

      <!-- If signup success display success message -->
      <?php if ( isset( $success ) ) : ?>
        <p class="alert alert-success"><?php echo $success; ?></p>
      <?php  endif; ?>

      <!-- If signup error display error message -->
      <?php if ( isset( $error['error'] ) ) : ?>
        <p class="alert alert-danger"><?php echo $error['error']; ?></p>
      <?php  endif; ?>

      <div class="form-group">
        <div class="col-lg-12">
          <label for="inputUsername" class="control-label">User Name or Email</label>
          <input name="user_name" type="text" class="form-control" id="inputUsername" value="<?php echo $user_name; ?>">
        </div>

        <div class="col-lg-12">
          <label for="inputPassword" class="control-label">Password</label>
          <input name="password" type="password" class="form-control" id="inputPassword">
        </div>
      </div><!-- .form-group -->

      <div class="form-group">
        <div class="col-lg-8">
          <p>
            <small>Need an account? Register <a href="<?php echo baseUrl() . '?page=admin&form=admin_register'; ?>">here.</a></small>
          </p>
        </div>
        <div class="col-lg-4 text-right">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </div>
    </fieldset>
  </form>
</div>
