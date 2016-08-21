<?php
$id = $_GET['id'];

$db->query( "SELECT * FROM members WHERE id = :id" );
$db->bind( ':id', $id );

$row = $db->single();

$first_name = $row['first_name'];
$last_name  = $row['last_name'];
$email      = $row['email'];
$id         = $row['id'];

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

  // Check if current user's email
  $db->query( 'SELECT email FROM members WHERE email = :email AND id = :id' );
  $db->bind( ':email', $email );
  $db->bind( ':id', $id );

  $db->execute();

  if ( $db->rowCount() === 0 ) {
    // Check if email exist
    $db->query('SELECT email FROM members WHERE email = :email');
    $db->bind(':email', $email);

    $db->execute();

    if ( $db->rowCount() > 0 ) {
      $error['email'] = "Sorry, that email is taken";
    }
  }

  // If there are no errors proceed with data update
  if ( empty( $error ) ) {
    $db->query( "UPDATE members
                 SET first_name = :first_name,
                     last_name = :last_name,
                     email = :email
                 WHERE id = :id" );

    $db->bind( ':first_name', $first_name );
    $db->bind( ':last_name', $last_name );
    $db->bind( ':email', $email );
    $db->bind( ':id', $id );

    $db->execute();

    if ( $db->rowCount() > 0 ) {
      $success = 'Successfully updated a member!';
    } else {
      $error['error'] = 'No changes have been made';
    }

  }

}
?>

<div class="well bs-component col-md-6 col-md-offset-6">
  <form action="" method="post" class="form-horizontal">
    <fieldset>
      <legend>Update existing member</legend>

      <!-- If signup success display success message -->
      <?php if ( isset( $success ) ) : ?>
        <p class="alert alert-success"><?php echo $success; ?></p>
      <?php  endif; ?>

      <!-- If signup error display error message -->
      <?php if ( isset( $error['error'] ) ) : ?>
        <p class="alert alert-warning"><?php echo $error['error']; ?></p>
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
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </fieldset>
  </form>
</div>
