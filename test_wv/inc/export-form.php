<?php
$db->query( "SELECT DISTINCT date( created_at ) AS created_at FROM members GROUP BY created_at" );

$rows = $db->resultset();
?>

<div class="well col-md-6 col-md-offset-6">

  <?php if ( isset( $error ) ) : ?>
    <p class="alert alert-danger">
      <?php echo $error; ?>
    </p>
  <?php endif; ?>

  <form action="" method="post">
    <fieldset>

      <legend>Export data to CSV</legend>

      <select name="date_range" class="form-control" id="select">
        <?php if ( count( $rows ) > 0 ) : ?>
          <option value="">All</option>
          <?php foreach ( $rows as $row ) {
            echo "<option value=" . $row['created_at'] . ">" . $row['created_at'] . "</option>";
          } ?>
        <?php endif; ?>
      </select>

      <br />

      <div class="row">

        <div class="col-md-8">
          <p>
            Select a date range above.
          </p>
        </div>

        <div class="col-md-4 text-right">
          <button class="btn btn-primary" type="submit" name="export">Export</button>
        </div>

      </div>

    </fieldset>
  </form>

</div>
