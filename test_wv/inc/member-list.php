<?php

$db->query( "SELECT * FROM members" );

$rows = $db->resultset();

if ( isset( $_POST['delete'] ) ) {
  require "member-delete.php";
}

?>

<!-- If signup success display success message -->
<?php if ( isset( $_GET['success_delete'] ) ) : ?>
  <p class="alert alert-success">Delete success!</p>
<?php  endif; ?>

<!-- If signup error display error message -->
<?php if ( isset( $_GET['error_delete'] ) ) : ?>
  <p class="alert alert-danger">Something went wrong :(</p>
<?php  endif; ?>

<?php if ( count( $rows > 0 ) ) : ?>
  <table class="table table-striped table-hover ">
    <thead>
      <tr class="info">
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ( $rows as $count => $row ) : ?>
        <tr>
          <td><?php echo $count + 1; ?></td>
          <td><?php echo $row['first_name']; ?></td>
          <td><?php echo $row['last_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><a class="btn label label-warning" href="<?php echo baseUrl() . '?page=admin&form=member_update&id=' . $row['id']; ?>">Edit</a></td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="member_id" value="<?php echo $row['id']; ?>">
              <button name="delete" type="submit" class="btn label label-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
