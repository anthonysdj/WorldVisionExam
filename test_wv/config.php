<?php

// Define database parameters
define( 'DB_HOST', 'localhost' );
define( 'DB_USER', 'your-database-user' );
define( 'DB_PASS', 'your-database-password' );
define( 'DB_NAME', 'your-database-name' );

function baseUrl()
{
  // check if $protocol in HTTP or HTTPS
  if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $protocol = "https";
  } else {
     $protocol = "http";
  }

  $hostName = $_SERVER['HTTP_HOST'];

  $path = $_SERVER['REQUEST_URI'];

  $url = $protocol . '://' . $hostName . $path;

  $url = parse_url( $url );

  // return full base url
  return $url['scheme'] . "://" . $url['host'] . $url['path'];
}
