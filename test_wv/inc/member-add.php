<?php
$first_name = "";
$last_name  = "";
$email      = "";

if ( $_POST ) {

  $first_name = trim( $_POST['first_name'] );
  $last_name  = trim( $_POST['last_name'] );
  $email      = trim( $_POST['email'] );

  $error = array();

  if ( empty( $first_name ) ) {
    $error['first_name'] = 'First name must not be blank.';
  }
  if ( empty( $last_name ) ) {
    $error['last_name'] = 'Last name must not be blank.';
  }
  if ( empty( $email ) ) {
    $error['email'] = 'Email must not be blank.';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Invalid email format";
  }

  // Check if email already exist
  $db->query('SELECT email FROM members WHERE email = :email');
  $db->bind(':email', $email);

  $db->execute();

  if( $db->rowCount() > 0 ) {
    $error['email'] = "Sorry, that email is taken";
  }

  // If there are no errors proceed with data insert
  if ( empty( $error ) ) {

    $db->query( 'INSERT INTO members (first_name,last_name,email) VALUES(:first_name,:last_name,:email)' );

    $db->bind( ':first_name', $first_name );
    $db->bind( ':last_name', $last_name );
    $db->bind( ':email', $email );

    $db->execute();

    if ( $db->lastInsertID() ) {
      $success = 'Successfully added a new member!';

      // Reset form data
      $first_name = "";
      $last_name  = "";
      $email      = "";
    } else {
      $error['error'] = 'Something went wrong.';
    }

  }

}
?>
<div class="col-md-6">
  <h3>Create new member</h3>
  <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  </p>
</div>

<div class="well bs-component col-md-6">
  <form action="" method="post" class="form-horizontal">
    <fieldset>
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
          <?php if ( !empty( $error['first_name'] ) ) : ?>
            <div class="has-error">
              <label for="inputFirst" class="control-label"><?php echo $error['first_name']; ?></label>
              <input name="first_name" type="text" class="form-control" id="inputFirst">
            </div>
          <?php else : ?>
            <label for="inputFirst" class="control-label">First Name</label>
            <input name="first_name" type="text" class="form-control" id="inputFirst" value="<?php echo $first_name; ?>">
          <?php endif; ?>

        </div>
        <div class="col-lg-12">

          <!-- If has error, show error message -->
          <?php if ( !empty( $error['last_name'] ) ) : ?>
            <div class="has-error">
              <label for="inputLast" class="control-label"><?php echo $error['last_name']; ?></label>
              <input name="last_name" type="text" class="form-control" id="inputLast">
            </div>
          <?php else : ?>
            <label for="inputLast" class="control-label">Last Name</label>
            <input name="last_name" type="text" class="form-control" id="inputLast" value="<?php echo $last_name; ?>">
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
      </div>

      <div class="form-group">
        <div class="col-lg-12 text-right">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </fieldset>
  </form>
</div>
