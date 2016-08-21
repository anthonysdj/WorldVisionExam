<?php
if ( isset( $_POST['export'] ) ) {
  $date_range = $_POST['date_range'];
  $fetchdates = array();

  $error = "";

  $db->query( "SELECT date( created_at ) FROM members" );

  $rows = $db->resultset();

  if ( count( $rows ) > 0 ) {
    foreach ( $rows as $row ) {
      array_push( $fetchdates, $row["date( created_at )"] );
    }
  }

  if ( !in_array( $date_range, $fetchdates ) && !empty( $date_range ) ) {
    $error = "Date range does not exist";
  }

  if ( empty( $error ) ) {
    $output = fopen('php://output', 'w');

    // Column headings
    fputcsv( $output, array( 'ID', 'First name', 'Last name', 'Email', 'Date' ) );

    // Fetch the data
    $query = "SELECT id, first_name, last_name, email, date( created_at ) FROM members";

    if ( !empty( $date_range ) ) {
      $query .= " WHERE date( created_at ) = :date";

      $db->query( $query );
      $db->bind( ':date', $date_range );
    } else {
      $db->query( $query );
    }

    $rows = $db->resultset();

    foreach ( $rows as $row ) {
      fputcsv( $output, $row );
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');

    exit();
  }
}
