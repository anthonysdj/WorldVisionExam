<?php
$user_name = "";
$password  = "";
$email      = "";

if ( $_POST ) {

  $user_name = trim( $_POST['user_name'] );
  $password  = trim( $_POST['password'] );
  $email     = trim( $_POST['email'] );

  $error = array();

  if ( empty( $user_name ) ) {
    $error['user_name'] = 'User name must not be blank.';
  }
  if ( empty( $password ) ) {
    $error['password'] = 'Password must not be blank.';
  }
  if ( empty( $email ) ) {
    $error['email'] = 'Email must not be blank.';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Invalid email format";
  }

  // Check if user already exist
  $db->query( 'SELECT user_name FROM users WHERE user_name = :user_name' );
  $db->bind( ':user_name', $user_name );

  $db->execute();

  if( $db->rowCount() > 0 ) {
    $error['user_name'] = "Sorry, that username is taken";
  }

  // Check if email already exist
  $db->query( 'SELECT email FROM users WHERE email = :email' );
  $db->bind( ':email', $email );

  $db->execute();

  if( $db->rowCount() > 0 ) {
    $error['email'] = "Sorry, that email is taken";
  }

  // If there are no errors proceed with data insert
  if ( empty( $error ) ) {

    // encrypt password
    $enc_password = password_hash( $password, PASSWORD_DEFAULT );

    $db->query( 'INSERT INTO users (user_name,password,email) VALUES(:user_name,:password,:email)' );

    $db->bind( ':user_name', $user_name );
    $db->bind( ':password', $enc_password );
    $db->bind( ':email', $email );

    $db->execute();

    if ( $db->lastInsertID() ) {
      $success = 'Registration success!';

      // Reset form data
      $user_name = "";
      $password  = "";
      $email     = "";
    } else {
      $error['error'] = 'Something went wrong.';
    }

  }

}
?>
<div class="well bs-component">
  <form action="" method="post" class="form-horizontal">
    <fieldset>
      <legend>Admin Registration Form</legend>

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

          <!-- If has error, show error message -->
          <?php if ( !empty( $error['user_name'] ) ) : ?>
            <div class="has-error">
              <label for="inputUsername" class="control-label"><?php echo $error['user_name']; ?></label>
              <input name="user_name" type="text" class="form-control" id="inputUsername" value="<?php echo $user_name; ?>">
            </div>
          <?php else : ?>
            <label for="inputUsername" class="control-label">User Name</label>
            <input name="user_name" type="text" class="form-control" id="inputUsername" value="<?php echo $user_name; ?>">
          <?php endif; ?>

        </div>

        <div class="col-lg-12">

          <!-- If has error, show error message -->
          <?php if ( !empty( $error['email'] ) ) : ?>
            <div class="has-error">
              <label for="inputEmail" class="control-label"><?php echo $error['email']; ?></label>
              <input name="email" type="text" class="form-control" id="inputEmail" value="<?php echo $email; ?>">
            </div>
          <?php else : ?>
            <label for="inputEmail" class="control-label">Email</label>
            <input name="email" type="text" class="form-control" id="inputEmail" value="<?php echo $email; ?>">
          <?php endif; ?>

        </div>

        <div class="col-lg-12">

          <!-- If has error, show error message -->
          <?php if ( !empty( $error['password'] ) ) : ?>
            <div class="has-error">
              <label for="inputPassword" class="control-label"><?php echo $error['password']; ?></label>
              <input name="password" type="password" class="form-control" id="inputPassword">
            </div>
          <?php else : ?>
            <label for="inputPassword" class="control-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPassword">
          <?php endif; ?>

        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-8">
          <p>
            <small>Have an account? Login <a href="<?php echo baseUrl() . '?page=admin&form=admin_signin'; ?>">here.</a></small>
          </p>
        </div>
        <div class="col-lg-4 text-right">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </div>
    </fieldset>
  </form>
</div>
