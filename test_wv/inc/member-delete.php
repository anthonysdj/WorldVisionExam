<?php
$id = $_POST['member_id'];

$db->query( "DELETE FROM members WHERE id = :id" );
$db->bind( ':id', $id );

$db->execute();

if ( $db->rowCount() > 0 ) {
  // $success = 'Delete success';

  header( "Location: " . baseUrl() . '?page=admin&form=member_list&success_delete=true' );
  exit;

} else {
  // $error = 'Something went wrong :(';

  header( "Location: " . baseUrl() . '?page=admin&form=member_list&error_delete=false' );
  exit;
}
