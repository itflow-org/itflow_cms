<?php

$query = mysqli_query($mysqli,"SELECT * FROM settings WHERE setting_id = 1");

$row = mysqli_fetch_array($query);

// Basic Configuration
$config_site_name = htmlentities($row['config_site_name']);

// Meta Data
$config_meta_author = htmlentities($row['config_meta_author']);
$config_meta_description = htmlentities($row['config_meta_description']);

// Theme
$config_theme = htmlentities($row['config_theme']);

// Date Time Format 

$config_date_time_format = htmlentities($row['config_date_time_format']);

// Content

$config_footer_right = $row['config_footer_right'];

// Modules
$config_module_docs_enabled = intval($row['config_module_docs_enabled']);
$config_module_forum_enabled = intval($row['config_module_forum_enabled']);
$config_module_blog_enabled = intval($row['config_module_blog_enabled']);
$config_module_user_registration_enabled = intval($row['config_module_user_registration_enabled']);
