<?php
session_start();

require "config.php";
require "class/database.php";
require "create_tables.php";

$db = new Database();

if ( isset( $_GET['form'] ) && $_GET['form'] === 'export' ) {
  require "inc/export.php";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>World Vision Test</title>
    <link rel="stylesheet" href="css/superhero.bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <?php include "inc/nav.php"; ?>
    <!-- ********** End main navigation **********  -->

    <div class="container">
      <?php
      if ( !isset( $_GET['page'] ) )
        require "inc/home-page.php";
      if ( isset( $_GET['page'] ) && $_GET['page'] === 'admin' )
        require "inc/admin-page.php";
      ?>
    </div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p>&copy; <?php echo date('Y'); ?> Created by <a href="#" rel="nofollow">Anthony Dejesus</a>. Contact me at <a href="mailto:tonsdejesus@gmail.com">tonsdejesus@gmail.com</a>.</p>
          </div>
        </div>
      </div>
    </footer>

    <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>
