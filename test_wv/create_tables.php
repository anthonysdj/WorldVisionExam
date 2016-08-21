<?php

// Create tables
try {
  $connect = new Database();

  // Create members table
  $create_table = "CREATE TABLE IF NOT EXISTS `members` (
                  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                  `first_name` VARCHAR(255) NOT NULL,
                  `last_name` VARCHAR(255) NOT NULL,
                  `email` VARCHAR(255) NOT NULL,
                  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`));";

  $connect->query( $create_table );
  $connect->execute();

  // Create users table
  $create_table2 = "CREATE TABLE IF NOT EXISTS `users` (
                   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                   `user_name` VARCHAR(255) NOT NULL,
                   `password` VARCHAR(255) NOT NULL,
                   `email` VARCHAR(255) NOT NULL,
                   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                   PRIMARY KEY (`id`));";

  $connect->query( $create_table2 );
  $connect->execute();
} catch( PDOException $e ) {
  echo 'Error: ' . $e->getMessage();
}

// close connection
$connect = null;
