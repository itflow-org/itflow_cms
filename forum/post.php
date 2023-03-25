<?php
include("../admin/functions.php");
include("../config.php");
include("../check_login.php");  

if(isset($_POST['new_topic'])){
  $title = trim(strip_tags(mysqli_real_escape_string($mysqli,$_POST['title'])));
  $content = mysqli_real_escape_string($mysqli,$_POST['content']);
  $title_url = SeoUrl($title);

  mysqli_query($mysqli,"INSERT INTO posts SET post_title = '$title', post_url_title = '$title_url', post_content = '$content', post_by = $session_user_id");
  
  header("Location: /forum");
}

if(isset($_POST['reply'])){
  $post_id = intval($_POST['post_id']);
  $content = mysqli_real_escape_string($mysqli,$_POST['content']);

  mysqli_query($mysqli,"INSERT INTO replies SET reply_content = '$content', reply_by = $session_user_id, post_id = $post_id");
  header("Location: " . $_SERVER["HTTP_REFERER"]);
}

?>