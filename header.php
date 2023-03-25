<?php 
  include("config.php");
  include("check_login.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $config_meta_description; ?>">
    <meta name="author" content="<?php echo $config_meta_author; ?>">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $config_site_name; ?> <?php if(isset($page_title)){ echo "| $page_title"; } ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/starter-template.css" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
    <link href="/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
  </head>
  <body>
    
    <?php include("nav.php"); ?>
    
    <main class="container">
    