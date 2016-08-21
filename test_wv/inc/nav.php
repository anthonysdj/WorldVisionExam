<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">

    <div class="navbar-header">
      <a href="#" class="navbar-brand">World Vision</a>
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-main">
      <ul class="nav navbar-nav navbar-right">
        <?php if ( !isset( $_SESSION['logged_in'] ) ) : ?>
          <li><a href="<?php echo baseUrl(); ?>">Member Signup</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
              Admin <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo baseUrl() . '?page=admin&form=admin_register'; ?>">Admin Register</a></li>
              <li><a href="<?php echo baseUrl() . '?page=admin&form=admin_signin'; ?>">Admin Login</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <li><a href="#">Help</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>

  </div>
</nav>
