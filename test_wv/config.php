<?php

// Define database parameters
define( 'DB_HOST', 'localhost' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );
define( 'DB_NAME', 'test_worldvision' );

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
